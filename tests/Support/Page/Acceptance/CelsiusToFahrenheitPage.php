<?php

declare( strict_types=1 );

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;


class CelsiusToFahrenheitPage extends Base_Page {

	/**
	 * @var AcceptanceTester;
	 */
	protected AcceptanceTester $tester;

	public static string $URL = '/index.php?action=form6';

	public static string $inputCelsius = "//input[@name='celsius']";
	public static string $inputFahrenheit = "//input[@name='fahrenheit']";
	public static string $btnConvert = "//input[@name='Convert']";


	public function __construct(AcceptanceTester $I)
	{
		$this->tester = $I;
		// you can inject other page objects here as well
	}

	public function provideCelsius( string $celsiusDegrees ) {
		$this->tester->clearField( self::$inputCelsius );
		$this->tester->fillField( self::$inputCelsius, $celsiusDegrees );
	}

	public function clickConvert() {
		$this->tester->waitForElementClickable( self::$btnConvert );
		$this->tester->click( self::$btnConvert );
	}

	public function readFahrenheitField(): string {
		return $this->tester->grabAttributeFrom(self::$inputFahrenheit, 'value');
	}
}
