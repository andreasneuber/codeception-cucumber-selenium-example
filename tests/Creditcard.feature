Feature: Creditcard Feature
  Description: The purpose of this feature is to illustrate the usage of a scenario outline

  While working on this noticed that PHPStorm had problems with example column names using hyphens when creating step definitions.
  Therefore changed them to underscores.

  @scenarioOutline
  Scenario Outline: Different responses to credit card data input
    Given User is on card card entry page
    When User <name> enters card number <cc_number> together with expiry date <expiry_date> and cvv <cvv>
    Then the page will respond with <response> and provide as reason <reason>

    Examples:
      | name        | cc_number        | expiry_date | cvv | response | reason                      |
      | Joe Doe     | 4242424242424242 | 10/27       | 753 | Success  | You are using VISA          |
      | Hans Hansen | 5555555555554444 | 02/28       | 159 | Success  | You are using MASTERCARD    |
      | Eugene Tonya| 4000000000009995 | 07/26       | 741 | Declined | You have insufficient funds |