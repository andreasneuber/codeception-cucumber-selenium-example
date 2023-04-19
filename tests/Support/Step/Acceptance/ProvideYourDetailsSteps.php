<?php

declare(strict_types=1);

namespace Tests\Support\Step\Acceptance;

use Behat\Gherkin\Node\TableNode;
use Tests\Support\AcceptanceTester;
use Tests\Support\Page\Acceptance\Provide_Your_Details_Page;
use Tests\Support\Page\Acceptance\Thank_You_Page;

class ProvideYourDetailsSteps extends AcceptanceTester
{


    /**
     * @Given /^I navigate to Information about yourself page$/
     */
    public function iNavigateToInformationAboutYourselfPage()
    {
        $provide_your_details = new Provide_Your_Details_Page($this);
        $provide_your_details->show();
        $this->maximizeWindow();
    }

    /**
     * @When /^I provide the following details$/
     */
    public function iProvideTheFollowingDetails(TableNode $table)
    {
        $tableRows            = $table->getRowsHash();
        $provide_your_details = new Provide_Your_Details_Page($this);

        $provide_your_details->provideFirstname($tableRows['firstname']);
        $provide_your_details->provideLastName($tableRows['lastname']);
        $provide_your_details->provideStreet($tableRows['street']);
        $provide_your_details->provideCity($tableRows['city']);
        $provide_your_details->provideZip($tableRows['zip']);
        $provide_your_details->provideState($tableRows['state']);
        $provide_your_details->provideCountry($tableRows['country']);
        $provide_your_details->provideMobilePhoneNumber($tableRows['mobile phone']);
        $provide_your_details->provideHomePhoneNumber($tableRows['home phone']);
        $provide_your_details->provideEmail($tableRows['email']);

        $provide_your_details->clickSubmitYourInformation();
    }

    /**
     * @Then /^I will see message "([^"]*)"$/
     */
    public function iWillSeeMessage($expectedMessage)
    {
        $thank_you_page = new Thank_You_Page($this);
        $actualMessage  = $thank_you_page->grabThankYouMessage();
        $this->assertEquals($expectedMessage, $actualMessage);
    }

}
