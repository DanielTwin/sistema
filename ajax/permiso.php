<?
ob_start();
if (strlen(session_id()) < 1)
{
    session_start();                //validación si existe o no existe la sesión
}
if (!isset($_SESSION["nombre"]))
{
    header("Location: ../vistas/login.html");   //Validación del acceso solo a los usuarios logueados al sistema.
}
else
{
    //Validación del acceso solo al usuario logueado y autorizados.
    if ($_SESSION['acceso']==1)
    {
        require_once "../modelos/Permiso.php";

        $permiso = new Permiso();

        switch ($_GET["op"]){
            case 'listar':
                $rspta = $permiso->listar();
                //Declaración del arreglo
                $data = Array();

                while ($reg = $rspta->fetch_object()){
                    $data[] = [
                        "0" => $reg->nombre
                    ];
                }
                $results = [
                    "sEcho" => 1,                           //Información para el datatables
                    "iTotalRecords" => count($data),        //Envio del total de registros al datatables
                    "iTotalDisplayRecords" => count($data), //Envio del total de registros a visualizar
                    "aaData" => $data
                ];
                echo json_encode($results);
                break;
        }
        //Fin de las validaciones de acceso
    }
    else
    {
        require 'noacceso.php';
    }
}
ob_end_flush();
?>