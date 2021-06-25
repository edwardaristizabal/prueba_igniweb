<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($codigo_trabajador,$num_documento,$nombre,$profesion,$cargo,$direccion,$telefono,$email,$login,$clave)
	{
		$sql="INSERT INTO usuario (codigo_trabajador,num_documento,nombre,profesion,cargo,direccion,telefono,email,login,clave)
		VALUES ('$codigo_trabajador','$num_documento','$nombre','$profesion','$cargo','$direccion','$telefono','$email','$login','$clave')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idusuario,$codigo_trabajador,$num_documento,$nombre,$profesion,$cargo,$direccion,$telefono,$email,$login,$clave)
	{
		$sql="UPDATE usuario SET codigo_trabajador='$codigo_trabajador',num_documento='$num_documento',nombre='$nombre',profesion='$profesion',cargo='$cargo',direccion='$direccion',telefono='$telefono',email='$email',login='$login',clave='$clave' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql);		
	}

    //Función que va a verficar si existe 
        //la cuenta de usuario
        public function verificar($login,$clave)
        {
            $sql="SELECT nombre, login, clave FROM usuario WHERE login='$login' AND clave='$clave'";
            
            return ejecutarConsulta($sql);
        }

     //Implementamos nuestro método para insertar registros 
        public function eliminar($idusuario)
        {
            $sql ="DELETE FROM usuario
            WHERE idusuario='$idusuario'";
            return ejecutarConsulta($sql);
        }
    }

?>
