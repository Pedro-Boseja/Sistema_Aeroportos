<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aeronave</title>

  <!--<link href="Views/style.css" type="text/css" rel="stylesheet">-->

</head>

<body>
  <h1>Registar Aeronave</h1>
  
  <label>Preencha os dados abaixo:</label><br><br>
  
  <form action="../Controllers/regcliente.php" method="get">
    <label>Nome Completo:</label><input name="nome" type="text" value="Pedro Silveira Polesca Boseja"></input><br>
    <label>Documento (RG ou Passaporte):</label><input name="documento" type="text"value="16.400.892"></input><br>
    <button>Enviar</button>
  </form>
  
  
</body>