<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getAllUser()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
                FROM `user` JOIN `user_role`
                ON `user`.`role_id` = `user_role`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function getUser($limit, $start, $keyword = null)
    {

        $query = "SELECT `user`.*, `user_role`.`role`
        FROM `user` JOIN `user_role`
        ON `user`.`role_id` = `user_role`.`id`
        ";


        if ($keyword) {
            $query = $query . " WHERE user.name LIKE '%$keyword%' 
                                                OR user.email LIKE '%$keyword%' 
                                                ESCAPE '!'";

            $query = $query . " LIMIT $limit
            OFFSET $start";
        } else {
            $query = $query . " LIMIT $limit
            OFFSET $start";
        }
        return $this->db->query($query)->result_array();
    }

    public function getUserById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }
    public function deleteById($table, $id)
    {
        $this->db->delete($table, ['id' => $id]);
    }
}