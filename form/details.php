<?php
require 'functions.php';
$connection = dbConnect();

if( !isset($_GET['id']) ){
    echo "de ID is niet gezet";
    exit;
}

$id = $_GET['id'];
$check_int = filter_var($id, FILTER_VALIDATE_INT);
if($check_int == false){
    echo "dit is geen getal (integer)";
    exit;
}

$statement = $connection->prepare('SELECT * FROM `berichten` WHERE id=?');
$params = [$id];
$statement->execute($params);
$place = $statement->fetch(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="header"><?php echo $place['titel']?></h1>
        <figure><img src="img/<?php echo $place['foto']?>" alt="" width="700px" height="500px"></figure>
        <p class="p"><?php echo $place['info']?></p>
        <a href="contact.php">Neem contact op</a>
        <hr>
        <a href="index.php">terug naar overzicht</a>

        

     

        

    </div>
    
</body>
</html>