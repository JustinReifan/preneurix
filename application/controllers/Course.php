<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{
    public function index(){
        $data['title'] = 'All Courses';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('course/index', $data);
        $this->load->view('templates/footer');
    }
}
