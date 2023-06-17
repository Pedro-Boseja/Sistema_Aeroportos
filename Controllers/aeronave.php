<head>
    <title>Cadastro de Aeronave</title>
</head>

<body>
  
    <h1>Sistema de Aeroportos</h1>
    
    <?php
        include_once "../Models/global.php";

        ob_start();
        Usuario::Login("Hugo Boss", "1234");
        ob_end_clean();
        
        $companhia = $_GET['companhia'];
        $fabricante = $_GET['fabricante'];
        $modelo = $_GET['modelo'];
        $registro = $_GET['registro'];
        $cap_p = $_GET['cap_p'];
        $cap_c = $_GET['cap_c'];

        $aeronave=null;
        
        //$comps = CompanhiaAerea::getRecordsByField("_nome", $companhia);

        try{
          $comps = CompanhiaAerea::getRecordsByField("_nome", $companhia);
          if($comps == null){
            throw new Exception("Companhia inválida.");
          }
          $aeronave = new Aeronave($fabricante, $modelo, $registro, $cap_p, $cap_c, 6, 30);
          $comps[0]->CadastrarAeronave($aeronave);
          $comps[0]->save();
          $aeronave->save();
          echo "Aeronave cadastrada com sucesso.";
        }catch(Exception $e){
          echo $e->getMessage();
        }catch(Error $e){
          echo "Dados inválidos.";
        }

        $fabricante = "Aeronave não registrada.";
        $modelo = "Aeronave não registrada.";
        $registro = "Aeronave não registrada.";
        $cap_p = "Aeronave não registrada.";
        $cap_c = "Aeronave não registrada.";

        if($aeronave!=null){
          $fabricante = $aeronave->getFabricante();
          $modelo = $aeronave->getModelo();
          $registro = $aeronave->getRegistro();
          $cap_p = $aeronave->getCapacidadeP();
          $cap_c = $aeronave->getCapacidadeC();
        }
    ?>

</body>

<body>
  
  <br><br><label>Fabricante: <?php echo " " . $fabricante; ?></label><br>
  <label>Modelo: <?php echo " " . $modelo; ?></label><br>
  <label>Registro: <?php echo " " . $registro; ?></label><br>
  <label>Capacidade de passageiros: <?php echo " " . $cap_p; ?></label><br>
  <label>Capacidade de carga: <?php echo " " . $cap_c; ?></label><br><br>

  <form action="../Views/aeronave.html" method="get">
        <button>Cadastrar outra aeronave</button>
    </form>
  
  <form action="../Views/sistema.html" method="get">
        <button>Voltar ao sistema</button>
  </form>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

