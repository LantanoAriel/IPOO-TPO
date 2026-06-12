<?php
    abstract class Personaje{
        protected int $idPersonaje;
        protected string $nombrePersonaje;
        protected int $nivelPersonaje;
        protected int $puntosVidaPersonaje;
        protected int $energiaPersonaje;
        protected int $duelosGanadosPersonaje;
        protected int $duelosPerdidosPersonaje;
        protected string $estadoPersonaje;
        protected Arma $arma;

        public function __construct($idPersonaje,$nombrePersonaje,
        $nivelPersonaje,$puntosVidaPersonaje,$energiaPersonaje,
        $duelosGanadosPersonaje,$duelosPerdidosPersonaje,
        $estadoPersonaje, $armaPersonaje){
            $this -> idPersonaje = $idPersonaje;
            $this -> nombrePersonaje = $nombrePersonaje;
            $this -> nivelPersonaje = $nivelPersonaje;
            $this -> puntosVidaPersonaje = $puntosVidaPersonaje;
            $this -> energiaPersonaje = $energiaPersonaje;
            $this -> duelosGanadosPersonaje = $duelosGanadosPersonaje;
            $this -> duelosPerdidosPersonaje = $duelosPerdidosPersonaje;
            $this -> estadoPersonaje = $estadoPersonaje;
            $this -> arma = $armaPersonaje;
        }

        public function setIdPersonaje($idPersonaje){
            $this -> idPersonaje = $idPersonaje;
        }
        public function setNombrePersonaje($nombrePersonaje){
            $this -> nombrePersonaje = $nombrePersonaje;
        }
        public function setNivelPersonaje($nivelPersonaje){
            $this -> nivelPersonaje = $nivelPersonaje;
        }
        public function setPuntosVidaPersonaje($puntosVidaPersonaje){
            $this -> puntosVidaPersonaje = $puntosVidaPersonaje;
        }
        public function setEnergiaPersonaje($energiaPersonaje){
            $this -> energiaPersonaje = $energiaPersonaje;
        }
        public function setDuelosGanadosPersonaje($duelosGanadosPersonaje){
            $this -> duelosGanadosPersonaje = $duelosGanadosPersonaje;
        }
        public function setDuelosPerdidosPersonaje($duelosPerdidosPersonaje){
            $this -> duelosPerdidosPersonaje = $duelosPerdidosPersonaje;
        }
        public function setEstadoPersonaje($estadoPersonaje){
            $this -> estadoPersonaje = $estadoPersonaje;
        }
        public function setArmaPersonaje($armaPersonaje){
            $this -> arma = $armaPersonaje;
        }

        public function getIdPersonaje(){return $this -> idPersonaje;}
        public function getNombrePersonaje(){return $this -> nombrePersonaje;}
        public function getNivelPersonaje(){return $this -> nivelPersonaje;}
        public function getPuntosVidaPersonaje(){return $this -> puntosVidaPersonaje;}
        public function getEnergiaPersonaje(){return $this -> energiaPersonaje;}
        public function getDuelosGanadosPersonaje(){return $this -> duelosGanadosPersonaje;}
        public function getDuelosPerdidosPersonaje(){return $this -> duelosPerdidosPersonaje;}
        public function getEstadoPersonaje(){return $this -> estadoPersonaje;}
        public function getArmaPersonaje(){return $this -> arma;}

        public function __toString(){
            return "ID Personaje: " . $this -> idPersonaje .
            "\nNombre: " . $this -> nombrePersonaje .
            "\nNivel: " . $this -> nivelPersonaje .
            "\nHP: " . $this -> puntosVidaPersonaje .
            "\nSP: " . $this -> energiaPersonaje .
            "\nDuelos Ganados: " . $this -> duelosGanadosPersonaje .
            "\nDuelos Perdidos: " . $this -> duelosPerdidosPersonaje .
            "\nEstado: " . $this -> estadoPersonaje;
            "\nArma: " . $this -> arma;
        }

        public function recibirDanio(int $cantidad){
            $vidaSacar = $this -> getPuntosVidaPersonaje() - $cantidad;
            $this -> setPuntosVidaPersonaje($vidaSacar);
        }
        public function recuperarVida(int $cantidad){
            $vidaRecuperar = $this -> getPuntosVidaPersonaje() + $cantidad;
            $this -> setPuntosVidaPersonaje($vidaRecuperar);

        }
        public function recuperarEnergia($cantidad){
            $spRecuperar = $this -> getEnergiaPersonaje() + $cantidad;
            $this -> setEnergiaPersonaje($spRecuperar);
        }
        public function puedeDuelar(){
            if($this -> getEstadoPersonaje() == "disponible"){
                $puede = true;
            }else{
                $puede = false;
            }
            return $puede;
        }
        public function calcularPoderTotal(){
            // Poder Base + Poder Especial + Daño del Arma + Modificador de la Arena
            $combatPoints = $this -> calcularPoderBase() + $this -> calcularPoderEspecial() + 
            $this -> getArmaPersonaje() -> calcularDanio();

            return $combatPoints;
        }

        // Faltó poner static y hacer la clase como abstract
        abstract public function calcularPoderBase();
        abstract public function calcularPoderEspecial();

        private function estadoActual(){
            if($this -> getPuntosVidaPersonaje() > 0 && $this -> getPuntosVidaPersonaje() <= 30){
                $this -> setEstadoPersonaje("lesionado");
            }else if($this -> getPuntosVidaPersonaje() > 30){
                $this -> setEstadoPersonaje("disponible");
            }else{
                $this -> setEstadoPersonaje("retirado");
            }
        }



    }
?>