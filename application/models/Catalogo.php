<?php

class Catalogo extends CI_Model {

    public function getRegiones() {
        $query = 'select id_region value, region text from region';
        $resultado = $this->db->query($query);
        $regiones = $resultado->result_array();
        header('Content-Type: application/json');
        echo json_encode($regiones);
    }

    public function getDistritos($idRegion) {
        $query = 'select id_distrito value, distrito label from distrito where id_region = ' . $idRegion;
        $resultado = $this->db->query($query);
        $regiones = $resultado->result_array();
        header('Content-Type: application/json');
        echo json_encode($regiones);
    }

    public function getMunicipios($region, $distrito, $filtros) {
        $query = 'select m.id_municipio value, m.municipio label
            from distrito_municipio dm
            join distrito d ON d.id_distrito = dm.id_distrito
            join municipio m ON m.id_municipio = dm.id_municipio
            where municipio like \'%'.$filtros['filters'][0]['value'].'%\'';
        if($region != null){
            $query .= " and d.id_region = '".$region."' and d.id_distrito = '".$distrito."'";
        }
        $resultado = $this->db->query($query);
        $regiones = $resultado->result_array();
        header('Content-Type: application/json');
        echo json_encode($regiones);
    }

}

?>