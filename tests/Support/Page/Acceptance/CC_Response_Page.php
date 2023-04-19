<?php

declare( strict_types=1 );

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;


class CC_Response_Page extends Base_Page {

	/**
	 * @var AcceptanceTester;
	 */
	protected AcceptanceTester $tester;

	public static string $URL = '/index.php?action=responsecc';

	protected static string $txtResponse = "//strong[@class='response']";
	protected static string $txtMoreInfo = "//span[@class='more-info']";
	protected static string $alertMessage = "//div[contains(@class, 'alert')]";


	public function __construct( AcceptanceTester $I ) {
		$this->tester = $I;
		// you can inject other page objects here as well
	}

	public function getAlertMessageBox(): bool {
		return $this->tester->pageHasElement( self::$alertMessage );
	}

	public function grabResponseFromAlertBox(): string {
		$this->tester->waitForElementVisible( self::$txtResponse );

		return $this->tester->grabTextFrom( self::$txtResponse );
	}

	public function grabMoreInfoFromAlertBox(): string {
		$this->tester->waitForElementVisible( self::$txtMoreInfo );

		return $this->tester->grabTextFrom( self::$txtMoreInfo );
	}
}
