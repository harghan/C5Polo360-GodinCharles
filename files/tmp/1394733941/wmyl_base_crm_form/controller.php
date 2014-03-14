<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

Loader::model('block_types');

class WmylBaseCrmFormPackage extends Package {

	protected $pkgHandle = 'wmyl_base_crm_form';
	protected $appVersionRequired = '5.6.0';
	protected $pkgVersion = '0.9';

	public function getPackageDescription() {
		return t('Creates a contact form that integrates with Base CRMs API');
	}

	public function getPackageName() {
		return t('Base CRM Contact Form');
	}

	public function install() {

		if  (!in_array  ('curl', get_loaded_extensions())) {
			throw new Exception(t('You need to install and activate curl for this plugin to work'));
		}

		parent::install();

		$this->configure();

	}

	public function configure(){

		$pkg = Package::getByHandle($this->pkgHandle);
		$this->pkg = $pkg;

		if (! BlockType::getByHandle('wmyl_base_crm_form')) {
			BlockType::installBlockTypeFromPackage('wmyl_base_crm_form', $pkg);
		}

		$this->addSingle('/dashboard/system/environment/crm', t('Base CRM Configuration'), 'cog');
	}


	public function uninstall() {
		parent::uninstall();
	}

	/**
     * Helper function to check if a page exists and, if not, 1) add as a single page, 2) set the name of the page, and 3) add any text content blocks
     * @param string $path Page path
     * @param string $name Page name
     * @param bool $redirectToFirstChild Set the attribute that this link redirects to the first child in the autonav
     * @param bool $excludeFromNav Set the attribute that this page is excluded from the autonav
     */
    private function addSingle($path, $name, $icon = '') {
        $page = Page::getByPath($path);
        if (! is_object($page) ||  ($page->isError() && $page->getError() == COLLECTION_NOT_FOUND)) {
            $page = SinglePage::add($path, $this->pkg);
            $page->update(array('cName'=>t($name)));

            if ($icon && CollectionAttributeKey::getByHandle('icon_dashboard')) {
            	$page->setAttribute('icon_dashboard', "icon-$icon");
            }
        }

        return $page;
    }

}	