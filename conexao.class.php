<?php
// criando a classe de conexão
class Conexao{
    //atributos da conexão,l privados

    private $usuario;
    private $senha;
    private $banco;
    private static $pdo;

    // método construtor
    public function __construct(){
        $this->servidor = "localhost";
        $this->banco = "banco_avatar";
        $this->usuario = "root";
        $this->senha = "";
    }
    //
    public function conectar(){
        try{

            if(is_null(self::$pdo)){
                self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);

      }
      return self::$pdo;
    }catch( PDOException $e){
        echo 'Error: ' .$e->getMessage();
    } 
    
  




    }

}






?>