<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FiestaOaxaca extends CI_Controller {

    public function index() {
        $datoSesion = array(
            'id_usuario' => false,
            'nombre' => false,
            'primer_apellido' => false,
            'segundo_apellido' => false
        );
        $this->session->set_userdata($datoSesion);
        $this->load->view('login');
    }

    public function calendario() {
        if ($this->session->userdata('id_usuario') == true) {
            $data['titulo'] = "Calendario";
            $data['pagina'] = $this->load->view('evento/verCalendario', '', TRUE);
            $data['menu'] = $this->session->userdata('menu');
            $data['nombreUsuario'] = $this->session->userdata('nombre') . ' ' . $this->session->userdata('primer_apellido');
            $this->load->view('principal', $data);
        } else {
            redirect(base_url());
        }
    }

    public function altaEvento() {
        if ($this->session->userdata('id_usuario') == true) {
            $data['titulo'] = "Alta Fiesta";
            $data['pagina'] = $this->load->view('evento/altaEvento', '', TRUE);
            $data['nombreUsuario'] = $this->session->userdata('nombre') . ' ' . $this->session->userdata('primer_apellido');
            $data['menu'] = $this->session->userdata('menu');
            $this->load->view('principal', $data);
        } else {
            redirect(base_url());
        }
    }

    public function altaUsuario() {
        if ($this->session->userdata('id_usuario') == true) {
            $data['titulo'] = "Alta Usuario";
            $data['pagina'] = $this->load->view('usuario/altaUsuario', '', TRUE);
            $data['nombreUsuario'] = $this->session->userdata('nombre') . ' ' . $this->session->userdata('primer_apellido');
            $data['menu'] = $this->session->userdata('menu');
            $this->load->view('principal', $data);
        } else {
            redirect(base_url());
        }
    }

    public function altaRol() {
        if ($this->session->userdata('id_usuario') == true) {
            $data['titulo'] = "Alta Rol";
            $data['pagina'] = $this->load->view('rol/altaRol', '', TRUE);
            $data['nombreUsuario'] = $this->session->userdata('nombre') . ' ' . $this->session->userdata('primer_apellido');
            $data['menu'] = $this->session->userdata('menu');
            $this->load->view('principal', $data);
        } else {
            redirect(base_url());
        }
    }

    //CATALOGOS
    public function getRegiones() {
        $this->load->model('Catalogo', 'catalogo', true);
        $this->catalogo->getRegiones();
    }

    public function getDistritos() {
        $idRegion = $this->input->get('idRegion');
        $this->load->model('Catalogo', 'catalogo', true);
        $this->catalogo->getDistritos($idRegion);
    }

    public function getMunicipios() {
        $idRegion = $this->input->get('idRegion');
        $idDistrito = $this->input->get('idDistrito');
        $filtros = $this->input->get('filter');
        $this->load->model('Catalogo', 'catalogo', true);
        $this->catalogo->getMunicipios($idRegion, $idDistrito, $filtros);
    }

    public function registrarEvento() {
        $datos = $this->input->post('datos');
        $datos['id_usuario'] = $this->session->userdata('id_usuario');
        $this->load->model('Evento', 'evento', true);
        $this->evento->registrar($datos);
    }

    public function listarEventos() {
        $filtros = $this->input->post('filtros');
        $this->load->model('Evento', 'evento', true);
        $this->evento->listarEventos($filtros);
    }

    public function listarUsuarios() {
        $filtros = $this->input->post('filtros');
        $this->load->model('Usuario', 'usuario', true);
        $this->usuario->listarUsuarios($filtros);
    }

    public function registrarUsuario() {
        $datos = $this->input->post('datos');
        $datos['id_usuario_alta'] = $this->session->userdata('id_usuario');
        $this->load->model('Usuario', 'usuario', true);
        if ($datos['id_usuario'] != "") {
            $this->usuario->actualizar($datos);
        } else {
            $this->usuario->registrar($datos);
        }
    }

    public function consultarUsuario() {
        $id_usuario = $this->input->post('id_usuario');
        $this->load->model('Usuario', 'usuario', true);
        $resultado = $this->usuario->consultaUsuario(null, null, $id_usuario);
        $resultado = $resultado[0];
        $roles = $this->usuario->consultaUsuarioRoles($id_usuario);
        $rolesFormat = array();
        foreach ($roles as $key => $value) {
            array_push($rolesFormat, $value['id_rol']);
        }
        $resultado['roles'] = $rolesFormat;
        echo json_encode($resultado);
    }

    public function listarRoles() {
        $this->load->model('Usuario', 'usuario', true);
        $this->usuario->listarRoles();
    }

    public function consultarRol() {
        $idRol = $this->input->post('id_rol');
        $this->load->model('Rol', 'rol', true);
        $resultado = $this->rol->consultarRol($idRol);
        $resultado = $resultado[0];
        $roles = $this->rol->consultaOpcionesRoles($idRol);
        $opcionesFormat = array();
        foreach ($roles as $key => $value) {
            array_push($opcionesFormat, $value['id_opcion']);
        }
        $resultado['opciones'] = $opcionesFormat;
        echo json_encode($resultado);
    }

    public function listarRolesGrid() {
        $this->load->model('Rol', 'rol', true);
        $this->rol->listarRoles();
    }

    public function gestionarRol() {
        $idRol = $this->input->post('id_rol');
    }

    public function listarOpciones() {
        $this->load->model('Rol', 'rol', true);
        $this->rol->listarOpciones();
    }

    public function login() {
        if ($this->session->userdata('id_usuario') == false) {
//            $usuario = strtoupper($this->input->post('usuario'));
//            $password = md5(strtoupper($this->input->post('password')));
            $usuario = 'GENERICO';
            $password = 'GENERICO';
            $resultado = $this->cargarConfiguracionUsuario($usuario, $password);
            if (!$resultado) {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
            //$this->load->view('alta/altaEvento');
        }
    }

    function cargarConfiguracionUsuario($usuario, $password) {
        $this->load->model('Usuario', 'usuario', true);
        $resultado = $this->usuario->consultaUsuario($usuario, md5($password), null);
        if (count($resultado) == 1) {

            //obtener configuracion de menu
            $this->load->model('Menu', 'menu', true);
            $menu = $this->menu->listarMenu($resultado[0]['id_usuario']);

            $datoSesion = array(
                'id_usuario' => strtoupper($resultado[0]['id_usuario']),
                'nombre' => strtoupper($resultado[0]['nombre']),
                'primer_apellido' => strtoupper($resultado[0]['primer_apellido']),
                'segundo_apellido' => strtoupper($resultado[0]['segundo_apellido']),
                'menu' => $menu
            );
            $this->session->set_userdata($datoSesion);

            $data['titulo'] = "Principal";
            $data['pagina'] = $this->load->view('introduccion', '', TRUE);
            $data['menu'] = $this->session->userdata('menu');
            $data['nombreUsuario'] = $this->session->userdata('nombre') . ' ' . $this->session->userdata('primer_apellido');
            $this->load->view('principal', $data);
            return true;
        }
        return false;
    }

    public function logout() {
        $datoSesion = array(
            'id_usuario' => false,
            'nombre' => false,
            'primer_apellido' => false,
            'segundo_apellido' => false
        );
        $this->session->set_userdata($datoSesion);
        $respuesta = array('mensaje' => 'cerró session correctamente');
        echo json_encode($respuesta);
    }

}
