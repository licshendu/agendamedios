<?php

class Rol extends CI_Model {
    
    public function listarRoles() {
        $query = 'SELECT * FROM rol;';
        $resultado = $this->db->query($query);
        $opciones = $resultado->result_array();
        header('Content-Type: application/json');
        echo json_encode($opciones);
    }
    
    public function consultarRol($idRol) {
        $query = 'SELECT * FROM rol where id_rol= '.$idRol;
        $resultado = $this->db->query($query);
        $rol = $resultado->result_array();
        return $rol;
    }
    
    public function consultaOpcionesRoles($idRol) {
        $query = "select id_opcion from rol_opcion where id_rol = $idRol";
        $resultado = $this->db->query($query);
        $roles = $resultado->result_array();
        return $roles;
    }
 
    public function listarOpciones() {
        $query = 'select id_opcion value, opcion label from opcion';
        $resultado = $this->db->query($query);
        $opciones = $resultado->result_array();
        header('Content-Type: application/json');
        echo json_encode($opciones);
    }
    
     public function registrar($datos) {
        $data = array(
            'rol' => $datos['rol']
        );
        $this->db->insert('rol', $data);

        $idRol = $this->db->insert_id();

        foreach ($datos['opciones'] as $key => $value) {
            $rolOpcion = array(
                'id_rol' => $idRol,
                'id_opcion' => $value['value']
            );
            $this->db->insert('rol_opcion', $rolOpcion);
        }

        $respuesta = array('mensaje' => 'registro exitoso');
        echo json_encode($respuesta);
    }

    public function actualizar($datos) {
        $data = array(
            'rol' => $datos['rol']
        );

        $this->db->where('id_rol',  $datos['id_rol']);
        $this->db->update('rol', $data);

        //borara los anteriores roles asignados
        $data = $this->db->query("delete from rol_opcion where id_rol = " . $datos['id_rol']);

        foreach ($datos['opciones'] as $key => $value) {
            $rolOpcion = array(
                'id_rol' => $idRol,
                'id_opcion' => $value['value']
            );
            $this->db->insert('rol_opcion', $rolOpcion);
        }

        $respuesta = array('mensaje' => 'registro exitoso');
        echo json_encode($respuesta);
    }


}

?>