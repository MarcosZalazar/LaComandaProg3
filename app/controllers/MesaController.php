<?php
require_once './models/Mesa.php';


class MesaController extends Mesa 
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $id = $parametros['id'];
        $estado = $parametros['estado'];

        $mesa = new Mesa();
        $mesa->id = $id;
        $mesa->estado = $estado;
        $mesa->crearMesa();

        $payload = json_encode(array("mensaje" => "Criptomoneda creada con exito"));

        $response->getBody()->write($payload);
        $response = $response->withStatus(200);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Mesa::obtenerTodos();
        if(!$lista)
        {
          $payload = json_encode(array("Error" => "No se encontró la mesa solicitada"));
          $response = $response->withStatus(400);
        }
        else
        {
          $payload = json_encode(array("listaMesa" => $lista));
          $response->getBody()->write($payload);
          $response = $response->withStatus(200);
        }
        
        return $response->withHeader('Content-Type', 'application/json');
    }
    
    /*
    public function TraerPorNacionalidad($request, $response, $args)
    {
        //$pais = $_GET["nacionalidad"];
        $pais = $args["nacionalidad"];
        $lista = Mesa::obtenerCriptomonedaPorPais($pais);
        if(!$lista)
        {
          $payload = json_encode(array("Error" => "No se encontró la criptomoneda solicitada"));
          $response = $response->withStatus(400);
        }
        else
        {
          $payload = json_encode(array("listaCriptomonedasPais" => $lista));
          $response->getBody()->write($payload);
          $response = $response->withStatus(200);
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function TraerPorId($request, $response, $args)
    {
        $id = $args["id"];
        $criptomoneda = Criptomoneda::obtenerCriptomonedaPorId($id);

        if(!$criptomoneda)
        {
          $payload = json_encode(array("Error" => "No se encontró la criptomoneda solicitada"));
          $response = $response->withStatus(400);
        }
        else
        {
          $payload = json_encode($criptomoneda);
          $response->getBody()->write($payload);
          $response = $response->withStatus(200);
        }
        return $response->withHeader('Content-Type', 'application/json');
    }


    public function ModificarUno($request, $response, $args)
    {
        $datos = json_decode(file_get_contents("php://input"), true);
        $criptoModificada = new Criptomoneda();
        $criptoModificada->id=$datos["id"]; 
        $criptoModificada->precio=$datos["precio"]; 
        $criptoModificada->nombre=$datos["nombre"]; 
        $criptoModificada->URLImagen=$this->moverImagenBackup();
        $criptoModificada->nacionalidad=$datos["nacionalidad"]; 
        if(Criptomoneda::modificarCriptomoneda($criptoModificada))
        {
          $payload = json_encode(array("mensaje" => "Criptomoneda modificada con exito"));
          $response->getBody()->write($payload);
          $response = $response->withStatus(200);
        }
        else
        {          
          $payload = json_encode(array("Error" => "No se pudo modificar la criptomoneda"));
          $response = $response->withStatus(400);
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args["id"];
       
        if(Criptomoneda::borrarCriptomoneda($id))
        {
          $payload = json_encode(array("mensaje" => "Criptomoneda borrada con éxito"));
          $response = $response->withStatus(200);
        }
        else
        {
          $payload = json_encode(array("Error" => "No se pudo borrar la criptomoneda"));
          $response = $response->withStatus(400);
        }

        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    private function moverImagen()
    {
      $carpetaFotos = ".".DIRECTORY_SEPARATOR."fotosCripto".DIRECTORY_SEPARATOR;
      if(!file_exists($carpetaFotos))
      {
          mkdir($carpetaFotos, 0777, true);
      }
      $nuevoNombre = $carpetaFotos.$_FILES["foto"]["name"];
      rename($_FILES["foto"]["tmp_name"], $nuevoNombre);

      return $nuevoNombre;
    }
    
    private function moverImagenBackup()
    {
      $carpetaFotos = ".".DIRECTORY_SEPARATOR."fotosCripto".DIRECTORY_SEPARATOR;
      $datos = json_decode(file_get_contents("php://input"), true);
      $nuevoNombre = $carpetaFotos.$datos["nombre"].".jpg";   
      $carpetaBackUp= ".".DIRECTORY_SEPARATOR."fotosCripto".DIRECTORY_SEPARATOR."Backup".DIRECTORY_SEPARATOR;
      if(file_exists($nuevoNombre))
      {
        if(!file_exists($carpetaBackUp))
        {
          mkdir($carpetaBackUp, 0777, true);
        }
        rename($nuevoNombre, $carpetaBackUp.$datos["nombre"].".jpg");
      }
      rename($datos["URLImagen"], $nuevoNombre);
      return $nuevoNombre;
    }*/
}
?>