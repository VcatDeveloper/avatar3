<?php

include_once "conexao.class.php";
//include_once "Funcoes.class.php";
//criação da classe

class Usuario{
    //atributos para instanciar
    private $con;
    private $crud;
    private $idUsuario;
    private $nome;
    private $email;
    private $senha;
    private $dataCadastro;

    //método construtor da classe usuário
    public function __construct(){
        $this->con = new Conexao();
      //  $this->crud = new Funcoes();
    }

    //metódo mágico
    public function __set($atributo, $valor){ 
        $this->$atributo = $valor;
    }

    public function __get($atributo){
        return $this->atributo;
    }

    // metódos de crud


    public function consultaUsuario($dado){
        try{

            $this->idUsuario = $this->crud->base64($dado,2);
            $cst = $this->con->conectar()->prepare("SELECT `idUsuario`, `nome`, `email`, `data_cadastro` FROM `usuario` WHERE `idUsuario` = :idFunc; ");
            $cst->bindParam(":idFunc", $this->idUsuario, PDO::PARAM_INT);
            if($cst->execute()){
                return $cst->fetch();
            }
        
        }catch(PDOException $e){
            return 'Error: ' .$e->getMessage();
        }


    }


    public function cadastraUsuario($dado){
        try{

            $this->nome = $this->crud->tratarCaracter($dado['nome'],1);
            $this->email = $this->crud->tratarCaracter($dado['email'],1);
            $this->senha = sha1($dado['senha']);
            $this->dataCadastro = $this->crud->dataAtual(2);
            $cst = $this->con->conectar()->prepare("INSERT INTO `usuario` (`nome`, `email`, `senha`, `data_cadastro`) VALUES (:nome, :email, :senha, :data);");
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":email", $this->email, PDO::PARAM_STR);
            $cst->bindParam(":senha", $this->senha, PDO::PARAM_STR);
            $cst->bindParam(":data", $this->dataCadastro, PDO::PARAM_STR);
            if($cst->execute()){
                return 'ok';
                      
        }else{
            return 'Erro ao cadastrar';
       }

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

public function atualizaUsuario($dado){
    try{
        $this->idUsuario = $this->crud->base64($dado['func'],2);
        $this->nome = $dado['nome'];
        $this->email = $dado['email'];
        $cst = $this->con->conectar()->prepare("UPDATE `usuario` SET `nome` = :nome, `email` = :email WHERE `idUsuario` = :idFunc;");
        $cst->bindParam(":idFunc", $this->idUsuario, PDO::PARAM_STR); 
        $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $cst->bindParam(":email", $this->email, PDO::PARAM_STR);
        if($cst->execute()){
            return 'ok';
        
        }else{
            return 'Error ao alterar';
        }
    
    }catch(PDOException $e){
        return 'Error: '.$e->getMessage();
    }


    }

    public function apagaUsuario($dado){

        try{

            $this->idUsuario = $this->crud->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("DELETE FROM `usuario` WHERE `idUsuario` = :idFunc;");
            $cst->bindParam(":idFunc", $this->idUsuario, PDO::PARAM_STR);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'Erro ao apagar';
            }
        }catch(PDOException $e){
            return 'Error: ' .$e->getMessage();
        }


    }

        public function logaUsuario($dado){
            $this->email = $dado['email'];
            $this->senha = sha1($dado['senha']);
            try{

                $cst = $this->con->conectar()->prepare("SELECT `idUsuario`, `email`, `senha` FROM `funcionario` WHERE `email` = :email AND `senha` = :senha;");
                $cst->bindParam(':email', $this->email, PDO::PARAM_STR);
                $cst->bindParam(':senha', $this->senha, PDO::PARAM_STR);
                $cst->execute();
                if($cst->rowCount() == 0){
                    header('location: login/?=error');
                }
        
            else{

                session_start();
                $rst = $cst->fecth();
                $_SESSION['logado'] = "sim";
                $_SESSION['func'] = $rst['idUsuario'];
                header("location: login/admin");
            }
            }catch(PDOException $e){
                return 'Error: ' .$e->getMessage();
            }
        }



    

    
}

?>