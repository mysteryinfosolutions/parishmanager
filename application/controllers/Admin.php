<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    var $parish_id = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function view($page = 'dashboard', $data = []) {
        if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
            show_404();
        }

        // Disabling loader after login
        if ($this->session->has_userdata('show_loader')) {
            $data['show_loader'] = $this->session->userdata('show_loader');
            $this->session->unset_userdata('show_loader');
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

        // Reading user data
        $data['user'] = $this->session->userdata("user");
        $data['usertheme'] = $this->session->userdata('usertheme');
        $data['parishdetails'] = $this->session->userdata("parish");
        $data['base_url'] = base_url() . strtolower($data['user']['role_name']) . "/";
        if (!isset($data['title'])) {
            $data['title'] = ucfirst($page);
        }

//        $data['sync']= $this->admin_model->getSyncStatus();

        if ($data['title'] === "Dashboard") {
            $dashboard_data = $this->admin_model->getDashboardData($data['parishdetails']['mparish_id']);
            $data['dashboard_data'] = $dashboard_data;
        }

        $data['themes'] = $this->session->userdata("themes");
        $this->load->view('admin/header', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('admin/footer', $data);
    }

    /* ------------------ End view page ------------------ */

    /* ------------------ Start scc ------------------ */

    public function profile() {
        if ($this->input->get('parish_id') && $this->input->get('view-profile')) {
            $mparish_id = $this->myencrypt->decrypt_url($this->input->get('parish_id'));
            $data['profile_data'] = $this->admin_model->getProfile($mparish_id);
            $this->view('profile', $data);
        }
    }

    public function managelogin() {
        $data = [];
        if ($this->input->post('submit')) {
            $login_data = array(
                'name' => $this->input->post('form_name'),
                'username' => $this->input->post('form_username'),
                'password' => $this->encryption->encrypt($this->input->post('form_password'))
            );
            $mparish_id = $this->myencrypt->decrypt_url($this->input->post('form_mparish_id'));
            $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));
            $result = $this->admin_model->setData('mlogins', array('id' => $id), $login_data);
            $action = "Updation";
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/profile?parish_id=' . $this->myencrypt->encrypt_url($mparish_id) . '&view-profile=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('login_id') && $this->input->get('edit')) {
            $login_id = $this->myencrypt->decrypt_url($this->input->get('login_id'));
            $data['login'] = $this->admin_model->getlogin(array('id' => $login_id));
        }
        $this->view('managelogin', $data);
    }

    /* ------------------ End view page ------------------ */

    /* ------------------ Start Theme management ------------------ */

    public function settheme() {
        if ($this->input->get('user_id') && $this->input->get('theme_id')) {
            $user = $this->myencrypt->decrypt_url($this->input->get('user_id'));
            $theme = $this->myencrypt->decrypt_url($this->input->get('theme_id'));
            $result = $this->admin_model->setData('mlogins', array('id' => $user, 'status' => 1), array('mtheme_id' => $theme));
            if ($result) {
                redirect('logout');
            } else {
                $this->session->set_userdata('error', 'Theme setting failed.');
                $this->view('dashboard');
            }
        }
    }

    /* ------------------ End Theme management ------------------ */

    /* ------------------ Start internet check ------------------ */

    public function checkInternetConnection($website = 'www.parish-manager.esy.es', $port = '80') {
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
        $settings = $this->admin_model->getRowData('msettings', $where);
        return $settings;
    }

    /* ------------------ end get settings ------------------ */

    /* ------------------ Start scc ------------------ */

    // view
    public function sccs() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('scc_id'));
            $data['scc'] = $this->admin_model->getSccs(array('msccs.mscc_id' => $id));
            $data['families'] = $this->admin_model->getFamilies(false, array('mfamilies.mscc_id' => $id));
            $data['donations'] = $this->admin_model->getDonations(false, array('ttransactions.mscc_id' => $id));
        } else {
            $data['sccs'] = $this->admin_model->getSccs();
        }
        $this->view('sccs', $data);
    }

    // manage
    public function managescc() {
        $data = [];
        if ($this->input->post('submit')) {
            $scc_data = array(
                'name' => $this->input->post('form_name'),
                'sakha' => $this->input->post('form_sakha'),
                'president' => $this->input->post('form_president'),
                'president_contact' => $this->input->post('form_president_contact'),
                'secretary' => $this->input->post('form_secretary'),
                'secretary_contact' => $this->input->post('form_secretary_contact'),
                'treasurer' => $this->input->post('form_treasurer'),
                'treasurer_contact' => $this->input->post('form_treasurer_contact'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));

                $result = $this->admin_model->setData('msccs', array('mscc_id' => $id), $scc_data);
                $action = "Updation";
            } else {
                $insert_result = $this->admin_model->addScc($scc_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/sccs?scc_id=' . $this->myencrypt->encrypt_url($id) . '&view=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['scc'] = $this->admin_model->getSccs(array('msccs.mscc_id' => $id));
            } else {
                $reason = "";
                if ($this->input->get('delete')) {
                    $action = "Deletion";
                    $families = $this->admin_model->getData('mfamilies', array('mscc_id' => $id));
                    if (empty($families)) {
                        $result = $this->admin_model->deleteByStatus('msccs', array('mscc_id' => $id));
                    } else {
                        $reason = " Contains Families.";
                    }
                } else if ($this->input->get('restore')) {
                    $action = "Restoration";
                    $result = $this->admin_model->restore('msccs', array('mscc_id' => $id));
                }
                if ($result) {
                    $this->session->set_userdata('success', $action . ' successful.');
                } else {
                    $this->session->set_userdata('error', $action . ' failed.' . $reason);
                }
                redirect('admin/sccs');
            }
        }
        $this->view('managescc', $data);
    }

    /* ------------------ End scc ------------------ */

    /* ------------------ Start family ------------------ */

    // view
    public function families() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('family_id'));
            $data['family'] = $this->admin_model->getFamilies(array('mfamilies.mfamily_id' => $id));
            $data['members'] = $this->admin_model->getMembers(false, array('mmembers.mfamily_id' => $id));
            $data['donations'] = $this->admin_model->getDonations(false, array('ttransactions.mfamily_id' => $id));
        } else {
            $data['families'] = $this->admin_model->getFamilies();
        }
        $this->view('families', $data);
    }

    // manage
    public function managefamily() {
        $data = [];
        if ($this->input->post('submit')) {
            $family_data = array(
                'mscc_id' => $this->myencrypt->decrypt_url($this->input->post('form_mscc_id')),
                'firstname' => $this->input->post('form_firstname'),
                'lastname' => $this->input->post('form_lastname'),
                'addressline1' => $this->input->post('form_addressline1'),
                'addressline2' => $this->input->post('form_addressline2'),
                'city' => $this->input->post('form_city'),
                'mstate_id' => $this->myencrypt->decrypt_url($this->input->post('form_mstate_id')),
                'pincode' => $this->input->post('form_pincode'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));

                $result = $this->admin_model->setData('mfamilies', array('mfamily_id' => $id), $family_data);
                $action = "Updation";
            } else {
                $insert_result = $this->admin_model->addFamily($family_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/families?family_id=' . $this->myencrypt->encrypt_url($id) . '&view=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['family'] = $this->admin_model->getFamilies(array('mfamilies.mfamily_id' => $id));
                $country = $this->admin_model->getRowData('mstates', array('id' => $data['family']['mstate_id'], 'status' => 1));
                $data['states'] = $this->admin_model->getData('mstates', array('mcountry_id' => $country['mcountry_id'], 'status' => 1));
            } else {
                $reason = "";
                if ($this->input->get('delete')) {
                    $action = "Deletion";
                    $members = $this->admin_model->getData('mmembers', array('mfamily_id' => $id, 'status' => 1));
                    if (empty($members)) {
                        $result = $this->admin_model->deleteByStatus('mfamilies', array('mfamily_id' => $id));
                    } else {
                        $reason = " Contains Members.";
                    }
                } else if ($this->input->get('restore')) {
                    $action = "Restoration";
                    $family_data = $this->admin_model->getRowData('mfamilies', array('mfamily_id' => $id));
                    $scc = $this->admin_model->getRowData('msccs', array('mscc_id' => $family_data['mscc_id']));
                    if (empty($scc)) {
                        $reason = " Activate scc first.";
                    } else {
                        $result = $this->admin_model->restore('mfamilies', array('mfamily_id' => $id));
                    }
                }
                if ($result) {
                    $this->session->set_userdata('success', $action . ' successful.');
                } else {
                    $this->session->set_userdata('error', $action . ' failed.' . $reason);
                }
                redirect('admin/families');
            }
        }
        if ($this->input->get('scc_id') && $this->input->get('add_family')) {
            $data['selected_scc'] = $this->myencrypt->decrypt_url($this->input->get('scc_id'));
        }
        $data['sccs'] = $this->admin_model->getData('msccs', array('status' => 1));
        $data['countries'] = $this->admin_model->getData('mcountries', array('status' => 1));
        $this->view('managefamily', $data);
    }

    /* ------------------ End family ------------------ */

    /* ------------------ Start member ------------------ */

    // view
    public function members() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('member_id'));
            $data['member'] = $this->admin_model->getMembers(array('mmembers.mmember_id' => $id));
            if (isset($data['member'])) {
                $data['baptism_details'] = $this->admin_model->getRegisters(false, array('tevents.mmember_id' => $id), 1);
                $data['communion_details'] = $this->admin_model->getRegisters(false, array('tevents.mmember_id' => $id), 2);
                $data['confirmation_details'] = $this->admin_model->getRegisters(false, array('tevents.mmember_id' => $id), 3);

                $gender = $data['member']['mgender_id'];
                if ($gender === '2') {
                    $data['marriage_details'] = $this->admin_model->getRegisters(false, array('tevents.mbride_id' => $id), 4);
                } else {
                    $data['marriage_details'] = $this->admin_model->getRegisters(false, array('tevents.mgroom_id' => $id), 4);
                }
                $data['vocation_details'] = $this->admin_model->getRegisters(false, array('tevents.mmember_id' => $id), 5);
                $data['death_details'] = $this->admin_model->getRegisters(false, array('tevents.mmember_id' => $id), 6);
            }
        } else {
            if ($this->input->get('temporary')) {
                $data['members'] = $this->admin_model->getMembers(false, array('active' => 0));
                $data['temporary'] = true;
            } else {
                $data['members'] = $this->admin_model->getMembers(false, array('active' => 1));
            }
        }
        $this->view('members', $data);
    }

    // manage
    public function managemember() {
        $data = [];
        if ($this->input->post('submit')) {
            $member_data = array(
                'membersince' => $this->input->post('form_membersince'),
                'mscc_id' => $this->myencrypt->decrypt_url($this->input->post('form_mscc_id')),
                'mfamily_id' => $this->myencrypt->decrypt_url($this->input->post('form_mfamily_id')),
                'firstname' => $this->input->post('form_firstname'),
                'lastname' => $this->input->post('form_lastname'),
                'mgender_id' => $this->input->post('form_gender'),
                'dateofbirth' => $this->input->post('form_dateofbirth'),
                'father' => $this->input->post('form_father'),
                'mother' => $this->input->post('form_mother'),
                'mqualification_id' => $this->myencrypt->decrypt_url($this->input->post('form_mqualification_id')),
                'moccupation_id' => $this->myencrypt->decrypt_url($this->input->post('form_moccupation_id')),
                'contact1' => $this->input->post('form_contact1'),
                'contact2' => $this->input->post('form_contact2'),
                'email1' => $this->input->post('form_email1'),
                'addressline1' => $this->input->post('form_addressline1'),
                'addressline2' => $this->input->post('form_addressline2'),
                'city' => $this->input->post('form_city'),
                'mstate_id' => $this->myencrypt->decrypt_url($this->input->post('form_mstate_id')),
                'pincode' => $this->input->post('form_pincode'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks'),
                'active' => empty($this->input->post('form_active_member')) ? 0 : 1);
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));
                $result = $this->admin_model->setData('mmembers', array('mmember_id' => $id), $member_data);
                $action = "Updation";
            } else {
                $insert_result = $this->admin_model->addMember($member_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/members?member_id=' . $this->myencrypt->encrypt_url($id) . '&view=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['member'] = $this->admin_model->getMembers(array('mmembers.mmember_id' => $id));
                $data['families'] = $this->admin_model->getData('mfamilies', array('mscc_id' => $data['member']['mscc_id'], 'status' => 1));
                $country = $this->admin_model->getRowData('mstates', array('id' => $data['member']['mstate_id'], 'status' => 1));
                $data['states'] = $this->admin_model->getData('mstates', array('mcountry_id' => $country['mcountry_id'], 'status' => 1));
            } else {
                $reason = "";
                if ($this->input->get('delete')) {
                    $action = "Deletion";
                    $registers = $this->admin_model->getData('tevents', array('mmember_id' => $id, 'status' => 1));
                    if (empty($registers)) {
                        $result = $this->admin_model->deleteByStatus('mmembers', array('mmember_id' => $id));
                    } else {
                        $reason = " Registers exists.";
                    }
                } else if ($this->input->get('restore')) {
                    $action = 'Restoration';
                    $member_data = $this->admin_model->getRowData('mmembers', array('mmember_id' => $id));
                    $family = $this->admin_model->getRowData('mfamilies', array('mfamily_id' => $member_data['mfamily_id']));
                    if (empty($family)) {
                        $reason = " Activate family first.";
                    } else {
                        $result = $this->admin_model->restore('mmembers', array('mmember_id' => $id));
                    }
                }
                if ($result) {
                    $this->session->set_userdata('success', $action . ' successful.');
                } else {
                    $this->session->set_userdata('error', $action . ' failed.' . $reason);
                }
                redirect('admin/members');
            }
        }
        if ($this->input->get('scc_id') && $this->input->get('add_member')) {
            $data['selected_scc'] = $this->myencrypt->decrypt_url($this->input->get('scc_id'));
            $data['families'] = $this->admin_model->getFamilies(false, array('mfamilies.mscc_id' => $data['selected_scc'], 'mfamilies.status' => 1));
            if ($this->input->get('family_id')) {
                $data['selected_family'] = $this->myencrypt->decrypt_url($this->input->get('family_id'));
            }
            $data['active_member'] = true;
        }
        if ($this->input->get('active')) {
            $data['active_member'] = true;
        }
        $data['sccs'] = $this->admin_model->getData('msccs', array('status' => 1));
        $data['countries'] = $this->admin_model->getData('mcountries', array('status' => 1));
        $data['occupations'] = $this->admin_model->getData('moccupations', array('status' => 1));
        $data['qualifications'] = $this->admin_model->getData('mqualifications', array('status' => 1));
        $this->view('managemember', $data);
    }

    /* ------------------ End member ------------------ */

    /* ------------------ Start registers ------------------ */

    // view
    public function registers() {
        if ($this->input->get('tevent_id') && $this->input->get('view') && $this->input->get('mevent_id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('tevent_id'));
            $mevent_id = $this->myencrypt->decrypt_url($this->input->get('mevent_id'));
            $data['register'] = $this->admin_model->getRegisters(array('tevents.tevent_id' => $id), false, $mevent_id);
            $data['mevent_data'] = $this->admin_model->getRowData('mevents', array('id' => $data['register']['mevent_id']));
        } else {
            if ($this->input->get('mevent_id')) {
                $mevent_id = $this->myencrypt->decrypt_url($this->input->get('mevent_id'));
                $data['mevent_data'] = $this->admin_model->getRowData('mevents', array('id' => $mevent_id));
                $data['registers'] = $this->admin_model->getRegisters(false, false, $mevent_id, array('tevents.mparish_id' => $this->parish_id));
            }
        }
        $this->view('registers', $data);
    }

    // manage
    public function manageregister() {
        $data = [];
        if ($this->input->post('submit')) {
            $mevent_id = $this->myencrypt->decrypt_url($this->input->post('form_mevent_id'));
            $register_data = array(
                'mevent_id' => $mevent_id,
                'register_no' => $this->input->post('form_register_no'),
                'date' => $this->input->post('form_date'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'venue_mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_venue_mparish_id')),
                'minister' => $this->input->post('form_minister'),
                'place' => $this->input->post('form_place'),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($mevent_id === '4') {
                $register_data['mgroom_id'] = $this->myencrypt->decrypt_url($this->input->post('form_mgroom_id'));
                $register_data['mbride_id'] = $this->myencrypt->decrypt_url($this->input->post('form_mbride_id'));
                $register_data['witness1'] = $this->input->post('form_witness1');
                $register_data['witness2'] = $this->input->post('form_witness2');
            } else {
                $register_data['mmember_id'] = $this->myencrypt->decrypt_url($this->input->post('form_mmember_id'));
                if ($mevent_id === '1' || $mevent_id === '3') {
                    if ($mevent_id === '1') {
                        $register_data['baptismal_name'] = $this->input->post('form_baptismal_name');
                    }
                    $register_data['godfather'] = $this->input->post('form_godfather');
                    $register_data['godmother'] = $this->input->post('form_godmother');
                } else if ($mevent_id === '6') {
                    $register_data['funeral_date'] = $this->input->post('form_funeral_date');
                }
            }
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));

                $result = $this->admin_model->setData('tevents', array('tevent_id' => $id), $register_data);
                $action = "Updation";
            } else {
                $insert_result = $this->admin_model->addRegister($register_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/registers?tevent_id=' . $this->myencrypt->encrypt_url($id) . '&view=true&mevent_id=' . $this->myencrypt->encrypt_url($register_data['mevent_id']));
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('tevent_id') && $this->input->get('mevent_id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('tevent_id'));
            $mevent_id = $this->myencrypt->decrypt_url($this->input->get('mevent_id'));
            if ($this->input->get('edit')) {
                if ($mevent_id === '4') {
                    $data['brides'] = $this->admin_model->getMembers(false, array('vocation_flag' => 0, 'mgender_id' => 2));
                    $data['grooms'] = $this->admin_model->getMembers(false, array('vocation_flag' => 0, 'mgender_id' => 1));
                } else if ($mevent_id === '5') {
                    $data['members'] = $this->admin_model->getMembers(false, array('marriage_flag' => 0));
                } else {
                    $data['members'] = $this->admin_model->getMembers();
                }
                $data['register'] = $this->admin_model->getRegisters(array('tevents.tevent_id' => $id), false, $mevent_id);
                $data['mevent_data'] = $this->admin_model->getRowData('mevents', array('id' => $data['register']['mevent_id']));
            } else {
                if ($this->input->get('delete')) {
                    $result = false;
                    $register = $this->admin_model->getRegisters(array('tevents.tevent_id' => $id), false, $mevent_id);
                    if (isset($register)) {
                        $event_name = strtolower($register['mevent_name']);
                        if ($register['mevent_id'] === '4') {
                            $groom_id = $register['mgroom_id'];
                            $bride_id = $register['mbride_id'];
                            $update_groom = $this->admin_model->setData('mmembers', array('mmember_id' => $groom_id), array($event_name . '_flag' => 0));
                            $update_bride = $this->admin_model->setData('mmembers', array('mmember_id' => $bride_id), array($event_name . '_flag' => 0));
                            if ($update_bride && $update_groom) {
                                $result = $this->admin_model->deleteByStatus('tevents', array('tevent_id' => $id));
                            }
                        } else {
                            $member_id = $register['mmember_id'];
                            $update_member = $this->admin_model->setData('mmembers', array('mmember_id' => $member_id), array($event_name . '_flag' => 0));
                            if ($update_member) {
                                $result = $this->admin_model->deleteByStatus('tevents', array('tevent_id' => $id));
                            }
                        }
                    }
                    $action = "Deletion";
                    if ($result) {
                        $this->session->set_userdata('success', $action . ' successful.');
                    } else {
                        $this->session->set_userdata('error', $action . ' failed');
                    }
                    redirect('admin/registers?mevent_id=' . $this->myencrypt->encrypt_url($mevent_id));
                }
            }
        }
        if ($this->input->get('mevent_id') && $this->input->get('add_register')) {
            $data['mevent_id'] = $this->myencrypt->decrypt_url($this->input->get('mevent_id'));
            $data['mevent_data'] = $this->admin_model->getRowData('mevents', array('id' => $data['mevent_id']));
            $mevent = $data['mevent_id'];
            if ($mevent === '1') {
                $data['members'] = $this->admin_model->getMembers(false, array('baptism_flag' => 0));
            } else if ($mevent === '2') {
                $data['members'] = $this->admin_model->getMembers(false, array('communion_flag' => 0));
            } else if ($mevent === '3') {
                $data['members'] = $this->admin_model->getMembers(false, array('confirmation_flag' => 0));
            } else if ($mevent === '4') {
                $data['brides'] = $this->admin_model->getMembers(false, array('marriage_flag' => 0, 'vocation_flag' => 0, 'mgender_id' => 2));
                $data['grooms'] = $this->admin_model->getMembers(false, array('marriage_flag' => 0, 'vocation_flag' => 0, 'mgender_id' => 1));
            } else if ($mevent === '5') {
                $data['members'] = $this->admin_model->getMembers(false, array('vocation_flag' => 0, 'marriage_flag' => 0));
            } else if ($mevent === '6') {
                $data['members'] = $this->admin_model->getMembers(false, array('death_flag' => 0));
            } else {
                $this->session->set_userdata('error', "Something went wrong");
            }
        }
        if ($this->input->get('scc_id') && $this->input->get('add_member')) {
            $data['selected_scc'] = $this->myencrypt->decrypt_url($this->input->get('scc_id'));
            $data['families'] = $this->admin_model->getFamilies(false, array('mfamilies.mscc_id' => $data['selected_scc'], 'mfamilies.status' => 1));
            if ($this->input->get('family_id')) {
                $data['selected_family'] = $this->myencrypt->decrypt_url($this->input->get('family_id'));
            }
        }
        if ($this->input->get('mid') && $this->input->get('add_register')) {
            $data['selected_member'] = $this->myencrypt->decrypt_url($this->input->get('mid'));
        }
        $parish_details = $this->session->userdata("parish");
        $data['parishes'] = $this->admin_model->getData('mparishes', array('mdiocese_id' => $parish_details['mdiocese_id'], 'status' => 1));
        $this->view('manageregister', $data);
    }

    /* ------------------ End register ------------------ */

    /* ------------------ Start print certificate ------------------ */

    public function printcertificate() {
        if ($this->input->get('tevent_id') && $this->input->get('mevent_id') && $this->input->get('print')) {
            $data['parishdetails'] = $this->session->userdata("parish");
            $id = $this->myencrypt->decrypt_url($this->input->get('tevent_id'));
            $mevent_id = $this->myencrypt->decrypt_url($this->input->get('mevent_id'));
            $data['register'] = $this->admin_model->getRegisters(array('tevents.tevent_id' => $id), false, $mevent_id);
            $data['mevent_data'] = $this->admin_model->getRowData('mevents', array('id' => $data['register']['mevent_id']));
            if ($mevent_id === '4') {
                $data['groom'] = $this->admin_model->getMembers(array('mmembers.mmember_id' => $data['register']['mgroom_id']));
                $data['bride'] = $this->admin_model->getMembers(array('mmembers.mmember_id' => $data['register']['mbride_id']));
            } else {
                $data['member'] = $this->admin_model->getMembers(array('mmembers.mmember_id' => $data['register']['mmember_id']));
            }
            $this->load->view('admin/printcertificate', $data);
        }
    }

    /* ------------------ End print certificate ------------------ */

    /* ------------------ Start Backup & sync ------------------ */

    public function sync() {
        if ($this->input->get('sync_btn') && $this->input->get('p_id')) {
            $data['parish_id'] = $this->myencrypt->decrypt_url($this->input->get('p_id'));
            $data['enable_btn'] = true;
        } else {
            $data['sync_error'] = '';
        }
        $this->view('sync', $data);
    }

    public function backup() {
        $this->load->dbutil();
        $parish_name = "";
        if ($this->input->get('parish_name')) {
            $parish_name = $this->input->get('parish_name');
        }

        $backup = $this->dbutil->backup();

        $db_name = $parish_name . 'backup-on-' . date("Y-m-d-H-i-s") . '.gz';
        $save = base_url() . $db_name;

        $this->load->helper('file');
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);
        redirect('admin/sync');
    }

    /* ------------------ Start Backup & sync ------------------ */

    /* ------------------ Start about ------------------ */

    public function about() {

        $data['abouts'] = $this->admin_model->getData('mabouts', array('status' => 1));
        $data['local_dbversion'] = $this->admin_model->getRowData('mabouts', array('property' => 'dbversion'));
        $appsettings = $this->getSettings(array('name' => 'defaultserver'));
        $is_connected = $this->checkInternetConnection($appsettings['value2']);

        if ($is_connected) {
            $url = $appsettings['value1'] . "api/getDbversion";
            $result = file_get_contents($url);
            $data['server_dbversion'] = json_decode($result, true);
        }

        $this->view('about', $data);
    }

    /* ------------------ Start about ------------------ */

    /* ------------------ Start associations ------------------ */

    // view
    public function associations() {
        if ($this->input->get('tassociation_id') && $this->input->get('view') && $this->input->get('massociation_id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('tassociation_id'));
            $massociation_id = $this->myencrypt->decrypt_url($this->input->get('massociation_id'));
            $data['association'] = $this->admin_model->getAssociations(array('tassociations.tassociation_id' => $id), false, $massociation_id);
            $data['massociation_data'] = $this->admin_model->getRowData('massociations', array('id' => $data['association']['massociation_id']));
            if ($massociation_id == '4') {
                $data['members'] = $this->admin_model->getData('mmembers', array('active' => 1, 'mgender_id' => 1, 'marriage_flag' => 1, 'floor(datediff(curdate(),dateofbirth)/365.25) >' => 35));
            } else if ($massociation_id == '5') {
                $data['members'] = $this->admin_model->getData('mmembers', array('active' => 1, 'mgender_id' => 2, 'marriage_flag' => 1, 'floor(datediff(curdate(),dateofbirth)/365.25) >' => 35));
            } else if ($massociation_id == '6') {
                $data['members'] = $this->admin_model->getData('mmembers', array('active' => 1, 'marriage_flag' => 0, 'floor(datediff(curdate(),dateofbirth)/365.25) >=' => 15, 'floor(datediff(curdate(),dateofbirth)/365.25) <=' => 35));
            } else if ($massociation_id == '7') {
                $data['members'] = $this->admin_model->getData('mmembers', array('active' => 1, 'floor(datediff(curdate(),dateofbirth)/365.25) >=' => 6, 'floor(datediff(curdate(),dateofbirth)/365.25) <=' => 14));
            }
            $data['committee_members'] = $this->admin_model->getData('tassociationmembers', array('status' => 1, 'tassociation_id' => $id));
        } else {
            if ($this->input->get('massociation_id')) {
                $massociation_id = $this->myencrypt->decrypt_url($this->input->get('massociation_id'));
                $data['massociation_data'] = $this->admin_model->getRowData('massociations', array('id' => $massociation_id));
                $data['associations'] = $this->admin_model->getAssociations(false, array('massociation_id' => $massociation_id));
            }
        }
        $this->view('associations', $data);
    }

    // manage
    public function manageassociation() {
        $data = [];
        if ($this->input->post('submit')) {
            $massociation_id = $this->myencrypt->decrypt_url($this->input->post('form_massociation_id'));
            $association_data = array(
                'massociation_id' => $massociation_id,
                'name' => $this->input->post('form_name'),
                'from_date' => $this->input->post('form_from_date'),
                'to_date' => $this->input->post('form_to_date'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'president' => $this->input->post('form_president'),
                'vicepresident' => $this->input->post('form_vicepresident'),
                'secretary' => $this->input->post('form_secretary'),
                'jointsecretary' => $this->input->post('form_jointsecretary'),
                'treasurer' => $this->input->post('form_treasurer'),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));
                $result = $this->admin_model->setData('tassociations', array('tassociation_id' => $id), $association_data);
                $action = "Updation";
            } else {
                $insert_result = $this->admin_model->addAssociation($association_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/associations?tassociation_id=' . $this->myencrypt->encrypt_url($id) . '&view=true&massociation_id=' . $this->myencrypt->encrypt_url($association_data['massociation_id']));
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('tassociation_id') && $this->input->get('massociation_id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('tassociation_id'));
            $massociation_id = $this->myencrypt->decrypt_url($this->input->get('massociation_id'));
            if ($this->input->get('edit')) {
                if ($massociation_id === '4') {
                    $data['brides'] = $this->admin_model->getMembers(false, array('vocation_flag' => 0, 'mgender_id' => 2));
                    $data['grooms'] = $this->admin_model->getMembers(false, array('vocation_flag' => 0, 'mgender_id' => 1));
                } else if ($massociation_id === '5') {
                    $data['members'] = $this->admin_model->getMembers(false, array('marriage_flag' => 0));
                } else {
                    $data['members'] = $this->admin_model->getMembers();
                }
                $data['association'] = $this->admin_model->getAssociations(array('tassociations.tassociation_id' => $id), false, $massociation_id);
                $data['massociation_data'] = $this->admin_model->getRowData('massociations', array('id' => $data['association']['massociation_id']));
            } else {
                if ($this->input->get('delete')) {
                    $result = false;
                    $result = $this->admin_model->deleteByStatus('tassociations', array('tassociation_id' => $id));
                    $action = "Deletion";
                    if ($result) {
                        $this->session->set_userdata('success', $action . ' successful.');
                    } else {
                        $this->session->set_userdata('error', $action . ' failed');
                    }
                    redirect('admin/associations?massociation_id=' . $this->myencrypt->encrypt_url($massociation_id));
                }
            }
        }
        if ($this->input->get('massociation_id') && $this->input->get('add_association')) {
            $data['massociation_id'] = $this->myencrypt->decrypt_url($this->input->get('massociation_id'));
            $data['massociation_data'] = $this->admin_model->getRowData('massociations', array('id' => $data['massociation_id']));
        }
        if ($this->input->get('scc_id') && $this->input->get('add_member')) {
            $data['selected_scc'] = $this->myencrypt->decrypt_url($this->input->get('scc_id'));
            $data['families'] = $this->admin_model->getFamilies(false, array('mfamilies.mscc_id' => $data['selected_scc'], 'mfamilies.status' => 1));
            if ($this->input->get('family_id')) {
                $data['selected_family'] = $this->myencrypt->decrypt_url($this->input->get('family_id'));
            }
        }
        if ($this->input->get('mid') && $this->input->get('add_association')) {
            $data['selected_member'] = $this->myencrypt->decrypt_url($this->input->get('mid'));
        }
        $parish_details = $this->session->userdata("parish");
        $data['parishes'] = $this->admin_model->getData('mparishes', array('mdiocese_id' => $parish_details['mdiocese_id'], 'status' => 1));
        $this->view('manageassociation', $data);
    }

    /* ------------------ End association ------------------ */

    /* ------------------ Start association members ------------------ */

    public function manageassociationmembers() {
        if ($this->input->post('submit')) {
            $tassociation_id = $this->myencrypt->decrypt_url($this->input->post('form_tassociation_id'));
            $massociation_id = $this->myencrypt->decrypt_url($this->input->post('form_massociation_id'));
            if (isset($_POST['form_tmember_id'])) {
                $association_member_ids = $_POST['form_tmember_id'];
            }

            $association_member_names = $_POST['form_tmember_name'];
            $delete_members = $this->admin_model->setData('tassociationmembers', array('tassociation_id' => $tassociation_id), array('status' => 0));
            $i = 0;
            if (isset($association_member_ids)) {
                $updation = true;
                for (; $i < sizeof($association_member_ids); $i++) {
                    $tmember_data = array('name' => $association_member_names[$i],
                        'tassociation_id' => $tassociation_id,
                        'status' => 1);
                    $updation_result = $this->admin_model->setData('tassociationmembers', array('tassociationmember_id' => $association_member_ids[$i]), $tmember_data);
                    $updation *= $updation_result;
                }
            }
            $insertion = true;
            for (; $i < sizeof($association_member_names); $i++) {
//                insert association members
                $tmember_data = array('name' => $association_member_names[$i], 'tassociation_id' => $tassociation_id);
                $insertion_result = $this->admin_model->addAssociationMember($tmember_data);
                $insertion *= $insertion_result;
            }
            $result = true;
            if (isset($updation)) {
                $result *= $updation;
            }
            if (isset($insertion)) {
                $result *= $insertion;
            }
            if ($result) {
                $this->session->set_userdata('success', 'Member details updation successful.');
                redirect('admin/associations?tassociation_id=' . $this->myencrypt->encrypt_url($tassociation_id) . '&view=true&massociation_id=' . $this->myencrypt->encrypt_url($massociation_id));
            } else {
                $this->session->set_userdata('error', 'Member details updation failed.');
            }
        } else {
            $data = [];
            if ($this->input->get('massociation_id') && $this->input->get('add_member')) {
                $data['massociation_id'] = $this->myencrypt->decrypt_url($this->input->get('massociation_id'));
                $data['massociation_data'] = $this->admin_model->getRowData('massociations', array('id' => $data['massociation_id']));
            }
            if ($this->input->get('tassociation_id')) {
                $data['tassociation_id'] = $this->myencrypt->decrypt_url($this->input->get('tassociation_id'));
                $data['association_members'] = $this->admin_model->getData('tassociationmembers', array('tassociation_id' => $data['tassociation_id'], 'status' => 1));
//                var_dump($data);
                $this->view('manageassociationmembers', $data);
            } else {
                redirect('admin/dashboard');
            }
        }
    }

    /* ------------------ End association members ------------------ */

    /* ------------------ Start Convent ------------------ */

    public function Convents() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('convent_id'));
            $data['convent'] = $this->admin_model->getConvents(array('mconvents.mconvent_id' => $id));
            $data['community_members'] = $this->admin_model->getData('tsisters', array('mconvent_id' => $id, 'status' => 1));
        } else {
            $data['convents'] = $this->admin_model->getConvents();
        }
        $this->view('convents', $data);
    }

    public function manageconvent() {
        $data = [];
        if ($this->input->post('submit')) {
            $convent_data = array(
                'name' => $this->input->post('form_name'),
                'mcongregation_id' => $this->myencrypt->decrypt_url($this->input->post('form_mcongregation_id')),
                'addressline1' => $this->input->post('form_addressline1'),
                'addressline2' => $this->input->post('form_addressline2'),
                'city' => $this->input->post('form_city'),
                'mstate_id' => $this->myencrypt->decrypt_url($this->input->post('form_mstate_id')),
                'pincode' => $this->input->post('form_pincode'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));

                $result = $this->admin_model->setData('mconvents', array('mconvent_id' => $id), $convent_data);
                $action = "Updation";
            } else {
                $insert_result = $this->admin_model->addConvent($convent_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/convents?convent_id=' . $this->myencrypt->encrypt_url($id) . '&view=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['convent'] = $this->admin_model->getConvents(array('mconvents.mconvent_id' => $id));
                $country = $this->admin_model->getRowData('mstates', array('id' => $data['convent']['mstate_id'], 'status' => 1));
                $data['states'] = $this->admin_model->getData('mstates', array('mcountry_id' => $country['mcountry_id'], 'status' => 1));
            } else {
                if ($this->input->get('delete')) {
                    $result = $this->admin_model->deleteByStatus('mconvents', array('mconvent_id' => $id));
                    $action = "Deletion";
                    if ($result) {
                        $this->session->set_userdata('success', $action . ' successful.');
                    } else {
                        $this->session->set_userdata('error', $action . ' failed');
                    }
                    redirect('admin/convents');
                }
            }
        }
        $data['congregations'] = $this->admin_model->getData('mcongregations', array('status' => 1));
        $data['countries'] = $this->admin_model->getData('mcountries', array('status' => 1));
        $this->view('manageconvent', $data);
    }

    public function manageconventcommunity() {
        if ($this->input->post('submit')) {
            $mconvent_id = $this->myencrypt->decrypt_url($this->input->post('form_mconvent_id'));
            if (isset($_POST['form_tcommunity_id'])) {
                $association_member_ids = $_POST['form_tcommunity_id'];
            }

            $association_member_names = $_POST['form_tcommunity_name'];
            $delete_members = $this->admin_model->setData('tsisters', array('mconvent_id' => $mconvent_id), array('status' => 0));
            $i = 0;
            if (isset($association_member_ids)) {
                $updation = true;
                for (; $i < sizeof($association_member_ids); $i++) {
                    $tmember_data = array('name' => $association_member_names[$i],
                        'mconvent_id' => $mconvent_id,
                        'status' => 1);
                    $updation_result = $this->admin_model->setData('tsisters', array('tsister_id' => $association_member_ids[$i]), $tmember_data);
                    $updation *= $updation_result;
                }
            }
            $insertion = true;
            for (; $i < sizeof($association_member_names); $i++) {
//                insert association members
                $tmember_data = array('name' => $association_member_names[$i], 'mconvent_id' => $mconvent_id);
                $insertion_result = $this->admin_model->addConventCommunity($tmember_data);
                $insertion *= $insertion_result;
            }
            $result = true;
            if (isset($updation)) {
                $result *= $updation;
            }
            if (isset($insertion)) {
                $result *= $insertion;
            }
            if ($result) {
                $this->session->set_userdata('success', 'Member details updation successful.');
                redirect('admin/convents?convent_id=' . $this->myencrypt->encrypt_url($mconvent_id) . '&view=true');
            } else {
                $this->session->set_userdata('error', 'Member details updation failed.');
            }
        } else {
            $data = [];
            if ($this->input->get('mconvent_id')) {
                $data['mconvent_id'] = $this->myencrypt->decrypt_url($this->input->get('mconvent_id'));
                $data['community_members'] = $this->admin_model->getData('tsisters', array('mconvent_id' => $data['mconvent_id'], 'status' => 1));
                $this->view('manageconventcommunity', $data);
            } else {
                redirect('admin/dashboard');
            }
        }
    }

    /* ------------------ End Convent ------------------ */

    /* ------------------ Start Institutions ------------------ */

    // view
    public function institutions() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('institution_id'));
            $data['institution'] = $this->admin_model->getInstitutions(array('tinstitutions.tinstitution_id' => $id));
        } else {
            $data['institutions'] = $this->admin_model->getInstitutions();
        }
        $this->view('institutions', $data);
    }

    // manage
    public function manageinstitution() {
        $data = [];
        if ($this->input->post('submit')) {
            $institution_data = array(
                'name' => $this->input->post('form_name'),
                'minstitution_id' => $this->myencrypt->decrypt_url($this->input->post('form_minstitution_id')),
                'incharge' => $this->input->post('form_incharge'),
                'contact1' => $this->input->post('form_contact1'),
                'contact2' => $this->input->post('form_contact2'),
                'email1' => $this->input->post('form_email1'),
                'email2' => $this->input->post('form_email2'),
                'website' => $this->input->post('form_website'),
                'addressline1' => $this->input->post('form_addressline1'),
                'addressline2' => $this->input->post('form_addressline2'),
                'city' => $this->input->post('form_city'),
                'mstate_id' => $this->myencrypt->decrypt_url($this->input->post('form_mstate_id')),
                'pincode' => $this->input->post('form_pincode'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));
                $result = $this->admin_model->setData('tinstitutions', array('tinstitution_id' => $id), $institution_data);
                $action = "Updation";
            } else {
                $insert_result = $this->admin_model->addInstitution($institution_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/institutions?institution_id=' . $this->myencrypt->encrypt_url($id) . '&view=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['institution'] = $this->admin_model->getInstitutions(array('tinstitutions.tinstitution_id' => $id));
                $country = $this->admin_model->getRowData('mstates', array('id' => $data['institution']['mstate_id'], 'status' => 1));
                $data['states'] = $this->admin_model->getData('mstates', array('mcountry_id' => $country['mcountry_id'], 'status' => 1));
            } else {
                if ($this->input->get('delete')) {
                    $result = $this->admin_model->deleteByStatus('tinstitutions', array('tinstitution_id' => $id));
                    $action = "Deletion";
                    if ($result) {
                        $this->session->set_userdata('success', $action . ' successful.');
                    } else {
                        $this->session->set_userdata('error', $action . ' failed');
                    }
                    redirect('admin/institutions');
                }
            }
        }
        $data['minstitutions'] = $this->admin_model->getData('minstitutions', array('status' => 1));
        $data['countries'] = $this->admin_model->getData('mcountries', array('status' => 1));
        $this->view('manageinstitution', $data);
    }

    /* ------------------ End Institutions ------------------ */

    /* ------------------ Start catechist ------------------ */

    public function catechists() {
        $data['catechists'] = $this->admin_model->getCatechists();
        $this->view('catechists', $data);
    }

    public function managecatechist() {
        $data = [];
        if ($this->input->post('submit')) {
            $catechist_data = array(
                'mmember_id' => $this->myencrypt->decrypt_url($this->input->post('form_mmember_id')),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id'))
            );
            $result = $this->admin_model->addCatechist($catechist_data);
            $action = "Insertion";
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/catechists');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('delete')) {
                $result = $this->admin_model->deleteByStatus('mcatechists', array('mcatechist_id' => $id, 'status' => 1));
                $action = "Deletion";
                if ($result) {
                    $this->session->set_userdata('success', $action . ' successful.');
                } else {
                    $this->session->set_userdata('error', $action . ' failed');
                }
                redirect('admin/catechists');
            }
        }
        $data['members'] = $this->admin_model->getData('mmembers', array('status' => 1), array('column' => 'firstname', 'order' => 'ASC'));
        $this->view('managecatechist', $data);
    }

    /* ------------------ End catechist ------------------ */

    /* ------------------ Start substation ------------------ */

    public function substations() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('substation_id'));
            $data['substation'] = $this->admin_model->getSubstations(array('msubstations.msubstation_id' => $id));
        } else {
            $data['substations'] = $this->admin_model->getSubstations();
        }
        $this->view('substations', $data);
    }

    // manage
    public function managesubstation() {
        $data = [];
        if ($this->input->post('submit')) {
            $substation_data = array(
                'name' => $this->input->post('form_name'),
                'place' => $this->input->post('form_place'),
                'established_in' => $this->input->post('form_established_in'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));

                $result = $this->admin_model->setData('msubstations', array('msubstation_id' => $id), $substation_data);
                $action = "Updation";
            } else {
                $insert_result = $this->admin_model->addSubstation($substation_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('admin/substations?substation_id=' . $this->myencrypt->encrypt_url($id) . '&view=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['substation'] = $this->admin_model->getSubstations(array('msubstations.msubstation_id' => $id));
            } else {
                if ($this->input->get('delete')) {
                    $result = $this->admin_model->deleteByStatus('msubstations', array('msubstation_id' => $id));
                    $action = "Deletion";
                    if ($result) {
                        $this->session->set_userdata('success', $action . ' successful.');
                    } else {
                        $this->session->set_userdata('error', $action . ' failed');
                    }
                    redirect('admin/substations');
                }
            }
        }
        $this->view('managesubstation', $data);
    }

    /* ------------------ End substation ------------------ */


    /* ------------------ Start Statistics ------------------ */

    public function statistics() {
        $data = [];
        if ($this->input->post('form_year') && $this->input->post('generate-report')) {
            $year = $this->input->post('form_year');
            $data['statistics'] = $this->admin_model->getStatistics($year);
            $data['year'] = $year;
        }
        $this->view('statistics', $data);
    }

    /* ------------------ End Statistics ------------------ */

    /* ------------------ Start donations ------------------ */

    public function donations() {
        $data = [];
        if ($this->input->get('view')) {
            $transaction_id = $this->myencrypt->decrypt_url($this->input->get('id'));
            $data['donation'] = $this->admin_model->getDonations(array('ttransactions.ttransaction_id' => $transaction_id));
            if (isset($data['donation']['mscc_id'])) {
                $data['mscc_id'] = $data['donation']['mscc_id'];
                $data['title'] = 'Sccs';
            } else if (isset($data['donation']['mfamily_id'])) {
                $data['mfamily_id'] = $data['donation']['mfamily_id'];
                $data['title'] = 'Families';
            }
        }
        $this->view('donations', $data);
    }

    public function managedonation() {
        $data = [];
        if ($this->input->post('submit')) {
            $insert = true;
            $financialyear_data = $this->admin_model->getRowData('mfinancialyears', array('active' => 1, 'status' => 1));
            $mfinancialyear_id = $financialyear_data['mfinancialyear_id'];
            $tledger_id = $this->myencrypt->decrypt_url($this->input->post('form_tledger_id'));
            $tledger_data = $this->admin_model->getRowData('tledgers', array('tledger_id' => $tledger_id, 'status' => 1));
            $mode = 'Cash Receipt';
            $transaction_data = array(
                'cash_debit' => $this->input->post('form_amount'),
                'date' => $this->input->post('form_date'),
                'mfinancialyear_id' => $mfinancialyear_id,
                'mledger_id' => $tledger_data['mledger_id'],
                'tledger_id' => $tledger_id,
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($this->input->post('form_mscc_id')) {
                $transaction_data['mscc_id'] = $this->myencrypt->decrypt_url($this->input->post('form_mscc_id'));
            }
            if ($this->input->post('form_mfamily_id')) {
                $transaction_data['mfamily_id'] = $this->myencrypt->decrypt_url($this->input->post('form_mfamily_id'));
            }
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));
                $result = $this->account_model->setData('ttransactions', array('ttransaction_id' => $id), $transaction_data);
                $action = "Updation";
            } else {
                if ($insert) {
                    $insert_result = $this->account_model->addTransaction($transaction_data, $mode);
                    $result = $insert_result['result'];
                    if ($result) {
                        $id = $insert_result['id'];
                    }
                } else {
                    $result = FALSE;
                }
                $action = "Transaction";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                $target = 'admin/dashboard';
                if (isset($transaction_data['mscc_id'])) {
                    $target = 'admin/sccs?scc_id=' . $this->myencrypt->encrypt_url($transaction_data['mscc_id']) . '&view=true';
                }
                if (isset($transaction_data['mfamily_id'])) {
                    $target = 'admin/families?family_id=' . $this->myencrypt->encrypt_url($transaction_data['mfamily_id']) . '&view=true';
                }
                redirect($target);
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['donation'] = $this->admin_model->getDonations(array('ttransactions.ttransaction_id' => $id));
                if (isset($data['donation']['mscc_id'])) {
                    $data['mscc_id'] = $data['donation']['mscc_id'];
                    $data['title'] = 'Sccs';
                } else if (isset($data['donation']['mfamily_id'])) {
                    $data['mfamily_id'] = $data['donation']['mfamily_id'];
                    $data['title'] = 'Families';
                }
            } else {
                if ($this->input->get('delete')) {
                    $result = $this->account_model->deleteByStatus('ttransactions', array('ttransaction_id' => $id));
                    $action = "Deletion";
                }
                if ($result) {
                    $this->session->set_userdata('success', $action . ' successful.');
                } else {
                    $this->session->set_userdata('error', $action . ' failed');
                }
                $target = 'admin/dashboard';
                if ($this->input->get('mscc_id')) {
                    $target = 'admin/sccs?scc_id=' . $this->input->get('mscc_id') . '&view=true';
                }
                if ($this->input->get('mfamily_id')) {
                    $target = 'admin/families?family_id=' . $this->input->get('mfamily_id') . '&view=true';
                }
                redirect($target);
            }
        }
        if ($this->input->get('mscc_id') && $this->input->get('add_donation')) {
            $data['mscc_id'] = $this->myencrypt->decrypt_url($this->input->get('mscc_id'));
            $data['title'] = 'Sccs';
        }
        if ($this->input->get('mfamily_id') && $this->input->get('add_donation')) {
            $data['mfamily_id'] = $this->myencrypt->decrypt_url($this->input->get('mfamily_id'));
            $data['title'] = 'Families';
        }
        $data['ledgers'] = $this->admin_model->getData('tledgers', array('status' => 1), array('column' => 'name', 'order' => 'ASC'));
        $this->view('managedonation', $data);
    }

    /* ------------------ End donations ------------------ */

    public function tables() {
        $data = [];
        $data['title'] = "Tables";
        if ($this->input->get('table') && $this->input->get('view')) {
            $data['table'] = $this->input->get('table');
            $table_data = $this->admin_model->getTables($data['table']);
            $data['fields'] = $table_data['fields'];
            $data['rows'] = $table_data['rows'];
        } else {
            $data['tables'] = $this->admin_model->getTables();
        }
        $this->view('tables', $data);
    }

    public function viewdata() {
        if ($this->input->get('table') && $this->input->get('id')) {
            $data['table'] = $this->input->get('table');
            $id = $this->input->get('id');
            $table_data = $this->admin_model->getTableRowData($data['table'], $id);
            $data['fields'] = $table_data['fields'];
            $data['row_data'] = $table_data['row_data'];
        }
                $data['title'] = "Tables";
        $this->view('viewdata', $data);
    }

    public function managedata() {
        if ($this->input->post('submit')) {
            
        }
        if ($this->input->get('table') && $this->input->get('id')) {
            $data['table'] = $this->input->get('table');
            $id = $this->input->get('id');
            $table_data = $this->admin_model->getTableRowData($data['table'], $id);
            $data['fields'] = $table_data['fields'];
            $data['row_data'] = $table_data['row_data'];
        }
                $data['title'] = "Tables";
        $this->view('managedata', $data);
    }

}
