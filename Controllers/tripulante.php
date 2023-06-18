<head>
    <title>Cadastro de Tripulante</title>
</head>

<body>
  
    <h1>Sistema de Aeroportos</h1>
    
    <?php
        include_once "../Models/global.php";

        ob_start();
        Usuario::Login("Hugo Boss", "1234");
        ob_end_clean();

        $nome = $_GET['nome'];
        $documento = $_GET['documento'];
        $data = $_GET['data'];
        $nacionalidade = $_GET['nacionalidade'];
        $cpf = $_GET['cpf'];
        $email = $_GET['email'];
        $cht = $_GET['cht'];
        $endereco = $_GET['endereco'];
        $aeroporto = $_GET['aeroporto'];
        $companhia = $_GET['companhia'];

        $tripulante = null;
        $aero=null;
        $comps=null;
        
        try{
            $comps = CompanhiaAerea::getRecordsByField("_nome", $companhia);
            if($comps == null){
            throw new Exception("Companhia inválida.");
            }
            $aero = Aeroporto::getRecordsByField("_sigla", $aeroporto);
            if($aero == null){
            throw new Exception("Aeroporto inválido.");
            }
            $nascimento = new DateTime($data);
            $cadastro = new Cadastro($nome, $documento);
            $tripulante = new Tripulante($cadastro, $nascimento, $nacionalidade, $email, $cht, $endereco, $comps[0], $aero[0], $cpf);
            echo "Tripulante cadastrado com sucesso.";
            
        }catch(Exception $e){
            echo $e->getMessage();
        }catch(Error $e){
            echo "Dados inválidos.";
        }

        $nome = "Tripulante não registrado.";
        $documento = "Tripulante não registrado.";
        $data = "Tripulante não registrado.";
        $nacionalidade = "Tripulante não registrado.";
        $cpf = "Tripulante não registrado.";
        $email = "Tripulante não registrado.";
        $cht = "Tripulante não registrado.";
        $endereco = "Tripulante não registrado.";
        $aeroporto = "Tripulante não registrado.";
        $companhia = "Tripulante não registrado.";

        if($tripulante!=null){
            $nome = $tripulante->getCadastro()->getNome();
            $documento = $tripulante->getCadastro()->getDocumento("RG");
            $data = $tripulante->getCadastro()->getDataNascimento()->format("d/m/Y");
            $nacionalidade = $tripulante->getCadastro()->getNacionalidade();
            $cpf = $tripulante->getCadastro()->getNumeroCpf();
            $email = $tripulante->getCadastro()->getEmail();
            $cht = $tripulante->getCadastro()->getDocumento("CHT");
            $endereco = $tripulante->getCadastro()->getEndereco();
            $aeroporto = $tripulante->getAeroporto()->getSigla();
            $companhia = $tripulante->getCompanhia()->getNome();
        }
    ?>

</body>

<body>
  
  <br><br><label>Nome: <?php echo " " . $nome; ?></label><br>
  <label>Documento: <?php echo " " . $documento; ?></label><br>
  <label>Data de Nascimento: <?php echo " " . $data; ?></label><br>
  <label>Nacionalidade: <?php echo " " . $nacionalidade; ?></label><br>
  <label>CPF: <?php if($nacionalidade=="BRASILEIRO") {echo " " . $cpf;} else echo "Estrangeiro"; ?></label><br>
  <label>E-mail: <?php echo " " . $email; ?></label><br>
  <label>CHT: <?php echo " " . $cht; ?></label><br>
  <label>Endereço: <?php echo " " . $endereco; ?></label><br>
  <label>Aeroporto: <?php echo " " . $aeroporto; ?></label><br>
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

