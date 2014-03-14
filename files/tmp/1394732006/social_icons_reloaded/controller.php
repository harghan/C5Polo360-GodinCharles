<?php 

defined('C5_EXECUTE') or die(_("Access Denied."));

class SocialIconsReloadedPackage extends Package {

	protected $pkgHandle = 'social_icons_reloaded';
	protected $appVersionRequired = '5.4.2';
	protected $pkgVersion = '2.0';

	public function getPackageDescription() {
		return t("A Social icons block with 69 icons");
	}

	public function getPackageName() {
		return t("Social Icons Reloaded");
	}

	public function install() {
		$pkg = parent::install();

		// install block
		BlockType::installBlockTypeFromPackage('social_icons_reloaded', $pkg);

	}
}