<?php 
  session_start();
  include_once('conexao.php');

  if(isset($_SESSION['usuario']))
  {
    $select = $con->prepare("SELECT nm_usuario, img_usuario FROM tb_usuario where lg_usuario ='" . $_SESSION["usuario"] . "'");
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
    <link rel="stylesheet" type="text/css" href="css/styledois.css">
    <title>Acesso</title>
    <style>
        .foto{
          min-width: 100%;
          width: 160vh;
          z-index: 1;
          margin-right: 5%;
          opacity: 0.6;
          filter: alpha(opacity=50); /* For IE8 and earlier */
        }
        .sidebar{
          z-index: 10;
        }
        html, body{
          overflow: hidden;
        }
        a{
          text-decoration: none;
        }
        .hud{
          font-size: 18px;
          color: white;
          font-family: 'Roboto';
          font-weight: 200;
        }
    </style>
</head>

<body>
    <!-- This is a reverse engineering of the "Hyperspace"
     design from HTML5 Up! https://html5up.net/hyperspace -->
<main class="main">

        <aside class="sidebar">
          <nav class="nav">
            <div class="hud">
              <h4>Olá <?php echo $_SESSION['usuario']; ?>!</h4>
            </div>
            <img src="<?php if(isset($_SESSION['usuario'])){echo $row['img_usuario'];}?>" alt="" width="120vh" style="border: 5px solid #6e214f">
            <ul>
            <li class="active"><a href="acesso.php">Início</a></li>
              <div class="dropdown">
              <li class="dropbtn"><a href="#" class="dropbtn">Cadastro</a></li>   
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
              <li><a href="sair.php">Sair</a></li>
                 
            </ul>
          </nav>
        </aside>
      
        <section class="twitter">
          <div class="container"> 
          <img src="predio.jpg" alt="" class="foto">
          </div>
        </section>
      </main>
</body>
</html>