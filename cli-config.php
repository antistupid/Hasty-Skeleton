<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

define('ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

require_once('vendor/autoload.php');
return ConsoleRunner::createHelperSet(\Hasty\Resource::getEntityManager());
