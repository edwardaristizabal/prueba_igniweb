<?php 

require_once "../modelos/Editorial.php";

$editorial=new editorial();

$ideditorial=isset($_POST["ideditorial"])? limpiarCadena($_POST["ideditorial"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($ideditorial)){
			$rspta=$editorial->insertar($nombre,$descripcion);
			echo $rspta ? "Registered editorial" : "Could not be registered editorial";
		}
		else {
			$rspta=$editorial->editar($ideditorial,$nombre,$descripcion);
			echo $rspta ? "Update editorial" : "Could not update editorial";
		}
	break;

	case 'desactivar':
		$rspta=$editorial->desactivar($ideditorial);
 		echo $rspta ? "Desactivated editorial" : "cannot be deactivated editorial";
	break;

	case 'activar':
		$rspta=$editorial->activar($ideditorial);
 		echo $rspta ? "Activated editorial" : "Cannot be activated editorial";
	break;

	case 'mostrar':
		$rspta=$editorial->mostrar($ideditorial);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$editorial->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->ideditorial.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->ideditorial.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->ideditorial.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->ideditorial.')"><i class="fa fa-check"></i></button>',
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
}
//Fin de las validaciones de acceso
//}
//else
//{
//  require 'noacceso.php';
//}
//}
//ob_end_flush();
?>