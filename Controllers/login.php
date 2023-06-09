<?php
  include_once "../Models/global.php";

  Usuario::Login("Hugo Boss", "1234");

  $login = $_GET['login'];
  $senha = $_GET['senha'];
  $email = $_GET['email'];
?>

<head>
    <title>Cadastro Usuário</title>
</head>

<body>

  <br><br>
  
</body>

<?php
  try{
    echo Usuario::Registrar($login, $senha, $email);
  }catch(Exception $e){
    echo $e->getMessage();
  }
  
  //echo $usuario->Registrar($login, $senha, $email);
  //$loginusuario = $usuario->getLogin();
  ///$emailusuario = $usuario->getEmail();
  //$senhausuario = $usuario->getSenha();
    
?>

<body>

  <br><br>
  
  <form action="../Views/usuario.html" method="get">
    <button>Voltar ao login</button>
  </form>
  
</body>

