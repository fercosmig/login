<?php
include "includes/top.php";

exibe_erros(true);
somente_logado();
somente_adm();

$id_usuario = trata_str($_GET["id"]);

$usuario = new Usuario();
$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->registro_por_id($id_usuario);

$grupoDAO = new GrupoDAO();
$lista_grupos = $grupoDAO->lista_todos();
?>
<br><br>
<h2>Formulário de alteração de usuários</h2>
<br><br>

<input type="button" onclick="direciona('usuario_lista.php')" value="Voltar">

<form id="form_novo" method="post" onsubmit="return verifica_senha(this.id);" action="usuario_alteracao_script.php">

    <div class="tabela">
        <div class="linha">
            <table>
                <tr>
                    <td><span class="rot">Id:</span></td>
                    <td><input type="text" id="id" name="id" value="<?= $usuario->get_id(); ?>" readonly class="t25"></td>
                </tr>
                <tr>
                    <td><span class="rot">Nome:</span></td>
                    <td><input type="text" id="nome" name="nome" value="<?= $usuario->get_nome(); ?>" required autofocus class="t400"></td>
                </tr>
                <tr>
                    <td><span class="rot">E-mail:</span></td>
                    <td><input type="text" id="email" name="email" value="<?= $usuario->get_email(); ?>" readonly class="t400"></td>
                </tr>
                <tr>
                    <td><span class="rot">Senha:</span></td>
                    <td><input type="password" id="senha" name="senha" value="<?= $usuario->get_senha(); ?>"  readonly class="t400"></td>
                </tr>
                <tr>
                    <td><span class="rot">Grupo:</span></td>
                    <td>
                        <select id="grupo" name="grupo" required class="t400">
                            <option></option>
<?php
foreach ($lista_grupos as $grupo)
{
    $str = "";
    if ($grupo->get_id() == $usuario->get_grupo()->get_id())
    {
        $str = "selected";
    }
?>
                            <option value="<?= $grupo->get_id(); ?>" <?= $str; ?>><?= $grupo->get_nome(); ?></option>
<?php
}
?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Salvar">
                        <input type="button" onclick="direciona('usuario_lista.php')" value="Cancelar">
                    </td>
                </tr>
            </table>
        </div>
    </div>

</form>

<input type="button" onclick="direciona('usuario_lista.php')" value="Voltar">
<br><br><br><br><br>
<?php
include "includes/bottom.php";
?>