<?php
include "includes/top.php";

exibe_erros(true);
somente_logado();
somente_adm();
?>

<h2>Lista de grupos de segurança</h2>

<input type="button" onclick="direciona('home.php');" value="Voltar">
<input type="button" onclick="direciona('grupo_novo_form.php');" value="Novo grupo">

<?php
$grupoDAO = new GrupoDAO();
$lista_grupos = $grupoDAO->lista_todos();
?>

<div class="tabela">
<?php
foreach($lista_grupos as $grupo)
{
?>
    <div class="linha">
        <div>
            <table>
                <tr>
                    <td style="width: 10px"><span class="rot">Id:</span></td>
                    <td style="width: 20px"><span class="val"><?= $grupo->get_id(); ?></span></td>
                    <td style="width: 10px;"></td>
                    <td style="width: 50px"><span class="rot">Nome:</span></td>
                    <td><span class="val"><?= $grupo->get_nome(); ?></span></td>
                </tr>
            </table>           
        </div>
        <div>
<?php
    if ($grupo->get_id() > 2)
    {
?>
            <input type="button" onclick="envia('grupo', 'alterar', <?= $grupo->get_id(); ?>);" value="Alterar">
            <input type="button" onclick="envia('grupo', 'excluir', <?= $grupo->get_id(); ?>);" value="Excluir">
<?php            
    }
?>
        </div>
    </div>   
<?php
}
?>
</div>

<input type="button" onclick="direciona('home.php');" value="Voltar">
<input type="button" onclick="direciona('grupo_novo_form.php');" value="Novo grupo">

<br>
<br>
<br>
<br>
<br>

<?php
include "includes/bottom.php";
?>