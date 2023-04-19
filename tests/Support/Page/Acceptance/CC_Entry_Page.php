<?php

declare( strict_types=1 );

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;

class CC_Entry_Page extends Base_Page {

	/**
	 * @var AcceptanceTester;
	 */
	protected AcceptanceTester $tester;

	public static string $URL = '/index.php?action=form3';

	protected static string $inputCardname = '#cname';
	protected static string $inputCcnumber = '#ccnum';
	protected static string $inputExpirydate = '#expdate';
	protected static string $inputCvv = '#cvv';
	protected static string $btnPayNow = "//input[@name='paynow']";
	protected static string $formCreditCardInfoEntry = '#ccentry';


	public function __construct( AcceptanceTester $I ) {
		$this->tester = $I;
		// you can inject other page objects here as well
	}

	public function enterCardInformation(
		string $cardname,
		string $ccnumber,
		string $expiryDate,
		string $cvv
	) {
		$this->tester->waitForElementVisible( self::$inputCardname );
		$this->tester->fillField( self::$inputCardname, $cardname );

		$this->tester->waitForElementVisible( self::$inputCcnumber );
		$this->tester->fillField( self::$inputCcnumber, $ccnumber );

		$this->tester->waitForElementVisible( self::$inputExpirydate );
		$this->tester->fillField( self::$inputExpirydate, $expiryDate );

		$this->tester->waitForElementVisible( self::$inputCvv );
		$this->tester->fillField( self::$inputCvv, $cvv );
	}

	public function submitPayment() {
		$this->tester->waitForElementClickable( self::$btnPayNow );
		$this->tester->click( self::$btnPayNow );
	}

	public function getCreditCardInfoEntryForm(): bool {
		return $this->tester->pageHasElement(self::$formCreditCardInfoEntry);
	}
}
