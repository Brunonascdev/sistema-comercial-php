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
		 
			$select = $con->prepare("SELECT * FROM tb_produto where cd_produto=$cod");
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

function vai(){
    var valor1 = document.getElementById("pc").value;
    var valor2 = document.getElementById("pv").value;
    var result = parseFloat(valor2) - parseFloat(valor1);

    if (valor1 > valor2){
        alert("O Prejuízo foi de: " + result.toFixed(2) + " R$.");
    } else if (valor1 < valor2){
      alert("O Lucro foi de: " + result.toFixed(2) + " R$.");
    }
    else if (valor1 == valor2){
        alert("Você não obteve lucros. O preço de compra e venda foi o mesmo.");
    }
}

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
              <h1 class="titulo">Alterar Produto</h1>
              <form action="confirmaAlterarProduto.php?codigo=<?php echo $row['cd_produto'];?>" method="POST">
              <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Código do Produto" id="user" name="codigo" required value="<?php echo $row['cd_produto'];?>" disabled>
                    <span class="focus-border"></span>
                </div>
              <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Nome do Produto" id="user" name="nome" required value="<?php echo $row['nm_produto'];?>">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="text" placeholder="Quantidade" id="user" name="quantidade" required value="<?php echo $row['qnt_produto'];?>">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="number" placeholder="Preço de Compra" id="pc" name="preçoCompra" required value="<?php echo $row['pc_produto'];?>">
                    <span class="focus-border"></span>
                </div>
                <div class="col-3">
                    <input class="effect-1" type="number" placeholder="Preço de Venda" id="pv" name="preçoVenda" required value="<?php echo $row['pv_produto'];?>">
                    <span class="focus-border"></span>
                </div>
                <button class="btns" type="submit" id="btnEnviar"> Atualizar</button>
                <button class="btns" type="reset"> Resetar Campos</button>

              </form>
              <button class="btns" id="calculate" onclick="vai()"> Calcular</button>    
          </div>
        </section>
      </main>
</body>
</html>
