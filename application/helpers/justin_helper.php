<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('name')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');
    if ($result->num_rows() > 0) {
        return "checked = 'checked'";
    }
}

function check_active($id, $table)
{
    $ci = get_instance();
    $ci->db->where('id', $id);
    $result = $ci->db->get($table)->row_array();
    if ($result['is_active'] == 1) {
        return "checked = 'checked'";
    }
}

function paginationStart($perPage, $total_rows, $table, $url)
{
    $ci = get_instance();

    $ci->load->model('General_model', 'general');
    $ci->load->library('pagination');
    // pagination config

    $config['base_url'] = base_url($url);
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $perPage;
    $config['total_rows'] =  $total_rows;

    $totalRows = $config['total_rows'];

    if (ceil($totalRows / $perPage) > 5) {
        $config['last_link']    =   '.... ' . $ci->general->countData($table);
        $config['first_link'] = '1 ....';
    } else {
        $config['last_link']    =   $ci->general->countData($table);
        $config['first_link'] = '1';
    }

    // initialize pagination
    $ci->pagination->initialize($config);

    // cek pagination
    if ($ci->uri->segment(3)) {
        return  $ci->uri->segment(3);
    } else {
        return  0;
    }
}

function check_keyword()
{
    $ci = get_instance();

    if ($ci->input->post('keywordBtn')) {
        $keyword = htmlspecialchars($ci->input->post('keyword'));
        $ci->session->set_userdata('keyword', $keyword);
        return $keyword;
    } else if ($ci->input->post('reset')) {
        $ci->session->unset_userdata('keyword');
        return "";
    } else {
        if ($ci->session->userdata('keyword')) {
            return $ci->session->userdata('keyword');
        } else {
            $ci->session->unset_userdata('keyword');
            return "";
        }
    }
}

function getUrl()
{
    $ci = get_instance();
    $controller = $ci->router->fetch_class();
    $method = $ci->router->fetch_method();
    if ($method) {
        return $controller . '/' . $method;
    } else {
        return $controller;
    }
}