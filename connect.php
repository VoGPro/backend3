<?php
$name = $_POST['name'];
$email = $_POST['email'];
$birth_date = $_POST['birth_date'];
$gender = $_POST['gender'];
$limbs = $_POST['limbs'];
$superpowers = $_POST['superpowers'];
$bio = $_POST['bio'];
$contract = $_POST['contract'];

//Database connection
$conn = new mysqli('localhost','u52985','8415427','u52985');
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connection_error);
} else {
    $stmt = $conn->prepare("INSERT INTO users(name, email, birth_date, gender, limbs, bio, contract)
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $name, $email, $birth_date, $gender, $limbs, $bio, $contract);
    $stmt->execute();
    echo "Last id: ";
    $last_id = mysqli_insert_id($conn);
    echo $last_id;
    foreach ($superpowers as $item) {
        $query = "INSERT INTO user_superpowers (user_id, superpower_id) VALUES ('$last_id', '$item')";
        mysqli_query($conn, $query);
    }
    echo ". Success!!!";
    $stmt->close();
    $conn->close();
}
?>