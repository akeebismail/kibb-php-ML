<?php
/**
 * Created by PhpStorm.
 * User: kibb
 * Date: 3/29/18
 * Time: 11:28 PM
 */
include  __DIR__.'/vendor/autoload.php';

use Phpml\Dataset\CsvDataset;
$dataset = new CsvDataset('data/Tweets.csv',1);

foreach ($dataset->getSamples() as $sample){
    print_r($sample);
}