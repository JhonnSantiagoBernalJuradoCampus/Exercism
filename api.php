<?php
    header("Content-Type: application/json");
    class Tournament{
        public $MP = [];
        public $W = [];
        public $D = [];
        public $L = [];
        public $P = [];
        public function __construct($scores){
            $this->equipos = explode(";", $scores);
        }
        public function asignacionPuntos(){
            foreach ($this->equipos as $key => $value) {
                if ($key == 2) {
                    switch ($this->equipos[$key]){
                        case "win":
                            $equipo1 = $this->equipos[$key -1];
                            $equipo2 = $this->equipos[$key -2];
                            ($this->W[$equipo1] ?? null) ? $this->W[$equipo1] += 1: $this->W[$equipo1] = 1;
                            ($this->L[$equipo2] ?? null) ? $this->L[$equipo2] += 1: $this->L[$equipo2] = 1;
                            ($this->P[$equipo1] ?? null) ? $this->P[$equipo1] += 3: $this->P[$equipo1] = 3;
                            break;
                        case "draw":
                            $equipo1 = $this->equipos[$key -1];
                            $equipo2 = $this->equipos[$key -2];
                            ($this->D[$equipo1] ?? null) ? $this->D[$equipo1] += 1: $this->D[$equipo1] = 1;
                            ($this->D[$equipo2] ?? null) ? $this->D[$equipo2] += 1: $this->D[$equipo2] = 1;
                            break;
                        case "loss":
                            $equipo1 = $this->equipos[$key -2];
                            $equipo2 = $this->equipos[$key -1];
                            ($this->W[$equipo1] ?? null) ? $this->W[$equipo1] += 1: $this->W[$equipo1] = 1;
                            ($this->L[$equipo2] ?? null) ? $this->L[$equipo2] += 1: $this->L[$equipo2] = 1;
                            ($this->P[$equipo1] ?? null) ? $this->P[$equipo1] += 3: $this->P[$equipo1] = 3;
                            break;
                    }
                }
            }
        }
    }
    $obj = new Tournament("Allegoric Alaskans;Blithering Badgers;win; Devastating Donkeys;Courageous Californians;draw; Devastating Donkeys;Allegoric Alaskans;win; Courageous Californians;Blithering Badgers;loss; Blithering Badgers;Devastating Donkeys;loss; Allegoric Alaskans;Courageous Californians;win");
    $obj->asignacionPuntos();
    echo(json_encode($obj->W, JSON_PRETTY_PRINT));
    echo(json_encode($obj->L, JSON_PRETTY_PRINT));
    echo(json_encode($obj->P, JSON_PRETTY_PRINT));
?>