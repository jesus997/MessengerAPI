<?php

include_once __DIR__.'/vendor/autoload.php';

$config = null;
$router = null;
$db = null;
$version = "1.0";

$ci = new JessHilario\Chatear\App\Core();

$ci->start();