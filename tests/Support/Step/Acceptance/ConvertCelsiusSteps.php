<?php

declare(strict_types=1);

namespace Tests\Support\Step\Acceptance;

use Tests\Support\AcceptanceTester;
use Tests\Support\Page\Acceptance\CelsiusToFahrenheitPage;

class ConvertCelsiusSteps extends AcceptanceTester
{


    /**
     * @Given /^I provide "([^"]*)" degree Celsius$/
     */
    public function iProvideDegreeCelsius($celsius)
    {
        $celsius_fahrenheit_page = new CelsiusToFahrenheitPage($this);

        $celsius_fahrenheit_page->show();
        $this->maximizeWindow();
        $celsius_fahrenheit_page->provideCelsius($celsius);
    }

    /**
     * @When /^I click the convert button$/
     */
    public function iClickTheConvertButton()
    {
        $celsius_fahrenheit_page = new CelsiusToFahrenheitPage($this);
        $celsius_fahrenheit_page->clickConvert();
    }

    /**
     * @Then /^I should see as result "([^"]*)" Fahrenheit$/
     */
    public function iShouldSeeAsResultFahrenheit(string $expectedFahrenheit)
    {
        $celsius_fahrenheit_page = new CelsiusToFahrenheitPage($this);
        $actualFahrenheit        = $celsius_fahrenheit_page->readFahrenheitField();
        $this->assertEquals($actualFahrenheit, $expectedFahrenheit);
    }

}
