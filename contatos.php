<?php
include 'Contato.class.php'; 

$contatos = new Contato();
?>
<link rel="stylesheet" href="css/lista.css">

<table>
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Email</th> 
        <th>Acoes</th>
    </tr>

<?php
$lista = $contatos->getAll(); 

foreach ($lista as $contato) { 
    ?>
    <tr>
        <td><?php echo $contato['id']; ?></td>
        <td><?php echo $contato['nome']; ?></td>
        <td><?php echo $contato['email']; ?></td>
        <td>
        <a href="editar.php?id=<?php echo $contato['id']; ?>" class="btn btn-edit">Editar</a>
        <a href="excluir.php?id=<?php echo $contato['id']; ?>" class="btn btn-delete">Excluir</a>
        </td>
    </tr>
    <?php
}
?>
</table> 