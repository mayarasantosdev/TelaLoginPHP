<?php
    require_once '../Classes/usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>TELA DE CADASTRO DE USUARIO</h2>
    <form method="post">
    <label>Nome:</label><br>
    <input type="text" name="nome" placeholder="Digite o nome completo."><br>
    <label>Email:</label><br>
    <input type="email" name="email" placeholder="Digite o email."><br>
    <label>Telefone:</label><br>
    <input type="tel" name="telefone" placeholder="Digite o número de telefone."><br>
    <label>Senha:</label><br>
    <input type="password" name="senha" placeholder="Criar uma senha."><br>
    <label>Confirmar Senha:</label><br>
    <input type="passWord" name="confSenha" placeholder="Confirmar sua Senha."><br>

    <input type="submit" value="CADASTRAR">

    <p>Já cadastrado? Clique <a href="login.php">aqui</a> para acessar.</p>

    </form>
    <?php
        if(isset($_POST['nome']))
        {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $senha = $_POST['senha'];
            $confirmarSenha = addslashes($_POST['confSenha']);

            if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confirmarSenha))
            {
                $usuario->conectar("cadastro140", "localhost", "root", "");
                if($usuario->msgErro == "")
                {
                    if($senha == $confirmarSenha)
                    {
                        if($usuario->cadastroUsuario($nome,$email,$telefone,$senha))
                        {
                            ?>
                                <div class="msg-sucesso">
                                    <p>Cadastro realizado com sucesso.</p>
                                    <p>Clique aqui para <a href="login.php">Logar.</a></p>
                                </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="msg-erro">
                                <p>Usuário já cadastrado.</p>
                            </div>
                        <?php
                        }
                    }
                    else
                    {
                    ?>
                        <div class="msg-erro">
                            <p>Senha e Confirmar senha não conferem.</p>
                        </div>
                    <?php
                    }
                }
                else
                {
                    ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$usuario->msgErro; ?>
                        </div>
                    <?php
                }
            }
            else
            {
                ?>
                    <div class="msg-erro">
                        <p>Preencha todos os campos.</p>
                    </div>
                <?php
            }
        }
    ?>
    
</body>
</html>