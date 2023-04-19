<?php

declare(strict_types=1);

namespace Tests\Support\Step\Acceptance;

use Tests\Support\Page\Acceptance\Employee_Page;
use Tests\Support\Page\Acceptance\Login_Page;
use Tests\Support\Page\Acceptance\Sales_Page;
use Tests\Support\Page\Acceptance\User_Account_Page;

class AdminPrivilegesSteps extends \Tests\Support\AcceptanceTester
{

    /**
     * @When /^I submit username "([^"]*)" and password "([^"]*)"$/
     */
    public function iSubmitUsernameAndPassword($username, $pw)
    {
        $login_page = new Login_Page($this);
        $login_page->add_credentials($username, $pw);
        $login_page->clickLogin();
    }

    /**
     * @Then /^I will be logged into the Admin Dashboard$/
     */
    public function iWillBeLoggedIntoTheAdminDashboard()
    {
        $user_account_page = new User_Account_Page($this);
        $this->assertTrue(
            $user_account_page->grab_admin_dashboard_header_txt() == 'Admin Dashboard',
            "Admin Dashboard is not displayed"
        );
    }

    /**
     * @When /^Admin searches for employee "([^"]*)"$/
     */
    public function adminSearchesForEmployee($employeeName)
    {
        $user_account_page = new User_Account_Page($this);
        $user_account_page->navigateToHumanResourcesSection();

        $employee_page = new Employee_Page($this);
        $this->assertTrue($employee_page->employeePageIsDisplayed(), "Employee Page is not displayed");

        $employee_page->fillEmployeeNameInput($employeeName);
        $employee_page->clickSearchBtn();
    }

    /**
     * @Then /^information appears that employee "([^"]*)" belongs to department "([^"]*)"$/
     */
    public function informationAppearsThatEmployeeBelongsToDepartment($expectedEmployeeName, $expectedDepartment)
    {
        $employee_page = new Employee_Page($this);
        $this->assertTrue($employee_page->employeeRecordIsDisplayed(), "No employee record is displayed");

        $actualEmployeeName = $employee_page->GrabEmployeeName();
        $this->assertEquals($expectedEmployeeName, $actualEmployeeName, "Expected employee name not found");

        $actualDepartmentName = $employee_page->GrabDepartmentName();
        $this->assertEquals($expectedDepartment, $actualDepartmentName, "Expected department name not found");
    }

    /**
     * @When /^Admin looks up total sales amount for month "([^"]*)" in year "([^"]*)"$/
     */
    public function adminLooksUpTotalSalesAmountForMonthInYear($month, $year)
    {
        $user_account_page = new User_Account_Page($this);
        $user_account_page->navigateToSalesSection();

        $sales_page = new Sales_Page($this);
        $this->assertTrue($sales_page->salesStatisticsPageIsDisplayed(), "Sales statistics Page is not displayed");
        $this->assertTrue(str_contains($sales_page->grabYearMonthHeader(), $year), "Year {$year} was not found.");
        $this->assertTrue($sales_page->monthCellIsDisplayed($month), "Month {$month} was not found.");
    }

    /**
     * @Then /^the total "([^"]*)" sales amount is "([^"]*)"$/
     */
    public function theTotalSalesAmountIs(string $month, string $expectedSalesAmount)
    {
        $sales_page        = new Sales_Page($this);
        $actualSalesAmount = $sales_page->grabSalesAmountFromMonth($month);
        $this->assertEquals($expectedSalesAmount, $actualSalesAmount, "Sales amount is not correct.");
    }

}
