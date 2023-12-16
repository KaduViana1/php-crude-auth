<?php
session_start();
include "db.php";


$email = "";
$password = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
  
    $errorMessages = array(
    "email" => "",
    "password" => "",
    "query" => "",
);

if(empty($email)) $errorMessages['email'] = 'Please enter an valid email'; 
if(empty($password)) $errorMessages['password'] = 'Please enter a valid password'; 

if(!empty($email) && !empty($password)) {    
$sql = "SELECT * FROM users WHERE email = '$email' ";
$result = mysqli_query($connection ,$sql);


if(!$result) {
 $errorMessages["query"] = "Invalid query: $connection->error";
} else {
$user = $result->fetch_assoc();


if(isset($user)) {

if(!password_verify($password, $user['senha'])) {
  $errorMessages["query"] = "Email ou senha incorretos";
} else {
$_SESSION['user'] = $user;

header('Location: /test');
exit;
}}}}}

mysqli_close($connection);
?>


<?php include 'header.php' ?>
    <main>
        <h1>Login</h1>
        <?php
             if(!empty($errorMessages["nquery"])) echo "<div class='error'> {$errorMessages['query']} </div>"    
             ?>       
        <form action="" method="post" class="form">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="text-input" value="<?php echo $email ?>"  >
             <?php
             if(!empty($errorMessages["email"])) echo "<div class='error'> {$errorMessages['email']} </div>"    
             ?> 
            <label for="name">Senha:</label>
            <input type="password" class="text-input" id="password" name="password" value="<?php echo $password ?>" >
             <?php
             if(!empty($errorMessages["password"])) echo "<div class='error'> {$errorMessages['password']} </div>"    
             ?> 
            <div class="buttons">
                <a class='botao' href="/test/signup.php" style="width: 150px; margin-inline: auto; font-size: 1.2rem; text-align: center;" role="button">Cadastre-se</a>
                <input class="botao" type='submit' value="Enviar"  style="width: 150px; margin-inline: auto; font-size: 1.2rem"/>
            </div>
        </form>
    </main>
<?php include 'footer.php' ?>