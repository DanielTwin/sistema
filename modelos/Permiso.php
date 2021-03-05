<?
//Incluímos inicialmente la conexión a la base de datos 
require "../config/Conexion.php";

Class Permiso
{
    //Implementación del constructor
	public function __construct()
	{

	}
    //Implentación de un método para listar los registros
    public function listar()
    {
        $sql="SELECT * FROM permiso";

        return ejecutarConsulta($sql);

    }
}
?>