<?php
// incluye la clase Db
header('Access-Control-Allow-Origin: *');
require_once('../../config/Db.php');
require_once('../../models/Calificacion.php');

	class CrudCalificacion{

		// constructor de la clase
		public function __construct(){}

		// método para mostrar todos los libros
		public function mostrar(){
			$db=Db::conectar();
			$listaCalificaciones=[];
			$select=$db->query('SELECT * FROM calificaciones');

			foreach($select->fetchAll() as $calificacion){
				$myCalificacion= new Calificacion();
				$myCalificacion->setId_calificacion($calificacion['id_calificacion']);
				$myCalificacion->setId_reporte($calificacion['id_reporte']);
				$myCalificacion->setServicio($calificacion['servicio']);
				$myCalificacion->setPuntualidad($calificacion['puntualidad']);
				$myCalificacion->setObservaciones($calificacion['observaciones']);
				$listaCalificaciones[]=$myCalificacion;
			}

			return $listaCalificaciones;
		}

		// método para buscar un libro, recibe como parámetro el id del libro
		public function obtener($id_reporte){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM calificaciones WHERE id_reporte=:id_reporte');
			$select->bindValue('id_reporte',$id_reporte);
			$select->execute();
			$calificacion=$select->fetch();
			$myCalificacion= new Calificacion();
			$myCalificacion->setId_Calificacion($calificacion['id_calificacion']);
			$myCalificacion->setId_reporte($calificacion['id_reporte']);
			$myCalificacion->setServicio($calificacion['servicio']);
			$myCalificacion->setPuntualidad($calificacion['puntualidad']);
			$myCalificacion->setObservaciones($calificacion['observaciones']);
			return $myCalificacion;
        }
        


		public function insertar($calificacion){
			$db=Db::conectar();
			//$insert=$db->prepare('INSERT INTO reportes values(NULL, :id_cliente, :id_ticket, :contacto, :solicitadopor, :partesdescripcion, :tareas, :tipo, :horallegada, :horasalida, :tiempotraslado, :fecha, :servicio, :puntualidad, :observaciones, :confirmacion)');
			$insert=$db->prepare('INSERT INTO calificaciones values(NULL, :id_reporte, :servicio, :puntualidad, :observaciones)');
			$insert->bindValue('id_reporte',$calificacion->getId_reporte());
			$insert->bindValue('servicio',$calificacion->getServicio());
			$insert->bindValue('puntualidad',$calificacion->getPuntualidad());
			$insert->bindValue('observaciones',$calificacion->getObservaciones());
			$insert->execute();
			
			$LAST_ID = $db->lastInsertId();

			return $LAST_ID;
		}

	}
?>