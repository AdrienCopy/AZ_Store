<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <script type="module" defer src="./assets/script/script.js"></script>
    <title>AZ Store</title>
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
    <table>
            <tr>
                <td>image</td>
                <td>name of product</td>
                <td>quantity</td>
                <td>price</td>
            </tr>
    <?php
    function Json($Fichier) {
        $Fichier = file_get_contents($Fichier);
        return json_decode($Fichier, true);
    }
    function deletePanier($idProduit) {
        if (isset($_SESSION['panier'][$idProduit])) {
            unset($_SESSION['panier'][$idProduit]);
        }
    }
    
    // Vérifier si une suppression est demandée
    if (isset($_GET['del'])) {
        $id_del = intval($_GET['del']);
        deletePanier($id_del);
    }
    // Fonction pour afficher le contenu du panier
    function showPanier($produits) {
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
            $panier = $_SESSION['panier'];
            $total = 0;
            echo "<h1>Basket contents :</h1>";
            foreach ($panier as $idProduit => $quantite) {
                if (isset($produits[$idProduit])) {
                    $nomProduit = htmlspecialchars($produits[$idProduit]['product']);
                    $prix = $produits[$idProduit]['price'];
                    $totalParProduit = $prix * $quantite;
                    $total += $totalParProduit;
                    
                    echo "
                            <tr>
                                <td><img src='" . htmlspecialchars($produits[$idProduit]['image_url']) . "' alt='" . $nomProduit . "' width='50'></td>
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
        } else {
            echo "Le panier est vide.";
        }
    }
    
    // Lire les informations produits depuis le fichier JSON
    $Fichier = 'assets/json/products.json';
    $produits = Json($Fichier);
    
    // Transformer le tableau en un tableau associatif indexé par idProduit
    $produitsIndexe = array();
    foreach ($produits as $produit) {
        $produitsIndexe[$produit['id']] = $produit;
    }
    
    // Afficher le contenu du panier
    showPanier($produitsIndexe);
    ?>
    </table>
    <form method="POST" id="form" action="">
        <label for="first_name">First name: </label><br>
        <input type="text" name="first_name" placeholder="First Name" aria-required="true" required><br>
        <label for="last_name">Last name: </label><br>
        <input type="text" name="last_name" placeholder="Last Name" aria-required="true" required><br>
        <label for="email">Email: </label><br>
        <input type="text" id="email" name="email" placeholder="Email" aria-required="true" required><br>
        <label for="adress">Address: </label><br>
        <input type="text" name="adress" placeholder="Adress" aria-required="true" required><br>
        <label for="city">City: </label><br>
        <input type="text" name="city" placeholder="City" aria-required="true" required><br>
        <label for="zip_code">Zip code: </label><br>
        <input type="text" id="zipcode" name="zip_code" placeholder="Zip code" aria-required="true" required><br>
        <label for="country">Country: </label><br>
        <select name="country" aria-required="true" required>
            <option disabled selected>Select a country</option>
            <option value="Albanie">Albanie</option>
            <option value="Allemagne">Allemagne</option>
            <option value="Andorre">Andorre</option>
            <option value="Autriche">Autriche</option>
            <option value="Belgique">Belgique</option>
            <option value="Biélorussie">Biélorussie</option>
            <option value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
            <option value="Bulgarie">Bulgarie</option>
            <option value="Chypre">Chypre</option>
            <option value="Croatie">Croatie</option>
            <option value="Danemark">Danemark</option>
            <option value="Espagne">Espagne</option>
            <option value="Estonie">Estonie</option>
            <option value="Finlande">Finlande</option>
            <option value="France">France</option>
            <option value="Géorgie">Géorgie</option>
            <option value="Grèce">Grèce</option>
            <option value="Hongrie">Hongrie</option>
            <option value="Irlande">Irlande</option>
            <option value="Islande">Islande</option>
            <option value="Italie">Italie</option>
            <option value="Kosovo">Kosovo</option>
            <option value="Lettonie">Lettonie</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lituanie">Lituanie</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macédoine du Nord">Macédoine du Nord</option>
            <option value="Malte">Malte</option>
            <option value="Moldavie">Moldavie</option>
            <option value="Monaco">Monaco</option>
            <option value="Monténégro">Monténégro</option>
            <option value="Norvège">Norvège</option>
            <option value="Pays-Bas">Pays-Bas</option>
            <option value="Pologne">Pologne</option>
            <option value="Portugal">Portugal</option>
            <option value="République Tchèque">République Tchèque</option>
            <option value="Roumanie">Roumanie</option>
            <option value="Royaume-Uni">Royaume-Uni</option>
            <option value="Russie">Russie</option>
            <option value="Saint-Marin">Saint-Marin</option>
            <option value="Serbie">Serbie</option>
            <option value="Slovaquie">Slovaquie</option>
            <option value="Slovénie">Slovénie</option>
            <option value="Suède">Suède</option>
            <option value="Suisse">Suisse</option>
            <option value="Ukraine">Ukraine</option>
            <option value="Vatican">Vatican</option>
        </select><br>
        <input type="text" name="control" style="display: none;"><br>
        <input type="submit" id="button" value="Submit">
    </form>
</main>

<?php 
$first_name = "";
$last_name = "";
$email = "";
$adress = "";
$city = "";
$zip_code = "";
$country = "";

function validateEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    } else {
        return false;
    }
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['control']) && $_POST['control'] != '') {
        die("Error: Suspicious activity detected.");
    }
    if (isset($_POST['first_name']) 
        && isset($_POST['last_name']) 
        && isset($_POST['email'])
        && isset($_POST['adress'])
        && isset($_POST['city'])
        && isset($_POST['zip_code'])
        && isset($_POST['country'])) {

            $first_name = sanitizeInput($_POST['first_name']);
            $last_name = sanitizeInput($_POST['last_name']);
            $email = sanitizeInput($_POST['email']);
            $adress = sanitizeInput($_POST['adress']);
            $city = sanitizeInput($_POST['city']);
            $zip_code = sanitizeInput($_POST['zip_code']);
            $country = sanitizeInput($_POST['country']);

            if (!ctype_digit($zip_code)) {
                die("Erreur : the postal code must consist of numbers only");
            }

            $validatedEmail = validateEmail($email);
                if ($validatedEmail !== false) {
                $email = $validatedEmail;
            }
            
            $_SESSION['formData'] = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'adress' => $adress,
                'city' => $city,
                'zip_code' => $zip_code,
                'country' => $country
            );
            profil($first_name, $last_name, $email, $adress, $city, $zip_code, $country);
    }
}

