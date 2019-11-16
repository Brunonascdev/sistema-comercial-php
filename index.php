<?php 
    if (!empty($_POST))
    {
        session_start();
        include_once 'conexao.php';

        echo $login = $_POST['username'];
        echo $senha = $_POST['password'];

        $rs = $con->query("SELECT * FROM tb_usuario where lg_usuario ='$login' and ds_senha = '$senha'");

        $rs ->execute(); 

        if ($rs->fetch(PDO::FETCH_ASSOC) == true){
            $_SESSION['usuario'] = $login;
            header('Location:acesso.php');
        }
        else
        {
            unset ($_SESSION['usuario']);
            echo "<script>alert('Nome de usuário ou senha inválidos!');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="components/script.js"></script>
</head>
<body>
    <div class="container">
        <img src="rose.svg" alt="rose" class="logo">
        <form action="" method="post">
        <div class="col-3" style="margin-left: 6%;">
                    <input class="effect-1" type="text" placeholder="Username" id="user" name="username">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3" style="margin-left: 6%;">
                    <input class="effect-1" type="password" placeholder="Senha" id="pass" name="password">
                    <span class="focus-border"></span>
                </div>
                    <button id="entra" type="submit" class="buto"> Entrar </button>            
        </form>
    </div>
</body>
</html>