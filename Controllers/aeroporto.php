<head>
    <title>Cadastro de Aeroporto</title>
</head>

<body>
  
    <h1>Sistema de Aeroportos</h1>
    
    <?php
        include_once "../Models/global.php";

        ob_start();
        Usuario::Login("Hugo Boss", "1234");
        ob_end_clean();

        $sigla = $_GET['sigla'];
        $cidade = $_GET['cidade'];
        $estado = $_GET['estado'];

        $aeroporto=null;
        
        try{
          $aeroporto = new Aeroporto($sigla, $cidade, $estado);
          $aeroporto->save();
          echo "Aeroporto cadastrado com sucesso.";
        }catch(Exception $e){
          echo $e->getMessage();
        }catch(Error $e){
          echo "Dados inválidos.";
        }

        $sigla = "Aeroporto não registrado.";
        $cidade = "Aeroporto não registrado.";
        $cnpj = "Aeroporto não registrado.";

        if($aeroporto!=null){
            $sigla = $aeroporto->getSigla();
            $cidade = $aeroporto->getCidade();
            $estado = $aeroporto->getEstado();
        }
    ?>

</body>

<body>
  
  <br><br><label>Sigla: <?php echo " " . $sigla; ?></label><br>
  <label>Cidade: <?php echo " " . $cidade; ?></label><br>
  <label>Estado: <?php echo " " . $estado; ?></label><br><br>

  <form action="../Views/aeroporto.html" method="get">
        <button>Cadastrar outro Aeroporto</button>
    </form>
  
  <form action="../Views/sistema.html" method="get">
        <button>Voltar ao sistema</button>
  </form>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

