<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();


        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function manageuser()
    {
        $data['title'] = 'User Management';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();


        // ambil data keyword (helper)
        $data['keyword'] = check_keyword();

        // search config
        $this->db->like('name', $data['keyword']);
        $this->db->or_like('email', $data['keyword']);
        $this->db->from('user');
        $data['total_rows'] =  $this->db->count_all_results();

        // pagination config
        $url = 'admin/manageuser';
        $perPage = 5;
        $data['start'] = paginationStart($perPage, $data['total_rows'], 'user', $url);

        $this->load->model('User_model', 'userdata');
        $data['allUser'] = $this->userdata->getUser($perPage, $data['start'], $data['keyword']);
        $data['allRole'] = $this->db->get('user_role')->result_array();
        $data['url'] = getUrl();

        // rules form
        if ($this->input->post('is_active')) {
            $this->form_validation->set_rules('name', 'name', 'required|trim|is_unique[user.name]');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('role_id', 'role', 'required');
            $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[6]|matches[password2]', [
                'matches' => 'Password dont match!',
                'min_length' => 'Password too short!'
            ]);
            $this->form_validation->set_rules('password2', 'repeat password', 'required|trim|matches[password1]');
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/manageuser', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_image = $_FILES['user_img']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|webp';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('user_img')) {
                    $new_image = $this->upload->data('file_name');
                    $data = [
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'image' => $new_image,
                        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                        'role_id' => $this->input->post('role_id'),
                        'is_active' => $this->input->post('is_active'),
                        'date_created' => time()
                    ];
                    $this->db->insert('user', $data);
                    $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
                           New User added!</div>', 4);
                    redirect('admin/manageuser');
                } else {
                    $this->session->set_tempdata('message', '<div class="alert alert-danger" role="alert">' .
                        $this->upload->display_errors() . '</div>', 4);
                    redirect('admin/manageuser');
                }
            } else {
                $data = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'image' => 'default.jpg',
                    'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'role_id' => $this->input->post('role_id'),
                    'is_active' => $this->input->post('is_active')
                ];
                $this->db->insert('user', $data);
                $this->session->set_tempdata('message', '<div class="alert alert-danger" role="alert">
                   New user added! (Default Profile Image)</div>', 4);
                redirect('admin/manageuser');
            }
        }
    }

    public function editUser($id)
    {
        $data['title'] = 'Edit Course';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        $this->load->model('User_model', 'userdata');
        $data['userData'] = $this->userdata->getUserById($id);
        $data['allRole'] = $this->db->get('user_role')->result_array();
        $role_id = $data['userData']['role_id'];
        $data['currentRole'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        // validasi form
        $this->form_validation->set_rules('name', 'user name', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('password1', 'password', 'trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'repeat password', 'trim|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edituser', $data);
            $this->load->view('templates/footer');
        } else {

            // data dr form
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $role = $this->input->post('role_id');
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            // cek jika ada gambar yg akan di upload
            $upload_image = $_FILES['user_img']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('user_img')) {
                    $old_image = $data['userData']['image'];

                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('name', $name);
            $this->db->set('email', $email);
            $this->db->set('email', $email);
            $this->db->set('role_id', $role);
            if ($password) {
                $this->db->set('password', $password);
            }

            $this->db->where('id', $id);
            $this->db->update('user');

            $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
            User has been updated!   </div>', 4);
            redirect('admin/manageuser');
        }
    }

    public function deleteUser($id)
    {
        $this->load->model('User_model', 'user');
        $data['userData'] = $this->user->getUserById($id);
        $old_image = $data['user']['image'];
        if ($old_image != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
        }
        $this->user->deleteById('user', $id);



        $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
                   User delete successfully</div>', 4);
        redirect('admin/manageuser');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'menu_id' => $menu_id,
            'role_id' => $role_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
            Access Changed!   </div>', 4);
    }

    public function course()
    {
        $data['title'] = 'Course Management';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        // ambil data keyword (helper)
        $data['keyword'] = check_keyword();

        // search config
        $this->db->like('course_title', $data['keyword']);
        $this->db->from('courses');
        $data['total_rows'] =  $this->db->count_all_results();

        // pagination config
        $url = 'admin/course';
        $perPage = 5;
        $data['start'] = paginationStart($perPage, $data['total_rows'], 'courses', $url);

        $this->load->model('Courses_model', 'courses');
        $data['courses'] = $this->courses->getCourses($perPage, $data['start'], $data['keyword']);
        $data['url'] = getUrl();

        // rules form
        if ($this->input->post('is_active')) {
            $this->form_validation->set_rules('course_title', 'course_title', 'required|trim|is_unique[courses.course_title]');
            $this->form_validation->set_rules('description', 'description', 'required');
        }

        // add menu
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/course', $data);
            $this->load->view('templates/footer');
        } else {
            // cek jika ada gambar yg akan di upload
            $upload_image = $_FILES['url_img']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|webp';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/thumbnail/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('url_img')) {
                    $new_image = $this->upload->data('file_name');
                    $data = [
                        'course_title' => $this->input->post('course_title'),
                        'url_img' => $new_image,
                        'description' => $this->input->post('description'),
                        'is_active' => $this->input->post('is_active')
                    ];
                    $this->db->insert('courses', $data);
                    $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
                           New Course added!</div>', 4);
                    redirect('admin/course');
                } else {
                    $this->session->set_tempdata('message', '<div class="alert alert-danger" role="alert">' .
                        $this->upload->display_errors() . '</div>', 4);
                    redirect('admin/course');
                }
            } else {
                $this->session->set_tempdata('message', '<div class="alert alert-danger" role="alert">
                   No file uploaded!</div>', 4);
                redirect('admin/course');
            }
        }
    }

    public function editCourse($id)
    {
        $data['title'] = 'Edit Course';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        // kirim data course ke view
        $this->load->model('Courses_model', 'Courses');
        $data['course'] = $this->Courses->getCourseById($id);

        // validasi form
        $this->form_validation->set_rules('course_title', 'course name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editcourse', $data);
            $this->load->view('templates/footer');
        } else {

            // data dr form
            $id = $this->input->post('id');
            $course_title = $this->input->post('course_title');
            $description = $this->input->post('description');
            // cek jika ada gambar yg akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/thumbnail/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['course']['url_img'];


                    unlink(FCPATH . 'assets/img/thumbnail/' . $old_image);

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('url_img', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('description', $description);
            $this->db->set('course_title', $course_title);

            $this->db->where('id', $id);
            $this->db->update('courses');

            $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
            Course has been updated!   </div>', 4);
            redirect('admin/course');
        }
    }

    public function deleteCourse($id)
    {
        $this->load->model('Courses_model', 'Courses');
        $data['course'] = $this->Courses->getCourseById($id);
        $old_image = $data['course']['url_img'];
        unlink(FCPATH . 'assets/img/thumbnail/' . $old_image);
        $this->Courses->deleteById('courses', $id);



        $this->session->set_tempdata('messageMenu', '<div class="alert alert-success" role="alert">
                   Course delete successfully</div>', 4);
        redirect('admin/course');
    }

    public function module()
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
        $perPage = 5;
        $data['start'] = paginationStart($perPage, $data['total_rows'], 'modules', $url);


        // panggil model
        $this->load->model('Courses_model', 'courses');
        $data['courses'] = $this->courses->getAllCourses();
        $data['modules'] = $this->courses->getModules($perPage, $data['start'], $data['keyword']);
        $data['url'] = getUrl();

        // rules form
        if ($this->input->post('is_active')) {

            $this->form_validation->set_rules('module_title', 'module title', 'required|is_unique[modules.module_title]');
            $this->form_validation->set_rules('courses_id', 'select courses', 'required');
        }

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/module', $data);
            $this->load->view('templates/footer');
        } else {
            // cek jika ada gambar yg akan di upload
            $upload_video = $_FILES['url_video']['name'];

            if ($upload_video) {

                $config['allowed_types'] = 'mp4';
                $config['max_size']     = '0';
                $config['upload_path'] = './assets/vid_modules/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('url_video')) {

                    $new_video = $this->upload->data('file_name');
                    $data = [
                        'courses_id' => $this->input->post('courses_id'),
                        'module_title' => $this->input->post('module_title'),
                        'url_video' => $new_video,
                        'is_active' => $this->input->post('is_active')
                    ];
                    $this->db->insert('modules', $data);
                    $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
                   New modules added!</div>', 4);
                    redirect('admin/module');
                } else {
                    $this->session->set_tempdata('message', '<div class="alert alert-danger" role="alert">' .
                        $this->upload->display_errors() . '</div>', 4);
                    redirect('admin/module');
                }
            } else {
                $this->session->set_tempdata('message', '<div class="alert alert-danger" role="alert">
                   No file uploaded!</div>', 4);
                redirect('admin/module');
            }
        }
    }


    public function editModule($id)
    {
        $data['title'] = 'Edit Module';
        $data['user'] = $this->db->get_where('user', ['name' => $this->session->userdata('name')])->row_array();

        // kirim data course ke view
        $this->load->model('Courses_model', 'Courses');
        $data['module'] = $this->Courses->getModuleById($id);
        $data['courses'] = $this->Courses->getAllCourses();

        // validasi form
        $this->form_validation->set_rules('module_title', 'module name', 'required|trim');
        $this->form_validation->set_rules('courses_id', 'module name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editmodule', $data);
            $this->load->view('templates/footer');
        } else {

            // cek jika ada gambar yg akan di upload
            $upload_video = $_FILES['url_video']['name'];
            if ($upload_video) {
                $config['allowed_types'] = 'mp4';
                $config['max_size']     = '0';
                $config['upload_path'] = './assets/vid_modules/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('url_video')) {
                    $old_video = $data['module']['url_video'];
                    $new_video = $this->upload->data('file_name');

                    if (!$new_video == $old_video) {
                        unlink(FCPATH . 'assets/vid_modules/' . $old_video);
                    }

                    $this->db->set('url_video', $new_video);
                } else {
                    $this->session->set_tempdata('message', '<div class="alert alert-danger" role="alert">' .
                        $this->upload->display_errors() . '</div>', 4);
                    redirect('admin/module');
                }
            }

            $this->load->model('Courses_model', 'courses');
            $this->courses->editModule();

            $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
            New module has been updated!   </div>', 4);
            redirect('admin/module');
        }
    }

    public function deleteModule($id)
    {
        $this->load->model('Courses_model', 'Courses');
        $data['module'] = $this->Courses->getModuleById($id);
        $old_video = $data['module']['url_video'];
        unlink(FCPATH . 'assets/vid_modules/' . $old_video);

        $this->Courses->deleteById('modules', $id);

        $this->session->set_tempdata('messageMenu', '<div class="alert alert-success" role="alert">
                   Module delete successfully</div>', 4);
        redirect('admin/module');
    }

    public function checkActive()
    {
        $active = $this->input->post('active');
        $dataId = $this->input->post('dataId');
        $table = $this->input->post('table');
        $url = $this->input->post('url');

        if ($active == '1') {
            $this->db->set('is_active', 0);

            $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
            ' . ucfirst($table) . ' Deactivated!   </div>', 4);
        } else {
            $this->db->set('is_active', 1);

            $this->session->set_tempdata('message', '<div class="alert alert-success" role="alert">
            ' . ucfirst($table) . ' Activated!   </div>', 4);
        }
        $this->db->where('id', $dataId);
        $this->db->update($table);
    }
}