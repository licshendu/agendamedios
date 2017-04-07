<?php

class Evento extends CI_Model {

    public function registrar($datos) {
        $data = array(
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'fecha_inicio' => $datos['fechaInicio'],
            'fecha_fin' => $datos['fechaFin'],
            'id_municipio' => $datos['idMunicipio'],
            'id_usuario' => $datos['id_usuario'],
            'id_evento_estatus' => 2,
        );
        $this->db->insert('evento', $data);

        $respuesta = array('mensaje' => 'registro exitoso');
        echo json_encode($respuesta);
    }

    public function listarEventos($filtros) {
        $query = 'select  e.id_evento, e.nombre evento, e.descripcion, e.fecha_inicio, e.fecha_fin, r.id_region, r.region,
                d.id_distrito, d.distrito, m.id_municipio, m.municipio, u.usuario, e.fecha_alta,ee.estatus
            from evento e 
            join distrito_municipio dm ON dm.id_municipio = e.id_municipio
            join distrito d ON d.id_distrito = dm.id_distrito
            join region r ON r.id_region = d.id_region
            join municipio m ON m.id_municipio = dm.id_municipio
            join usuario u ON u.id_usuario = e.id_usuario
            join evento_estatus ee ON ee.id_evento_estatus = e.id_evento_estatus
            ORDER BY fecha_alta DESC';
        $resultado = $this->db->query($query);
        $regiones = $resultado->result_array();
        header('Content-Type: application/json');
        echo json_encode($regiones);
    }

}

?>