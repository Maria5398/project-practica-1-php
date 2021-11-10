<?php
require_once 'includes/conexion.php';
/*
si existe el usuario identificado y el id de a eentradas desi puedee eliminaar la enntrada
*/
if(isset($_SESSION['usuario']) && isset($_GET['id'])){
	$entrada_id = $_GET['id'];
	$usuario_id = $_SESSION['usuario']['id'];
	
	$sql = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";
	$borrar = mysqli_query($db, $sql);
	/*
	$db nuestra base de datos de la
	$sqql envaar la conssulta realizada
	*/
}

header("Location: index.php");
