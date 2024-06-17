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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-*" crossorigin="anonymous" />
    <title>Home</title>
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
        <a href="shopping-cart.php">
            <?php
            if(isset($_SESSION['panier'])){
                echo array_sum($_SESSION['panier']);
            }
            ?>
            <!-- <img src="assets/picture/shopping-cart.svg" alt="image of shopping cart"> -->
            <i class="fas fa-cart-arrow-down" style="color: #f5fffe;"></i>
        </a>
            <p>Login</p>
        </div>
    </header>
    <main>
        <div class="div-h1-img">
            <section class="h1">
                <h1>shoe the right <strong>one</strong>.</h1>
                <section>
                    <button href="" class="btn-see-our-store">See our store</button>
                </section>
            </section>
            <section class="h2">
                <img src="assets/picture/shoe_one.png" alt="image of the shoe">
                <h2>nike</h2>
            </section>
        </div>
        <div class="div-products" id="our-products">
            <h3><strong>Our</strong> last products</h3>
            <div class="products">
            <?php
                // boucle pour afficher les produits dans la BD
                foreach($products as $product){
                    echo '<div class="product-info"><img src="' . $product["image_url"] . '" alt="image of' . $product["product"] . '" width ="50px"><p>' . $product["product"] . '</p><p>' . $product["price"]. "€" . '<button href="ajout-panier.php?idP='. $product["id"] . '" class ="btn-add-to-card" id= "' . $product["id"] . '">Add to cart</button></div>';
                }
                ?>
            </div>
        </div>
        <section class="shoe">
            <img src="assets/picture/shoe_two.png" alt="image of shoe">
            <h2>we provide you <br>the <strong>best</strong> quality</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos totam veritatis sunt praesentium quae repudiandae quo suscipit.</p>
        </section>
        <div class="div-opinion">
            <section>
                <img src="assets/picture/image-emily.jpg" alt="image of emily">
                <h4>Emily from xyz</h4>
                <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, voluptatum iste. Sint reprehenderit dolor perspiciatis earum animi libero non consectetur fugit debitis pariatur, eveniet voluptates ab. Dolores ducimus vero officia?"</p>
            </section>
            <section>
                <img src="assets/picture/image-thomas.jpg" alt="image of thomas">
                <h4>Thomas from corporate</h4>
                <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, voluptatum iste. Sint reprehenderit dolor perspiciatis earum animi libero non consectetur fugit debitis pariatur, eveniet voluptates ab. Dolores ducimus vero officia?"</p>
            </section>
            <section>
                <img src="assets/picture/image-jennie.jpg" alt="image of jennie">
                <h4>Jennie from Nike</h4>
                <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus, voluptatum iste. Sint reprehenderit dolor perspiciatis earum animi libero non consectetur fugit debitis pariatur, eveniet voluptates ab. Dolores ducimus vero officia?"</p>
            </section>
        </div>
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