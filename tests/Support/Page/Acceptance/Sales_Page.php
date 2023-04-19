<?php

declare( strict_types=1 );

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;


class Sales_Page extends Base_Page {

	/**
	 * @var AcceptanceTester;
	 */
	protected AcceptanceTester $tester;

	public static string $URL = '/index.php?action=sales';

	protected static string $titleSalesStatistics = "//h2[contains(text(),'Sales - Statistics')]";
	protected static string $salesYearMonthHeader = ".sales.header-year-month";
	protected static string $monthCell = "//td[contains(text(), '%s')]";
	public static string $monthSalesCell = "//td[contains(text(), '%s')]/following-sibling::td";


	public function __construct( AcceptanceTester $I ) {
		$this->tester = $I;
		// you can inject other page objects here as well
	}

	public function salesStatisticsPageIsDisplayed(): bool {
		return $this->tester->pageHasElement( self::$titleSalesStatistics );
	}

	public function grabYearMonthHeader(): string {
		return $this->tester->grabTextFrom( self::$salesYearMonthHeader );
	}

	public function monthCellIsDisplayed( string $month ): bool {
		$completeXpath = sprintf( self::$monthCell, $month );

		return $this->tester->pageHasElement( $completeXpath );
	}

	public function grabSalesAmountFromMonth( string $month ): string {
		$completeXpath = sprintf( self::$monthSalesCell, $month );

		//$el            = driver . findElement( By . xpath( completeXpath ) );

		return $this->tester->grabTextFrom( $completeXpath );
	}
}
