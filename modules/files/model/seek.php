<?php
$time = microtime(true);
$reader = new FileReader("text.txt");

if(isset($_GET['optimize']) and $_GET['optimize'] === "true")
    $reader->optimize();

$itemAmount = isset($_GET['items']) ? intval($_GET['items']) : 1;
?>