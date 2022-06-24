<?php
require 'functions.php';
$connection = dbConnect();

$voornaam = '';
$email = '';
$onderwerp = '';
$bericht = '';

$errors = [];

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $voornaam = $_POST['voornaam'];
    $email = $_POST['email'];
    $onderwerp = $_POST['onderwerp'];
    $bericht = $_POST['bericht'];
    $tijdstip = date('Y-m-d H:i:s');

    if( isEmpty($voornaam) ){
        $errors['voornaam'] = 'Vul uw voornaam in.';
    }
    if(!isValidEmail($email)){
        $errors['email'] = 'Dit is geen geldig Email-adres!';
    }
    if( isEmpty($onderwerp) ){
        $errors['onderwerp'] = 'Vul het onderwerp in.';
    }
    if( !hasMinLength($bericht, 5) ){
        $errors['bericht'] = 'Vul minimaal 5 tekens in.';


    }

    if(count($errors) == 0){
        $sql = "INSERT INTO `berichten` ( `voornaam`,`email`, `onderwerp`, `bericht`, `tijdstip`)
            VALUES ( :voornaam, :email, onderwerp, :bericht, :tijdstip);";

        $statement = $connection->prepare($sql);
        $params = [
        'voornaam' => $voornaam,
        'email' => $email,
        'onderwerp' => $onderwerp,
        'bericht' => $bericht,
        'tijdstip' => $tijdstip
        ];        

        $statement->execute($params);
        header('location: bedankt.html');
        exit;
}
    

}

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
        <h1 class="contact_h1">neem contact op!</h1>

        <section class="contact_head">

            <header class="contact_header">
                <h2> have a question?</h2>
            </header>

            <form action="contact.php" method="POST" novalidate>
                <div class="contact_form">
                    <label for="voornaam">Voornaam</label>
                    <input type="text" value="<?php echo $voornaam;?>" id="voornaam" name="voornaam" placeholder="Vul uw voornaam in" required>

                    <?php if(!empty($errors['voornaam'])):?>
                        <p class="form_error"><?php echo $errors['voornaam']?></p>
                    <?php endif;?>

                <div class="contact_form">
                    <label for="email">E-mail</label>
                    <input type="email" value="<?php echo $email;?>" id="email" name="email" placeholder="Vul uw e-mailadres in" required>
                    <?php if(!empty($errors['email'])):?>
                        <p class="form_error"><?php echo $errors['email']?></p>
                    <?php endif;?>
                </div>

                <div class="contact_form">
                    <label for="onderwerp">Onderwerp</label>
                    <input type="onderwerp" value="<?php echo $email;?>" id="onderwerp" name="onderwerp" placeholder="Vul het onderwerp in" required>
                    <?php if(!empty($errors['onderwerp'])):?>
                        <p class="form_error"><?php echo $errors['onderwerp']?></p>
                    <?php endif;?>
                </div>

                <div class="contact_form">
                    <label for="bericht">Bericht</label>
                    <textarea id="bericht" name="bericht" placeholder="Vul uw vraag of bericht in" required><?php echo $bericht;?></textarea>
                    <?php if(!empty($errors['bericht'])):?>
                        <p class="form_error"><?php echo $errors['bericht']?></p>
                    <?php endif;?>
                    <button type="submit" class="contact_button">Opsturen</button>
                </div>
                

            </form>

        </section>
    </div>
    
</body>

</html>