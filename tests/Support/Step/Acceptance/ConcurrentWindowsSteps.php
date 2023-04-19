<?php

declare(strict_types=1);

namespace Tests\Support\Step\Acceptance;

use Codeception\Lib\Actor\Shared\Friend;
use Tests\Support\AcceptanceTester;

class ConcurrentWindowsSteps extends AcceptanceTester
{
    use Friend;

    private \Codeception\Lib\Friend $orangePage;
    private \Codeception\Lib\Friend $greenPage;
    private \Codeception\Lib\Friend $brownPage;


    /**
     * @Given /^different people went to different sites$/
     */
    public function differentPeopleWentToDifferentSites()
    {
        // While executing this 4 windows will be open. 1x standard window, 3x friends.
        $this->orangePage = $this->haveFriend('orangePage');
        $this->orangePage->does(function () {
            $this->amOnPage('/index.php?action=orangePage');
        });

        $this->greenPage = $this->haveFriend('greenPage');
        $this->greenPage->does(function () {
            $this->amOnPage('/index.php?action=greenPage');
        });

        $this->brownPage = $this->haveFriend('brownPage');
        $this->brownPage->does(function () {
            $this->amOnPage('/index.php?action=brownPage');
        });
    }

    /**
     * @When /^they realize that they forgot what they actually wanted to do there$/
     */
    public function theyRealizeThatTheyForgotWhatTheyActuallyWantedToDoThere()
    {
        $this->orangePage->does(function () {
            echo("Wait a minute ...");
            echo("We forgot that we are so forgetful.");
        });

        $this->greenPage->does(function () {
            echo("Wait a minute ...");
            echo("We forgot that we are so forgetful.");
        });

        $this->brownPage->does(function () {
            echo("Wait a minute ...");
            echo("We forgot that we are so forgetful.");
        });
    }

    /**
     * @Then /^they leave the sites again$/
     */
    public function theyLeaveTheSitesAgain()
    {
        // "leave" means the window is closed
        $this->orangePage->leave();
        $this->greenPage->leave();
        $this->brownPage->leave();
    }

}
