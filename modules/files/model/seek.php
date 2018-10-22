<?php
$time = microtime(true);
$reader = new FileReader("text.txt");

if($_GET['optimize'] === "true")
    $reader->optimize();

$itemAmount = intval($_GET['items']);
?>