<?php
require 'functions.php';
$connection = dbConnect();

$result = $connection->query('SELECT * FROM `berichten` WHERE 1=1');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>formulier</title>
</head>
<body>
    <div class="container">
        <h1>portfolio</h1>

        <section class="projecten">
            <?php foreach($result as $row): ?>

            <article class="titels">
                <h2><?php echo $row['titel']; ?></h2>
                <figure class="foto"><img src="img/<?php echo $row['foto']; ?>" alt="project 1" width="300px" height="300px"></figure>
                <header>
                </header>
                <p class="beschrijving"><?php echo $row['beschrijving']; ?></p>
                <a class="button" href="details.php?id=<?php echo $row['id'];?>">Meer Info</a>
            </article>

            <?php endforeach; ?>

        


        </section>
    </div>
    
</body>
</html>