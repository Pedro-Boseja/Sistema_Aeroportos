<?php
include_once("class.passagem.php");
include_once("class.cadastro.php");
include_once("class.viagem.php");
include_once("class.facade.php");
include_once("persist.php");

class Cliente extends persist{

    private Cadastro $_cadastro;
    private $_viagens_compradas = array();
    private $_passagens = array();
    static $local_filename = "clientes.txt";

    public function __construct(Cadastro $cadastro) {
        $this -> _cadastro = $cadastro;
        $this->save();
    }
    static public function getFilename() {
      return get_called_class()::$local_filename;
    }
    public function EscolherAssento (Viagem $viagem){

      if(count($viagem->getAssentosLivres()) == 0) {
          echo "Esta viagem já está lotada!\n";
          return "x";
      } else {
          echo "Estes assentos estão disponíveis para a sua viagem: \n";
          foreach($viagem->getAssentosLivres() as $as){
            echo $as . "\n";
          }
          echo "Qual assento você deseja? \n";
          $resposta = fgets(STDIN);
          return $resposta;
      }
    }

    public function SolicitarViagem () {
        // //Escolher ou não a companhia aerea
        // //echo "Você quer olhar as viagens de alguma comphania aérea específica?\n";
        // //echo "(1) Sim!\n(2) Não...\n\n";
        // //$op = fgets(STDIN);
        // //if ($op == 1){
        // //  Echo "Qual? (Escreve a sigla da companhia escolhida)\n";
        // //  
        // //}

        // echo "Qual vai ser o aeropordo de decolagem?(Escreve a sigla da companhia escolhida)\n\n";
        // $aeroporto_saida = fgets(STDIN);
        // echo "E o aeropordo de chegada?(Escreve a sigla da companhia escolhida)\n\n";
        // $aeroporto_chegada = fgets(STDIN);

        //$planos = array();   
        //Viagem $viagem;

        // $planos = $companhia_aerea->getPlanejamentoA($aeroporto_saida, $aeroporto_chegada); 

        // if(count($planos) == 0){ //viagem com conexão

        //     $planos = $companhia_aerea->getPlanejamentoB($aeroporto_saida, $aeroporto_chegada);
        
        // } else { //viagem direta
        //     //Verificar no planejamento quais viagens possuem assentos disponíveis
        //     echo "Aqui está uma lista de viagens diretas de " . $aeroporto_saida . "a " . $aeroporto_chegada . ":\n\n";
        //     foreach($planos as $p){
        //       //colocar data em planejamento?
        //         echo $p->getCogigo() . " : " . $p->getData() . " - " . $p->getHorarioC . " ~ " . $p->getHorarioS . "\n";
        //     }
        //     echo "\nDigite o código da viagem que você escolheu :0\n";
        //     $cod = fgets(STDIN);
        //      //....
        // }

        // return $viagem;
    }

    public function ComprarPassagem () {

        // echo "Vamos comprar uma passagem :D\n\n";
        // $viagem = $this->SolicitarViagem();

        // echo "Oba, você encontrou a sua viagem!\nAgora vamos escolher um assento.\n\n";
        // $assento = $this->EscolherAssento($viagem);

        // echo "Seu assento foi escolhido com sucesso!\n";
        // echo "Por último, para completar a compra insira os dados que serão pedidos abaixo.\n\n";

        // //Verificar se o passageiro já existe ou não;
        // //Caso ele não exista será preciso criar um;
        // //Compra de franquias
        // //Tarifa?????

        // array_push($this->_viagens_compradas, $viagem);
        // array_push($this->_passagens, $passagem);
    }

    public function CancelarViagem (Passagem $passagem){
    // if(in_array(EnumStatus::Passagem_adquirida, $passagem->getStatus())){
    //   if(in_array(EnumStatus::Passagem_cancelada, $passagem->getStatus())){
    //       echo "A passagem já foi cancelada";
    //   }else{
    //       if(in_array(EnumStatus::No_show, $passagem->getStatus())){
    //         echo "A passagem não pode ser cancelada";
    //       }else{
    //         if(in_array(EnumStatus::Checkin_realizado, $passagem->getStatus())){
    //           echo "A passagem não pode ser cancelada";
    //         }else{
    //           if(in_array(EnumStatus::Embarque_realizado, $passagem->getStatus())){
    //             echo "A passagem não pode ser cancelada";
    //           }else{
    //             $passagem->setStatus(EnumStatus::Passagem_cancelada);
    //           }
    //         }
    //       }
    //     }
    // }else{
    //   echo "Antes de cancelar, é necessário adiquirir a passagem";
    // }  
  }
}