<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        
        ";
        return $this->db->query($query)->result_array();
    }
    public function getMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }
    public function getSubMenuById($id)
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                WHERE `user_sub_menu`.`id` = '$id'
        ";
        return $this->db->query($query)->result_array();
    }
    public function editMenu()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', ["menu" => $this->input->post('newMenu', true)]);
    }
    public function deleteMenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
    }
    public function editSubMenu()
    {
        $data = [
            "menu_id" => $this->input->post('menu_id', true),
            "title" => $this->input->post('title', true),
            "url" => $this->input->post('url', true),
            "icon" => $this->input->post('icon', true),
            "is_active" => $this->input->post('is_active', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }
    public function deleteSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
    }
}