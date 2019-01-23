<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/helper.php';

use League\Csv\Reader;
use League\Csv\Statement;

$fileA = './data/old.csv';
$fileB = './data/new.csv';

$readerA = Reader::createFromStream(fopen($fileA, 'r'));
$readerA->setHeaderOffset(0);
$readerB = Reader::createFromStream(fopen($fileB, 'r'));
$readerB->setHeaderOffset(0);

$count = 0;

measureResource(function () use ($readerA, $readerB, &$count) {
    $hashOfA = [];
    $hashOfB = [];

    foreach ($readerA as $offset => $row) {
        $hashOfA[md5(serialize($row))] = true;
    }
    foreach ($readerB as $offset => $row) {
        $hash = md5(serialize($row));
        if (!isset($hashOfA[$hash])) {
            $hashOfB[$hash] = true;
            $count++;
        }
    }

//    $offset = 0;
//    $limit = 100000;
//    do {
//        $stmt = (new Statement())
//            ->offset($offset)
//            ->limit($limit);
//
//        $records = $stmt->process($readerA);
//
//        foreach ($records as $record) {
//            $hash = md5(serialize($record));
//            $hashOfA[$hash] = true;
//        }
//        $offset += $limit;
//    } while(count($records) > 0);
//
//    $offset = 0;
//    do {
//        $stmt = (new Statement())
//            ->offset($offset)
//            ->limit($limit);
//
//        $records = $stmt->process($readerB);
//
//        foreach ($records as $record) {
//            $hash = md5(serialize($record));
//            if (!isset($hashOfA[$hash])) {
//                $hashOfB[$hash] = true;
//                $count++;
//            }
//        }
//        $offset += $limit;
//    } while(count($records) > 0);

});

printf('Record count: %s' . PHP_EOL, $count);

