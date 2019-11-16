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

		$cod = $_GET['codigo'];
		
		include_once('conexao.php');
		 
			$select = $con->prepare("SELECT * FROM tb_usuario where cd_usuario=$cod");
			$select->execute();
		
			$row = $select->fetch();

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
    <link rel="stylesheet" type="text/css" href="css/styledois.css">
    <title>Acesso</title>
</head>

<script type="text/javascript" >
$(document).on("click", "#btnEnviar", function(){
  $(":input").val() = "";
});
</script>
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
              <h1 class="titulo">Alterar Usuário</h1>
              <form action="confirmaAlterarUsuario.php?codigo=<?php echo $row['cd_usuario'];?>" method="POST" enctype="multipart/form-data">
              <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Código do Usuário" id="user" name="codigo" required value="<?php echo $row['cd_usuario'];?>" disabled>
                    <span class="focus-border"></span>
                </div>
              <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Nome do Usuário" id="user" name="nome" required value="<?php echo $row['nm_usuario'];?>">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Login Usuário" id="user" name="login" required value="<?php echo $row['lg_usuario'];?>">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Senha Usuário" id="pc" name="senha" required value="<?php echo $row['ds_senha'];?>">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="E-mail usuário" id="pv" name="email" required value="<?php echo $row['em_usuario'];?>">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <img src="<?php echo $row['img_usuario'] ?>" width='120vh' style='border: 5px solid #6e214f'>
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="file" name="imgUsuario">
                    <span class="focus-border"></span>
                </div>
                <button class="btns" type="submit" id="btnEnviar"> Atualizar</button>
                <button class="btns" type="reset"> Resetar Campos</button>
              </form>  
          </div>
        </section>
      </main>
</body>
</html>
