<head>
    <title>Cadastro de Veículos</title>
</head>

<body>
  
    <h1>Sistema de Aeroportos</h1>
    
    <?php
        include_once "../Models/global.php";

        ob_start();
        Usuario::Login("Hugo Boss", "1234");
        ob_end_clean();
        
        $capacidade = $_GET['capacidade'];
        $velocidade = $_GET['velocidade'];
        $viagem = $_GET['viagem'];
        $companhia = $_GET['companhia'];

        $veiculo = null;
        $vi = null;
        $comps = null;

        try{
          $vi = Viagem::getRecordsByField("_codigo", $viagem);
          if($vi == null){
            throw new Exception("Viagem inválida.");
          }
          $comps = CompanhiaAerea::getRecordsByField("_nome", $companhia);
          if($comps == null){
            throw new Exception("Companhia inválida.");
          }
          $veiculo = new Veiculo($capacidade, $velocidade, $vi[0]);
          $comps[0]->CadastrarVeículo($veiculo);
          $comps[0]->save();
          $veiculo->save();
          echo "Veículo cadastrado com sucesso.";
        }catch(Exception $e){
          echo $e->getMessage();
        }catch(Error $e){
          echo "Dados inválidos.";
        }

        $capacidade = "Veículo não registrado.";
        $velocidade = "Veículo não registrado.";
        $viagem = "Veículo não registrado.";
        $companhia = "Veículo não registrado.";

        if($veiculo!=null){
          $capacidade = $veiculo->getCapacidade();
          $velocidade = $veiculo->getVMedia();
          $viagem = $veiculo->getViagem()->getCodigo();

        }
    ?>

</body>

<body>
  
  <br><br><label>Capacidade do veículo: <?php echo " " . $capacidade; ?></label><br>
  <label>Velocidade média: <?php echo " " . $velocidade; ?></label><br>
  <label>Código da viagem: <?php echo " " . $viagem; ?></label><br><br>

  <form action="../Views/veiculo.html" method="get">
        <button>Cadastrar outro veículo</button>
    </form>
  
  <form action="../Views/sistema.html" method="get">
        <button>Voltar ao sistema</button>
  </form>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

