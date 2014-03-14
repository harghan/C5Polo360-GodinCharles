<?php  defined('C5_EXECUTE') or die('Access Denied.');

Loader::model('nosql', 'wmyl_base_crm_form');

class CrmConfig {
	protected $co;
	protected $nosql;

	protected $fields = 'username,password';

	public function __construct() {
		$this->co = new Config();
		$this->co->setPackageObject(Package::getByHandle('wmyl_base_crm_form'));

		$this->nosql = new BaseCrmNoSql($this->fields, $this->co->get('site_config'), $this->defaults);
	}

	public function get($key) {
		return $this->nosql->$key;
	}

	public function set($data) {
		$this->nosql->setData($data);
	}

	public function getData($keys = null) {
		return $this->nosql->getData($keys);
	}

	public function getAll($keys = null) {
		return $this->nosql->asJSON($keys);
	}

	public function save() {
		$this->co->save('site_config', $this->nosql->asJSON());
	}
}