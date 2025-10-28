<?php
include "includes/top.php";

exibe_erros(true);
somente_logado();
somente_adm();

?>

<h2>Lista de usuários do sistema</h2>

<a href="usuario_novo_form.php"><img src="./images/add.png" width="24px" height="24px" alt="Novo usuario"></a>
<table class="tabela">
    <tr class="linha_titulo">
        <td>ID</td>
        <td>NOME</td>
        <td>EMAIL</td>
        <td>GRUPO</td>
        <td></td>
        <td></td>
    </tr>

<?php
    $usuarioDAO = new UsuarioDAO();
    $lista_usuarios = $usuarioDAO->lista_todos();
    //var_dump($lista_usuarios);
    foreach($lista_usuarios as $usuario)
    {
?>
        <tr>
            <td class="celula_conteudo centro"><?= $usuario->get_id(); ?></td>
            <td class="celula_conteudo"><?= $usuario->get_nome(); ?></td>
            <td class="celula_conteudo"><?= $usuario->get_email(); ?></td>
            <td class="celula_conteudo"><?= $usuario->get_grupo()->get_nome(); ?></td>

<?php
        // Os usuários "adm@adm.com", "usuario@usuario.com" e "fercosmig@gmail.com"
        // não exibem os botões de alterar e excluir.
        if ($usuario->get_id() > 3)
        {
?>
            <td class="celula_conteudo centro"><img src="./images/change.png" width="24px" height="24px" alt="Alterar usuario" onclick="envia('usuario', 'alterar', <?= $usuario->get_id(); ?>);"></td>
            <td class="celula_conteudo centro"><img src="./images/delete.png" width="24px" height="24px" alt="Excluir usuario" onclick="envia('usuario', 'excluir', <?= $usuario->get_id(); ?>);"></td>
<?php
        }
        else
        {
?>
            <td class="celula_conteudo centro"><img src="./images/proibido.png" width="24px" height="24px" alt="Alterar usuario"></td>
            <td class="celula_conteudo centro"><img src="./images/proibido.png" width="24px" height="24px" alt="Excluir usuario"></td>
<?php
        }
?>
       </tr>
<?php        
    }
?>
</table>

<br>
<br>
<br>
<br>
<br>

<?php
include "includes/bottom.php";
?>