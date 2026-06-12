<?php

class Arquero extends Personaje{
    private int $precision;
    private int $velocidad;

    public function __construct(int $precision, int $velocidad, int $idPersonaje, string $nombrePersonaje, int $nivelPersonaje, int $puntosVidaPersonaje, int $energiaPersonaje, int $duelosGanadosPersonaje, int $duelosPerdidosPersonaje, int $estadoPersonaje, int $armaPersonaje){
        parent::__construct( $idPersonaje, $nombrePersonaje, $nivelPersonaje, $puntosVidaPersonaje, $energiaPersonaje,
        $duelosGanadosPersonaje, $duelosPerdidosPersonaje, $estadoPersonaje, $armaPersonaje);        
        $this->precision = $precision;
        $this->velocidad = $velocidad;
    }

    public function getPrecision(){
        return $this->precision;
    }

    public function setPrecision(int $precision){
        $this->precision = $precision;
    }

    public function getVelocidad(){
        return $this->velocidad;
    }

    public function setVelocidad(int $velocidad){
        $this->velocidad = $velocidad;
    }

    public function calcularPoderBase(){
        $this->getNivelPersonaje() * 12 + $this->getPrecision();
    }
    
    public function calcularPoderEspecial(){
        $this->getPrecision() * 2 + $this->getVelocidad();
    }
}