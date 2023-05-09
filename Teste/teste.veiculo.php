<?php

    include_once ("../classes.class.veiculo.php");

    $veiculo = new Veiculo (12, 18.0);

    echo $veiculo->getCapacidade() . "\n";
    echo $veiculo->getVMedia() . "\n";