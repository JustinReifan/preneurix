<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courses_model extends CI_Model
{
    public function getCourses()
    {
        return $this->db->get('courses')->result_array();
    }
    public function getModules()
    {
        $query = "SELECT `modules`.*, `courses`.`course_title`
                FROM `modules` JOIN `courses`
                ON `modules`.`courses_id` = `courses`.`id`
        
        ";
        return $this->db->query($query)->result_array();
    }
    public function countModuleByCourseId($id)
    {
        $query = "SELECT `modules`.*
                FROM `modules` JOIN `courses`
                ON `modules`.`courses_id` = `courses`.`id`
                WHERE `courses`.`id` = $id
        
        ";
        return $this->db->query($query)->num_rows();
    }
}
