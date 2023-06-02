<?php   
    include_once "../global.php";
    $cartao = new CartaodeEmbarque("Gustavo", "Cupt", "BHB", "SPP", '2023-04-22 01:25:00', '2023-04-22 05:25:00', "20");
    echo $cartao->getAssento();
    echo $cartao->getDestinoVoo();
    //echo $cartao->getHorarioChegada();
    //echo $cartao->getHorarioEmbarque();
    echo $cartao->getNome();
    echo $cartao->getSobrenome();
    echo $cartao->getOrigemVoo();
    