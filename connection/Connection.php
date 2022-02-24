<?php

require_once('config.php');

//Classe para conexao que utiliza o design pattern sigleton
class Connection {

    private static $connection;

    //para usar o padrao singleton, o metodo construtor deve ser privado
    private function __construct(){}

    public static function getConnection(){
        $pdoConfig = DB_DRIVER . ':' . 'Server=' . DB_HOST . ',' . DB_PORT . ';' . 'Database=' . DB_NAME .';';

        try{
            if(!isset($connection)){
                $connection = new PDO($pdoConfig, DB_USER, DB_PASSWD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
        } catch (PDOException $e){
            $mensagem = 'Drivers disponíveis: ' . implode(',', PDO::getAvailableDrivers());
            $mensagem = "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
        }

    }//function

}//Class