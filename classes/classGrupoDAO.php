<?php
require_once "./includes/functions.php";
require_once "./classes/classGrupo.php";

class GrupoDAO
{
    // Insere novo grupo na tabela.
    // Recebe um objeto da classe Grupo.
    // Retorna TRUE se der certo ou FALSE se der erro.
    public function insere($grupo)
    {
        $retorno = false;
        $sql = "INSERT INTO tb_grupo (nome) VALUES (:nome);";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $grupo->get_nome(), PDO::PARAM_STR);
            $stmt->execute();
            $retorno = true;
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            $pdo = null;
            $stmt = null;
        }
        return $retorno;
    }

    // Lista todos os grupos cadastrados na tabela.
    // Retorna um array de objetos da classe Grupo.
    public function lista_todos()
    {
        $sql = "SELECT id, nome FROM tb_grupo ORDER BY nome ASC;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            //$linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $linhas = $stmt->fetchAll(PDO::FETCH_CLASS, 'Grupo');
            $pdo = null;
            $stmt = null;
        }         
        return $linhas;            
    }
    
    // Busca um grupo específico por id.
    // Recebe um integer com o id do grupo.
    // Retorna um objeto da classe Grupo.
    public function registro_por_id($id_grupo)
    {
        $sql = "SELECT id, nome FROM tb_grupo WHERE id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id_grupo, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            $linha = $stmt->fetch(PDO::FETCH_ASSOC);
            $grupo = new Grupo();
            $grupo->set_id($linha['id']);
            $grupo->set_nome($linha['nome']);

            $pdo = null;
            $stmt = null;
        } 
        return $grupo;
    }

    // Altera os dados de um grupo.
    // Recebe um objeto da classe Grupo.
    // Retorna TRUE se der certo ou FALSE se der erro.
    public function altera($grupo)
    {
        $retorno = false;
        $sql = "UPDATE tb_grupo SET nome = :nome WHERE id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $grupo->get_nome(), PDO::PARAM_STR);
            $stmt->bindParam(":id", $grupo->get_id(), PDO::PARAM_INT);
            $stmt->execute();
            $retorno = true;
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            $pdo = null;
            $stmt = null;
        }
        return $retorno;
    }

    // Exclui um grupo da tabela.
    // Recebe um integer com o id do grupo.
    // Retorna TRUE se der certo ou FALSE se der erro.
    public function exclui($id_grupo)
    {
        $retorno = false;
        $sql = "DELETE FROM tb_grupo WHERE id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id_grupo, PDO::PARAM_INT);
            $stmt->execute();
            $retorno = true;
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            $pdo = null;
            $stmt = null;
        }        
        return $retorno;
    }

    // Verifica se nome do grupo já existe na tabela.
    // Recebe uma string com o nome do grupo.
    // Retorna TRUE caso já exista ou FALSE se não for encontrado.
    public function nome_ja_existe($nome_grupo)
    {
        $sql = "SELECT id, nome FROM tb_grupo WHERE nome = :nome;";

        $retorno = false;
        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $nome_grupo, PDO::PARAM_STR);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            alerta("Erro:" . $e->getMessage(), "");
            exit;
        }
        finally
        {
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $retorno = true;
            }

            $pdo = null;
            $stmt = null;
        }         
        return $retorno;
    }
}
?>