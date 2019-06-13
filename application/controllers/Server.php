<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {
    /* ------------------ Start internet check ------------------ */

    public function checkInternetConnection($website = 'www.diocese-manager.esy.es', $port = '80') {
        if ($port) {
            $internetconnected = @fsockopen($website, $port);
        } else {
            $internetconnected = @fsockopen($website);
        }

        //website, port  (try 80 or 443)
        if ($internetconnected) {
            $is_conn = true; //action when connected
            fclose($internetconnected);
        } else {
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }

    /* ------------------ end internet check ------------------ */

    /* ------------------ Start get settings ------------------ */

    public function getSettings($where = false) {
        $settings = $this->pm_model->getRowData('msettings', $where);
        return $settings;
    }

    /* ------------------ end get settings ------------------ */

    public function sync() {
        $response = array();
        $tables = $this->pm_model->getData('ttables', array('sync' => 1, 'status' => 1), array('column' => 'priority', 'order' => 'ASC'));
        if (isset($tables)) {
            $updated_tables = array();
            foreach ($tables as $table) {
                $sync_data['table'] = $table->name;
                $sync_data['primary_key'] = $table->primary_key;
                $fields = $this->pm_model->getFields($table->name);
                $field_array = array();
                foreach ($fields as $field) {
                    if ($field->name == 'id' || $field->name == 'sync_flag') {
                        continue;
                    } else {
                        array_push($field_array, $field->name);
                    }
                }
                $sync_data['fields'] = $field_array;
                $sync_data['data'] = $this->pm_model->getDataForSync($sync_data['table'], implode(',', $field_array));

                $url = 'http://diocese-manager.esy.es/sync/sync';

                $ch = curl_init($url);

                $payload = json_encode($sync_data);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $result = curl_exec($ch);
                $server_response = json_decode($result);
                if (!empty($server_response->updated_rows)) {
                    $updated_rows = $server_response->updated_rows;
                    if (!empty($updated_rows)) {
                        foreach ($updated_rows as $updated_row) {
                            $this->pm_model->setDataAfterSync($sync_data['table'], array($sync_data['primary_key'] => $updated_row), array('sync_flag' => 0));
                        }
                    }
                    if (count($updated_rows) == count($sync_data['data'])) {
                        if ($this->pm_model->setDataAfterSync('ttables', array('name' => $sync_data['table']), array('sync' => 0))) {
                            array_push($updated_tables, $table->id);
                        }
                    }
                    curl_close($ch);
                } else if (!empty($server_response->error)) {
                    $response['error'] = $server_response->error;
                }
            }
            if (count($updated_tables) == count($tables)) {
                $response['success'] = 'Data syncronization successfull.';
            } else {
                $response['warning'] = 'Data syncronization completed with errors.';
            }
        } else {
            $response['success'] = 'Server data is uptodate.';
        }
        echo json_encode($response);
    }

//    public function updateapplication() {
//        $response = false;
//        $appsettings = $this->getSettings(array('name' => 'defaultserver'));
//        $is_connected = $this->checkInternetConnection($appsettings['value2']);
//        if ($is_connected) {
//            $url = $appsettings['value1'] . 'update/getapplicationupdates';
//            $result = file_get_contents($url);
//            $server_file_datas = json_decode($result, true);
//            if (isset($server_file_datas)) {
//                foreach ($server_file_datas as $server_file_data) {
//                    $file_exist = $this->pm_model->getRowData('mupdater', array('filename' => $server_file_data['filename'], 'path' => $server_file_data['path'], 'status' => $server_file_data['status']));
//                    if (!empty($file_exist)) {
//                        if ($server_file_data['updated_at'] > $file_exist['updated_at']) {
//                            $tablerowfromserverurl = $appsettings['value1'] . "update/getupdaterow?id=" . $server_file_data['id'];
//                            $tablerowfromserverjson = file_get_contents($tablerowfromserverurl);
//                            $tablerowfromserver = json_decode($tablerowfromserverjson, true);
//                            if (isset($tablerowfromserver)) {
//                                $update_data = array(
//                                    'filename' => $tablerowfromserver['filename'],
//                                    'content' => $tablerowfromserver['content'],
//                                    'version' => $tablerowfromserver['version'],
//                                    'path' => $tablerowfromserver['path'],
//                                    'created_at' => $tablerowfromserver['created_at'],
//                                    'updated_at' => $tablerowfromserver['updated_at'],
//                                    'deleted_at' => $tablerowfromserver['deleted_at'],
//                                    'update_flag' => 1,
//                                    'status' => $tablerowfromserver['status']
//                                );
//                                $result = $this->pm_model->setData('mupdater', array('id' => $tablerowfromserver['id']), $update_data);
//                            }
//                        }
//                    } else {
//                        $tablerowfromserverurl = $appsettings['value1'] . "update/getupdaterow?id=" . $server_file_data['id'];
//                        $tablerowfromserverjson = file_get_contents($tablerowfromserverurl);
//                        $tablerowfromserver = json_decode($tablerowfromserverjson, true);
//                        if (isset($tablerowfromserver)) {
//                            $update_data = array(
//                                'filename' => $tablerowfromserver['filename'],
//                                'content' => $tablerowfromserver['content'],
//                                'version' => $tablerowfromserver['version'],
//                                'path' => $tablerowfromserver['path'],
//                                'created_at' => $tablerowfromserver['created_at'],
//                                'updated_at' => $tablerowfromserver['updated_at'],
//                                'deleted_at' => $tablerowfromserver['deleted_at'],
//                                'update_flag' => 1,
//                                'status' => $tablerowfromserver['status']
//                            );
//                            $result = $this->pm_model->putData('mupdater', $update_data);
//                        }
//                    }
//                    $response .= $result;
//                }
//            }
//        }
//        echo json_encode($response);
//    }

    public function updateapplication() {
        $response['status'] = true;
        $appsettings = $this->getSettings(array('name' => 'defaultserver'));
        $is_connected = $this->checkInternetConnection($appsettings['value2']);
        if ($is_connected) {

            $url = $appsettings['value1'] . 'update/getapplicationupdates';
            $sync_data = [];
            $ch = curl_init($url);
            $payload = json_encode($sync_data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $serverfiledatasjson = curl_exec($ch);
            $server_file_datas = json_decode($serverfiledatasjson);
            if (isset($server_file_datas)) {
                foreach ($server_file_datas as $server_file_data) {
                    $result = true;
                    $tablerowfromserverurl = $appsettings['value1'] . "update/getupdaterow?id=" . $server_file_data->id;
                    $ch = curl_init($tablerowfromserverurl);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array()));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $file_exist = $this->pm_model->getRowData('mupdater', array('filename' => $server_file_data->filename, 'path' => $server_file_data->path, 'status' => $server_file_data->status));
                    if (!empty($file_exist)) {
                        if ($server_file_data->updated_at > $file_exist['updated_at']) {
                            $serverrowdatajson = curl_exec($ch);
                            $tablerowfromserver = json_decode($serverrowdatajson);

                            if (!empty($tablerowfromserver)) {
                                $update_data = array(
                                    'filename' => $tablerowfromserver->filename,
                                    'content' => $tablerowfromserver->content,
                                    'version' => $tablerowfromserver->version,
                                    'path' => $tablerowfromserver->path,
                                    'created_at' => $tablerowfromserver->created_at,
                                    'updated_at' => $tablerowfromserver->updated_at,
                                    'deleted_at' => $tablerowfromserver->deleted_at,
                                    'update_flag' => 1,
                                    'status' => $tablerowfromserver->status
                                );
                                $result = $this->pm_model->setData('mupdater', array('id' => $tablerowfromserver->id), $update_data);
                            }
                        }
                    } else {
                        $serverrowdatajson = curl_exec($ch);
                        $tablerowfromserver = json_decode($serverrowdatajson);
                        if (isset($tablerowfromserver)) {
                            $update_data = array(
                                'filename' => $tablerowfromserver->filename,
                                'content' => $tablerowfromserver->content,
                                'version' => $tablerowfromserver->version,
                                'path' => $tablerowfromserver->path,
                                'created_at' => $tablerowfromserver->created_at,
                                'updated_at' => $tablerowfromserver->updated_at,
                                'deleted_at' => $tablerowfromserver->deleted_at,
                                'update_flag' => 1,
                                'status' => $tablerowfromserver->status
                            );
                            $result = $this->pm_model->putData('mupdater', $update_data);
                        }
                    }
                    $response['status'] *= $result;
                }
            }
        }
        return json_encode($response);
    }

    public function updatedatabase() {
        $response['status'] = true;
        $appsettings = $this->getSettings(array('name' => 'defaultserver'));
        $is_connected = $this->checkInternetConnection($appsettings['value2']);
        if ($is_connected) {

            $servertabledetailsurl = $appsettings['value1'] . "update/gettabledetails";
            $ch = curl_init($servertabledetailsurl);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array()));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $servertabledetailsjson = curl_exec($ch);
            $server_table_data = json_decode($servertabledetailsjson);

            if (isset($server_table_data)) {
                foreach ($server_table_data as $server_table) {
                    $result = true;
                    $table_exist = $this->pm_model->getRowData('mtables', array('name' => $server_table->name));
                    if (!empty($table_exist)) {
                        if ($table_exist['version'] < $server_table->version) {

                            $tabledatafromserverurl = $appsettings['value1'] . "update/gettabledata?table=" . $server_table->name;
                            $ch = curl_init($tabledatafromserverurl);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array()));
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $tabledatafromserverjson = curl_exec($ch);
                            $tabledatafromserver = json_decode($tabledatafromserverjson);
                            if (isset($tabledatafromserver)) {
                                $table = $server_table->name;
                                if ($this->db->table_exists($table)) {
                                    $fields = $tabledatafromserver->fields;
                                    $primary_key = $server_table->primary_key;
                                    $update_datas = $tabledatafromserver->data;
                                    if (isset($update_datas)) {
                                        foreach ($update_datas as $update_data) {
                                            $exist = $this->pm_model->getRowData($table, array($primary_key => $update_data->$primary_key));
                                            $row_data = array();
                                            foreach ($fields as $field) {
                                                $row_data[$field] = $update_data->$field;
                                            }
                                            if (!empty($exist)) {
                                                $result = $this->pm_model->setData($table, array($primary_key => $update_data->$primary_key), $row_data);
                                            } else {
                                                $result = $this->pm_model->putData($table, $row_data);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $result = $this->pm_model->putData('mtables', $server_table);
                    }
                    $response['status'] *= $result;
                }
            }
        }
        return json_encode($response);
    }

    public function checkforupdate($mode = 'JSON') {
        $response['status'] = false;
        $local_abouts = $this->pm_model->getData('mabouts', array('status' => 1));
        foreach ($local_abouts as $local_about) {
            if ($local_about->property === "dbversion") {
                $local_dbversion = $local_about;
            }
            if ($local_about->property === "appversion") {
                $local_appversion = $local_about;
            }
        }
        $appsettings = $this->getSettings(array('name' => 'defaultserver'));
        $is_connected = $this->checkInternetConnection($appsettings['value2']);
        if ($is_connected) {
            $url = $appsettings['value1'] . "update/getabout";
            $result = file_get_contents($url);
            $server_abouts = json_decode($result, TRUE);
            foreach ($server_abouts as $server_about) {
                if ($server_about['property'] === "dbversion") {
                    $server_dbversion = $server_about;
                    $response['dbversion'] = $server_about['data'];
                }
                if ($server_about['property'] === "appversion") {
                    $server_appversion = $server_about;
                    $response['appversion'] = $server_about['data'];
                }
            }
            if ($server_appversion['data'] > $local_appversion->data) {
                $response['status'] = TRUE;
                $response['update_for_app'] = true;
            }
            if ($server_dbversion['data'] > $local_dbversion->data) {
                $response['status'] = TRUE;
                $response['update_for_db'] = true;
            }
            if (!$response['status']) {
                $response['msg'] = "Application is up-to-date.";
            }
        } else {
            $response['error'] = "Failed to connect to server.";
        }
        if ($mode === 'JSON') {
            echo json_encode($response);
        } else {
            return $response;
        }
    }

    public function update() {
        $response['status'] = TRUE;
        $update = $this->checkforupdate('return');
        if ($update['status'] == true) {
            if (!empty($update['update_for_app'])) {
                if ($update['update_for_app']) {
                    $app_downloaded = $this->updateapplication();
                }
            }
            if (!empty($update['update_for_db'])) {
                if ($update['update_for_db']) {
                    $db_downloaded = $this->updatedatabase();
                }
            }
            if (!empty($app_downloaded)) {
                if ($app_downloaded) {
                    $response['app_updated'] = true;
                }
            }
            if (isset($app_downloaded) || $db_downloaded) {
                $response['success'] = 'Updation Successfull.';
                $response['status'] = true;
            } else {
                $response['status'] = false;
            }
        } else {
            $response['success'] = $update['msg'];
        }
        echo json_encode($response);
    }

    public function installupdate() {
        $response['status'] = false;
        $output_result = true;
        $files = $this->pm_model->getData('mupdater', array('update_flag' => 1));
        if (!empty($files)) {
            foreach ($files as $file) {
                if (!is_dir($file->path)) {
                    mkdir($file->path, 0777, TRUE);
                }
                var_dump(get_file_info($file->path . $file->filename));
                $result = write_file($file->path . $file->filename, html_entity_decode($file->content));
                if ($result) {
                    $this->pm_model->setData('mupdater', array('filename' => $file->filename, 'path' => $file->path), array('update_flag' => 0));
                }
                $output_result *= $result;
            }
        }
        $response['status'] = $output_result;
        echo json_encode($response);
    }

}
