======================
Planning alert service
======================

This is a console command to read the `Planning Alert Service <https://www.planningalerts.org.au>`_ APIS.

It works by calling the API on the planning authority you specify and then searching the description of returned
planning applications for keywords.

The keywords are listed in config/planning-alerts.yaml

------------
Installation
------------

Run composer install of course.

You will need to create a .env.local file with the following:

``
PLANNING_ALERTS_KEY=secretkey
``

-------
Running
-------

Make sure you have run composer install and checked that you are happy with the keywords in config/planning-alerts.yaml

Then pick and authority key. Get a list of valid authorities here https://www.planningalerts.org.au/authorities

Then from the basedir run

``
./bin/console planning-alerts:view rockhampton
``

---------
Debugging
---------

PHPSTORM
---------

Add an alq.test server in PHP -> Servers

``
export PHP_IDE_CONFIG="serverName=alq.test"
export XDEBUG_CONFIG="idekey=PHPSTORM remote_enable=1"
``
