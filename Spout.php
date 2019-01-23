<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/helper.php';

use Box\Spout\Common\Type;
use Box\Spout\Reader\ReaderFactory;

$fileA = './data/old.csv';
$fileB = './data/new.csv';

$readerA = ReaderFactory::create(Type::CSV);
$readerA->open($fileA);

$readerB = ReaderFactory::create(Type::CSV);
$readerB->open($fileB);

$count = 0;

measureResource(function () use ($readerA, $readerB, &$count) {
    $hashOfA = [];
    $hashOfB = [];

    foreach ($readerA->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
            $hashOfA[md5(serialize($row))] = true;
        }
    }

    foreach ($readerB->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
            $hash = md5(serialize($row));
            if (!isset($hashOfA[$hash])) {
                $hashOfB[$hash] = true;
                $count++;
            }
        }
    }
});

printf('Record count: %s' . PHP_EOL, $count);

