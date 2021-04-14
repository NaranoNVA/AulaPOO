<?php

require('classes/Usuario.class.php');
require('classes/Fabricante.class.php');
require('classes/Estoque.class.php');
require('classes/Movimentacao.class.php');

class Main {

    public function __construct(){
        echo "\n\nCOMEÇO DO PROGRAMA\n\n";
        $objUsuario = new Usuario;
        $objFabricante = new Fabricante;
        $objEstoque = new Estoque;
        $objMovimentacao = new Movimentacao;

        switch ($_SERVER['argv'][1]) {
            case 'gravaUsuario':
                $this->gravaUsuario($objUsuario);
                break;
            case 'editaUsuario':
                $this->editaUsuario($objUsuario);
                break;    
            default:
            echo "\nErro: Não existe a funcionalidade {$_SERVER['argv'][1]}\n";
                break;
        }
    }

    public function __destruct(){
        echo "\n\nFIM DO PROGRAMA\n\n";
    }

    public function pegaDados(){
        $args = explode(',', $_SERVER['argv'][2] ); //Argumentos separados por vircula

        foreach($args as $valor){
            $arg = explode('=', $valor);
            $dados[$arg[0]] = $arg[1];
            var_dump($dados);
        }
        return $dados;
    }

    public function gravaUsuario($objUsuario){
        $dados = $this->pegaDados();

        var_dump($dados);
        $objUsuario->setDados($dados);
        if($objUsuario->gravarDados()){
            echo "\n Cadastro deu bom menó \n";
        }
    }

    public function editaUsuario($objUsuario){
        $dados = $this->pegaDados();

        var_dump($dados);
        $objUsuario->setDados($dados);
        if($objUsuario->gravarDados()){
            echo "\n Editar deu bom menó \n";
        }
    }
}

new Main;

