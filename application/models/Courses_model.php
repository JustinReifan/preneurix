<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courses_model extends CI_Model
{
    public function getAllCourses()
    {
        $this->db->where('is_active', 1);
        return $this->db->get('courses')->result_array();
    }

    public function getCourses($limit, $start)
    {
        $query = "SELECT * FROM courses
                LIMIT $limit
                OFFSET $start
        ";
        return $this->db->query($query)->result_array();
    }

    public function getCourseById($id)
    {
        // return $id;
        $this->db->where('id', $id);
        return $this->db->get('courses')->row_array();
    }

    public function getAllModules()
    {
        $query = "SELECT `modules`.*, `courses`.`course_title`
                FROM `modules` JOIN `courses`
                ON `modules`.`courses_id` = `courses`.`id`
        ";
        return $this->db->query($query)->result_array();
    }


    public function getModules($limit, $start, $keyword = null)
    {

        $query = "SELECT `modules`.*, `courses`.`course_title`
        FROM `modules` JOIN `courses`
        ON `modules`.`courses_id` = `courses`.`id`
        ";


        if ($keyword) {
            $query = $query . " WHERE modules.module_title LIKE '%$keyword%' ESCAPE '!'";

            $query = $query . " LIMIT $limit
            OFFSET $start";
        } else {
            $query = $query . " LIMIT $limit
            OFFSET $start";
        }
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

    public function countModules()
    {
        return $this->db->get('modules')->num_rows();
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
                ORDER BY id DESC
                LIMIT 1
        
        ";
        $res = $this->db->query($query)->row_array();
        if ($res !== null) {
            return $res;
        } else {
            return false;
        }
    }

    public function deleteById($table, $id)
    {
        $this->db->delete($table, ['id' => $id]);
    }

    public function editModule()
    {

        $data = [
            "module_title" => $this->input->post('module_title', true),
            "courses_id" => $this->input->post('courses_id', true),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('modules', $data);
    }
}