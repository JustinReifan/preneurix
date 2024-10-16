<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function course()
    {
        $data['title'] = 'Module Management';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();
        // ambil data keyword (helper)
        $data['keyword'] = check_keyword();

        // search config
        $this->db->like('module_title', $data['keyword']);
        $this->db->from('modules');
        $data['total_rows'] =  $this->db->count_all_results();

        // pagination config (helper)
        $url = 'admin/module';
        $perPage = 1;
        $data['start'] = paginationStart($perPage, $data['total_rows'], 'modules', $url);


        // panggil model
        $this->load->model('Courses_model', 'courses');
        $data['modules'] = $this->courses->getModules($perPage, $data['start'], $data['keyword']);


        $this->load->view('ajax/course', $data);
    }
}