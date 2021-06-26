<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Prestamo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idlibro,$fecha_prestamo,$fecha_devolucion,$cantidad,$observacion)
	{
		$sql="INSERT INTO prestamo (idlibro,fecha_prestamo,fecha_devolucion,cantidad,observacion,estado)
		VALUES ('$idlibro','$fecha_prestamo','$fecha_devolucion','$cantidad','$observacion','Loaned')";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT p.idprestamo,p.idlibro,l.titulo as libro, DATE(p.fecha_prestamo) as fecha_prestamo,DATE(p.fecha_devolucion) as fecha_devolucion,p.cantidad,p.observacion,p.estado FROM prestamo p INNER JOIN libro l ON p.idlibro=l.idlibro ORDER BY p.idprestamo desc";
		return ejecutarConsulta($sql);		
	}


	public function mostrar($idprestamo)
	{
		$sql="SELECT * FROM prestamo WHERE idprestamo='$idprestamo'";
		return ejecutarConsultaSimpleFila($sql);
	}
//Implementamos un método para anular prestamo
	public function anular($idprestamo)
	{
		$sql="UPDATE prestamo SET estado='Returned' WHERE idprestamo='$idprestamo'";
		return ejecutarConsulta($sql);
	}

}

?>