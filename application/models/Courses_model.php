<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courses_model extends CI_Model
{
    public function getCourses()
    {
        return $this->db->get('courses')->result_array();
    }

    public function getCourseById($id)
    {
        // return $id;
        $this->db->where('id', $id);
        return $this->db->get('courses')->row_array();
    }

    public function getModules()
    {
        $query = "SELECT `modules`.*, `courses`.`course_title`
                FROM `modules` JOIN `courses`
                ON `modules`.`courses_id` = `courses`.`id`
        
        ";
        return $this->db->query($query)->result_array();
    }

    public function getAllModulesById($id)
    {
        $this->db->where('courses_id', $id);
        return $this->db->get('modules')->result_array();
    }

    public function getModuleById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('modules')->row_array();
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
    public function getAllModuleByCourseId($id)
    {
        $query = "SELECT `modules`.*
                FROM `modules` JOIN `courses`
                ON `modules`.`courses_id` = `courses`.`id`
                WHERE `courses`.`id` = $id AND `modules`.`is_active` = 1
        
        ";
        return $this->db->query($query)->result_array();
    }

    public function getNextModuleByCourseId($courseId, $id)
    {

        $query = "SELECT `modules`.*
                FROM `modules` JOIN `courses`
                ON `modules`.`courses_id` = `courses`.`id`
                WHERE `courses`.`id` = $courseId AND `modules`.`id` > $id
                LIMIT 1
        
        ";
        $res = $this->db->query($query)->row_array();
        if ($res !== null) {
            return $res;
        } else {
            return false;
        }
    }


    public function getPrevModuleByCourseId($courseId, $id)
    {
        $query = "SELECT `modules`.*
                FROM `modules` JOIN `courses`
                ON `modules`.`courses_id` = `courses`.`id`
                WHERE `courses`.`id` = $courseId AND `modules`.`id` < $id
                LIMIT 1
        
        ";
        $res = $this->db->query($query)->row_array();
        if ($res !== null) {
            return $res;
        } else {
            return false;
        }
    }
}
