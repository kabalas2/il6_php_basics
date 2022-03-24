<?php

include 'vendor/autoload.php';

$messenger = new \Service\PriceChangeInformer\Cron;

$messenger->exec();