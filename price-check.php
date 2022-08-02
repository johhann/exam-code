<?php


/*
 * Complete the 'priceCheck' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. STRING_ARRAY products
 *  2. FLOAT_ARRAY productPrices
 *  3. STRING_ARRAY productSold
 *  4. FLOAT_ARRAY soldPrice
 */

function priceCheck($products, $productPrices, $productSold, $soldPrice) {
    $newProductPrices = array();
    $newProductSoldPrices = array();
    
    for($i=0; $i < count($products); $i++){
        $newProductPrices[$products[$i]] = $productPrices[$i];
    }
    
    for($i=0; $i < count($productSold); $i++){
        $newProductSoldPrices[$productSold[$i]] = $soldPrice[$i];
    }    
    
    $counter = 0;
    foreach($newProductSoldPrices as $soldProduct => $soldPrice){
        foreach($newProductPrices as $product => $price){
            if($soldProduct == $product && $soldPrice != $price){
                $counter++;
            }
        }
    }
    
    return $counter;
    
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$products_count = intval(trim(fgets(STDIN)));

$products = array();

for ($i = 0; $i < $products_count; $i++) {
    $products_item = rtrim(fgets(STDIN), "\r\n");
    $products[] = $products_item;
}

$productPrices_count = intval(trim(fgets(STDIN)));

$productPrices = array();

for ($i = 0; $i < $productPrices_count; $i++) {
    $productPrices_item = floatval(trim(fgets(STDIN)));
    $productPrices[] = $productPrices_item;
}

$productSold_count = intval(trim(fgets(STDIN)));

$productSold = array();

for ($i = 0; $i < $productSold_count; $i++) {
    $productSold_item = rtrim(fgets(STDIN), "\r\n");
    $productSold[] = $productSold_item;
}

$soldPrice_count = intval(trim(fgets(STDIN)));

$soldPrice = array();

for ($i = 0; $i < $soldPrice_count; $i++) {
    $soldPrice_item = floatval(trim(fgets(STDIN)));
    $soldPrice[] = $soldPrice_item;
}

$result = priceCheck($products, $productPrices, $productSold, $soldPrice);

fwrite($fptr, $result . "\n");

fclose($fptr);