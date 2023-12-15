<?php
include "db.php";

$title= 'Sign up';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
  
    $errorMessages = array(
    "name" => "",
    "emaik" => "",
    "password" => "",
);

if(empty($name)) $errorMessages['name'] = 'Please enter a valid name'; 
if(empty($email)) $errorMessages['email'] = 'Please enter an valid email'; 
if(empty($password)) $errorMessages['password'] = 'Please enter a valid password'; 

if(isset($name) && isset($email) && isset($password)) {
$hashed = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (nome, email, senha) VALUES ('$name', '$email' , '$hashed' )";

};

 mysqli_query($connection ,$sql);


}







mysqli_close($connection);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>PHP Test</title>
</head>
<body>
    <main>
        <h1><?php echo $title ?></h1>
        
        <form action="index.php" method="post" class="form">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" >
             <?php
             if(!empty($errorMessages["name"])) echo "<div class='error'> {$errorMessages['name']} </div>"    
             ?> 
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"  >
             <?php
             if(!empty($errorMessages["email"])) echo "<div class='error'> {$errorMessages['email']} </div>"    
             ?> 
            <label for="name">Senha:</label>
            <input type="password" id="password" name="password"  >
             <?php
             if(!empty($errorMessages["password"])) echo "<div class='error'> {$errorMessages['password']} </div>"    
             ?> 
            <button class="botao" type='submit' >Enviar</button>
        </form>
        
    </main>
</body>
</html>

