<?php

declare( strict_types=1 );

namespace Tests\Support\Step\Acceptance;

use Behat\Gherkin\Node\TableNode;
use Tests\Support\AcceptanceTester;
use Tests\Support\Page\Acceptance\Login_Page;
use Tests\Support\Page\Acceptance\User_Account_Page;


class LoginSteps extends AcceptanceTester {

	/**
	 * @Given I navigate to login page
	 */
	public function iNavigateToLoginPage() {
		$login_page = new Login_Page( $this );
		$login_page->show();
		//$this->maximizeWindow();
	}

	/**
	 * @Given I enter username :arg1 and password :arg2 as credentials
	 */
	public function iEnterUsernameAndPasswordAsCredentials( $username, $password ) {
		$login_page = new Login_Page( $this );
		$login_page->add_credentials( $username, $password );
	}


	/**
	 * @Given I enter following for login
	 */
	public function iEnterFollowingForLogin( TableNode $table ) {
		$login_page = new Login_Page( $this );
		$login_page->form_is_loaded();

		$tableRows = $table->getHash();

		foreach ( $tableRows as $row ) {
			$login_page->add_credentials( $row['username'], $row['password'] );
		}
	}

	/**
	 * @Given I enter following credentials for login
	 */
	public function iEnterFollowingCredentialsForLogin( TableNode $table ) {
		$login_page = new Login_Page( $this );
		$login_page->form_is_loaded();

		$rows = $table->getRowsHash();
		$login_page->add_credentials( $rows['username'], $rows['password'] );
	}

	/**
	 * @When I click login button
	 */
	public function iClickLoginButton() {
		$login_page = new Login_Page( $this );
		$login_page->clickLogin();
	}

	/**
	 * @Then I will see user form page correctly
	 */
	public function iWillSeeUserFormPageCorrectly() {
		$user_account_page = new User_Account_Page( $this );

		$user_account_page->form_is_loaded();
		$this->see( 'User Account', 'h2' );
	}


    /**
     * @Then /^I should be able to access the protected area$/
     */
    public function iShouldBeAbleToAccessTheProtectedArea()
    {
        $user_account_page = new User_Account_Page($this);
        $this->assertTrue($user_account_page->admin_dashboard_is_displayed(), "Admin Dashboard Is not displayed");
    }

    /**
     * @Given /^I enter following values to login$/
     */
    public function iEnterFollowingValuesToLogin(TableNode $table)
    {
        # TableNode is defined in vendor\behat\gherkin\src\Behat\Gherkin\Node\TableNode.php
        # See also https://behat.org/en/latest/user_guide/writing_scenarios.html

        $login_page = new Login_Page($this);
        $login_page->form_is_loaded();

        $tableRows = $table->getRowsHash();
        $login_page->add_credentials($tableRows['username'], $tableRows['password']);
    }


}
