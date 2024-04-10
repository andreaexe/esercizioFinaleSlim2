<?php

class Alunno implements JsonSerializable{

    private $nome;
    private $cognome;
    private $eta;

    function __construct($nome, $cognome, $eta) {
        $this->set_nome($nome);
        $this->set_cognome($cognome);
        $this->set_eta($eta);
    }

    function set_nome($nome) {
        $this->nome = $nome;
    }

    function get_nome() {
        return $this->nome;
    }

    function set_cognome($cognome) {
        $this->cognome = $cognome;
    }

    function get_cognome() {
        return $this->cognome;
    }

    function set_eta($eta) {
        $this->eta = $eta;
    }

    function get_eta() {
        return $this->$eta;
    }


    public function toString() {
        return "Nome: " . $this->nome . ", cognome: " . $this->cognome . ", eta: " . $this->eta . ".<br>";
    }

    public function jsonSerialize(){
        $a = [
            "nome"=>$this->nome,
            "cognome"=>$this->cognome,
            "eta"=>$this->eta
        ];
        return $a;
    }

}

?>