function envia(objeto, acao, id)
{
  switch (acao)
  {
    case 'alterar':
        pagina = objeto + '_alteracao_form.php?id=' + id;
        //window.location.href = pagina;
        alert(pagina);
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