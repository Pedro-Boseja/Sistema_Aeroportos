<head>
    <title>Cadastro de Planejamento</title>
</head>

<body>
  
    <h1>Sistema de Aeroportos</h1>
    
    <?php
        include_once "../Models/global.php";

        ob_start();
        Usuario::Login("Hugo Boss", "1234");
        ob_end_clean();

        $frequencia = $_GET['frequencia'];
        $codigo = $_GET['codigo'];
        $ac = $_GET['ac'];
        $as = $_GET['as'];
        $chegada = $_GET['chegada'];
        $saida = $_GET['saida'];
        $milhagem = $_GET['milhagem'];
        $companhia = $_GET['companhia'];

        $planejamento=null;
        
        try{
            $comps = CompanhiaAerea::getRecordsByField("_nome", $companhia);
            if($comps == null){
            throw new Exception("Companhia inválida.");
            }
            $aeroc = Aeroporto::getRecordsByField("_sigla", $aeroc);
            if($aeroc == null){
            throw new Exception("Aeroporto de chegada inválido.");
            }
            $aeros = Aeroporto::getRecordsByField("_sigla", $aeros);
            if($aeros == null){
            throw new Exception("Aeroporto de saída inválido.");
            }
            $hc = new Datetime($chegada);
            $hs = new DateTime($saida);
            $planejamento = new Planejamento($frequencia, $codigo, $aeros[0], $aeroc[0], $hs, $hc, $milhagem, $comps[0]);
            echo "Planejamento cadastrado com sucesso.";
        }catch(Exception $e){
            echo $e->getMessage();
        }catch(Error $e){
            echo "Dados inválidos.";
        }

        $frequencia = "Planejamento não registrado.";
        $codigo = "Planejamento não registrado.";
        $ac = "Planejamento não registrado.";
        $as = "Planejamento não registrado.";
        $chegada = "Planejamento não registrado.";
        $saida = "Planejamento não registrado.";
        $milhagem = "Planejamento não registrado.";
        $companhia = "Planejamento não registrado.";

        if($planejamento!=null){
            $frequencia = $planejamento->getFrequencia();
            
        }
    ?>

</body>

<body>
  
  <br><br><label>Frequencia: <?php echo " " . $frequencia; ?></label><br>
  <label>Codigo: <?php echo " " . $codigo; ?></label><br>
  <label>Aeroporto de chegada: <?php echo " " . $ac; ?></label><br>
  <label>Aeroporto de saída: <?php echo " " . $as; ?></label><br>
  <label>Horário de chegada: <?php echo " " . $chegada; ?></label><br>
  <label>Horário de saída: <?php echo " " . $saida; ?></label><br>
  <label>Milhagem: <?php echo " " . $milhagem; ?></label><br>
  <label>Companhia: <?php echo " " . $companhia; ?></label><br><br>

  <form action="../Views/planejamento.html" method="get">
        <button>Cadastrar outro Planejamento</button>
    </form>
  
  <form action="../Views/sistema.html" method="get">
        <button>Voltar ao sistema</button>
  </form>
  
  <form action="../index.html" method="get">
    <button>Sair</button>
  </form>
  
</body>

