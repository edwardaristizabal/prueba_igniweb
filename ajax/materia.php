<?php 
require_once "../modelos/Materia.php";

$materia=new Materia();
$idmateria=isset($_POST["idmateria"])? limpiarCadena($_POST["idmateria"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idmateria)){
			$rspta=$materia->insertar($nombre,$descripcion);
			echo $rspta ? "Registered topic" : "Topic could not be registered";
		}
		else {
			$rspta=$materia->editar($idmateria,$nombre,$descripcion);
			echo $rspta ? "Topic updated" : "topic could not be updated";
		}
	break;

	case 'desactivar':
		$rspta=$materia->desactivar($idmateria);
 		echo $rspta ? "Topic deactivated" : "Topic cannot be deactivated";
	break;

	case 'activar':
		$rspta=$materia->activar($idmateria);
 		echo $rspta ? "Topic activated" : "Topic cannot be activated";
	break;

	case 'mostrar':
		$rspta=$materia->mostrar($idmateria);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$materia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idmateria.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idmateria.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idmateria.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idmateria.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->descripcion,
 				"3"=>($reg->estado)?'<span class="label bg-green">Activated</span>':
 				'<span class="label bg-red">Disable</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
///}
//Fin de las validaciones de acceso
//}
//else
//{
 // require 'noacceso.php';
//}
}
//ob_end_flush();
?>