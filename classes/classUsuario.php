<?php
class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $grupo;

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function get_nome()
    {
        return $this->nome;
    }

    public function set_nome($nome)
    {
        $this->nome = $nome;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function set_email($email)
    {
        $this->email = $email;
    }

    public function get_senha()
    {
        return $this->senha;
    }

    public function set_senha($senha)
    {
        $this->senha = $senha;
    }
    public function get_grupo()
    {
        return $this->grupo;
    }

    public function set_grupo($grupo)
    {
        $this->grupo = $grupo;
    }
}
?>