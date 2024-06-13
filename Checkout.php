<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" defer src="./assets/script/script.js"></script>
    <title>AZ Store</title>
</head>
<body>
    <form method="POST" id="form">
        <label for="first_name">First name: </label>
        <input type="text" name="first_name" aria-required="true" required><br>
        <label for="last_name">Last name: </label>
        <input type="text" name="last_name" aria-required="true" required><br>
        <label for="email">Email: </label>
        <input type="text" id="email" name="email" aria-required="true" required><br>
        <label for="adress">Address: </label>
        <input type="text" name="adress" aria-required="true" required><br>
        <label for="city">City: </label>
        <input type="text" name="city" aria-required="true" required><br>
        <label for="zip_code">Zip code: </label>
        <input type="text" name="zip_code" aria-required="true" required><br>
        <label for="country">Country: </label>
        <input type="text" name="country" aria-required="true" required><br>
        <input type="text" name="control" style="display: none;">
        <input type="submit" id="button" value="Submit">
    </form>


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

            $validatedEmail = validateEmail($email);
                if ($validatedEmail !== false) {
                $email = $validatedEmail;
            }
            
    }
}

print_r ($first_name . $last_name . $email . $adress . $city . $zip_code . $country);
?>

</body>
</html>