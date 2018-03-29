<?php

namespace Kibb;
require __DIR__. '/vendor/autoload.php';

use Phpml\Exception\FileException;

$srcFile = __DIR__.'/data/Tweets.csv';
$dstFilePath = __DIR__.'/data/out/tweets.csv';

$rows = [];

$rows = getRows($srcFile, $rows);

writeRows($dstFilePath,$rows);
function getRows($filepath, $rows){
    $handle = checkPermission($filepath);

    while (($data = fgetcsv($handle, 1000)) !== false){
        $rows[] = [$data[10],$data[1]];
    }
    fclose($handle);

    return $rows;
}

function checkPermission($filePath,$mode='rb'){
    if (!file_exists($filePath)){
        throw FileException::missingFile(basename($filePath));
    }

    if (false === $handle = fopen($filePath, $mode)){
        throw FileException::cantOpenFile(basename($filePath));
    }

    return $handle;
}

function writeRows($filePath,$rows){
    $handle = checkPermission($filePath, 'wb');
    foreach ($rows as $row){
        fputcsv($handle, $row);
    }

    fclose($handle);
}