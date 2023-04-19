<?php

declare( strict_types=1 );

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;
use Tests\Support\Page\Acceptance\Base_Page;


class Thank_You_Page extends Base_Page {

	/**
	 * @var AcceptanceTester;
	 */
	protected AcceptanceTester $tester;

	public static string $URL = '/index.php?action=thankYou';

	protected static string $txtThankYou = '//h2';


	public function __construct( AcceptanceTester $I ) {
		$this->tester = $I;
		// you can inject other page objects here as well
	}


	public function grabThankYouMessage(): string {
		$this->tester->waitForElementVisible( self::$txtThankYou );

		return $this->tester->grabTextFrom( self::$txtThankYou );
	}

}
