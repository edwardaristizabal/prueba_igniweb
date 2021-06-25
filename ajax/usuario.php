<?php
session_start();
//Para que se inicie la sesión 
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$codigo_trabajador=isset($_POST["codigo_trabajador"])? limpiarCadena($_POST["codigo_trabajador"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$profesion=isset($_POST["profesion"])? limpiarCadena($_POST["profesion"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idusuario)){
			$rspta=$usuario->insertar($codigo_trabajador,$num_documento,$nombre,$profesion,$cargo,$direccion,$telefono,$email,$login,$clave);
			echo $rspta ? "Registered user" : "User could not register";
		}
		else {
			$rspta=$usuario->editar($idusuario,$codigo_trabajador,$num_documento,$nombre,$profesion,$cargo,$direccion,$telefono,$email,$login,$clave);
			echo $rspta ? "Updated user" : "User could not update";
		}
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'eliminar':
    $rspta=$usuario->eliminar($idusuario);
    echo $rspta ? "Deleted User" : "User cannot be deleted";

    break;

	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->idusuario,
        		"1"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button> <button class="btn btn-danger" onclick="eliminarFila('.$reg->idusuario.')"><i class="fa fa-trash"></button>',
 				"2"=>$reg->codigo_trabajador,
 				"3"=>$reg->num_documento,
 				"4"=>$reg->nombre,
 				"5"=>$reg->profesion,
 				"6"=>$reg->cargo,
 				"7"=>$reg->direccion,
 				"8"=>$reg->telefono,
 				"9"=>$reg->email,
 				"10"=>$reg->login
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

 case 'verificar':
    $loginf=$_POST['loginf'];
    $clavef=$_POST['clavef'];
    $rspta=$usuario->verificar($loginf, $clavef);

    $fetch=$rspta->fetch_object();
    echo json_encode($fetch);

    if (isset($fetch))
    {
        //Declaramos las variables de sesión
        $_SESSION['nombre']=$fetch->nombre;

        $_SESSION['login']=$fetch->login;
    }
    break;

    case "salir": 
         //Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");
        break;
}

?>