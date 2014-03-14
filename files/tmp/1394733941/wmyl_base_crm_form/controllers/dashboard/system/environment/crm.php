<?php  defined('C5_EXECUTE') or die("Access Denied.");

Loader::model('config', 'wmyl_base_crm_form');

class DashboardSystemEnvironmentCrmController extends Controller {
	public function view() {

		$config = new CrmConfig();

		if (isset($_GET['saved'])) {
			$this->set('message', t('Configuration Updated'));
		}

		$this->set('config', $config);
	}

	public function save() {
		if (Loader::helper('validation/token')->validate('form-config')) {
			$config = new CrmConfig();
			$config->set($_POST);
			$config->save();
		}

		$this->redirect('/dashboard/system/environment/crm?saved=1');
	}
}

?>