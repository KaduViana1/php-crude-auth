<?php
session_start();
include "db.php";


$name = "";
$email = "";
$password = "";
$phone = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT );
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
  
    $errorMessages = array(
    "name" => "",
    "email" => "",
    "password" => "",
    "query" => "",
);

if(empty($name)) $errorMessages['name'] = 'Please enter a valid name'; 
if(empty($email)) $errorMessages['email'] = 'Please enter an valid email'; 
if(empty($password)) $errorMessages['password'] = 'Please enter a valid password'; 

if(!empty($name) && !empty($email) && !empty($password)) {
$hashed = password_hash($password, PASSWORD_DEFAULT);
$id = uniqid();

$sql = "INSERT INTO users (id ,nome, email, telefone , senha) VALUES ('$id' ,'$name', '$email', '$phone' , '$hashed' )";

$result = mysqli_query($connection ,$sql);

if(!$result) {
 $errorMessages["query"] = "Invalid query: $connection->error";
} else {

$sql2 = "SELECT * FROM users WHERE id = '$id'";
$userResult = $connection->query($sql2);
$user = $userResult->fetch_assoc();

if(isset($user)) {
$_SESSION['user'] = $user;

header('Location: /test');

}

    
}

};
}

mysqli_close($connection);
?>


<?php include 'header.php' ?>


    <main>
        <h1>Cadastro</h1>
        <?php
             if(!empty($errorMessages["nquery"])) echo "<div class='error'> {$errorMessages['query']} </div>"    
             ?> 
        
        <form action="" method="post" class="form">
             
            <label for="name">Nome <small>*</small>:</label>
            <input type="text" id="name" name="name" class="text-input" value="<?php echo $name ?>" >
             <?php
             if(!empty($errorMessages["name"])) echo "<div class='error'> {$errorMessages['name']} </div>"    
             ?> 
            <label for="email">Email <small>*</small>:</label>
            <input type="email" id="email" name="email" class="text-input" value="<?php echo $email ?>"  >
             <?php
             if(!empty($errorMessages["email"])) echo "<div class='error'> {$errorMessages['email']} </div>"    
             ?> 
            <label for="phone">Telefone:</label>
            <input type="number id="phone" name="phone" class="text-input" value="<?php echo $phone ?>"  >
            <label for="name">Senha <small>*</small>:</label>
            <input type="password" class="text-input" id="password" name="password" value="<?php echo $password ?>" >
             <?php
             if(!empty($errorMessages["password"])) echo "<div class='error'> {$errorMessages['password']} </div>"    
             ?> 
            <div class="buttons">
                <a class='botao' href="/test/login.php" style="width: 150px; margin-inline: auto; font-size: 1.2rem; text-align: center;" role="button">Log in</a>
                <input class="botao" type='submit' value="Enviar"  style="width: 150px; margin-inline: auto; font-size: 1.2rem"/>
            </div>
        </form>
        
    </main>


<?php include 'footer.php' ?>