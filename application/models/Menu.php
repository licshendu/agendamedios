<?php

class Menu extends CI_Model {

    public function listarMenu($idUsuario) {
        try {
            $query = "SELECT 1 nivel, m.id_menu, m.menu, '' id_opcion,'' opcion, m.descripcion, '' url
                    FROM usuario_rol ur
                                    JOIN rol r ON r.id_rol = ur.id_rol
                                    JOIN rol_opcion ro ON ro.id_rol = r.id_rol
                                    JOIN opcion o ON o.id_opcion = ro.id_opcion
                                    JOIN menu m ON m.id_menu = o.id_menu
                    WHERE id_usuario = $idUsuario and activa = 1
                    GROUP BY m.id_menu, m.menu
                                    UNION ALL
                    SELECT  2 nivel, id_menu, '' menu, o.id_opcion, opcion, descripcion, url
                    FROM usuario_rol ur
                                    JOIN rol r ON r.id_rol = ur.id_rol
                                    JOIN rol_opcion ro ON ro.id_rol = r.id_rol
                                    JOIN opcion o ON o.id_opcion = ro.id_opcion
                    WHERE id_usuario = $idUsuario and activa = 1
                    ORDER BY id_menu, nivel";
            $resultado = $this->db->query($query);
            $configuracion = $resultado->result_array();

            //formato de menu
            $menuFormateado = array();
            $menu = null;
            if (count($configuracion) > 0) {
                foreach ($configuracion as $key => $value) {
                    if ($value['nivel'] == 1) {
                        if (!is_null($menu)) {
                            array_push($menuFormateado, $menu);
                        }
                        $menu = array('menu' => $value['menu'], 'opciones' => array());
                    } else {
                        array_push($menu['opciones'], array('opcion' => $value['opcion'], 'url' => $value['url']));
                    }
                }

                array_push($menuFormateado, $menu);
            }

            return $menuFormateado;
        } catch (Exception $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
        }
    }

}

?>