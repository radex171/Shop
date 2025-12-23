<?php

session_start();


if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [

    ];
}
$products = [
    ['name' => 'mleko', 'price' => 3.50],
    ['name' => 'chleb', 'price' => 4.20],
    ['name' => 'cukier', 'price' => 2.99],
];






if(isset($_GET['add'])){
  
    $productId = (int) $_GET['add']; 
    if (isset($products[$productId])) { 
       if(isset($_SESSION['cart'][$productId])){
        $_SESSION['cart'][$productId]++;
       } else {
        $_SESSION['cart'][$productId] = 1;
       }
    }
}

if(isset($_GET['clear'])){
    $_SESSION['cart'] = [];
}


echo "<h2>Produkty:</h2>";
foreach($products as $id => $product){
    echo $product['name'] . ' - ' . $product['price'] . ' PLN ' .
         '<a href="index.php?add='.$id.'">Dodaj do koszyka</a><br>';
}

echo "<h2>Koszyk:</h2>";
if (!empty($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $id => $qty){
        echo $products[$id]['name'] . ' - ilość: ' . $qty . '<br>';
    }
    echo '<a href="index.php?clear=1">Wyczyść koszyk</a>';
} else {
    echo "Brak produktów w koszyku.";
}