function profil($first_name, $last_name, $email, $adress, $city, $zip_code, $country) {
    $db = new SQLite3('bdd.sqlite');

    $query = 'CREATE TABLE IF NOT EXISTS customer (
        id INTEGER PRIMARY KEY,
        first_name TEXT,
        last_name TEXT,
        email TEXT,
        adress TEXT,
        city TEXT,
        zip_code TEXT,
        country TEXT

    )';

    $db->exec($query);

    $stmt = $db->prepare('INSERT INTO customer (first_name, last_name, email, adress, city, zip_code, country) VALUES (:first_name, :last_name, :email, :adress, :city, :zip_code, :country)');
    
    $stmt->bindValue(':first_name', $first_name, SQLITE3_TEXT);
    $stmt->bindValue(':last_name', $last_name, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':adress', $adress, SQLITE3_TEXT);
    $stmt->bindValue(':city', $city, SQLITE3_TEXT);
    $stmt->bindValue(':zip_code', $zip_code, SQLITE3_TEXT);
    $stmt->bindValue(':country', $country, SQLITE3_TEXT);

    $result = $stmt->execute();

    $order_id = $db->lastInsertRowID();

    // Créez une table pour les articles de la commande
    $query = 'CREATE TABLE IF NOT EXISTS order_items (
        id INTEGER PRIMARY KEY,
        order_id INTEGER,
        product_id INTEGER,
        quantity INTEGER,
        price NUMERIC,
        FOREIGN KEY(order_id) REFERENCES orders(id)
    )';

    $db->exec($query);

    // Insérez les articles du panier dans la table order_items
    foreach ($_SESSION['panier'] as $product_id => $quantity) {
        $stmt = $db->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)');
        $stmt->bindValue(':order_id', $order_id, SQLITE3_INTEGER);
        $stmt->bindValue(':product_id', $product_id, SQLITE3_INTEGER);
        $stmt->bindValue(':quantity', $quantity, SQLITE3_INTEGER);
        $stmt->bindValue(':price', $produitsIndexe[$product_id]['price'], SQLITE3_FLOAT);
        $stmt->execute();
    }

    $db->close();
    exit();
}
?>
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