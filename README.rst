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

You will need to create a .env.local file with the secret key you get after you sign up to the website:

.. code-block:: ini

  PLANNING_ALERTS_KEY=secretkey

-------
Running
-------

Make sure you have run composer install and checked that you are happy with the keywords in config/planning-alerts.yaml

Then pick an authority key. Get a list of valid authorities here https://www.planningalerts.org.au/authorities

Then from the basedir run

.. code-block:: bash

  ./bin/console planning-alerts:view rockhampton

-------
Testing
-------

After composer install run:

.. code-block:: sh

  ./bin/phpunit

**Gotchas**
There is some stupid Symfony package bug which won't download the TestCase library without running ./bin/phpunit first

---------
Debugging
---------

PHPSTORM
---------

Add an alq.test server in PHP -> Servers

.. code-block:: bash

  export PHP_IDE_CONFIG="serverName=alq.test"
  export XDEBUG_CONFIG="idekey=PHPSTORM remote_enable=1"

