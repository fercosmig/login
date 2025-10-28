<?php
require_once "./includes/functions.php";
require_once "./classes/classGrupo.php";
require_once "./classes/classUsuario.php";

class UsuarioDAO
{
    // Verifica os dados de login do usuario.
    // Recebe um objeto da classe Usuario com email e senha.
    // Retorna um objeto da classe Usuario.
    public function login($usuario)
    {
        $sql = "SELECT tb_usuario.id, tb_usuario.nome, tb_usuario.email, tb_usuario.senha, ";
        $sql .= "tb_grupo.id as grupo_id, tb_grupo.nome as grupo_nome ";
        $sql .= "FROM tb_usuario ";
        $sql .= "INNER JOIN tb_grupo ";
        $sql .= "ON tb_usuario.id_grupo = tb_grupo.id ";
        $sql .= "WHERE tb_usuario.email = :email ";
        $sql .= "AND tb_usuario.senha = :senha;";
        
        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":email", $usuario->get_email(), PDO::PARAM_STR);
            $stmt->bindParam(":senha", $usuario->get_senha(), PDO::PARAM_STR);
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
                $grupo = new Grupo();
                $grupo->set_id($linha["grupo_id"]);
                $grupo->set_nome($linha["grupo_nome"]);
                
                $usuario = new Usuario();
                $usuario->set_id($linha['id']);
                $usuario->set_nome($linha['nome']);
                $usuario->set_email($linha['email']);
                $usuario->set_senha($linha['senha']);
                $usuario->set_grupo($grupo);
            }

            $pdo = null;
            $stmt = null;
        }
        return $usuario;
    }

    // Insere um novo usuario na tabela.
    // Recebe um objeto da classe Usuario.
    // Retorna TRUE se der certo e FALSE se der erro.
    public function insere($usuario)
    {
        $retorno = false;
        $sql = "INSERT INTO tb_usuario (nome, email, senha, id_grupo) VALUES ";
        $sql .= "(:nome, :email, :senha, :id_grupo);";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $usuario->get_nome(), PDO::PARAM_STR);
            $stmt->bindParam(":email", $usuario->get_email(), PDO::PARAM_STR);
            $stmt->bindParam(":senha", $usuario->get_senha(), PDO::PARAM_STR);
            $stmt->bindParam(":id_grupo", $usuario->get_grupo()->get_id(), PDO::PARAM_INT);
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

    // Lista todos os usuários cadastrados na tabela.
    // Retorna um array de objetos da classe Usuario.
    public function lista_todos()
    {
        $sql = "SELECT tb_usuario.id, tb_usuario.nome, tb_usuario.email, tb_usuario.senha, ";
        $sql .= "tb_grupo.id as grupo_id, tb_grupo.nome as grupo_nome ";
        $sql .= "FROM tb_usuario ";
        $sql .= "INNER JOIN tb_grupo ";
        $sql .= "ON tb_usuario.id_grupo = tb_grupo.id ";
        $sql .= "ORDER BY tb_usuario.nome ASC;";

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
            $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;
            $stmt = null;

            $resultado = array();
            foreach ($linhas as $linha)
            {
                $grupo = new Grupo();
                $grupo->set_id($linha['grupo_id']);
                $grupo->set_nome($linha['grupo_nome']);

                $usuario = new Usuario();
                $usuario->set_id($linha['id']);
                $usuario->set_nome($linha['nome']);
                $usuario->set_email($linha['email']);
                $usuario->set_senha($linha['senha']);
                $usuario->set_grupo($grupo);

                array_push($resultado, $usuario);
            }
        }
        return $resultado;
    }

    // Busca um usuário específico por id.
    // Recebe um integer com o id do usuário.
    // Retorna um objeto da classe Usuario.
    public function registro_por_id($id_usuario)
    {
        $sql = "SELECT tb_usuario.id, tb_usuario.nome, tb_usuario.email, tb_usuario.senha, ";
        $sql .= "tb_grupo.id as grupo_id, tb_grupo.nome as grupo_nome ";
        $sql .= "FROM tb_usuario ";
        $sql .= "INNER JOIN tb_grupo ";
        $sql .= "ON tb_usuario.id_grupo = tb_grupo.id ";
        $sql .= "WHERE tb_usuario.id = :id;";
        
        try
        {
            $pdo = conectaDB();
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id_usuario, PDO::PARAM_INT);
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
            
            $pdo = null;
            $stmt = null;
            
            $grupo = new Grupo();
            $grupo->set_id($linha['grupo_id']);
            $grupo->set_nome($linha['grupo_nome']);
            
            $usuario = new Usuario();
            $usuario->set_id($linha['id']);
            $usuario->set_nome($linha['nome']);
            $usuario->set_email($linha['email']);
            $usuario->set_senha($linha['senha']);
            $usuario->set_grupo($grupo);
        }
        return $usuario;
    }

    // Altera os dados de um usuário.
    // Recebe um objeto da classe Usuario.
    // Retorna TRUE se der certo ou FALSE se der erro.
    public function altera($usuario)
    {
        $retorno = false;
        $sql = "UPDATE tb_usuario SET nome = :nome, email = :email, ";
        $sql .= "senha = :senha, id_grupo = :id_grupo WHERE id = :id;";

        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $usuario->get_nome(), PDO::PARAM_STR);
            $stmt->bindParam(":email", $usuario->get_email(), PDO::PARAM_STR);
            $stmt->bindParam(":senha", $usuario->get_senha(), PDO::PARAM_STR);
            $stmt->bindParam(":id_grupo", $usuario->get_grupo()->get_id(), PDO::PARAM_INT);
            $stmt->bindParam(":id", $usuario->get_id(), PDO::PARAM_INT);
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

    // Exclui um usuário da tabela.
    // Recebe um integer com o id do usuário.
    // Retorna TRUE se der certo ou FALSE se der erro.
    public function exclui($id_usuario)
    {
        $sql = "DELETE FROM tb_usuario WHERE id = :id;";

        $retorno = false;
        try
        {
            $pdo = conectaDB();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id_usuario, PDO::PARAM_INT);
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

    // Verifica se email do usuário já existe na tabela.
    // Recebe uma string com o email do usuário.
    // Retorna TRUE caso já exista ou FALSE se não for encontrado.
    public function email_ja_existe($email_usuario)
    {
        $sql = "SELECT tb_usuario.id, tb_usuario.nome, tb_usuario.email, tb_usuario.senha, ";
        $sql .= "tb_grupo.id as grupo_id, tb_grupo.nome as grupo_nome ";
        $sql .= "FROM tb_usuario ";
        $sql .= "INNER JOIN tb_grupo ";
        $sql .= "ON tb_usuario.id_grupo = tb_grupo.id ";
        $sql .= "WHERE tb_usuario.email = :email;";
        
        $retorno = false;
        try
        {
            $pdo = conectaDB();
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":email", $email_usuario, PDO::PARAM_STR);
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