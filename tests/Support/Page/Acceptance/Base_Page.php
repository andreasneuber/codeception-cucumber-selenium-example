<?php

declare(strict_types=1);

namespace Tests\Support\Page\Acceptance;

use Tests\Support\AcceptanceTester;

class Base_Page
{
    /**
     * @var AcceptanceTester;
     */
    protected AcceptanceTester $tester;

    public static string $URL;

    public function show(): string
    {
        $this->tester->amOnPage(static::$URL);
        return static::$URL;
    }

}