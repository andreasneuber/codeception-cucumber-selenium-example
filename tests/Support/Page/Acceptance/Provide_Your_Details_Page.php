<?php

declare( strict_types=1 );

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;


class Provide_Your_Details_Page extends Base_Page {

	/**
	 * @var AcceptanceTester;
	 */
	protected AcceptanceTester $tester;

	public static string $URL = '/index.php?action=form1';

	protected static string $inputFirstName = "#fname";
	protected static string $inputLastName = "#lname";
	protected static string $inputStreet = "#street";
	protected static string $inputCity = "#city";
	protected static string $inputZip = "#zip";
	protected static string $inputState = "#state";
	protected static string $inputCountry = "#country";
	protected static string $inputMobilePhoneNumber = "#mobile";
	protected static string $inputHomePhoneNumber = "#home";
	protected static string $inputEmail = "#email";
	protected static string $btnSubmit = "#submit-info";
	protected static string $titleForm = "//h2[contains(text(),'Form 1 - Information about yourself')]";


	public function __construct( AcceptanceTester $I ) {
		$this->tester = $I;
		// you can inject other page objects here as well
	}

	public function provideFirstname( string $firstName ): void
    {
		$this->tester->waitForElementVisible( self::$inputFirstName );
		$this->tester->fillField( self::$inputFirstName, $firstName );
	}

	public function provideLastName( string $lastName ): void
    {
		$this->tester->waitForElementVisible( self::$inputLastName );
		$this->tester->fillField( self::$inputLastName, $lastName );
	}

	public function provideStreet( string $street ): void
    {
		$this->tester->waitForElementVisible( self::$inputStreet );
		$this->tester->fillField( self::$inputStreet, $street );
	}

	public function provideCity( string $city ): void
    {
		$this->tester->waitForElementVisible( self::$inputCity );
		$this->tester->fillField( self::$inputCity, $city );
	}

	public function provideZip( string $zipCode ): void
    {
		$this->tester->waitForElementVisible( self::$inputZip );
		$this->tester->fillField( self::$inputZip, $zipCode );
	}

	public function provideState( string $state ): void
    {
		$this->tester->waitForElementVisible( self::$inputState );
		$this->tester->fillField( self::$inputState, $state );
	}

	public function provideCountry( string $country ): void
    {
		$this->tester->waitForElementVisible( self::$inputCountry );
		$this->tester->fillField( self::$inputCountry, $country );
	}

	public function provideMobilePhoneNumber( string $number ): void
    {
		$this->tester->waitForElementVisible( self::$inputMobilePhoneNumber );
		$this->tester->fillField( self::$inputMobilePhoneNumber, $number );
	}

	public function provideHomePhoneNumber( string $number ): void
    {
		$this->tester->waitForElementVisible( self::$inputHomePhoneNumber );
		$this->tester->fillField( self::$inputHomePhoneNumber, $number );
	}

	public function provideEmail( string $email ): void
    {
		$this->tester->waitForElementVisible( self::$inputEmail );
		$this->tester->fillField( self::$inputEmail, $email );
	}

	public function clickSubmitYourInformation(): void
    {
		$this->tester->waitForElementClickable(self::$btnSubmit );
		$this->tester->click(self::$btnSubmit );
	}
}
