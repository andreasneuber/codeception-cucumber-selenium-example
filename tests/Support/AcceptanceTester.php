<?php

declare(strict_types=1);

namespace Tests\Support;

use Codeception\Actor;
use PHPUnit\Framework\AssertionFailedError;


class AcceptanceTester extends Actor
{
    use _generated\AcceptanceTesterActions;


    public function pageHasElement($element): bool
    {
        try {
            $this->seeElement($element);
        } catch (AssertionFailedError $exception) {
            return false;
        }

        return true;
    }

    public function pageHasText($text, $locator): bool
    {
        try {
            $this->see($text, $locator);
        } catch (AssertionFailedError $exception) {
            return false;
        }

        return true;
    }
}
