<?php  defined('C5_EXECUTE') or die('Access Denied.');

//might need to make this support deep arrays. http://www.php.net/manual/en/function.array-intersect-key.php#93720 wouldn't be too hard, with html forms[]


class BaseCrmNoSql {
	protected $fields = array();
	protected $fieldsAsKeys = array();

	protected $data = array();

	public function __construct($validFields, $data = null, $defaults = null) {
		if (is_array($validFields)) {
			if ($this->isAssoc($validFields)) {
				$this->fields = array_keys($validFields);
			} else {
				$this->fields = $validFields;
			}
		} else {
			$this->fields = array_filter(explode(',', $validFields));
		}
		$this->fieldsAsKeys = array_fill_keys($this->fields, '');

		$this->setData($data, $defaults);
	}

	public function setData($data, $defaults = array()) {
		//might run into a problem where data is set multiple times
		$this->data = array_merge($this->parseData($defaults), $this->parseData($data));

		return $this;
	}

	public function __get($prop) {
		return isset($this->data[$prop]) ? $this->data[$prop] : null;
	}

	public function __set($prop, $val) {
		$this->data[$prop] = $val;
	}

	public function getData($keys = null) {
		if ($keys) {
			if (! is_array($keys)) {
				$keys = explode(',', $keys);
			}

			$data = array_intersect_key($this->data, array_fill_keys($keys, ''));
		} else {
			$data = $this->data;
		}

		return $data;
	}

	private function object_to_array($data) {
		if(is_array($data) || is_object($data)){
		$result = array();
		foreach($data as $key => $value){
			$result[$key] = $this->object_to_array($value);
		}
		return $result;
	}
	return $data;
	}

	public function asJSON($keys = null) {

		$json = Loader::helper('json');

		return $json->encode($this->getData($keys));
	}

	public function __toString() {
		return $this->asJSON();
	}

	protected function parseData($data) {

		$json = Loader::helper('json');

		if (is_array($data)) {
			return array_intersect_key($data, $this->fieldsAsKeys);
		} else if ($data && ($data = $this->object_to_array($json->decode($data)))) {
			return array_intersect_key($data, $this->fieldsAsKeys);
		} else {
			return array();
		}
	}

	//http://stackoverflow.com/a/4254008/121861
	protected function isAssoc($array) {
		return (bool) count(array_filter(array_keys($array), 'is_string'));
	}
}