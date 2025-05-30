# Sportradar

## Excercise

**Football World Cup Score Board**

You are working on a sports data company. And we would like you to develop a new  Live Football World Cup Score Board that shows matches and scores.
The boards support the following operations:

    1.Start a game. When a game starts, it should capture (being initial score 0-0)  
        a. Home team
        b. Away Team
    2. Finish a game. It will remove a match from the scoreboard.
    3. Update score. Receiving the pair score; home team score and away team score  updates a game score
    4. Get a summary of games by total score. Those games with the same total score  will be returned ordered by the most recently added to our system.  
   
As an example, being the current data in the system:

    1. Mexico - Canada: 0 - 5
    2. Spain - Brazil: 10 - 2
    3. Germany - France: 2 - 2
    4. Uruguay - Italy: 6 - 6
    5. Argentina - Australia: 3 - 1

The summary would provide with the following information:
    
    1. Uruguay 6 - Italy 6
    2. Spain 10 - Brazil 2
    3. Mexico 0 - Canada 5
    4. Argentina 3 - Australia 1
    5. Germany 2 - France 2 

## Solution

Plain object oriented PHP 8 with PHPUnit and Faker test suite.

### Demo usage by running tests

    composer install --dev
    vendor/bin/phpunit

### Code usage

See `test.php` code example.

You can run it with:

    php test.php

