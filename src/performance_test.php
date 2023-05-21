<?php
// Starting clock time in seconds
namespace Salar;
require_once "Slice/BST/BSTSlice.php";
$start_time = microtime(true);

$bst = BSTSlice::from([
    654, 548, 15,
    3254, 68, 1,
    4, 85, 896,
    123, 45, 1135,
    11, 25, 18,
]);




// End clock time in seconds
$end_time = microtime(true);

// Calculating the script execution time
$execution_time = $end_time - $start_time;

echo $execution_time . " ms \n";
