Feature: Show all users
	In order to accomplish this assessment
	As a job applicant
	I need to show a list of the users using xml or db as source

	Scenario:
		Given I am using "users.xml" as source of data
		 When I access the homepage
		 Then I should see a table showing all the users in the xml file

	Scenario:
		Given I am using "users.sqlite" as source of data
		 When I access the homepage
		 Then I should see a table showing all the users in the sqlite file