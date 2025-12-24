<?php

session_start();


if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];

}
$products = [
    ['name' => 'mleko', 'price' => 3.50],
    ['name' => 'chleb', 'price' => 4.20],
    ['name' => 'cukier', 'price' => 2.99],
];




$totalPrice = 0;

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

foreach($_SESSION['cart'] as $id => $qty){
    $subtotal = $products[$id]['price'] * $qty;
    $totalPrice += $subtotal;
}

if(isset($_GET['clear'])){
    $_SESSION['cart'] = [];
}

echo '<h2 style="
display: flex;

border: 1px solid black;
background: green;
">Produkty:</h2>';


foreach($products as $id => $product){
    echo'<section style="
        display: flex;
        padding: 1rem;
       
        ">'. $product['name'] . ' - ' . $product['price'] . ' PLN  ' .
         '<a href="index.php?add='.$id.'"  
        style="
        display: flex;
        margin:0 1rem;">Dodaj do koszyka</a></section><br>';
}

echo '<h2 
style="
display: flex;
margin: 0rem 3rem;
">Koszyk:</h2></br>';
if (!empty($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $id => $qty){
        echo '<section style="
        display: flex;
        padding: 1rem;
        border: 1px solid black;
        ">' . $products[$id]['name']  . ' - ilość: ' . $qty .'</section> <br>';
        
    }
    echo '<a href="index.php?clear=1">Wyczyść koszyk</a>';
} else {
    echo "Brak produktów w koszyku.";
}

echo '<section  style="
        display: flex;
        padding: 1rem;
        margin-top: 2rem;
        border: 1px solid green;
        background: green;
        color: white;
        "> Całkowita cena: ' . $totalPrice . ' zł';