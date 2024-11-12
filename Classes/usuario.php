<?php

    Class Usuario
    {
        private $pdo;
        public $msgErro ="";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;
            try
            {
                $pdo = new PDO("mysql:dbname=".$nome, $usuario, $senha);
            }
            catch(PDOException $erro)
            {
                $msgErro = $erro->getMessage();
            }
        }

        public function cadastroUsuario($nome, $telefone, $email, $senha)
        {
            global $pdo;

            //verificar se já existe um email cadastrado.
            $sql = $pdo->prepare("SELECT ID_usuario FROM usuario WHERE email = :e");
            $sql->bindValue(":e",$email);
            $sql->execute();
            if($sql->rowCount()>0)
            {
                return false;
            }
            else
            {
                $sql = $pdo->prepare("INSERT INTO usuario (nome, email, telefone, senha) VALUES (:n, :e, :t, :s)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":s",$senha);
                $sql->execute();
                return true;
            }
        }
    }
?>