<?php
// incluye la clase Db
header('Access-Control-Allow-Origin: *');
$current=dirname(__FILE__);
$parent=$current.'/..';
require_once($parent.'/config/Db.php');
require_once('PasswordHash.php');

	class CrudLogin{
		public function __construct(){}

		public function insertar($token, $id){
			$db=Db::conectar();
			$insert=$db->prepare('INSERT INTO tokens values(NULL, :id_usuario, :token)');
			$insert->bindValue('id_usuario',$id);
			$insert->bindValue('token',$token);
			$insert->execute();
			$LAST_ID = $db->lastInsertId();
			return $LAST_ID;
		}

		public function setToken($token, $id){
			$db=Db::conectar();
			$insert=$db->prepare('UPDATE tokens SET token=:token WHERE id_usuario=:id_usuario ');
			$insert->bindValue('token',$token);
			$insert->bindValue('id_usuario',$id);
			$insert->execute();
		}

		public function getToken($token){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM tokens WHERE token=:token');
            $select->bindValue('token',$token);
			$select->execute();
            $usuario=$select->fetch();
            $id=$usuario['id_usuario'];
			return $id;
		}

		public function getPublicTokenRep($token){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM reportes WHERE publictoken=:token');
            $select->bindValue('token',$token);
			$select->execute();
            $usuario=$select->fetch();
            $id=$usuario['id_reporte'];
			return $id;
		}

		public function obtener($username, $password){
			$db=Db::conectar();
			$select=$db->prepare('SELECT * FROM wp_users WHERE user_login=:username');
            $select->bindValue('username',$username);
			$select->execute();
			$usuario=$select->fetch();
			$pass=$usuario['user_pass'];
			$hasher = new PasswordHash(8, true);
			//echo $hasher->CheckPassword($password, $pass);
			if($hasher->CheckPassword($password, $pass)==1){
				$id=$usuario['ID'];
				return $id;
			}else{
				return null;
			}
		}
	}
?>