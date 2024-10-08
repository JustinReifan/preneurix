<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }
    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'menu_id' => $menu_id,
            'role_id' => $role_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
            Access Changed!   </div>', 4);
    }

    public function course()
    {
        $data['title'] = 'Course Management';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Courses_model', 'courses');
        $data['courses'] = $this->courses->getCourses();
        $this->form_validation->set_rules('course_title', 'course_title', 'required|trim');

        // add menu
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/course', $data);
            $this->load->view('templates/footer');
        } else {
            // cek jika ada gambar yg akan di upload
            $upload_image = $_FILES['url_img']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|webp';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/thumbnail/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('url_img')) {
                    $new_image = $this->upload->data('file_name');
                    $data = [
                        'course_title' => $this->input->post('course_title'),
                        'url_img' => $new_image
                    ];
                    $this->db->insert('courses', $data);
                    $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
                           New Course added!</div>', 4);
                    redirect('admin/course');
                } else {
                    $this->session->set_tempdata('message', '<div class="alert alert-danger" role="alert">' .
                        $this->upload->display_errors() . '</div>', 4);
                    redirect('admin/course');
                }
            } else {
                $this->session->set_tempdata('message', '<div class="alert alert-danger" role="alert">
                   No file uploaded!</div>', 4);
                redirect('admin/course');
            }
        }
    }

    public function module()
    {
        $data['title'] = 'Module Management';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Courses_model', 'courses');
        $data['modules'] = $this->courses->getModules();
        $data['courses'] = $this->courses->getCourses();


        $this->form_validation->set_rules('module_title', 'module_title', 'required');
        $this->form_validation->set_rules('courses_id', 'select courses', 'required');
        $this->form_validation->set_rules('url_video', 'video url', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/module', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'courses_id' => $this->input->post('courses_id'),
                'module_title' => $this->input->post('module_title'),
                'url_video' => $this->input->post('url_video'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('modules', $data);
            $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
                   New modules added!</div>', 4);
            redirect('admin/module');
        }
    }
}
