<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/8/2020
 * Time: 1:28 PM
 */

$fibo = [];
for($i = 0; $i < 20; $i++) {
    if ($i == 0) {
        $fibo[] = 0;
    } elseif ($i == 1) {
        $fibo[] = 1;
    } else {
        $fibo[] = $fibo[$i - 1] + $fibo[$i - 2];
    }
}
echo "<pre>";
print_r($fibo);
echo "</pre>";
