<?php
    include_once('classes/persist.php');
    include_once('verificacoes.php');
    function autoloader($pClassName) {
        $pClassName = strtolower($pClassName);
        echo __NAMESPACE__;
        $path = __DIR__ . '/classes/class.'. $pClassName . '.php';
        if (is_file($path)) {
            include_once $path;
        }
        else {
            $path = __DIR__ . '/classes/class.' . $pClassName . '.php';
            if (is_file($path)) {
                include_once $path;
            }
            else
                throw( new Exception('Não foi encontrada a definição da classe '.$pClassName.' na pasta classes.'));
        }
    }
    spl_autoload_register('autoloader');