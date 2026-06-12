<?php
include_once "personaje.php";
class Mago extends Personaje{

    private int $mana;
    private int $inteligencia;

    public function construct(int $mana,int $inteligencia,int $idPersonaje,string $nombrePersonaje,
        int $nivelPersonaje,int $puntosVidaPersonaje,int $energiaPersonaje,
        int $duelosGanadosPersonaje,int $duelosPerdidosPersonaje,
        string $estadoPersonaje,Arma $armaPersonaje){
        parent::__construct($idPersonaje,$nombrePersonaje,
        $nivelPersonaje,$puntosVidaPersonaje,$energiaPersonaje,
        $duelosGanadosPersonaje,$duelosPerdidosPersonaje,
        $estadoPersonaje, $armaPersonaje);
        $this -> mana = $mana;
        $this -> inteligencia = $inteligencia;
    }

    public function setMana(int $mana){
        $this -> mana = $mana;
    }
    public function setInteligencia(int $inteligencia){
        $this -> inteligencia = $inteligencia;
    }

    public function getMana(){return $this -> mana;}
    public function getInteligencia(){return $this -> inteligencia;}

    public function calcularPoderBase(){
        $retornoPoderBase = ($this -> getNivelPersonaje() * 10) + $this -> mana;
        return $retornoPoderBase;
    }
    public function calcularPoderEspecial(){
        $retornoPoderEspecial = $this -> mana + ($this -> inteligencia * 3);
        return $retornoPoderEspecial;
    }

}
?>