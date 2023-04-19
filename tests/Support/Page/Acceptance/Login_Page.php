<?php

declare(strict_types=1);

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;


class Login_Page extends Base_Page
{

    /**
     * @var AcceptanceTester;
     */
    protected AcceptanceTester $tester;

    public static string $URL = '/index.php?action=form4';

    protected static string $inputUserName = "//input[@name='user']";
    protected static string $inputPassWord = "//input[@name='pw']";
    protected static string $btnLogin = "//input[@name='Login']";
    protected static string $formLogin = '#loginform';

    public function __construct(AcceptanceTester $I)
    {
        $this->tester = $I;
        // you can inject other page objects here as well
    }

    public function form_is_loaded(): void
    {
        $this->tester->waitForElementVisible(self::$formLogin);
    }

    public function add_credentials(string $userName, string $password): void
    {
        $this->tester->waitForElementVisible(self::$inputUserName);
        $this->tester->waitForElementVisible(self::$inputPassWord);

        $this->tester->fillField(self::$inputUserName, $userName);
        $this->tester->fillField(self::$inputPassWord, $password);
    }

    public function clickLogin(): void
    {
        $this->tester->waitForElementClickable(self::$btnLogin);
        $this->tester->click(self::$btnLogin);
    }

}
