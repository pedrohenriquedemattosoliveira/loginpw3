<?php
include "contato.class.php";

$contato = new Contato();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $del = $contato->deletar($id);
    /*if($del){
        echo "Contato excluido com sucesso";
    }else{
        echo "Erro ao excluir contato";
    }*/



header("location:contatos.php");
}
?>