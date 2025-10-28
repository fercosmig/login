/*
Recebe (objeto) uma string com o prefixo do nome da página. Ex.: grupo, usuario...
Recebe (acao) a ação: alterar ou excluir.
Recebe (id) o id do registro que será manipulado.
Monta o nome da página de destino e redireciona para a mesma.
No caso de exclusão solicita uma confirmação do usuário.
*/
function envia(objeto, acao, id)
{
  switch (acao)
  {
    case 'alterar':
        pagina = objeto + '_alteracao_form.php?id=' + id;
        window.location.href = pagina;
        break;
    case 'excluir':
        pagina = objeto + '_exclusao_script.php?id=' + id;
        if (confirm ('Tem certeza? Esta ação não poderá ser desfeita!'))
        {
            window.location.href = pagina;
        }
        else
        {
            alert('Ação cancelada! Sábia decisão!');
        }
        break;
  }
}

/*
Recebe o id do formulário.
Percorre todos os elementos do formulario.
Se tipo text ou password remove os espaços em branco do início e do final e verifica o valor do campo.
Exibe um alerta se tiver campos vazios.
Retorna FALSE se tiver campos vazios ou TRUE se estiver tudo preenchido.
*/
function trata_campos_form(form_id)
{
    form = document.getElementById(form_id);
    retorno = true;

    for (i = 0; i < form.elements.length; i++)
    {
        elemento = form.elements[i];
        tipo = elemento.type;
        
        if (tipo == 'text' || tipo == 'password'){
            valor = elemento.value;
            valor = valor.trim();
            if (valor == '')
            {
                alert('campo ' + elemento.name + ' não pode ser vazio.');
                retorno = false;
            }
        }
    }
    return retorno;
}

/*
Recebe o id do formulario.
Verifica se os campos senha1 e senha2 são iguais (confirmação de senha).
Se as senhas digitadas forem iguais envia o id do formulario para a função trata_campos_form.
Retorna TRUE ou FALSE se as senhas forem diferentes ou contiver campos vazios.
Usada na página usuario_novo_form.php, onde a senha e a confirmação de senha devem ser iguais.
*/
function verifica_senha(form_id)
{
    retorno = false;
    senha1 = document.getElementById('senha1').value.trim();
    senha2 = document.getElementById('senha2').value.trim();

    if (senha1 != "" && senha2 != "" && senha1 == senha2)
    {
        if(trata_campos_form(form_id))
        {
            retorno = true;
        }
    }
    else
    {
        alert('Os campos senha e repetir senha devem ser iguais!');
    }
    return retorno;
}