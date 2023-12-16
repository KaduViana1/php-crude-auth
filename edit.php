<?php
session_start();
include "db.php";

$id= "";
$name = "";
$email = "";
$password = "";
$phone = "";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    
    if(!isset($_GET['id'])) {
        header('location: /test/signin.php');
        exit;
    }

    $id= $_GET['id'];

    $sql = " SELECT * FROM users WHERE id = '$id' ";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    $name = $row['nome'];
    $email = $row['email'];
    $password = $row['senha'];
    $phone = $row['telefone'];

}


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT );
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
  
    $errorMessages = array(
    "name" => "",
    "emaik" => "",
    "password" => "",
    "query" => "",
);

if(empty($name)) $errorMessages['name'] = 'Please enter a valid name'; 
if(empty($email)) $errorMessages['email'] = 'Please enter an valid email'; 
if(empty($password)) $errorMessages['password'] = 'Please enter a valid password'; 

if(!empty($name) && !empty($email) && !empty($password)) {
$hashed = password_hash($password, PASSWORD_DEFAULT);


$sql = "UPDATE users " . "SET nome = '$name', email = '$email', senha = '$hashed', telefone = '$phone' " . "WHERE id = '$id' ";



$result = $connection->query($sql);

if(!$result) {
 $errorMessages["query"] = "Invalid query: $connection->error";
} 

};
}

mysqli_close($connection);
?>


<?php include 'header.php' ?>


    <main>
        <h1>Editar</h1>
        <?php
             if(!empty($errorMessages["nquery"])) echo "<div class='error'> {$errorMessages['query']} </div>"    
             ?> 
        
        <form action="" method="post" class="form">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
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
            <input class="botao" type='submit' value="Enviar"  style="width: 150px; margin-inline: auto; font-size: 1.2rem"/>
        </form>
        
    </main>


<?php include 'footer.php' ?>