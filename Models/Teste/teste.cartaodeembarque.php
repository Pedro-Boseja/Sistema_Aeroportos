<?php   
    include_once "../global.php";
    $cartao = new CartaodeEmbarque("Gustavo", "Cupt", "BHB", "SPP", new DateTime('2023-04-22 01:25:00'), new DateTime('11-09-2001 15:45'), "20");
    echo $cartao->getAssento();
echo "\n";
    echo $cartao->getDestinoVoo();
echo "\n";
    echo $cartao->getHorarioChegada()->format('Y-m-d H:i:s');
echo "\n";
    echo $cartao->getHorarioEmbarque()->format('Y-m-d H:i:s');
echo "\n";
    echo $cartao->getNome();
echo "\n";
    echo $cartao->getSobrenome();
echo "\n";
    echo $cartao->getOrigemVoo();
echo "\n";

    