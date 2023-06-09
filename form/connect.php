<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection Result</title>
    <style>
        .vertical-center {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
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
$conn = new mysqli('localhost','root','','test');
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO users(name, email, birth_date, gender, limbs, bio, contract)
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $name, $email, $birth_date, $gender, $limbs, $bio, $contract);
    $stmt->execute();
    $last_id = mysqli_insert_id($conn);
    foreach ($superpowers as $item) {
        $query = "INSERT INTO user_superpowers (user_id, superpower_id) VALUES ('$last_id', '$item')";
        mysqli_query($conn, $query);
    }
    $stmt->close();
    $conn->close();
}
?>
<body>
    <div class="container vertical-center">
        <div class="container rounded-pill shadow-lg bg-dark text-white text-center">
            <p class="fs-3 fw-bold">Success!!!</p>
            <p class="fs-4 fw-bold">Your id: <?=$last_id?></p>
        </div>
    </div>
</body>
</html>
