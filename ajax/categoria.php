<?
require_once "../modelos/Categoria.php";

$categoria=new Categoria();

$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
        if (empty($idcategoria)){
            $rspta=$categoria->insertar($nombre,$descripcion);
            echo $rspta ? "Categoria registrada" : "Categoria no se puede registrar";
        }
        else{
            $rspta=$categoria->editar($idcategoria,$descripcion);
            echo $rspta ? "Categoria actualizada" : "Categoria no se puede actualizar";
        }
        break;
    case 'desactivar':
        $rspta=$categoria->desactivar($idcategoria);
        echo $rspta ? "Categoría desactivada" : "Categoría no se puede desactivar";
        break;
    case 'activar':
        $rspta=$categoria->activar($idcategoria);
        echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
        break;
    case 'mostrar':
        $rspta=$categoria->mostrar($idcategoria);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;
    case 'listar':
        $rspta=$categoria->listar();
        //vamos a declara un array
        $data = Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=[
                "0" => $reg->idcategoria,
                "1" => $reg->nombre,
                "2" => $reg->descripcion,
                "3" => $reg->condicion,
            ];
        }
        $results = [
            "sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data
        ];
        echo json_encode($results);
        break;
}
?>