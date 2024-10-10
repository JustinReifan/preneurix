<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'All Courses';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('Courses_model', 'courses');
        $data['courses'] = $this->courses->getCourses();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('course/index', $data);
        $this->load->view('templates/footer');
    }

    public function details($id)
    {
        $data['title'] = 'Course Details';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $data['id'] = $id;

        $this->load->model('Courses_model', 'courses');
        $data['module'] = $this->courses->getAllModuleByCourseId($id);
        $data['course'] = $this->courses->getCourseById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/course_sidebar', $data);
        $this->load->view('templates/course_topbar', $data);
        $this->load->view('course/details', $data);
        $this->load->view('templates/footer');
    }

    public function module($id)
    {
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();
        $this->load->model('Courses_model', 'courses');
        $data['module'] = $this->courses->getModuleById($id);

        $coursesId = $data['module']['courses_id'];
        $data['id'] = $id;
        $data['moduleList'] = $this->courses->getAllModulesById($coursesId);

        $data['course'] = $this->courses->getCourseById($coursesId);
        $data['nextModule'] = $this->courses->getNextModuleByCourseId($coursesId, $id);
        $data['prevModule'] = $this->courses->getPrevModuleByCourseId($coursesId, $id);
        $data['title'] = $data['module']['module_title'];


        $this->load->view('templates/header', $data);
        $this->load->view('templates/module_sidebar', $data);
        $this->load->view('templates/module_topbar', $data);
        $this->load->view('course/module/index', $data);
        $this->load->view('templates/footer');
    }
}
