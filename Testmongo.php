<?php

$m = new MongoClient();
$collection = $m->selectCollection('test', 'phpmanual');

// If an array literal is used, there is no way to access the generated _id
$collection->insert(array('x' => 1));

// The _id is available on an array passed by value
$a = array('x' => 2);
$collection->insert($a);
var_dump($a);

// The _id is not available on an array passed by reference
$b = array('x' => 3);
$ref = &$b;
$collection->insert($ref);
var_dump($ref);

// The _id is available if a wrapping function does not trigger copy-on-write
function insert_no_cow($collection, $document)
{
    $collection->insert($document);
}

$c = array('x' => 4);
insert_no_cow($collection, $c);
var_dump($c);

// The _id is not available if a wrapping function triggers copy-on-write
function insert_cow($collection, $document)
{
    $document['y'] = 1;
    $collection->insert($document);
}

$d = array('x' => 5);
insert_cow($collection, $d);
var_dump($d);

?>
