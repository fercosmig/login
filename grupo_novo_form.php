<?php
include "includes/top.php";

somente_logado();
somente_adm();
?>
<br><br>
<h2>Formulário de cadastro de novos grupos</h2>
<br><br>
<br><br>

<input type="button" onclick="direciona('grupo_lista.php')" value="Voltar">


<form id="form_novo" method="post" onsubmit="return trata_campos_form(this.id);" action="grupo_novo_script.php">

    <div class="tabela">
        <div class="linha">
            <div>
                <label for="nome" class="rot">Nome do grupo:</label>
                <input type="text" id="nome" name="nome" required autofocus class="t400">
            </div>
            <div>
                <input type="submit" value="Salvar">
                <input type="reset" value="Limpar">
                <input type="button" onclick="direciona('grupo_lista.php')" value="Cancelar">
            </div>
        </div>
    </div>

</form>

<input type="button" onclick="direciona('grupo_lista.php')" value="Voltar">

<br><br><br>
<br><br><br>
<br><br><br>
<?php
include "includes/bottom.php";
?>