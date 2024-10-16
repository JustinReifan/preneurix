<?php

defined('BASEPATH') or exit('No direct script access allowed');

class General_model extends CI_Model
{
    public function countData($table)
    {
        return $this->db->get($table)->num_rows();
    }
}
