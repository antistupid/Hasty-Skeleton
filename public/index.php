<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once(ROOT . 'vendor/autoload.php');

function dump($obj)
{
    if (php_sapi_name() == 'cli') {
        print_r($obj);
        echo "\n";
    } else {
        echo '<pre>';
        print_r($obj);
        echo '</pre>';
    }
}


class JsonifiedObject
{
    public $value;

    public function __construct($value)
    {
        $this->value = json_encode($value, JSON_PRETTY_PRINT);
    }

    public function getValue() {
        return $this->value;
    }
}

function jsonify($obj)
{
    return new JsonifiedObject($obj);
}

\Hasty\Entrance::bootstrap('../app');
