<?php

class Usuario extends CI_Model {

    public function consultaUsuario($usuario, $password, $id_usuario) {
        $query = "select id_usuario, nombre, primer_apellido, segundo_apellido, usuario, contrasenia "
                . "from usuario ";
        if ($id_usuario != null) {
            $query .= "where id_usuario = $id_usuario";
        } else {
            $query .= "where usuario ='$usuario' and contrasenia = '$password'";
        }

        $resultado = $this->db->query($query);
        $usuarios = $resultado->result_array();
        return $usuarios;
    }

    public function consultaUsuarioRoles($idUsuario) {
        $query = "select id_rol from usuario_rol where id_usuario = $idUsuario";
        $resultado = $this->db->query($query);
        $roles = $resultado->result_array();
        return $roles;
    }

    public function listarUsuarios($filtros) {
        $query = 'SELECT id_usuario, usuario, nombre, primer_apellido, segundo_apellido FROM usuario';
        $resultado = $this->db->query($query);
        $regiones = $resultado->result_array();
        header('Content-Type: application/json');
        echo json_encode($regiones);
    }

    public function listarRoles() {
        $query = 'SELECT id_rol value, rol label FROM rol';
        $resultado = $this->db->query($query);
        $regiones = $resultado->result_array();
        header('Content-Type: application/json');
        echo json_encode($regiones);
    }

    public function registrar($datos) {
        $data = array(
            'usuario' => $datos['usuario'],
            'contrasenia' => md5($datos['contrasenia']),
            'nombre' => $datos['nombre'],
            'primer_apellido' => $datos['primer_apellido'],
            'segundo_apellido' => $datos['segundo_apellido'],
            'id_usuario_alta' => $datos['id_usuario_alta']
        );
        $this->db->insert('usuario', $data);

        $idUsuario = $this->db->insert_id();

        foreach ($datos['roles'] as $key => $value) {
            $rolUsuario = array(
                'id_usuario' => $idUsuario,
                'id_rol' => $value['value']
            );
            $this->db->insert('usuario_rol', $rolUsuario);
        }

        $respuesta = array('mensaje' => 'registro exitoso');
        echo json_encode($respuesta);
    }

    public function actualizar($datos) {
        $data = array(
            'usuario' => $datos['usuario'],
            'contrasenia' => md5($datos['contrasenia']),
            'nombre' => $datos['nombre'],
            'primer_apellido' => $datos['primer_apellido'],
            'segundo_apellido' => $datos['segundo_apellido'],
            'id_usuario_alta' => $datos['id_usuario_alta']
        );

        $this->db->where('id_usuario', $datos['id_usuario']);
        $this->db->update('usuario', $data);

        //borara los anteriores roles asignados
        $data = $this->db->query("delete from usuario_rol where id_usuario = " . $datos['id_usuario']);

        foreach ($datos['roles'] as $key => $value) {
            $rolUsuario = array(
                'id_usuario' => $datos['id_usuario'],
                'id_rol' => $value['value']
            );
            $this->db->insert('usuario_rol', $rolUsuario);
        }

        $respuesta = array('mensaje' => 'registro exitoso');
        echo json_encode($respuesta);
    }

}

?>