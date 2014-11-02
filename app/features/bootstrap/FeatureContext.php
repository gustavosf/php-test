<?php

use Behat\Behat\Context\Step;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\Mink\Driver\GoutteDriver;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext
{

	/** @BeforeFeature */
	public static function prepareForTheFeature()
	{} // clean database or do other preparation stuff

	/** @Given /^I am using "(.*?)" as source of data$/ */
	public function prepareSource($source)
	{
        // throw new PendingException();
    }

	/** @When /^I access the homepage$/ */
    public function goToHomepage()
    {
        parent::iAmOnHomepage();
    }

    /**
     * @Then I should see a table showing all the users in the database
     */
    public function iShouldSeeATableShowingAllTheUsersInTheDatabase()
    {
        parent::assertElementOnPage('table');
        parent::assertPageContainsText('Dalana');
        parent::assertPageContainsText('Jenkins');
        parent::assertPageContainsText('dalana');
        parent::assertPageContainsText('asdf');
        parent::assertPageContainsText('dalana@inmemorian.com');
    }

}