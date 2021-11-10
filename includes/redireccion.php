<?php
//si no existe la session, iniciar session
if(!isset($_SESSION)){
	session_start();
}
//en caso de no estar inciado ir a index 
if(!isset($_SESSION['usuario'])){
	header("Location: index.php");
}