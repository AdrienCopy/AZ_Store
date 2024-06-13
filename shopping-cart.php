<?php
    session_start();
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
             // création de la sesion panier
    if(isset($_SESSSION['panier'])){
        $_SESSION['panier'] = array();
    }
    // récuperation de l'id dans le lien
    if(isset($_GET['idP'])){
        $idProduit = $_GET['idP'];
        // To read data from the JSON file in PHP
        $productsJson = file_get_contents('assets/json/products.json');
        $products = json_decode($productsJson, true);
        //vérification que la requete est bien exécuté
        // affiche toutes les infos de la BD
        // var_dump($products);
        // affiche le nom du produit selectionné 
        // var_dump($products[$idProduit]['product']);

        if(isset($products[$idProduit])){
            //ajouter le produit dans le panier ( Le tableau)
            if (isset($_SESSION['panier'][$idProduit])) {// si le produit est déjà dans le panier
                $_SESSION['panier'][$idProduit]++; //Représente la quantité
            } else {
                //si non on ajoute le produit
               $_SESSION['panier'][$idProduit]= 1 ;
            }
        }
        else{
            echo "Produit non trouvé";
        }
        //supprimer les produits
        //si la variable del existe
        if(isset($_GET['del'])){
            $id_del = $_GET['del'] ;
            //suppression
            unset($_SESSION['panier'][$id_del]);
        }
    
            // $productsJson = file_get_contents('assets/json/products.json');
            // $products = json_decode($productsJson, true);
            // récupérer les clés du tableau session
            $tousIdProduit = array_keys($_SESSION['panier']);
       
            if(empty($tousIdProduit)){
                echo "<tr><td colspan='6'><h3>Votre panier est vide.</h3></td></tr>";
            }
            else{
                // récupérer les clés du tableau session
                // $tousIdProduit = array_keys($_SESSION['panier']);
                $total = 0;
                foreach($tousIdProduit as $idProduit){
                    // Vérification que l'ID du produit existe dans les données JSON
                    if (isset($products[$idProduit])) {
                        $nomProduit = htmlspecialchars($products[$idProduit]['product']);
                        $prix = $products[$idProduit]['price'];
                        $quantite = $_SESSION['panier'][$idProduit];
                        $totalParProduit = $prix * $quantite;
                        $total += $totalParProduit;
        
                        echo "<tr>
                                <td><img src='{$products[$idProduit]['image_url']}' alt='{$nomProduit}' width='50'></td>
                                <td>{$nomProduit}</td>
                                <td>{$quantite}</td>
                                <td>$" . number_format($prix, 2) . "</td>
                                <td>$" . number_format($totalParProduit, 2) . "</td>
                                <td><a href='?del={$idProduit}'>Supprimer</a></td>
                            </tr>";
                    }
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