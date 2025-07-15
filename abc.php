<?php
// Function to calculate the factorial of a number
function factorial($n) {
  $fact = 1;
  for ($i = 1; $i <= $n; $i++) {
    $fact *= $i;
  }
  return $fact;
}

// Function to calculate nCr
function nCr($n, $r) {
  return factorial($n) / (factorial($r) * factorial($n - $r));
}

// Example values
$n = 5; // Total number of items
$r = 2; // Number of items to choose

// Display the result
echo "NCR ($n, $r) = " . nCr($n, $r);
?>
