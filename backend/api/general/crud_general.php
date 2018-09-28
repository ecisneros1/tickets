<?php
// incluye la clase Db
header('Access-Control-Allow-Origin: *');
require_once('../../config/Db.php');
require_once('../../models/Reporte.php');

	class CrudGeneral{
		// constructor de la clase
		public function __construct(){}

		// método para mostrar todos los libros
		public function mostrar($fechainicio, $fechafinal){
			$db=Db::conectar();
            $listaReportes=[];
            $select=$db->prepare('SELECT * FROM reportes WHERE fecha>=:fechainicio AND fecha<=:fechafinal ');
            $select->bindValue('fechainicio',$fechainicio);
            $select->bindValue('fechafinal',$fechafinal);
            $select->execute();

			foreach($select->fetchAll() as $reporte){
				$myReporte= new Reporte();
				$myReporte->setId_reporte($reporte['id_reporte']);
				$myReporte->setCliente($reporte['cliente']);
				$myReporte->setId_ticket($reporte['id_ticket']);
				$myReporte->setContacto($reporte['contacto']);
				$myReporte->setSolicitadopor($reporte['solicitadopor']);
				$myReporte->setPartesdescripcion($reporte['partesdescripcion']);
				$myReporte->setTareas($reporte['tareas']);
				$myReporte->setTipo($reporte['tipo']);
				$myReporte->setHorallegada($reporte['horallegada']);
				$myReporte->setHorasalida($reporte['horasalida']);
				$myReporte->setTiempotraslado($reporte['tiempotraslado']);
				$myReporte->setFecha($reporte['fecha']);
				$listaReportes[]=$myReporte;
            }

            if(count($listaReportes)>0){
                $f=array();
                foreach($listaReportes as $reporte){
                    $t=0;
                    $t=$this->LessTime($reporte->getHorallegada(),$reporte->getHorasalida());
                    array_push($f, $t, $reporte->getTiempotraslado());
                }
                $time=$this->AddTime($f);

                $obj=new stdClass();
                $obj->time=$time;
                $obj->fechainicio=$fechainicio;
                $obj->fechafinal=$fechafinal;
                            
                // pass the array to the function
                return $obj;  
            }
        }

        public function mostrarEmpresas($fechainicio, $fechafinal){
            $objs=array();
            $listaclientes=$this->getClientes($fechainicio, $fechafinal);
            if(count($listaclientes)>0){
                foreach($listaclientes as $cliente){
                    //echo json_encode($cliente);
                    $horascliente=$this->selectByCliente($cliente->cliente, $fechainicio, $fechafinal);
                    //echo json_encode($horascliente);
                    if(count($horascliente)>0){
                        $f=array();
                        $ids='';
                        $fechas='';
                        foreach($horascliente as $reporte){
                            $ids=$reporte->id_reporte.', '.$ids;
                            $fechas=$reporte->fecha.', '.$fechas;
                            $t=0;
                            $t=$this->LessTime($reporte->getHorallegada(),$reporte->getHorasalida());
                            array_push($f, $t, $reporte->getTiempotraslado());
                            //echo json_encode($f);
                        }
                        $time=$this->AddTime($f);
                        //echo $time;
                        $obj=new stdClass();
                        $obj->cliente=$cliente->cliente;
                        $obj->ids=$ids;
                        $obj->fechas=$fechas;
                        $obj->time=$time;
                    }
                    //echo '<br/>';
                    //echo '<br/>';
                    array_push($objs,$obj);
                }
                $objetos=new stdClass();
                $objetos->fechainicio=$fechainicio;
                $objetos->fechafinal=$fechafinal;
                $objetos->objs=$objs;
                return $objetos;
            }
        }

        public function mostrarEmpresa($cli, $fechainicio, $fechafinal){
            $lista=$this->selectByCliente($cli, $fechainicio, $fechafinal);
            if(count($lista)>0){
                $f=array();
                foreach($lista as $reporte){
                    $t=0;
                    $t=$this->LessTime($reporte->getHorallegada(),$reporte->getHorasalida());
                    array_push($f, $t, $reporte->getTiempotraslado());
                }
                $time=$this->AddTime($f);
                $obj=new stdClass();
                $obj->time=$time;
                $obj->cliente=$cli;
                $obj->fechainicio=$fechainicio;
                $obj->fechafinal=$fechafinal;
                            
                // pass the array to the function
                return $obj;
            }
        }
        

        function AddTime($times) {
            $minutes = 0; //declare minutes either it gives Notice: Undefined variable
            // loop throught all the times
            foreach ($times as $time) {
                list($hour, $minute) = explode(':', $time);
                $minutes += $hour * 60;
                $minutes += $minute;
            }
        
            $hours = floor($minutes / 60);
            $minutes -= $hours * 60;
        
            // returns the time already formatted
            return sprintf('%02d:%02d', $hours, $minutes);
        }

        function LessTime($inicio, $fin) {
            $minute=0;
            list($hourI, $minuteI)=explode(':',$inicio);
            list($hourF, $minuteF)=explode(':',$fin);
            $f=$hourF*60+$minuteF;
            $i=$hourI*60+$minuteI;
            
            $start=new DateTime($hourI.':'.$minuteI);
            $end=new DateTime($hourF.':'.$minuteF);
            $since=$start->diff($end);

            $hour=$since->h;
            $minute=$since->i;

            return sprintf('%02d:%02d', abs($hour), abs($minute));
        }

        function adminClientes($obj){
            $cli=array();
            foreach($obj as $cl){
                array_push($cli, $cl->cliente);
            }
            return $cli;
        }

        function getClientes($fechainicio, $fechafinal){
            $db=Db::conectar();
            $listaReportes=[];
            $select=$db->prepare('SELECT DISTINCT cliente FROM reportes WHERE fecha>=:fechainicio AND fecha<=:fechafinal ');
            $select->bindValue('fechainicio',$fechainicio);
            $select->bindValue('fechafinal',$fechafinal);
            $select->execute();

			foreach($select->fetchAll() as $reporte){
				$myReporte= new Reporte();
				$myReporte->setCliente($reporte['cliente']);
				$listaReportes[]=$myReporte;
            }
            return $listaReportes;
        }

        function selectByCliente($cli, $fechainicio, $fechafinal){
            $db=Db::conectar();
            $listaReportes=[];
            $select=$db->prepare('SELECT * FROM reportes WHERE fecha>=:fechainicio AND fecha<=:fechafinal AND cliente=:cliente ');
            $select->bindValue('fechainicio',$fechainicio);
            $select->bindValue('fechafinal',$fechafinal);
            $select->bindValue('cliente',$cli);
            $select->execute();

			foreach($select->fetchAll() as $reporte){
				$myReporte= new Reporte();
				$myReporte->setId_reporte($reporte['id_reporte']);
				$myReporte->setCliente($reporte['cliente']);
				$myReporte->setId_ticket($reporte['id_ticket']);
				$myReporte->setContacto($reporte['contacto']);
				$myReporte->setSolicitadopor($reporte['solicitadopor']);
				$myReporte->setPartesdescripcion($reporte['partesdescripcion']);
				$myReporte->setTareas($reporte['tareas']);
				$myReporte->setTipo($reporte['tipo']);
				$myReporte->setHorallegada($reporte['horallegada']);
				$myReporte->setHorasalida($reporte['horasalida']);
				$myReporte->setTiempotraslado($reporte['tiempotraslado']);
				$myReporte->setFecha($reporte['fecha']);
				$listaReportes[]=$myReporte;
            }
            return $listaReportes;
        }
	}
?>