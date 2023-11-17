<?php

declare( strict_types=1 );

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;

class User_Account_Page extends Base_Page {

	/**
	 * @var AcceptanceTester;
	 */
	protected AcceptanceTester $tester;

	public static string $URL = '/index.php?action=useraccount';


	protected static string $titleAdminDashboard = "//h2[contains(text(),'Admin Dashboard')]";
	protected static string $linkHumanResources = "#hr-resources-link";
	protected static string $linkSalesStatistics = "#sales-statistics-link";
	protected static string $form_user_details = "#userDetails";
	protected static string $input_firstname = "#FirstName";
	protected static string $input_middle_name = "#MiddleName";
	protected static string $btn_save = "#btnSave";


	public function __construct( AcceptanceTester $I ) {
		$this->tester = $I;
		// you can inject other page objects here as well
	}


	public function form_is_loaded(): void {
		$this->tester->waitForElementVisible( self::$form_user_details );
	}

	public function admin_dashboard_is_displayed(): bool {
		return $this->tester->pageHasElement( self::$titleAdminDashboard );
	}

	public function grab_admin_dashboard_header_txt(): string {
		$this->tester->waitForElementVisible( self::$titleAdminDashboard );

		return $this->tester->grabTextFrom( self::$titleAdminDashboard );
	}

	public function provide_firstname( $firstname ): void {
		$this->tester->fillField( self::$input_firstname, $firstname );
	}

	public function grab_firstname(): ?string {
		return $this->tester->grabValueFrom( self::$input_firstname );
	}

	public function provide_middle_name( $middlename ): void {
		$this->tester->fillField( self::$input_middle_name, $middlename );
	}

	public function grab_middle_name(): ?string {
		return $this->tester->grabValueFrom( self::$input_middle_name );
	}

	public function save_data(): void {
		$this->tester->waitForElementClickable( self::$btn_save );
		$this->tester->click( self::$btn_save );
	}

	public function navigateToHumanResourcesSection(): void
    {
		$this->tester->waitForElementClickable( self::$linkHumanResources );
		$this->tester->click( self::$linkHumanResources );
	}

	public function navigateToSalesSection(): void
    {
		$this->tester->waitForElementClickable( self::$linkSalesStatistics );
		$this->tester->click( self::$linkSalesStatistics );
	}
}
