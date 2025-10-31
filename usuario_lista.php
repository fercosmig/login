<?php
include "includes/top.php";

exibe_erros(true);
somente_logado();
somente_adm();

$usuarioDAO = new UsuarioDAO();
$lista_usuarios = $usuarioDAO->lista_todos();
?>
 <br><br>
<h2>Lista de usuários do sistema</h2>
<br><br>

<input type="button" onclick="direciona('home.php');" value="Voltar">
<input type="button" onclick="direciona('usuario_novo_form.php');" value="Novo usuário">

<div class="tabela">

<?php
foreach($lista_usuarios as $usuario)
{
?>
    <div class="linha">
        <div>
            <table>
                <tr>
                    <td style="width: 50px"><span class="rot">Id:</span></td>
                    <td style="width: 200px"><span class="val"><?= $usuario->get_id(); ?></span></td>
                    <td style="width: 50px"><span class="rot">Nome:</span></td>
                    <td style="width: 300px"><span class="val"><?= $usuario->get_nome(); ?></span></td>
                </tr>
                <tr>
                    <td style="width: 50px"><span class="rot">E-mail:</span></td>
                    <td style="width: 200px"><span class="val"><?= $usuario->get_email(); ?></span></td>
                    <td style="width: 50px"><span class="rot">Grupo:</span></td>
                    <td style="width: 300px"><span class="val"><?= $usuario->get_grupo()->get_nome(); ?></span></td>
                </tr>
            </table>
        </div>
        <div>
<?php
    if ($usuario->get_id() > 3)
    {
?>            
            <input type="button" onclick="envia('usuario', 'alterar', <?= $usuario->get_id(); ?>);" value="Alterar">
            <input type="button" onclick="envia('usuario', 'excluir', <?= $usuario->get_id(); ?>);" value="Excluir">
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
<input type="button" onclick="direciona('usuario_novo_form.php');" value="Novo usuário">

<br><br><br><br><br>
<?php
include "includes/bottom.php";
?>