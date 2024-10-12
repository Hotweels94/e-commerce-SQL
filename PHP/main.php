<?php
require_once 'vendor/autoload.php'; 

$host = '127.0.0.1';
$db = 'e-commerce-b2';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$faker = Faker\Factory::create();

// Fill user table 

for ($i = 0; $i < 100; $i++) {
    $username = $faker->userName;
    $mail = $faker->email;
    $password = md5($faker->password);
    $cell_number = $faker->phoneNumber;

    $sql_request = "INSERT INTO user (username, mail, password, cell_number) VALUES ('$username', '$mail', '$password', '$cell_number')";

    if (mysqli_query($conn, $sql_request)) {
        echo "user add \n";
    }else{
        echo "problem the user is not add \n";
    }
} 

// Fill products table

for ($i = 0; $i < 100; $i++) {
    $name = $faker->word;
    $type = $faker->word;
    $description = $faker->sentence;
    $price = $faker->randomFloat(2, 5, 100);
    $stock = $faker->numberBetween(1, 50);

    $sql_request = "INSERT INTO product (name, type, description, price, stock) VALUES ('$name', '$type', '$description', '$price', '$stock')";

    if (mysqli_query($conn, $sql_request)) {
        echo "product add \n";
    }else{
        echo "problem the product is not add \n";
    }
} 

// Fill photo table

$defaultImagePath = '../image/test.png';
$imageData = file_get_contents($defaultImagePath);
$imageData = mysqli_real_escape_string($conn, $imageData);

for ($i = 0; $i < 100; $i++) {

    $sql_request = "INSERT INTO photo (photo) VALUES ('$imageData')";

    if (mysqli_query($conn, $sql_request)) {
        echo "photo add \n";
    }else{
        echo "problem the photo is not add \n";
    }
} 

// Fill payment table

for ($i = 0; $i < 100; $i++) {
    $IBAN = $faker->iban;
    $card_number = $faker->creditCardNumber;
    $expiration_date = $faker->creditCardExpirationDate->format('Y-m-d');
    $cryptogram = $faker->randomNumber(3);
    $user_id = $faker->numberBetween(1, 80);

    $sql_request = "INSERT INTO payment (IBAN, card_number, expiration_date, cryptogram, user_id) VALUES ('$IBAN', '$card_number', '$expiration_date', '$cryptogram', '$user_id')";

    if (mysqli_query($conn, $sql_request)) {
        echo "payment add \n";
    }else{
        echo "problem the payment is not add \n";
    }
} 

// Fill address table

for ($i = 0; $i < 100; $i++) {
    $street = mysqli_real_escape_string($conn, $faker->streetAddress); // use real_escape_string to avoid special caracters
    $city = mysqli_real_escape_string($conn, $faker->city);
    $country = mysqli_real_escape_string($conn, $faker->streetAddress);;
    $user_id = $faker->numberBetween(1, 80);

    $sql_request = "INSERT INTO address (street, city, country, user_id) VALUES ('$street', '$city', '$country', '$user_id')";

    if (mysqli_query($conn, $sql_request)) {
        echo "address add \n";
    }else{
        echo "problem the address is not add \n";
    }
} 

// Fill cart table

for ($i = 0; $i < 100; $i++) {
    $user_id = $faker->numberBetween(1, 80);

    $sql_request = "INSERT INTO cart (user_id) VALUES ('$user_id')";

    if (mysqli_query($conn, $sql_request)) {
        echo "cart add \n";
    }else{
        echo "problem the cart is not add \n";
    }
} 

// Fill command table

for ($i = 0; $i < 100; $i++) {
    $command_date = $faker->dateTimeThisYear->format('Y-m-d');
    $delivered = $faker->boolean(50);
    $user_id = $faker->numberBetween(1, 80);
    $cart_id = $faker->numberBetween(1, 80);
    $address_id = $faker->numberBetween(1, 80);
    $payment_id = $faker->numberBetween(1, 80);

    $sql_request = "INSERT INTO command (command_date, delivered, user_id, cart_id, address_id, payment_id) VALUES ('$command_date', '$delivered', '$user_id', '$cart_id', '$address_id', '$payment_id')";

    if (mysqli_query($conn, $sql_request)) {
        echo "command add \n";
    }else{
        echo "problem the command is not add \n";
    }
} 

// Fill invoices table

for ($i = 0; $i < 100; $i++) {
    $command_date = $faker->dateTimeThisYear->format('Y-m-d');
    $delivered_date = $faker->dateTimeThisYear->format('Y-m-d');
    $command_id = $faker->numberBetween(1, 80);
    $user_id = $faker->numberBetween(1, 80);
    $address_id = $faker->numberBetween(1, 80);

    $sql_request = "INSERT INTO invoices (command_date, delivered_date, command_id, user_id, address_id) VALUES ('$command_date', '$delivered_date', '$command_id', '$user_id', '$address_id')";

    if (mysqli_query($conn, $sql_request)) {
        echo "invoices add \n";
    }else{
        echo "problem the invoices is not add \n";
    }
}

// Fill cart_product table

for ($i = 0; $i < 100; $i++) {
    $cart_id = $faker->numberBetween(1, 80);
    $product_id = $faker->numberBetween(1, 80);
    $quantity = $faker->numberBetween(1, 10);

    $sql_request = "INSERT INTO cart_product (cart_id, product_id, quantity) VALUES ('$cart_id', '$product_id', '$quantity')";

    if (mysqli_query($conn, $sql_request)) {
        echo "cart_product add \n";
    }else{
        echo "problem the cart_product is not add \n";
    }
}

// Fill command_product table

for ($i = 0; $i < 100; $i++) {
    $command_id = $faker->numberBetween(1, 80);
    $product_id = $faker->numberBetween(1, 80);
    $quantity = $faker->numberBetween(1, 10);

    $sql_request = "INSERT INTO command_product (command_id, product_id, quantity) VALUES ('$command_id', '$product_id', '$quantity')";

    if (mysqli_query($conn, $sql_request)) {
        echo "command_product add \n";
    }else{
        echo "problem the command_product is not add \n";
    }
}

// Fill photo_product table

for ($i = 0; $i < 100; $i++) {
    $photo_id = $faker->numberBetween(1, 80);
    $product_id = $faker->numberBetween(1, 80);

    $sql_request = "INSERT INTO photo_product (photo_id, product_id) VALUES ('$photo_id', '$product_id')";

    if (mysqli_query($conn, $sql_request)) {
        echo "photo_product add \n";
    }else{
        echo "problem the photo_product is not add \n";
    }
}

// Fill photo_product table

for ($i = 0; $i < 100; $i++) {
    $photo_id = $faker->numberBetween(1, 80);
    $user_id = $faker->numberBetween(1, 80);

    $sql_request = "INSERT INTO photo_user (photo_id, user_id) VALUES ('$photo_id', '$user_id')";

    if (mysqli_query($conn, $sql_request)) {
        echo "photo_user add \n";
    }else{
        echo "problem the photo_user is not add \n";
    }
} 

mysqli_close($conn);

?>