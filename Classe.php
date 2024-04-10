<?php

require_once("./Alunno.php");

class Classe implements JsonSerializable{

    private $sezione;
    private $listaAlunni = array();

    function __construct($sezione) {
        $this->sezione = $sezione;
        $a1 = new Alunno("davide", "xie", 20);
        $a2 = new Alunno("filippo", "marinai", 13);
        $a3 = new Alunno("giovanni", "brussi", 18);
        $this->listaAlunni = array($a1, $a2, $a3);
    }

    function getAlunno($name){
        $string = $name;
        $text = "";

        foreach ($this->listaAlunni as $a) {
            if($a->get_nome() == $name){
                $text = $text . $a->toString();                
            }
        }

        if($text == "")
            return "Alunno non trovato";

        return $text;
    }

    function getApiAlunno($name){
        $string = $name;
        $alunno = null;

        foreach ($this->listaAlunni as $a) {
            if($a->get_nome() == $name){
                $alunno = $a;
                break;                
            }
        }

        return $alunno;
    }

    function set_sezione($nome) {
        $this->sezione = $nome;
    }

    function get_sezione() {
        return $this->sezione;
    }

    function toString() {

        $text = "";

        foreach ($this->listaAlunni as $a) {
            $text = $text . $a->toString();
        }

        return $text;
    }

    public function jsonSerialize(){
        $a = [
            "nome"=>$this->sezione,
            "alunni"=>$this->listaAlunni
        ];
        return $a;
    }

}

?>