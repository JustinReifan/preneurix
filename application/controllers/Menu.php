<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'menu', 'required');

        // add menu
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_tempdata('messageMenu', '<div class="alert alert-success" role="alert">
                   New menu added!</div>', 4);
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();
        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();


        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('menu_id', 'menu', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
                   New submenu added!</div>', 4);
            redirect('menu/submenu');
        }
    }

    public function editmenu($id)
    {
        $data['title'] = 'Edit Menu';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();
        $this->load->model('Menu_model', 'menu');
        $this->form_validation->set_rules('newMenu', 'New Menu Name', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->menu->editMenu();
            $this->session->set_tempdata('messageMenu', '<div class="alert alert-success" role="alert">
                   Menu edit successfully</div>', 4);
            redirect('menu');
        }
    }
    public function deletemenu($id)
    {
        $this->load->model('Menu_model', 'menu');
        $this->menu->deleteMenu($id);
        $this->session->set_tempdata('messageMenu', '<div class="alert alert-success" role="alert">
                   Menu delete successfully</div>', 4);
        redirect('menu');
    }
    public function editsubmenu($id)
    {
        $data['title'] = 'Edit SubMenu';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['subMenuDetails'] = $this->menu->getSubMenuById($id);
        $data['menu'] = $this->menu->getMenu();
        $this->form_validation->set_rules('menu_id', 'Sub Menu', 'required');
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editsubmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->menu->editSubMenu();
            $this->session->set_tempdata('messageMenu', '<div class="alert alert-success" role="alert">
                   Sub Menu edit successfully</div>');
            redirect('menu/submenu');
        }
    }
    public function deletesubmenu($id)
    {
        $this->load->model('Menu_model', 'menu');
        $this->menu->deleteSubMenu($id);
        $this->session->set_tempdata('messageMenu', '<div class="alert alert-success" role="alert">
                   Sub Menu delete successfully</div>');
        redirect('menu/submenu');
    }
}