<?php

require 'vendor/autoload.php';

use RebaseData\Converter\Converter;
use RebaseData\InputFile\InputFile;

$inputFiles = [new InputFile('C:\Users\Francesco\Downloads\provaExcel.xlsx')];

$converter = new Converter();
$database = $converter->convertToDatabase($inputFiles);
$tables = $database->getTables();

foreach ($tables as $table) {
  echo "Reading table '".$table->getName()."'\n";

  $rows = $table->getRowsIterator();
  foreach ($rows as $row) {
    echo implode(', ', $row)."\n";
  }
}