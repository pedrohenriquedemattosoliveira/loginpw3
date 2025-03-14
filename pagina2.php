<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status de Login</title>
    <link rel="stylesheet" href="css/pg2.css">
</head>
<body>
    <div class="container">
        <h1>Status de Login</h1>
        
        <?php
        if(isset($_SESSION['nome'])){
            echo '<div class="message logged-in">Olá ' . $_SESSION['nome'] . '</div>';
        } else {
            echo '<div class="message not-logged">Você não está logado</div>';
        }
        ?>
        
        <div class="links">
           
            <a href="sair.php" class="exit">Sair</a>
        </div>
    </div>
</body>
</html>