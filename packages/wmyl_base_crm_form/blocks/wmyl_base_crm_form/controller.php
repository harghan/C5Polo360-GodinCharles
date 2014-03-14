<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

Loader::model('config', 'wmyl_base_crm_form');

class WmylBaseCrmFormBlockController extends BlockController {
	
	protected $btTable = "btBaseCrmForm";
	protected $btInterfaceWidth = "400";
	protected $btInterfaceHeight = "600";

	private $apiUrl = 'https://sales.futuresimple.com/api/v1/';
	private $authenticationToken = null;

	public function getBlockTypeName() {
		return t('Base CRM Contact Form');
	}

	public function getBlockTypeDescription() {
		return t('Creates a contact form that integrates with Base CRMs API');
	}

	public function action_submit() {

		$th = Loader::helper('text');
		$validation = $this->getValidation();

		if($validation->test()) {
			$contactId = $this->getContactId($th->sanitize($_POST['email']), $th->sanitize($_POST['first_name']), $th->sanitize($_POST['last_name']), $th->sanitize($_POST['mobile']));
			$this->createDeal($contactId, $th->sanitize($_POST['message']));
			$this->set('success', true);
		}
		else {
			$this->set('success', false);
			$this->set('error', $validation->getError());
			$this->set('fields', $_POST);
		}
	}

	/**
	 * @return mixed
	 */
	private function getValidation() {
		$validation = Loader::helper('validation/form');
		$validation->addRequired('first_name', t('Please enter your first name'));
		$validation->addRequired('last_name', t('Please enter your last name'));
		$validation->addRequiredEmail('email', t('Please enter your e-mail address'));
		$validation->addRequired('mobile', t('Please enter your mobile phone number'));
		$validation->addRequired('message', t('Please enter a message'));
		$validation->setData($_POST);
		return $validation;
	}

	/**
	 * @return mixed
	 */
	private function getContactId($email, $firstName, $lastName, $mobile) {
		$search = (object)array('email' => $email);
		$contact = $this->callApi('contacts.json', 'GET', $search);
		if (count($contact) < 1)
			$contact = $this->createIndividualContact($email, $firstName, $lastName, $mobile);
		else {
			$contact = $contact[0];
		}
		return $contact->contact->id;
	}

	/**
	 * @return mixed
	 */
	private function createIndividualContact($email, $firstName, $lastName, $mobile) {
		$contact = (object)array(
			'contact' => array(
				'first_name' => $firstName,
				'last_name' => $lastName,
				'email' => $email,
				'mobile' => $mobile,
				'is_organization' => false,
				'tag_list' => $this->tag
			)
		);
		return $this->callApi('contacts.json', 'POST', $contact);
	}

	/**
	 * @return mixed
	 */
	private function createOrganizationContact($organizationName) {
		$contact = (object)array(
			'contact' => array(
				'name' => $organizationName,
				'is_organization' => true
			)
		);
		return $this->callApi('contacts.json', 'POST', $contact);
	}

	/**
	 * @return mixed
	 */
	private function createDeal($contactId, $message = '', $subject = '') {
		$deal = new stdClass();
		$deal->name = t('Incoming from contact form');
		if($message != '') {
			$deal->name = substr($message, 0, 24);
		}
		if($subject != '') {
			$deal->name = $subject;
		}
		$deal->entity_id = $contactId;
		$deal->deal_tags = $this->tag;
		$deal->stage = 'incoming';
		$deal = $this->callApi('deals.json', 'POST', $deal);
		if($message != '') {
			$this->createDealNote($deal->deal->id, $message);
		}

		return $deal;
	}

	private function createDealNote($dealId, $message) {
		$note = (object)array(
			'note' => array(
				'content' => $message
			)
		);
		return $this->callApi('deals/' . $dealId . '/notes.json', 'POST', $note);
	}

	private function callApi($uri, $method, $data = '') {

		$this->authenticate($uri);
		$jsonHelper = Loader::helper('json');
		$dataString = $jsonHelper->encode($data);

		$ch = curl_init($this->apiUrl . $uri);
		$headers = array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($dataString)
		);
		if($this->authenticationToken != null) {
			$headers[] = 'X-Pipejump-Auth: ' . $this->authenticationToken->authentication->token;
		}
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);
		$jsonResult = $jsonHelper->decode($result);

		if($jsonResult === null) {
			throw new Exception(t('API call failed curl error: %s call returned: %s', curl_error($ch), $result));
		}

		return $jsonResult;
	}

	/**
	 * @param $uri
	 */
	private function authenticate($uri) {
		if ($uri != 'authentication.json' && $this->authenticationToken == null) {

			$config = new CrmConfig();

			$user = new stdClass();
			$user->email = $config->get('username');
			$user->password = $config->get('password');
			$authenticationToken = $this->callApi('authentication.json', 'POST', $user);

			if($authenticationToken === null) {
				throw new Exception(t('Could not authenticate with Base. Are you sure you have the correct username / password?'));
			}

			$this->authenticationToken = $authenticationToken;
		}
	}


	public function save($data) {

		parent::save($data);

		$config = new CrmConfig();

		$username = $config->get('username');
		$password = $config->get('password');

		if(empty($username) && empty($password)) {
			throw new Exception(t('Cannot save. You need set the username and password to Base CRM under System & Settings / Enviroment / Base CRM Configuration.'));
		}

	}
}
