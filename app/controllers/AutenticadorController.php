<?php
require_once './models/AutentificadorJWT.php';
require_once './interfaces/IApiUsable.php';
use Fpdf\Fpdf;

class AutentificadorController extends AutentificadorJWT
{
    public function CrearTokenLogin ($request, $response,$args)
    {
        $parametros = $request->getParsedBody();
        $usuarioBaseDeDatos=Usuario::obtenerUsuario($parametros["id"]);
        if($usuarioBaseDeDatos !=null)
        {
            if(password_verify($parametros["clave"],$usuarioBaseDeDatos->clave))
            {
                $datos = array('nombre' => $usuarioBaseDeDatos->nombre, "perfil_usuario"=> $usuarioBaseDeDatos->perfil_usuario);
                $token = AutentificadorJWT::CrearToken($datos);
                $payload = json_encode(array('mensaje' => "OK. $usuarioBaseDeDatos->perfil_usuario",'jwt' => $token));
                $response->getBody()->write($payload);
                $response = $response->withStatus(200);
            }
            else
            {
                $response->getBody()->write("Error en los datos ingresados");
                $response = $response->withStatus(403);
            }
        }
        else
        {
            $response->getBody()->write("El usuario no existe");
            $response = $response->withStatus(403);
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}
?>
