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
		$this->getSession()->visit('http://localhost:4567/');
        $content = $this->getSession()->getPage()->getContent();
        throw new \Exception($content);
    }

    /**
     * @Then I should see a table showing all the users in the xml file
     */
    public function iShouldSeeATableShowingAllTheUsersInTheXmlFile()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a table showing all the users in the sqlite file
     */
    public function iShouldSeeATableShowingAllTheUsersInTheSqliteFile()
    {
        throw new PendingException();
    }

}