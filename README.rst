# Planning alert service

## Installation

You will need to create a .env.local file with the following:

``
PLANNING_ALERTS_KEY=secretkey
``

## Debugging

### PHPSTORM

Add an alq.test server in PHP -> Servers

``
export PHP_IDE_CONFIG="serverName=alq.test"
export XDEBUG_CONFIG="idekey=PHPSTORM remote_enable=1"
``
