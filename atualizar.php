<?php
require "Contato.class.php";

$contato = new Contato();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['email'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        
        if (!empty($_POST['senha'])) {
            $senha = $_POST['senha'];
        } else {
            $usuario = $contato->getById($id);
            if ($usuario) {
                $senha = $usuario['senha'];
            } else {
                echo "<script>
                alert('Erro: Usuário não encontrado');
                window.location.href = 'contatos.php';
                </script>";
                exit;
            }
        }
        
        if (empty($nome) || empty($email)) {
            echo "<script>
            alert('Nome e email não podem estar vazios');
            window.location.href = 'editar.php?id=$id';
            </script>";
            exit;
        }
        
        $resultado = $contato->atualizar($id, $nome, $email, $senha);
        
        if ($resultado) {
            echo "<script>
            alert('Contato atualizado com sucesso');
            window.location.href = 'contatos.php';
            </script>";
            header("location:contatos.php");
        } else {
            echo "<script>
            alert('Erro ao atualizar contato. Verifique se houve alguma alteração nos dados.');
            window.location.href = 'editar.php?id=$id';
            </script>";
        }
    } else {
        echo "<script>
        alert('Todos os campos obrigatórios devem ser preenchidos');
        window.location.href = 'contatos.php';
        </script>";
    }
} else {
 
    echo "<script>
    alert('Acesso inválido');
    window.location.href = 'contatos.php';
    </script>";
}
?>