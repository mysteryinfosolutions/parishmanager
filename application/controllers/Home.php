<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $db = json_decode($this->checkDbExists(),true);
        if (isset($db)) {
            if (empty($db['status'])) {
                redirect('setup/home');
            }
        }
        $this->load->model('pm_model');
    }

    public function checkDbExists($format = false) {
        $this->load->database();
        $this->load->dbutil();
        $result['status'] = false;
        if ($this->dbutil->database_exists('parishmanagerfinal')) {
            $result['status'] = true;
            $result['msg'] = "Database exists.";
        } else {
            $result['msg'] = "Database doesnot exist.";
        }
        if ($format === 'JSON') {
            echo json_encode($result);
        } else {
            return json_encode($result);
        }
    }

    public function view($page = 'home', $data = false) {
        if (!file_exists(APPPATH . 'views/home/' . $page . '.php')) {
            show_404();
        }

//        if ($page != 'activateparish') {
//            $this->activeparishcheck();
//        }

        $this->load->view('home/' . $page, $data);
    }

    /* ------------------ Start initialization ------------------ */

    public function activeparishcheck() {
//        echo 'hai';
//        exit(0);
        $result = $this->pm_model->getData('mparishes', array('activeparish' => 1, 'status' => 1));
        if (empty($result)) {
            //redirect to create parish login page
            redirect('activateparish');
        } else {
            redirect('login');
        }
    }

    public function activateparish() {
        $data = [];
        if ($this->input->post('submit')) {
            $parish_id = $this->myencrypt->decrypt_url($this->input->post('parish'));
            $key = $this->input->post('key');
            if ($key === strtoupper(substr($this->myencrypt->encrypt_url($parish_id), 4, 25))) {
                $login_data = array(
                    'name' => 'Parish',
                    'username' => $this->input->post('username'),
                    'password' => $this->encryption->encrypt($this->input->post('password')),
                    'target_id' => $parish_id,
                    'mrole_id' => '4',
                    'maccessright_id' => '1'
                );
                $admin_login = array(
                    'name' => 'Admin',
                    'username' => 'admin' . $parish_id,
                    'password' => $this->encryption->encrypt('letmein' . $parish_id),
                    'target_id' => $parish_id,
                    'mrole_id' => '1',
                    'maccessright_id' => '1'
                );
                $insert_admin_login = $this->pm_model->addLogin($admin_login);
                if ($insert_admin_login) {
                    $insert_login = $this->pm_model->addLogin($login_data);
                    if ($insert_login) {
//                        $insert_parish_index = $this->pm_model->putData('mparishindex', array('mparish_id' => $parish_id));
//                        if ($insert_parish_index) {
//                            $insert_register_index = $this->pm_model->putData('mregisterindex', array('mparish_id' => $parish_id));
//                            if ($insert_register_index) {
//                                $insert_account_index = $this->pm_model->putData('maccountindex', array('mparish_id' => $parish_id));
//                                if ($insert_account_index) {
                        $update_activeparish = $this->pm_model->setData('mparishes', array('mparish_id' => $parish_id, 'status' => 1), array('activeparish' => 1));
                        if ($update_activeparish) {
                            redirect();
                        } else {
                            $data['error_message'] = 'Parish activation failed.';
                        }
//                                } else {
//                                    $data['error_message'] = 'Account index insertion failed.';
//                                }
//                            } else {
//                                $data['error_message'] = 'Register index insertion failed.';
//                            }
//                        } else {
//                            $data['error_message'] = "Index initialization failed.";
//                        }
                    } else {
                        $data['error_message'] = "Login insertion failed.";
                    }
                } else {
                    $data['error_message'] = 'Admin login insertion failed.';
                }
            } else {
                $data['error_message'] = "Invalid Product key.";
            }
        }
        $data['parishes'] = $this->pm_model->getData('mparishes', array('activeparish' => 0, 'status' => 1));
        $this->view('activateparish', $data);
    }

    /* ------------------ Start initialization ------------------ */

    /* ------------------ Start authentication ------------------ */

    // Login user
    public function login() {
        $data = [];

        if ($this->input->post('submit')) {
            $user_data = array(
                'username' => $this->input->post('username')
            );
            $selected_user = $this->pm_model->loginCheck($user_data);
            if ($selected_user) {
                if ($this->encryption->decrypt($selected_user['password']) === $this->input->post('password')) {
                    if ($selected_user['status'] === '1') {
                        $user = $selected_user;
                        $user['lastlogin'] = $this->pm_model->getLastLogin(array('mlogin_id' => $selected_user['mlogin_id']), true);
                        $this->pm_model->putData('tlogins', array('mlogin_id' => $selected_user['mlogin_id']));
                        $this->session->set_userdata("user", $user);
                        $usertheme = $this->pm_model->getRowData('mthemes', array('id' => $user['mtheme_id'], 'status' => 1));
                        $this->session->set_userdata("usertheme", $usertheme['name']);
                        $this->session->set_userdata("themes", $this->pm_model->getData('mthemes', array('status' => 1)));
                        $this->session->set_userdata("show_loader", "1");
                        if ($selected_user['role_name'] === 'Parish') {
                            $parish = $this->pm_model->getParishDetails(array('mparish_id' => $selected_user['target_id']));
                            $this->session->set_userdata("parish", $parish);
                        }
                        redirect($selected_user['target_page']);
                    } else {
                        $data['error_message'] = "Account suspended. Please contact admin.";
                    }
                } else {
                    $data['error_message'] = "Invalid password.";
                }
            } else {
                $data['error_message'] = "Invalid username.";
            }
        }
        $this->view('login', $data);
    }

    // Logout user
    public function logout() {
        $data['warning_message'] = false;
        if ($this->session->has_userdata('warning_message')) {
            $data['warning_message'] = $this->session->userdata('warning_message');
        }
        $this->session->sess_destroy();
        $this->load->view('home/logout', $data);
    }

    /* ------------------ End authentication ------------------ */
}
