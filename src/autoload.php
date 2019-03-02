<?php

namespace HostHinh;

//for hotfix but declare the new class
$mapping = array(
    /*-- database --*/
    'HostHinh\HostHinhClient' => __DIR__ . '/HostHinhClient.php',
);

spl_autoload_register(function ($class) use ($mapping) {
    if (isset($mapping[$class])) {
        require_once $mapping[$class];
    }
}, true);