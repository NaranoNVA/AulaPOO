<?php

require('classes/Usuario.class.php');
require('classes/Fabricante.class.php');
require('classes/Estoque.class.php');
require('classes/Movimentacao.class.php');

class Main {

    private $objUsuario;
    private $objFabricante;
    private $objEstoque;
    private $objMovimentacao;

    public function __construct(){
        echo "\n\nCOMEÇO DO PROGRAMA\n\n";
        $this->objUsuario = new Usuario;
        $this->objFabricante = new Fabricante;
        $this->objEstoque = new Estoque;
        $this->objMovimentacao = new Movimentacao;

        $this->verificaSeExisteArg(1);
        $this->executaOperacao($_SERVER['argv'][1]);
    }

    private function executaOperacao($operacao){
        switch ($operacao) {
            case 'gravaUsuario':
                $this->gravaUsuario();
                break;
            case 'editaUsuario':
                $this->editaUsuario();
                break;
            case 'listaUsuario':
                $this->listaUsuario();
                break;
            case 'apagaUsuario':
                $this->apagaUsuario();
                break;
            default:
            echo "\nErro: Não existe a funcionalidade {$_SERVER['argv'][1]}\n";
                break;
        }
    }

    public function __destruct(){
        echo "\n\nFIM DO PROGRAMA\n\n";
    }

    private function verificaSeExisteArg(int $numArg){
        if( !isset($_SERVER['argv'][$numArg]) ){
            
            $msg = $numArg == 1 ? 
            "php estoque.php [operação]" 
            : 
            "php estoque.php [operação] [dado=valor], [dado2=valor2], ...";

            echo "\n\nErro: digite: $msg \n\n";
            exit();
        }
    }
    
    private function pegaDados(){

        $this->verificaSeExisteArg(2);

        $args = explode(',', $_SERVER['argv'][2] ); //Argumentos separados por vircula

        foreach($args as $valor){
            $arg = explode('=', $valor);
            $dados[$arg[0]] = $arg[1];
            var_dump($dados);
        }
        return $dados;
    }

    private function gravaUsuario(){
        $dados = $this->pegaDados();

        var_dump($dados);
        $this->objUsuario->setDados($dados);
        if($this->objUsuario->gravarDados()){
            echo "\n Cadastro deu bom menó \n";
        }
    }

    private function editaUsuario(){
        $dados = $this->pegaDados();

        var_dump($dados);
        $this->objUsuario->setDados($dados);
        if($this->objUsuario->gravarDados()){
            echo "\n Editar deu bom menó \n";
        }
    }
    
    private function listaUsuario(){

        $lista = $this->objUsuario->getAll();
        foreach ($lista as $usuario) {
            
            echo "{$usuario['id']}\t{$usuario['cpf']}\t{$usuario['nome']}\n";
        }

    }

    private function apagaUsuario(){
        
        $dados = $this->pegaDados();
        $this->objUsuario->setDados($dados);

        if( $this->objUsuario->delete() ){
            echo "\n Usuario apagado com sucesso!\n";
        }
        else{
            echo "\n Falha ao apagar Usuario! Você enviou o Id? \n";
        }
    }
}

new Main;

