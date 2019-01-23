<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/helper.php';

use Box\Spout\Common\Type;
use Box\Spout\Reader\ReaderFactory;

$fileA = './data/old.csv';
$fileB = './data/new.csv';

$readerA = fopen($fileA, 'r');
$readerB = fopen($fileB, 'r');

$count = 0;

measureResource(function () use ($readerA, $readerB, &$count) {
    $hashOfA = [];
    $hashOfB = [];

    while (!feof($readerA)) {
        $hashOfA[md5(serialize(fgetcsv($readerA)))] = true;
    }

    while (!feof($readerB)) {
        $hash = md5(serialize(fgetcsv($readerB)));
        if (!isset($hashOfA[$hash])) {
            $hashOfB[$hash] = true;
            $count++;
        }
    }
});

printf('Record count: %s' . PHP_EOL, $count);

