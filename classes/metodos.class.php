<?php
<<<<<<< HEAD:classes/metodos.class.php
 //criação da classe contendo métodos dos sistema
class Metodos{
=======
 //criação da classe contendo métodos do sistema
class metodos{
>>>>>>> d9aef25ddea7c34f2ee737b5a39346b79e48d57e:metodos.class.php
    //metodo para tratar carcateres do sistema
    public function tratarCaracter($valor,$tipo){
        switch($tipo){
            case 1: $rst = utf8_decode($valor); break;
            case 2: $rst = htmlentities($valor); break;

        }
        return $rst;

    }

    //consegue recuperar data e hora
    public function dataAtual($valor){
        switch($valor){
            case 1: return date("Y-m-d"); break;
            case 2: return date("Y-m-d  H:i:s"); break;
            case 3: return date("d/m/Y"); break;

        }
    }
    
    //coloca valores na função base64

    public function base64($valor, $n){
        switch($n){
            case 1; return base64_encode($valor); break;
            case 2; return base64_encode($valor); break;


        }


    }
    
    //verfica se o campos está vazio

   public function verificarCampo($dados){

    return (isset($dados))?($dados):("");

   }


}






?>  
