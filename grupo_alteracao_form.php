<?php
include "includes/top.php";
require_once "./classes/classGrupoDAO.php";

exibe_erros(true);
somente_logado();
somente_adm();

$id_grupo = trata_str($_GET["id"]);

$grupo = new Grupo();
$grupoDAO = new GrupoDAO();
$grupo = $grupoDAO->registro_por_id($id_grupo);
?>

<br><br>
<h2>Formulário de alteração de grupos</h2>
<br><br>

<input type="button" onclick="direciona('grupo_lista.php');" value="Voltar">

<form id="form_alteracao" method="post" onsubmit="return trata_campos_form(this.id);" action="grupo_alteracao_script.php">

    <div class="tabela">
        <div class="linha">
            <div>
                <table>
                    <tr>
                        <td><span>Id:</span></td>
                        <td><input type="text" id="id" name="id" value="<?= $grupo->get_id(); ?>" readonly class="t25"></td>
                        <td><span>Nome:</span></td>
                        <td><input type="text" id="nome" name="nome" value="<?= $grupo->get_nome(); ?>" required autofocus class="t400"></td>
                    </tr>
                </table>
            </div>
            <div>
                <input type="submit" value="Salvar">
                <input type="button" onclick="direciona('grupo_lista.php');" value="Cancelar">
            </div>
        </div>
    </div>

</form>

<input type="button" onclick="direciona('grupo_lista.php');" value="Voltar">

<br><br><br>
<br><br><br>
<br><br><br>
<br><br>
<?php
include "includes/bottom.php";
?>