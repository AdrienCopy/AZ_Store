<?php 
    session_start();
    $productsJson = file_get_contents('assets/json/products.json');
    $products = json_decode($productsJson, true);
    //creer la session
     //si la session panier n'existe pas alors on va la créer
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = [];
    }
    //récupération de l'id dans le lien
    if(isset($_GET['idP'])){
        //si un id a été envoyé alors :   
        $id = $_GET['idP'] ;
        echo "ligne 14: " . $id . "<br>";

       //ajouter le produit dans le panier ( Le tableau)
        if(isset($_SESSION['panier'][$id])){
            // si le produit est déjà dans le panier
            //Représente la quantité 
            $session = $_SESSION['panier'][$id]++; 
            echo $session;

        }
        else {
            //si non on ajoute le produit
            $_SESSION['panier'][$id]= 1;
        }
    
       //redirection vers la page index.php
       header("Location:index.php#our-products");
    }
?>
