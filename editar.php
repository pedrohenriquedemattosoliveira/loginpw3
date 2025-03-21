<?php
require "Contato.class.php";

$contato = new Contato();

if(!$contato){
    echo "<script>
    alert('Falha ao conectar com o banco de dados. tente mais tarde')
    window.location.href = 'sair.php';
    </script>";
} else {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $usuario = $contato->getById($id);
        
        if($usuario) {
            ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="css/editar.css">

</head>
<body>
    <div class="container">
        <h1>Editar Contato</h1>
        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
            
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo $usuario['nome']; ?>" required>
            </div>
            
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>" required>
            </div>
            
            <div>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Digite para alterar a senha">
            </div>
            
            <div class="form-actions">
                <button type="submit">Atualizar</button>
                <a href="contatos.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
            <?php
        } else {
            echo "<script>
            alert('Usuário não encontrado')
            window.location.href = 'contatos.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('ID não informado')
        window.location.href = 'contatos.php';
        </script>";
    }
}
?>