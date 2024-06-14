<?php
        session_start();
        // To read data from the JSON file in PHP
        $productsJson = file_get_contents('assets/json/products.json');
        $products = json_decode($productsJson, true);
        // echo $products[1]["product"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Shopping Cart</title>
</head>
<body>
<header>
        <div class="logo">
            <p>AZ&#91;store&#93;</p>
        </div>
        <div class="nav">
        <nav>
            <a href="index.php">Home</a>
            <a href="">About</a>
            <a href="">Product</a>
            <a href="">Contact</a>
        </nav>
        </div>
        <div class="shopping-login">
            <img src="assets/picture/shopping-cart.svg" alt="image of shopping cart">
            <p>Login</p>
        </div>
    </header>
    <main>
        <h1>Shopping cart</h1>
        <!-- réalisation du tableau pour afficher les produits ajouté dans le panier -->
         <table>
            <tr>
                <td>image</td>
                <td>name of product</td>
                <td>quantity</td>
                <td>price</td>
            </tr>
            <?php  
            if(!isset($_SESSION['panier'])){
                echo "<tr><td colspan='6'><h3>Votre panier est vide.</h3></td></tr>";
            }
            else{
                //supprimer les produits
                //si la variable del existe
                if(isset($_GET['del'])){
                    $id_del = $_GET['del'];
                    //suppression
                    unset($_SESSION['panier'][$id_del]);
                }

                // augmenter la quantité des produits 
                //si la variable add existe
                if(isset($_GET['add'])){
                    $id_add  = $_GET['add'];
                    // augmenter
                    $session = $_SESSION['panier'][$id_add]++; 
                }

                // diminuer la quantité des produits
                //si la variable minus existe
                if(isset($_GET['minus'])){
                    $id_minus  = $_GET['minus'];
                    // diminuer
                    $session = $_SESSION['panier'][$id_minus]--;
                    //suppression
                    if($_SESSION['panier'][$id_minus] == 0){
                        unset($_SESSION['panier'][$id_minus]);
                    }
                }

                $total = 0 ;
                $tousIdProduit = array_keys($_SESSION['panier']);
            //s'il n'y a aucune clé dans le tableau
            if(empty($tousIdProduit)){
                echo "<tr><td colspan='6'><h3>Votre panier est vide.</h3></td></tr>";
            }
            else{
                //liste des produit avec une boucle foreach
                foreach($tousIdProduit as $idProduit){
                    $nomProduit = htmlspecialchars($products[$idProduit]['product']);
                    $prix = $products[$idProduit]['price'];
                    $quantite = $_SESSION['panier'][$idProduit];
                    $totalParProduit = $prix * $quantite;
                    $total += $totalParProduit;
                    //calculer le total ( prix unitaire * quantité) 
                    //et aditionner chaque résutats a chaque tour de boucle
                    echo'<tr>
                    <td><img src="'. $products[$idProduit]['image_url'] . '" alt="'. $nomProduit .'"width="50"></td>
                    <td>'. $nomProduit. '</td>
                    <td>'. $quantite . '</td>
                    <td>' . number_format($prix, 2) . '</td>
                    <td><a href="shopping-cart.php?add=' .$idProduit. '"><img src="assets/picture/plus.png" width = "30"></a></td>
                    <td><a href="shopping-cart.php?minus=' .$idProduit. '"><img src="assets/picture/minus.png" width = "30"></a></td>
                    <td><a href="shopping-cart.php?del=' .$idProduit. '"><img src="assets/picture/delete.png" width = "30"></a></td>';
                }
                echo "<tr>
                        <td colspan='4'>Total</td>
                        <td colspan='2'>$" . number_format($total, 2) . "</td>
                      </tr>";
            }
        }

            ?>
         </table>
         <a href="checkout.php">Validate cart</a>
    </main>
    <footer>
        <nav>
            <a href="index.php">Home</a>
            <a href="">About</a>
            <a href="">Product</a>
            <a href="">Contact</a>
        </nav>
    </footer>
</body>
</html>