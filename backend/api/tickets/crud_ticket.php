<?php
// incluye la clase Db
header('Access-Control-Allow-Origin: *');
require_once('../../config/Db.php');
require_once('../../models/Ticket.php');

	class CrudTicket{

		// constructor de la clase
		public function __construct(){}

		// método para mostrar todos los libros
		public function mostrar(){
			$db=Db::conectar();
			$listaTickets=[];
			//$select=$db->query('SELECT * FROM wp_js_ticket_tickets WHERE closed IS NOT NULL AND wp_js_ticket_tickets.ticketid NOT IN (SELECT reportes.id_ticket from reportes) ');
			$select=$db->query('SELECT * FROM wp_js_ticket_tickets WHERE wp_js_ticket_tickets.ticketid NOT IN (SELECT reportes.id_ticket from reportes) ');

			foreach($select->fetchAll() as $ticket){
				$myTicket= new Ticket();
				$myTicket->setId_ticket($ticket['id']);
				$myTicket->setTicketid($ticket['ticketid']);
				$myTicket->setPriorityid($ticket['priorityid']);
				$myTicket->setEmail($ticket['email']);
				$myTicket->setName($ticket['name']);
				$myTicket->setSubject($ticket['subject']);
				$strng = mb_convert_encoding($ticket['message'], 'UTF-8', 'UTF-8');
				$myTicket->setMessage($strng);
				//echo ($myTicket->getMessage());
				$myTicket->setPhone($ticket['phone']);
				$myTicket->setStatus($ticket['status']);
				$myTicket->setClosed($ticket['closed']);
				$myTicket->setCreated($ticket['created']);
				$listaTickets[]=$myTicket;
			}

			return $listaTickets;
		}

		// método para buscar un libro, recibe como parámetro el id del libro
		public function obtener($id_ticket){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM wp_js_ticket_tickets WHERE ticketid=:id_ticket');
			$select->bindValue('id_ticket',$id_ticket);
			$select->execute();
			$ticket=$select->fetch();
			$myTicket= new Ticket();
			$myTicket->setId_ticket($ticket['id']);
			$myTicket->setTicketid($ticket['ticketid']);
			$myTicket->setPriorityid($ticket['priorityid']);
			$myTicket->setEmail($ticket['email']);
			$myTicket->setName($ticket['name']);
			$myTicket->setSubject($ticket['subject']);
			$strng = mb_convert_encoding($ticket['message'], 'UTF-8', 'UTF-8');
			$myTicket->setMessage($strng);
			//echo ($myTicket->getMessage());
			$myTicket->setPhone($ticket['phone']);
			$myTicket->setStatus($ticket['status']);
			$myTicket->setClosed($ticket['closed']);
			$myTicket->setCreated($ticket['created']);
			//$myTicket->setServicio($Ticket['servicio']);
			//$myTicket->setPuntualidad($Ticket['puntualidad']);
			//$myTicket->setObservaciones($Ticket['observaciones']);
			//$myTicket->setConfirmacion($Ticket['confirmacion']);
			return $myTicket;
		}
	}
?>