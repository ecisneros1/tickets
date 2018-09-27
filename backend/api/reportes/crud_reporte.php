<?php
// incluye la clase Db
header('Access-Control-Allow-Origin: *');
require_once('../../config/Db.php');
require_once('../../models/Reporte.php');

	class CrudReporte{
		// constructor de la clase
		public function __construct(){}

		// método para insertar, recibe como parámetro un objeto de tipo reporte
		public function insertar($reporte){
			$db=Db::conectar();
			//$insert=$db->prepare('INSERT INTO reportes values(NULL, :id_cliente, :id_ticket, :contacto, :solicitadopor, :partesdescripcion, :tareas, :tipo, :horallegada, :horasalida, :tiempotraslado, :fecha, :servicio, :puntualidad, :observaciones, :confirmacion)');
			$insert=$db->prepare('INSERT INTO reportes values(NULL, :cliente, :id_ticket, :contacto, :solicitadopor, :partesdescripcion, :tareas, :tipo, :horallegada, :horasalida, :tiempotraslado, :fecha)');
			$insert->bindValue('cliente',$reporte->getCliente());
			$insert->bindValue('id_ticket',$reporte->getId_ticket());
			$insert->bindValue('contacto',$reporte->getContacto());
			$insert->bindValue('solicitadopor',$reporte->getSolicitadopor());
			$insert->bindValue('partesdescripcion',$reporte->getPartesdescripcion());
			$insert->bindValue('tareas',$reporte->getTareas());
			$insert->bindValue('tipo',$reporte->getTipo());
			$insert->bindValue('horallegada',$reporte->getHorallegada());
			$insert->bindValue('horasalida',$reporte->getHorasalida());
			$insert->bindValue('tiempotraslado',$reporte->getTiempotraslado());
			$insert->bindValue('fecha',$reporte->getFecha());
			$insert->execute();
			
			$LAST_ID = $db->lastInsertId();

			return $LAST_ID;
			
			//echo json_encode($oki);

		}

		// método para mostrar todos los libros
		public function mostrar(){
			$db=Db::conectar();
			$listaReportes=[];
			$select=$db->query('SELECT * FROM reportes');

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
				//$myReporte->setServicio($reporte['servicio']);
				//$myReporte->setPuntualidad($reporte['puntualidad']);
				//$myReporte->setObservaciones($reporte['observaciones']);
				//$myReporte->setConfirmacion($reporte['confirmacion']);
				$listaReportes[]=$myReporte;
			}
			return $listaReportes;
		}

		// método para eliminar un libro, recibe como parámetro el id del libro
		public function eliminar($id_reporte){
			$db=Db::conectar();
			$eliminar=$db->prepare('DELETE FROM reportes WHERE id_reporte=:id_reporte');
			$eliminar->bindValue('id_reporte',$id_reporte);
			$eliminar->execute();
		}

		// método para buscar un libro, recibe como parámetro el id del libro
		public function obtener($id_reporte){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM reportes WHERE id_reporte=:id_reporte');
			$select->bindValue('id_reporte',$id_reporte);
			$select->execute();
			$reporte=$select->fetch();
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
			//$myReporte->setServicio($reporte['servicio']);
			//$myReporte->setPuntualidad($reporte['puntualidad']);
			//$myReporte->setObservaciones($reporte['observaciones']);
			//$myReporte->setConfirmacion($reporte['confirmacion']);
			return $myReporte;
		}

		// método para actualizar un libro, recibe como parámetro el libro
		public function actualizar($reporte){
			$db=Db::conectar();
			$actualizar=$db->prepare('UPDATE reportes SET cliente=:cliente, id_ticket=:id_ticket, contacto=:contacto  WHERE id_reporte=:id_reporte');
			$actualizar->bindValue('id_reporte',$reporte->getId_reporte());
			$actualizar->bindValue('cliente',$reporte->getCliente());
			$actualizar->bindValue('id_ticket',$reporte->getId_ticket());
			$actualizar->bindValue('contacto',$reporte->getContacto());
			$actualizar->bindValue('solicitadopor',$reporte->getSolicitadopor());
			$actualizar->bindValue('partesdescripcion',$reporte->getPartesdescripcion());
			$actualizar->bindValue('tareas',$reporte->getTareas());
			$actualizar->bindValue('tipo',$reporte->getTipo());
			$actualizar->bindValue('horallegada',$reporte->getHorallegada());
			$actualizar->bindValue('horasalida',$reporte->getHorasalida());
			$actualizar->bindValue('tiempotraslado',$reporte->getTiempotraslado());
			$actualizar->bindValue('fecha',$reporte->getFecha());
			$actualizar->bindValue('servicio',$reporte->getServicio());
			$actualizar->bindValue('puntualidad',$reporte->getPuntualidad());
			$actualizar->bindValue('confirmacion',$reporte->getConfirmacion());
			$actualizar->execute();
		}
	}
?>