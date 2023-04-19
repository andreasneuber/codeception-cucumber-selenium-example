<?php

declare(strict_types=1);

namespace Tests\Support\Step\Acceptance;

use Tests\Support\AcceptanceTester;
use Tests\Support\Page\Acceptance\Login_Page;
use Tests\Support\Page\Acceptance\User_Account_Page;

class UserAccountSteps extends AcceptanceTester
{

	/**
	 * @Given I am logged in as administrator with username :arg1 and password :arg2
	 */
	public function iAmLoggedInAsAdministratorWithUsernameAndPassword( $username, $pw ) {
		$this->amOnPage( '/index.php?action=form4' );
		$login_page = new Login_Page( $this );
		$login_page->add_credentials( $username, $pw );
		$login_page->clickLogin();
	}

	/**
	 * @Given /^I open the user account page$/
	 */
	public function iOpenTheUserAccountPage() {
		$user_account_page = new User_Account_Page( $this );
		$user_account_page->form_is_loaded();
	}

	/**
	 * @When /^I fill as first name "([^"]*)"$/
	 */
	public function iFillAsFirstName( $firstname ) {
		$user_account_page = new User_Account_Page( $this );
		$user_account_page->provide_firstname( $firstname );
	}

	/**
	 * @Given /^save the user account data$/
	 */
	public function saveTheUserAccountData() {
		$user_account_page = new User_Account_Page( $this );
		$user_account_page->save_data();
	}

	/**
	 * @Then /^I will see as firstname "([^"]*)"$/
	 */
	public function iWillSeeAsFirstname( $expectedFirstname ) {
		$user_account_page = new User_Account_Page( $this );
		$actualFirstName   = $user_account_page->grab_firstname();
		$this->assertTrue( $expectedFirstname === $actualFirstName, "error message - first name" );
	}

	/**
	 * @When I fill as middle name :arg1
	 */
	public function iFillAsMiddleName( $middleName ) {
		$user_account_page = new User_Account_Page( $this );
		$user_account_page->provide_middle_name( $middleName );
	}

	/**
	 * @Then I will see as middle name :arg1
	 */
	public function iWillSeeAsMiddleName( $expectedMiddleName ) {
		$user_account_page = new User_Account_Page( $this );
		$actualMiddleName  = $user_account_page->grab_middle_name();
		$this->assertTrue( $expectedMiddleName === $actualMiddleName, "error message - middle name" );
	}

}
