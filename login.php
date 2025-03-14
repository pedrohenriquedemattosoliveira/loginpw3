<?php
session_start();

//importa a classe Contato
require 'Contato.class.php';

//cria um objeto da classe Contato e conecta ao banco de dados
$conecta = $contato = new Contato();

if( !$conecta ){
    echo "<h1>Erro ao conectar ao banco de dados</h1>";
    exit;
} else {
    // se o usuario clicou no botao entrar passo os dados do post
    // para variaveis locais
    if( isset($_POST['btnEntrar'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        //imprimo para ver se os dados vieram do formulario
        //echo"$nome - $email - $senha";

        $user = $contato->chkUser($email);

        if( $user ){
            $user = $contato->chkUserPass($email, $senha);
            if( !empty($user)  ){
                // se o usuario e senha estiverem corretos
                $_SESSION['nome'] = $user['nome'];
                header("location:pagina2.php");
            } else {
                echo "<script> 
                alert('Usuario ou Senha incorretos');</script>";
                
                exit;
            }
        } else {
            echo "<script>
            alert('Usuario não encontrado');</script>";
            exit;
        }
   } else {
        if( isset( $_POST['btnCadastrar'])){
            $nome  = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
            $user = $contato->chkUser($email);
            
            if($user){
                echo "<h1>Usuario já existe. Va para o login</h1>";
            } else {
                $contato->insertUser($nome, $email, $senha);  // Alterado de cadastraUser para insertUser
            }
        }
   }
}
?>