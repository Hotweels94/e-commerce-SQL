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

for ($i = 0; $i < 100; $i++) {
    $username = $faker->userName;
    $mail = $faker->email;
    $password = md5($faker->password);
    $cell_number = $faker->phoneNumber;

    $sql_request = "INSERT INTO user (username, mail, password, cell_number) VALUES ('$username', '$mail', '$password', '$cell_number')";

    if (mysqli_query($conn, $sql_request)) {
        echo "user add";
    }else{
        echo "problem the user is not add";
    }
}

mysqli_close($conn);

?>