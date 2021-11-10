<?php

function mostrarError($errores, $campo){
	$alerta = '';
	if(isset($errores[$campo]) && !empty($campo)){
		$alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
	}
	
	return $alerta;
}

function borrarErrores(){
	$borrado = false;
	
	if(isset($_SESSION['errores'])){
		$_SESSION['errores'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['errores_entrada'])){
		$_SESSION['errores_entrada'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['completado'])){
		$_SESSION['completado'] = null;
		$borrado = true;
	}
	
	return $borrado;
}
//conexion categoria a mmysql
function conseguirCategorias($conexion){
	$sql = "SELECT * FROM categorias ORDER BY id ASC;";
	$categorias = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($categorias && mysqli_num_rows($categorias) >= 1){
		$resultado = $categorias;
	}
	
	return $resultado;
}
//mostrar entradas por caaateegoriaa
function conseguirCategoria($conexion, $id){
	$sql = "SELECT * FROM categorias WHERE id = $id;";
	$categorias = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($categorias && mysqli_num_rows($categorias) >= 1){
		$resultado = mysqli_fetch_assoc($categorias);
	}
	
	return $resultado;
}
//para que me muestre todo el dato de una entrada

function conseguirEntrada($conexion, $id){
	$sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario"
		  . " FROM entradas e ".
		   "INNER JOIN categorias c ON e.categoria_id = c.id ".
		   "INNER JOIN usuarios u ON e.usuario_id = u.id ".
		   "WHERE e.id = $id";
	$entrada = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($entrada && mysqli_num_rows($entrada) >= 1){
		$resultado = mysqli_fetch_assoc($entrada);
	}
	
	return $resultado;
}
//ver toda las entradas

function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){
	$sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
		 "INNER JOIN categorias c ON e.categoria_id = c.id ";
	
	if(!empty($categoria)){
		$sql .= "WHERE e.categoria_id = $categoria ";
	}
	
	if(!empty($busqueda)){
		$sql .= "WHERE e.titulo LIKE '%$busqueda%' "; //usar comodin pparaa que busque porr los carctereess intrrodducidos
	}
	
	$sql .= "ORDER BY e.id DESC ";//el  orden va all final despuees de where
	
	if($limit){
		// $sql = $sql." LIMIT 4";
		$sql .= "LIMIT 4";
	}
	
	$entradas = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($entradas && mysqli_num_rows($entradas) >= 1){
		$resultado = $entradas;
	}
	
	return $entradas;
}