<?php

class Mesa
{
    public $id;
    public $estado;


    public function crearMesa()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO mesas (estado) 
        VALUES (:estado)");
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM mesas");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }
    /*
    public static function obtenerUsuario($id)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuarios WHERE id = :id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();

        return $consulta->fetchObject('Usuario');
    }

    public static function modificarUsuario($usuario)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET 
        clave = :clave, nombre=:nombre, perfil_usuario= :perfilUsuario, fechaAlta=:fechaAlta WHERE id = :id");
        $claveHash = password_hash($usuario->clave, PASSWORD_DEFAULT);
        $consulta->bindValue(':nombre', $usuario->mail, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $claveHash, PDO::PARAM_STR);

        if($usuario->perfil_usuario!=null)
        {
            $consulta->bindValue(':perfilUsuario', $usuario->perfil_usuario, PDO::PARAM_STR);
        }else{
            $consulta->bindValue(':perfilUsuario', null, PDO::PARAM_STR);
        }

        if($usuario->fechaAlta != null)
        {
            $consulta->bindValue(':fechaAlta', $usuario->fechaAlta, PDO::PARAM_STR);
        }else{
            $consulta->bindValue(':fechaAlta', null, PDO::PARAM_STR);
        }

        if($usuario->fechaBaja != null)
        {
            $consulta->bindValue(':fechaBaja', $usuario->fechaBaja, PDO::PARAM_STR);
        }else{
            $consulta->bindValue(':fechaBaja', null, PDO::PARAM_STR);
        }

        $consulta->execute();
    }

    public static function borrarUsuario($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE usuarios SET fechaBaja = :fechaBaja WHERE id = :id");
        $fecha = date("Y-m-d H:i:s");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', $fecha);
        $consulta->execute();
    }
    */
}
?>