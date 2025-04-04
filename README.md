# codeception-cucumber-selenium-example
Example project of BDD implementation with Codeception

## Application under test
The tests here were written to fit [https://github.com/andreasneuber/automatic-test-sample-site](https://github.com/andreasneuber/automatic-test-sample-site)

README in that project explains how to start the sample site.

## Setup tests
- `git clone`
- `composer install`
- Adjust config values in `codeception.dist.yml` as needed
- `php vendor/bin/codecept build`
- Start ChromeDriver `chromedriver --url-base=/wd/hub --port=9515`

## For developing new tests...
- Create a new feature file: `php vendor/bin/codecept g:feature acceptance <name of file without .feature extension>`
- Write your Gherkin scenarios
- Create a step definition class: `php vendor/bin/codecept generate:stepobject acceptance <your name>Steps`
- Create skeleton step definitions: `php vendor/bin/codecept gherkin:snippets acceptance`
- Copy terminal output of above command into steps definition class (or `AcceptanceTester.php` which is default)
- Implement logic inside new step definition functions
- Open file `codeception.yml` and add the new step definition class under "gherkin > contexts > default"

## How to run the tests locally
Start ChromeDriver: `chromedriver --url-base=/wd/hub --port=9515`

Then, best in another terminal window: `php vendor/bin/codecept run --steps --html`

`--steps` gives you more detailed output what test is doing. `--html` generates a HTML report in folder `_output`.

When developing a new test most likely you want to run only this one new test. Can be accomplished like this:

Add a tag to scenario
```gherkin
  @develop
  Scenario: Check if page returns something wonderful
    Given I am on the page
    When I do something interesting
    Then I will see something wonderful on the page
```

Add the tag as group parameter to CC run command
`php vendor/bin/codecept run -g develop --steps --html`

or

`clear && php vendor/bin/codecept clean && php vendor/bin/codecept run -g develop --steps --html`

## Running tests in pipeline
File `codeception.ci.yml` should have your optimized values for the CI pipeline.

The pipeline script will rename `codeception.ci.yml` to `codeception.yml`. This way in the hierarchy of config
files it will be used first, and `codeception.dist.yml` will be ignored.

## ChromeDriver + pipeline related...
The ChromeDriver and Chrome Google Browser versions should be always the same.

Get the latest Chromedriver for Linux first:

```
# .gitlab-ci.yml

  - version=$(curl -s https://googlechromelabs.github.io/chrome-for-testing/LATEST_RELEASE_STABLE)
  - wget -N https://edgedl.me.gvt1.com/edgedl/chrome/chrome-for-testing/${version}/linux64/chromedriver-linux64.zip
  - unzip chromedriver_linux64.zip
  - chmod +x chromedriver
  - cp chromedriver /usr/local/bin
  - rm chromedriver_linux64.zip chromedriver
  
  - chromedriver --url-base=/wd/hub &
  - sleep 5
```

You can also skip the last 2 lines in above snippet and start ChromeDriver directly in your codeception.yml file:
```
extensions:
  - Codeception\Extension\RunProcess:
      0: chromedriver --url-base=/wd/hub
      sleep: 5
```

## To-Do
Better handling of updating browser driver versions. 
