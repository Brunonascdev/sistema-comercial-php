<?php 
  session_start();
  include_once('conexao.php');

  if(isset($_SESSION['usuario']))
  {
    $select = $con->prepare("SELECT nm_usuario FROM tb_usuario where lg_usuario ='" . $_SESSION["usuario"] . "'");
    $select->execute();
    $row = $select->fetch();  
  }
  else{
    echo "<script> window.alert('Não permitido')
          window.location.href='index.php'
          </script>";
  }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet">
    <script src="jq.js"></script>
    <script src="components/pelo.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styledois.css">
    <title>Acesso</title>
</head>
<style>
  .hud{
          font-size: 18px;
          color: white;
          font-family: 'Roboto';
          font-weight: 200;
        }
</style>

<body>
    <!-- This is a reverse engineering of the "Hyperspace"
     design from HTML5 Up! https://html5up.net/hyperspace -->
<main class="main">

        <aside class="sidebar">
          <nav class="nav">
          <div class="hud">
              <h4>Olá <?php echo $_SESSION['usuario']; ?>!</h4>
            </div>
            <img src="ota.svg" alt="" width="60vh">
            <ul>
            <li><a href="acesso.php">Início</a></li>
              <div class="dropdown">
              <li class="dropbtn active"><a href="#" class="dropbtn">Cadastro</a></li>   
                <div class="dropdown-content">
                  <a href="cadCliente.php">Clientes</a>
                  <a href="cadFuncionario.php">Funcionário</a>
                  <a href="cadFornecedor.php">Fornecedor</a>
                  <a href="cadProduto.php">Produto</a>
                  <a href="cadUsuario.php">Usuário</a>
                </div>
              </div>
              <div class="dropdown">
              <li class="dropbtn"><a href="#" class="dropbtn">Consulta</a></li>   
                <div class="dropdown-content">
                  <a href="consultaCliente.php">Clientes</a>
                  <a href="consultaFuncionario.php">Funcionário</a>
                  <a href="consultaFornecedor.php">Fornecedor</a>
                  <a href="consultaProduto.php">Produto</a>
                  <a href="consultaUsuario.php">Usuário</a>
                </div>
              </div>  
              <li><a href="sobre.php">Sobre</a></li>
              <li><a href="acesso.php">Contato</a></li>
              <li><a href="index.php">Sair</a></li>
                 
            </ul>
          </nav>
        </aside>
      
        <section class="twitter">
          <div class="containerDois"> 
              <h1 class="titulo">Cadastro de Usuário</h1>
              <form action="#" method="POST" enctype="multipart/form-data">
              <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Nome do Usuário" id="nome" name="nome" required> 
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Login" id="login" name="login" required>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="password" placeholder="Senha" id="senha" name="senha" required maxlength="12">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="password" placeholder="Insira a senha novamente" id="dois" name="csenha" required maxlength="12" onblur="verificar();"> 
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="email" placeholder="E-Mail" id="pc" name="email" required>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="file" name="imgUsuario">
                    <span class="focus-border"></span>
                </div>
                <button class="btns" type="submit" id="btnEnviar"> Cadastrar</button>
                <button class="btns" type="reset"> Resetar Campos</button>
              </form>             
          </div>
        </section>
      </main>
      <?php
                if (!empty($_POST)) 
                {
                  date_default_timezone_set('America/Sao_Paulo');
                  include_once('conexao.php');
                  
                  $nome  = $_POST['nome'];
                  $login  = $_POST['login'];
                  $senha   = $_POST['senha']; 
                  $email   = $_POST['email']; 
                  $csenha    = $_POST['csenha'];
                  $dir = "img/usuarios/"; // diretorio para as imagens
                  $foto = $_FILES['imgUsuario'];
                  
                  if($senha == $csenha)
                  {
                  
                    //upload da foto
                    $ext = strtolower(substr($foto['name'],-4)); //Pegando extensão do arquivo 
                  
                    $novo_nome = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo 
              
                    move_uploaded_file($foto['tmp_name'], $dir.$novo_nome); //Fazer upload do arquivo 
                    
                    $caminhoIMG = $dir.$novo_nome;
                    
                    $stmt = $con->prepare("INSERT INTO tb_usuario(nm_usuario,
                                            lg_usuario, 
                                            ds_senha, 
                                            img_usuario, 
                                            em_usuario) 
                                 VALUES(?, ?, ?, ?, ?)");
                                 
                    $stmt->bindParam(1,$nome);
                    $stmt->bindParam(2,$login);
                    $stmt->bindParam(3,$senha);
                    $stmt->bindParam(4,$caminhoIMG);
                    $stmt->bindParam(5,$email);
                    
                    $stmt->execute();
                    
                    echo "<script>
                        alert('Cadastrado com Sucesso!');
                        </script>";
                  }
                }
              ?>
</body>
</html>