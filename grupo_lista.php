<?php
include "includes/top.php";

exibe_erros(true);
somente_logado();
somente_adm();
?>

<h2>Lista de grupos de segurança</h2>

<a href="grupo_novo_form.php"><img src="./images/add.png" width="24px" height="24px" alt="Novo grupo" /></a>

<table class="tabela">
    <tr class="linha_titulo">
        <td>ID</td>
        <td>NOME</td>
        <td></td>
        <td></td>
    </tr>

<?php
    $grupoDAO = new GrupoDAO();
    $lista_grupos = $grupoDAO->lista_todos();
    foreach($lista_grupos as $grupo)
    {
?>
        <tr>
            <td class="celula_conteudo centro"><?= $grupo->get_id(); ?></td>
            <td class="celula_conteudo"><?= $grupo->get_nome(); ?></td>
<?php
        // Os grupos "Usuários" e "Administradores" não exibem botão para alterar e excluir.
        if ($grupo->get_id() > 2)
        {
?>
            <td class="celula_conteudo centro"><img src="./images/change.png" width="24px" height="24px" alt="Alterar grupo" onclick="envia('grupo', 'alterar', <?= $grupo->get_id(); ?>);"></td>
            <td class="celula_conteudo centro"><img src="./images/delete.png" width="24px" height="24px" alt="Excluir grupo" onclick="envia('grupo', 'excluir', <?= $grupo->get_id(); ?>);"></td>
<?php
        }
        else
        {
?>
            <td class="celula_conteudo centro"><img src="./images/proibido.png" width="24px" height="24px" alt="Alterar grupo"></td>
            <td class="celula_conteudo centro"><img src="./images/proibido.png" width="24px" height="24px" alt="Excluir grupo"></td>
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