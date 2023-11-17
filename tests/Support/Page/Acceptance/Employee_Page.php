<?php

declare( strict_types=1 );

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;


class Employee_Page extends Base_Page {

	/**
	 * @var AcceptanceTester;
	 */
	protected AcceptanceTester $tester;

	public static string $URL = '/index.php?action=employee';


	protected static string $titleFindEmployee = "//h2[contains(text(),'Human Resources - Find employee')]";
	protected static string $inputEmployeeName = "#employee-name";
	protected static string $btnSearch = "#btnSearch";
	protected static string $tableEmployeeDetails = "#employee-details";
	protected static string $txtDepartment = ".employee.department";
	protected static string $txtEmployeeName = ".employee.name";

	public function __construct( AcceptanceTester $I ) {
		$this->tester = $I;
		// you can inject other page objects here as well
	}

	public function employeePageIsDisplayed(): bool {
		return $this->tester->pageHasElement( self::$titleFindEmployee );
	}

	public function fillEmployeeNameInput( $employeeName ): void
    {
		$this->tester->fillField( self::$inputEmployeeName, $employeeName );
	}

	public function clickSearchBtn(): void
    {
		$this->tester->click( self::$btnSearch );
	}

	public function employeeRecordIsDisplayed(): bool {
		return $this->tester->pageHasElement( self::$tableEmployeeDetails );
	}

	public function GrabEmployeeName() {
		return $this->tester->grabTextFrom( self::$txtEmployeeName );
	}

	public function GrabDepartmentName() {
		return $this->tester->grabTextFrom( self::$txtDepartment );
	}
}
