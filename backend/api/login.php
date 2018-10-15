<?php
require_once('crud_login.php');


$crud= new CrudLogin();

class Login{

	function checkPost($data){
		if(isset($_POST[''.$data.'']) && !empty($_POST[''.$data.''])){
			return $_POST[''.$data.''];
		}else{
			return 'empty';
		}
	}
	function checkGet($data){
		if(isset($_GET[''.$data.'']) && !empty($_GET[''.$data.''])){
			return $_GET[''.$data.''];
		}else{
			return '0';
		}
    }
    
    function rand_string( $length ) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@#$&*";  
        $size = strlen( $chars );
        $str='';
        for( $i = 0; $i < $length; $i++ ) {
            $str= $str.$chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
    }
 
	function useClass(){
        if (isset($_POST['login'])) {
            $username=checkPost('username');
            $password=checkPost('password');
            $id=$crud->obtener($username, $password);
            if($id!=null){
                $token=rand_string( 40 );
                $crud->setToken($token, $id);
                echo $token;
            }else{
                echo null;
            }
        }
    }
    
}
?>