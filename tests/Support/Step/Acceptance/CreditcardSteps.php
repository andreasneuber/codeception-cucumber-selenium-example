<?php

declare(strict_types=1);

namespace Tests\Support\Step\Acceptance;

use Tests\Support\AcceptanceTester;
use Tests\Support\Page\Acceptance\CC_Response_Page;
use Tests\Support\Page\Acceptance\CC_Entry_Page;

class CreditcardSteps extends AcceptanceTester
{

    /**
     * @Given User is on credit card entry page
     */
    public function userIsOnCreditCardEntryPage()
    {
        $cc_data_entry_page = new CC_Entry_Page($this);
        $cc_data_entry_page->show();
    }

    /**
     * @When User :name enters card number :ccnumber together with expiry date :expirydate and cvv :cvv
     */
    public function usernameEntersCardNumberccnumberTogetherWithExpiryDateexpirydateAndCvvcvv(
        $name,
        $ccnumber,
        $expirydate,
        $cvv
    ) {
        $this->waitForElementClickable('#btnPaynow');

        $this->fillField('#cname', $name);
        $this->fillField('#ccnum', $ccnumber);
        $this->fillField('#expdate', $expirydate);
        $this->fillField('#cvv', $cvv);

        $this->click('#btnPaynow');
    }

    /**
     * @Then the page will respond with :arg1 and provide as reason :arg2
     */
    public function thePageWillRespondWithresponseAndProvideAsReasonreason($response, $reason)
    {
        $this->wait(1);
        $this->see($response);
        $this->see($reason);
    }


    /**
     * @Given /^User is on card card entry page$/
     */
    public function userIsOnCardCardEntryPage()
    {
        $credit_card_entry_page = new CC_Entry_Page($this);
        $credit_card_entry_page->show();
        $this->maximizeWindow();
    }

    /**
     * @When /^User (.*) enters card number (.*) together with expiry date (.*) and cvv (.*)$/
     */
    public function userEntersCardNumberTogetherWithExpiryDateAndCvv($name, $cc_number, $expiry_date, $cvv)
    {
        $credit_card_entry_page = new CC_Entry_Page($this);
        $credit_card_entry_page->enterCardInformation($name, $cc_number, $expiry_date, $cvv);
        $credit_card_entry_page->submitPayment();
    }

    /**
     * @Then /^the page will respond with (.*) and provide as reason (.*)$/
     */
    public function thePageWillRespondWithAndProvideAsReason(string $expectedResponse, string $expectedReason)
    {
        $credit_card_response_page = new CC_Response_Page($this);
        $this->assertTrue($credit_card_response_page->getAlertMessageBox(), "Message alert box is not displayed");

        $response = $credit_card_response_page->grabResponseFromAlertBox();
        $this->assertTrue(
            str_contains($response, $expectedResponse),
            "Expected response '{$response}' to contain '{$expectedResponse}' but string could not be found."
        );

        $reason = $credit_card_response_page->grabMoreInfoFromAlertBox();
        $this->assertTrue(
            str_contains($reason, $expectedReason),
            "Expected reason '{$reason}' to contain '{$expectedReason}' but string could not be found."
        );
    }

}
