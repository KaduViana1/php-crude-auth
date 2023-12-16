<?php
include "db.php";
session_start();

if(!isset($_SESSION['user'])) {
    // $user = array("nome" => "Visitor");
    header('location: /test/login.php');
    exit;
} else {
    $user = $_SESSION['user'];
}


$sql = 'SELECT * FROM users';
$results = $connection->query($sql);

if (empty($results)) {
    die("invalid query" . $connection->error);
}

mysqli_close($connection);
?>


<?php include 'header.php' ?>
    <main>
        <div class="container">
        <div class="header">
            <h1>Hello <?php echo $user['nome'] ?></h1>
            <a class='botao' href="/test/logout.php" role="button">Logout</a>
        </div>
        
        <?php 
            echo "
            <table>
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Telefone</th>
                  <th>Data de registro</th>
                  <th>Ações</th>
                </tr>
              </thead>
            <tbody>";

            while($row = $results->fetch_assoc()) {
             echo " 
              <tr>
              <td>{$row['nome']}</td>
              <td>{$row['email']}</td>
              <td>{$row['telefone']}</td>
              <td>{$row['registro']}</td>
              <td>
              <a href='/test/edit.php?id={$row['id']}'>
              <svg xmlns='http://www.w3.org/2000/svg' width='25' height=25 viewBox='0 0 24 24'><g fill='yellow'><path d='M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157l3.712 3.712l1.157-1.157a2.625 2.625 0 0 0 0-3.712Zm-2.218 5.93l-3.712-3.712l-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z'/><path d='M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z'/></g></svg>
              </a>
              <a href='/test/delete.php?id={$row['id']}'>
              <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' viewBox='0 0 24 24'><path fill='red' fill-rule='evenodd' d='M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512a.75.75 0 1 1-.256 1.478l-.209-.035l-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z' clip-rule='evenodd'/></svg>
              </a>
              </td>
              </tr>";
            }

            echo "
                  </tbody>
                  </table>";
         ?>

       </div>
    </main>
<?php include 'footer.php' ?>