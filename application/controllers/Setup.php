<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // do something that needed to be checked in every instance of invoking this 
        $this->load->library('Pm_library');
//        $this->pm_library->checkInternetConnection();
//        exit(0);
//        $this->pm_library->checkDbExists();
        
        $this->productIdExists();
    }

    public function view($page = 'home', $data = false) {

        if (!file_exists(APPPATH . 'views/setup/' . $page . '.php')) {
            show_404();
        }

        // Setting notifications
        if ($this->session->has_userdata('success')) {
            $data['success'] = $this->session->userdata('success');

            $this->session->unset_userdata('success');
        }
        if ($this->session->has_userdata('warning')) {
            $data['warning'] = $this->session->userdata('warning');
            $this->session->unset_userdata('warning');
        }
        if ($this->session->has_userdata('error')) {
            $data['error'] = $this->session->userdata('error');
            $this->session->unset_userdata('error');
        }

        if ($page == 'home') {
            $data['mysql_connection'] = $this->checkmysqlconnection();
            if (!empty($data['mysql_connection']['status'])) {
                $data['database'] = json_decode($this->checkDbExists(), true);
                if (!empty($data['database']['status'])) {
                    $result = $this->tableExistCheck("mparishes");
                    if (!$result) {
                        $data['table_error'] = "Database not intialized. Import database to continue.";
                    }
                }
            }
        }
        $this->load->view('setup/' . $page, $data);
    }

    public function checkMysqlConnectionAjax() {
        $result = array();
        $db_config = array('hostname' => $this->input->post('hostname'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        $link = mysqli_connect($db_config['hostname'], $db_config['username'], $db_config['password']);
        if (!$link) {
            $result['status'] = false;
            $result['error_code'] = mysqli_connect_errno();
            switch ($result['error_code']) {
                case 2002:$result['error_message'] = "Could not connect to MySql server. Verify hostname.";
                    break;
                case 1045:$result['error_message'] = "Invalid user credentials. Verify username and password.";
                    break;
                default :$result['error_message'] = mysqli_connect_error();
            }
        } else {
            $result['status'] = true;
        }
        mysqli_close($link);
        echo json_encode($result);
    }

    public function checkMysqlConnection() {
        $result = array();
        $db_config_file = 'system/config/database.json';
        if (file_exists($db_config_file)) {
            $db_config = json_decode(read_file($db_config_file), true);
            $link = mysqli_connect($db_config['hostname'], $db_config['username'], $db_config['password']);
            if (!$link) {
                $result['status'] = false;
                $result['error_code'] = mysqli_connect_errno();
                switch ($result['error_code']) {
                    case 2002:$result['error_message'] = "Could not connect to MySql server. Verify hostname.";
                        break;
                    case 1045:$result['error_message'] = "Invalid user credentials. Verify username and password.";
                        break;
                    default :$result['error_message'] = mysqli_connect_error();
                }
            } else {
                $result['status'] = true;
            }
            mysqli_close($link);
        } else {
            $result['status'] = false;
            $result['error_message'] = "ERR 404 - Database configuration file not found.";
        }
        return $result;
    }

    public function initialize() {
        $mysql_connection = $this->checkMysqlConnection();
        if ($mysql_connection['status']) {
            $database_connection = json_decode($this->checkDbExists(), true);
            if ($database_connection['status']) {
                $result = $this->tableExistCheck("mparishes");
                if ($result) {
                    redirect('activeparishcheck');
                } else {
                    $data['table_error'] = "Database not intialized. Import database to continue.";
                }
            } else {
                $data['database'] = $database_connection;
            }
        }
        $this->view('home', $data);
    }

    public function tableExistCheck($table_name) {
        $result = false;
        $this->load->database();
        $tables = $this->db->list_tables();
        if (in_array($table_name, $tables)) {
            $result = true;
        }
        return $result;
    }

    public function database_config() {
        if ($this->input->post('submit')) {
            $database_config = array(
                "hostname" => $this->input->post('hostname'),
                "username" => $this->input->post('username'),
                "password" => $this->input->post('password'),
                "database" => $this->input->post('databasename'),
            );
            if (write_file('system/config/database.json', json_encode($database_config), 'w+')) {
                $this->session->set_userdata('success', 'Database configuration updation successfull.');
            } else {
                $this->session->set_userdata('error', 'Database configuration updation failed.');
            }
        }
        $data['database'] = json_decode($this->checkDbExists(), true);
        $data['db_config'] = json_decode(read_file('system/config/database.json'), true);
        $this->view('databaseconfigure', $data);
    }

    public function about() {
        $data['application'] = json_decode(read_file('system/config/application.json'), true);
        $this->view('about', $data);
    }

    public function register() {
        $data['registrationdetails'] = json_decode(read_file('system/config/application.json'), true);
        $this->view('register', data);
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

    public function createDb($format = false) {
        $result['status'] = false;
        if ($this->input->post('format')) {
            $format = $this->input->post('format');
        }
        $db_config = json_decode(read_file('system/config/database.json'), true);
        // Connect to MySQL
        $link = mysqli_connect($db_config['hostname'], $db_config['username'], $db_config['password']);
        if (!$link) {
            $result['msg'] = "Could not connect: " . mysql_error();
        } else {
            // Make my_db the current database
            $db_selected = mysqli_select_db($db_config['database'], $link);

            if (!$db_selected) {
                // If we couldn't, then it either doesn't exist, or we can't see it.
                $sql = 'CREATE DATABASE IF NOT EXISTS ' . $db_config['database'];

                if (mysqli_query($link, $sql)) {
                    $result['status'] = true;
                    $result['msg'] = "Database created successfully.";
                } else {
                    $result['mss'] = 'Error creating database: ' . mysql_error();
                }
            }
            mysqli_close($link);
        }
        if ($format === 'JSON') {
            echo json_encode($result);
        } else {
            return json_encode($result);
        }
    }

    public function dropDb($format = false) {
        $result['status'] = false;
        if ($this->input->post('format')) {
            $format = $this->input->post('format');
        }

        $db_config = json_decode(read_file('system/config/database.json'), true);
        // Connect to MySQL
        $link = mysqli_connect($db_config['hostname'], $db_config['username'], $db_config['password']);
        if (!$link) {
            $result['msg'] = "Connection to Mysql Server failed.";
        } else {
            if ($this->input->post('db')) {
                $database = $this->input->post('db');
            } else {
                $database = $db_config['database'];
            }
            // Make my_db the current database
            $db_selected = mysqli_select_db($database, $link);

            if (!$db_selected) {
                // If we couldn't, then it either doesn't exist, or we can't see it.
                $sql = 'DROP DATABASE ' . $database;

                if (mysqli_query($link, $sql)) {
                    $result['status'] = true;
                    $result['msg'] = "Database dropped successfully.";
                } else {
                    $result['msg'] = "Error droping database: " . mysql_error();
                }
            }
        }
        mysqli_close($link);
        if ($format === 'JSON') {
            echo json_encode($result);
        } else {
            return json_encode($result);
        }
    }

    public function importDb() {

        $data = [];
        if ($this->input->post('submit')) {
            $database_exist = json_decode($this->checkDbExists(), true);
            if ($database_exist['status']) {
                $upload_dir = 'uploads/database/';
                if (!is_dir($upload_dir)) {
                    mkdir('./' . $upload_dir, 0777, TRUE);
                }
                $config['upload_path'] = './' . $upload_dir;
                $config['allowed_types'] = 'gz';
                $config['max_size'] = 10240;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $this->session->set_userdata('error', $this->upload->display_errors());
                } else {
                    $uploaded_file = $this->upload->data();
                    $result = $this->importDbFromFile('./' . $upload_dir . $uploaded_file['file_name']);
                    if ($result) {
                        $this->session->set_userdata('success', "Database imported successfully.");
                    } else {
                        $this->session->set_userdata('error', "Database couldnot be imported.");
                    }
                }
            } else {
                $this->session->set_userdata('error', "Database doesnot exist.");
            }
        }
        $this->view('backupandrestore');
    }

    public function generateProductId() {
        $sys_details = php_uname();
        $md5 = strtoupper(md5($sys_details));

        $code[] = substr($md5, 0, 5);
        $code[] = substr($md5, 5, 5);
        $code[] = substr($md5, 10, 5);
        $code[] = substr($md5, 15, 5);

        $membcode = implode("-", $code);
        if (strlen($membcode) == "23") {
            return($membcode);
        } else {
            return false;
        }
    }

    public function productIdExists() {
        $app_data = json_decode(read_file('system/config/application.json'), true);
        if (!array_key_exists("product Id", $app_data)) {
            $product_id = $this->generateProductId();
            $app_data['product Id'] = $product_id;
            if (write_file('system/config/application.json', json_encode($app_data), 'w+')) {
                $this->session->set_userdata('success', 'Product Id created successfully.');
            } else {
                $this->session->set_userdata('error', 'Product id creation failed.');
            }
        }
    }

    public function saveToFile() {
        $this->load->model('pm_model');
        $data = $this->pm_model->getData('mupdater');
        if (write_file('system/config/updater.json', json_encode($data), 'w+')) {
            $this->session->set_userdata('success', 'Product Id created successfully.');
            redirect('setup/home');
        } else {
            $this->session->set_userdata('error', 'Product id creation failed.');
        }
    }

    public function getUpdations() {
        $db_config = json_decode(read_file('system/config/updater.json'), true);
        var_dump($db_config);
    }

    public function backup() {
        $this->load->model('pm_model');
        $this->load->dbutil();

        $app_details = json_decode(read_file('system/config/application.json'), true);

        $prefs = array(
            'ignore' => array('mupdater'));

        $backup = $this->dbutil->backup($prefs);

        $db_name = $app_details['product Id'] . 'backup-on-' . date("Y-m-d-H-i-s") . '.gz';


        $this->load->helper('file');

        $upload_dir = "backup/database/".date("Y-m-d")."/";
        if (!is_dir($upload_dir)) {
            mkdir('./' . $upload_dir, 0777, TRUE);
        }
        write_file($upload_dir . $db_name, $backup, 'w+');

        $this->load->helper('download');
        if (force_download($db_name, $backup)) {
            $this->session->set_userdata('success', "Backup downloaded successfully.");
        } else {
            $this->session->set_userdata('error', "Backup download failed");
        }
    }

    public function importDbFromFile($path) {
        $gz = gzopen($path, 'rb');
        if (!$gz) {
            $result['msg'] = "Could not open gzip file.";
        }

        $temp_file = 'uploads/database/temp_db_import_file';
        $dest = fopen('./' . $temp_file, 'wb');
        if (!$dest) {
            gzclose($gz);
            $result['msg'] = "Could not open destination file.";
        }

        // transfer ...
        stream_copy_to_stream($gz, $dest);

        gzclose($gz);
        fclose($dest);

        $this->load->model('pm_model');
        $result = $this->pm_model->import_database($temp_file);

        if ($result) {
            unlink($path);
            unlink('./' . $temp_file);
        }

        return $result;
    }

}
