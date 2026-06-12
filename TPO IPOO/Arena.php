<?php
include_once 'personaje.php';
include_once 'config.php';
    class Arena{
        private int $idArena;
        private string $nombre;
        private string $dificultad;
        private int $capacidadPublico; 
        private string $clima;
    
        public function __construct(string $nombre, string $dificultad, int $capacidadPublico, string $clima){
            $this->nombre = $nombre;
            $this->dificultad = $dificultad;
            $this->capacidadPublico = $capacidadPublico;
            $this->clima = $clima;
        }
        public function getIdArena(){
            return $this->idArena;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getDificultad(){
            return $this->dificultad;
        }
        public function getCapacidadPublico(){
            return $this->capacidadPublico;
        }
        public function getClima(){
            return $this->clima;
        }
        
        public function setIdArena(int $idArena){
            $this->idArena = $idArena;
        }
        public function setNombre(string $nombre){
            $this->nombre = $nombre;
        }
        public function setDificulatad(string $dificultad){
            $this->dificultad = $dificultad;
        }
        public function setCapacidadPublico(int $capacidadPublico){
            $this->capacidadPublico = $capacidadPublico;
        } 
        public function setClima(string $clima){
            $this->clima = $clima;
        }

        public function climaActual(string $clima){
            $numero = 1; // inicializamos el clima en normal
            $numero = random_int(1,4);
            if ($numero == 1){  
                $clima = "normal";
            }elseif ($numero == 2){
                $clima = "lluvia";
            }elseif ($numero == 3){
                $clima = "tormeta";
            }else{
                $clima = "niebla";}
            return $clima;                
        }

        public function calcularModificadorArena(Personaje $personaje){
// 
            $clima = $this->getClima();
            $modificador = 0;
              switch ($clima){
                case "normal": return $modificador; break;
                case "lluvia": 
                    if($personaje instanceof arquero){
                        $modificador = -10;
                    }elseif($personaje instanceof mago){
                        $modificador = +5;
                    }elseif($personaje instanceof guerrero){
                        $modificador = 0;
                    }; break;  
                case "tormenta":
                    if($personaje instanceof arquero){
                        $modificador = -5;
                    }elseif($personaje instanceof mago){
                        $modificador = +15;
                    }elseif($personaje instanceof guerrero){
                        $modificador = -5;
                    } ; break;
                case "niebla":
                    if($personaje instanceof arquero){
                        $modificador = -15;
                    }elseif($personaje instanceof mago){
                        $modificador = 0;
                    }elseif($personaje instanceof guerrero){
                        $modificador = +5;
                    }; break;
              }
              return $modificador;
        }


        public function __toString(){
            return "\nArena: " . $this->getIdArena() . $this->getNombre() . "\n Dificultad: " . $this->getDificultad() . 
                   "\n Capacidad publico: " . $this->getCapacidadPublico() . "\n Clima: " . $this->getClima();
        }

        public function arenaDB(){
                $database -> insert('arenas',
                $this -> )
        }

}
    