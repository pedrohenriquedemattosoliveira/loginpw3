<?php
session.start();
require 'Contato.class.php';

$conecta = $contato = new Contato();

if( !$conecta ){
    echo "<h1>Erro ao conectar ao banco de dados</h1>";
    //exit;
}else{
    if( isset($_POST['nome'])){
        $nome  = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        echo $nome . " - " . $email . " - " . $senha;
        if( isset($_POST['btnEntrar'])){
            $user = $contato->chkUser($email);
            if($user){
               $user = $contato->chkUserPass($email, $senha); 
               if($user){
                   $_SESSION['email'] = $email;
                   $_SESSION['nome'] = $nome;
                   header("location:pagina2.php");
               }
               else{
                   echo"Usuario ou Senha invalidos";
               }
            }else{
                echo "<h1>Usuario nao cadastrado. Crie uma conta</h1>";
            }

        }else{
            if( isset($_POST['btn_cadastrar'])){
                $conecta->insertContato($nome, $email, $senha);
            }else{
                exit;
            }
        }
    }

}
