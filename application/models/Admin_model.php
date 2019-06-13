<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* ------------------ Start put data ------------------ */

    public function putData($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    /* ------------------ Start put data ------------------ */

    /* ------------------ Start set data ------------------ */

    public function setData($table, $where, $data) {
        $sync_flag_exist = $this->checkSyncFlag($table);
        if ($sync_flag_exist) {
            $data['sync_flag'] = 1;
        }
        $this->db->where($where);
        $result = $this->db->update($table, $data);
        return $result;
    }

    /* ------------------ End set data ------------------ */

    /* ------------------ Start sync table check data ------------------ */

    public function checkSyncFlag($table) {
        $result = false;
        $this->db->select("*");
        $this->db->from('ttables');
        $this->db->where('name', $table);
        $this->db->where('status', 1);
        $table_data_query = $this->db->get();
        $table_data_result = $table_data_query->row_array();
        if (!empty($table_data_result)) {
            $result = true;
            if ($table_data_result['sync'] === '0') {
                $this->setSyncFlag($table);
            }
        }
        return $result;
    }

    /* ------------------ End sync table check  data ------------------ */

    /* ------------------ Start sync table check data ------------------ */

    public function setSyncFlag($table) {
        $result = false;
        $this->db->where('name', $table);
        $this->db->where('status', 1);
        $result = $this->db->update('ttables', array('sync' => 1));
        return $result;
    }

    /* ------------------ End sync table check  data ------------------ */

    /* ------------------ Start set data ------------------ */

    public function deleteByStatus($table, $where) {
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['status'] = 0;
        $sync_flag_exist = $this->checkSyncFlag($table);
        if ($sync_flag_exist) {
            $data['sync_flag'] = 1;
        }
        $this->db->where($where);
        $result = $this->db->update($table, $data);
        return $result;
    }

    /* ------------------ End set data ------------------ */

    /* ------------------ Start restore ------------------ */

    public function restore($table, $where) {
        $data['deleted_at'] = NULL;
        $data['status'] = 1;
        $sync_flag_exist = $this->checkSyncFlag($table);
        if ($sync_flag_exist) {
            $data['sync_flag'] = 1;
        }
        $this->db->where($where);
        $result = $this->db->update($table, $data);
        return $result;
    }

    /* ------------------ End restore ------------------ */

    /* ------------------ Start delete data ------------------ */

    public function deleteData($table, $where) {
        $this->db->where($where);
        $result = $this->db->delete($table);
        return $result;
    }

    /* ------------------ End delete data ------------------ */

    /* ------------------ Start get data ------------------ */

    public function getData($table, $where = false, $orderby = false) {
        if ($where) {
            $this->db->where($where);
        }
        if ($orderby) {
            $this->db->order_by($orderby['column'], $orderby['order']);
        }
        $result = $this->db->get($table);
        return $result->result();
    }

    /* ------------------ End get data ------------------ */

    /* ------------------ Start get data ------------------ */

    public function getDataForSync($table, $fields, $where = false) {
        $this->db->select($fields);
        if ($where) {
            $this->db->where($where);
        }
        $this->db->where('sync_flag', '1');
        $this->db->order_by('id', 'ASC');
        $result = $this->db->get($table);
        return $result->result();
    }

    /* ------------------ End get data ------------------ */

    /* ------------------ Start get row data ------------------ */

    public function getRowData($table, $where) {
        $this->db->where($where);
        $result = $this->db->get($table);
        return $result->row_array();
    }

    /* ------------------ End get row data ------------------ */


    /* ---------- Start  get field data ---------- */

    public function getFields($table) {
        $result = $this->db->field_data($table);
        return $result;
    }

    /* ------------------ End get field data ------------------ */


    /* ---------- Start login check ---------- */

    public function loginCheck($where = false) {
        $this->db->limit(1);
        $this->db->select('mlogins.* , maccessrights.name as accessright_name, mroles.name as role_name, mroles.id as role_id, mroles.target_page as target_page,mroles.image_default as profile_image, mthemes.name as theme_name, mthemes.id as theme_id');
        $this->db->from('mlogins');
        $this->db->join('maccessrights', 'maccessrights.id = mlogins.maccessright_id', 'left');
        $this->db->join('mroles', 'mroles.id = mlogins.mrole_id', 'left');
        $this->db->join('mthemes', 'mthemes.id = mlogins.mtheme_id', 'left');
        $this->db->order_by('name', 'ASC');
        $this->db->where($where);
        $result = $this->db->get();
        return $result->row_array();
    }

    /* ---------- End logincheck  ---------- */

    /* ---------- Start get last login ---------- */

    public function getLastLogin($where, $limit = false) {
        if ($limit) {
            $this->db->limit(1);
        }
        $this->db->select('tlogins.*');
        $this->db->from('tlogins');
        $this->db->order_by('login_at', 'DESC');
        $this->db->where($where);
        $result = $this->db->get();
        if ($limit) {
            return $result->row_array();
        }
        return $result->result();
    }

    /* ---------- Start get last login ---------- */

    /* ---------- Start get parish detils  ---------- */

    public function getParishDetails($where) {
        $this->db->limit(1);
        $this->db->select('mparishes.* , mdeanaries.mdeanary_id as denanary_id, mdeanaries.name as denanry_name, mdioceses.name as diocese, '
                . 'mstates.name as state, mcountries.name as country');
        $this->db->from('mparishes');
        $this->db->join('mdeanaries', 'mdeanaries.mdeanary_id = mparishes.mdeanary_id', 'left');
        $this->db->join('mdioceses', 'mdioceses.id = mparishes.mdiocese_id', 'left');
        $this->db->join('mstates', 'mstates.id = mparishes.mstate_id', 'left');
        $this->db->join('mcountries', 'mcountries.id = mstates.mcountry_id', 'left');
        $this->db->order_by('name', 'ASC');
        $this->db->where($where);
        $result = $this->db->get();
        return $result->row_array();
    }

    /* ---------- End get parish detils  ---------- */

    /* ------------------ Start get dashboard data ------------------ */

    public function getDashBoardData($mparish_id) {
        if (isset($mparish_id)) {
            $query = $this->db->get_where('msccs', array('mparish_id' => $mparish_id, 'status' => 1));
            $result['sccs'] = $query->num_rows();
            $query = $this->db->get_where('mfamilies', array('mparish_id' => $mparish_id, 'status' => 1));
            $result['families'] = $query->num_rows();
            $query = $this->db->get_where('mmembers', array('mparish_id' => $mparish_id, 'active' => 1, 'status' => 1, 'death_flag' => 0));
            $result['members'] = $query->num_rows();
            $query = $this->db->get_where('mcatechists', array('mparish_id' => $mparish_id, 'status' => 1));
            $result['catechists'] = $query->num_rows();
        } else {
            $query = $this->db->get('msccs');
            $result['sccs'] = $query->num_rows();
            $query = $this->db->get('mfamilies');
            $result['families'] = $query->num_rows();
            $query = $this->db->get('mmembers');
            $result['members'] = $query->num_rows();
            $query = $this->db->get('mcatechists');
            $result['catechists'] = $query->num_rows();
        }
        return $result;
    }

    /* ------------------ End get dashboard data ------------------ */

    /* ---------- Start profile data  ---------- */

    public function getProfile($mparish_id) {
        $this->db->select('mparishes.*');
        $this->db->select('mdeanaries.name as deanary_name');
        $this->db->select('mdioceses.name as diocese_name');
        $this->db->select('mstates.name as state_name');
        $this->db->select('mcountries.name as country_name');
        $this->db->from('mparishes');
        $this->db->join('mdeanaries', 'mdeanaries.mdeanary_id = mparishes.mdeanary_id', 'left');
        $this->db->join('mdioceses', 'mdioceses.id = mparishes.mdiocese_id', 'left');
        $this->db->join('mstates', 'mstates.id = mparishes.mstate_id', 'left');
        $this->db->join('mcountries', 'mcountries.id = mstates.mcountry_id', 'left');
        $this->db->where('mparishes.mparish_id', $mparish_id);
        $this->db->where('mparishes.status', 1);
        $query_parish = $this->db->get();
        $result['parish_data'] = $query_parish->row_array();
        $this->db->select('mlogins.*');
        $this->db->from('mlogins');
        $this->db->where('target_id', $mparish_id);
        $this->db->where('status', 1);
        $query_logins = $this->db->get();
        $result['logins'] = $query_logins->result();
        $mlogin_ids = array_column($result['logins'], 'id');
        $this->db->select('tlogins.*');
        $this->db->select('mlogins.name as name');
        $this->db->from('tlogins');
        $this->db->join('mlogins', 'mlogins.id = tlogins.mlogin_id', 'left');
        $this->db->where_in('mlogins.id', $mlogin_ids);
        $this->db->where('tlogins.status', 1);
        $this->db->order_by('tlogins.login_at', 'desc');
        $query_recentlogins = $this->db->get();
        $result['recentlogins'] = $query_recentlogins->result();
        return $result;
    }

    public function getlogin($where) {
        $this->db->select('mlogins.*');
        $this->db->from('mlogins');
        $this->db->where($where);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    /* ------------------ End profile data ------------------ */

    /* ---------- Start get scc detils  ---------- */

    public function getSccs($id = false, $where = false) {
        $this->db->select('msccs.*');
        $this->db->from('msccs');
        $this->db->group_by('msccs.mscc_id');
        $this->db->order_by('msccs.mscc_id', 'ASC');
        if ($id) {
            $this->db->where($id);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($where) {
            $this->db->where($where);
            $result = $this->db->get();
            return $result->result();
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addScc($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('msccs', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mparishindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['scc_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mparishindex', array('scc_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index);
        $scc_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('mscc_id' => $scc_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('msccs', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $scc_id;
        }
        return $result;
    }

    /* ---------- Start get scc details  ---------- */

    /* ---------- Start get family details  ---------- */

    public function getFamilies($id = false, $where = false) {
        $this->db->select('mfamilies.*, msccs.name as scc_name, mstates.name as state_name, mcountries.name as country_name, mcountries.id as country_id');
        $this->db->from('mfamilies');
        $this->db->join('msccs', 'msccs.mscc_id = mfamilies.mscc_id', 'left');
        $this->db->join('mstates', 'mstates.id = mfamilies.mstate_id', 'left');
        $this->db->join('mcountries', 'mcountries.id = mstates.mcountry_id', 'left');
        $this->db->order_by('mfamilies.firstname', 'ASC');
        if ($id) {
            $this->db->where($id);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($where) {
            $this->db->where($where);
            $result = $this->db->get();
            return $result->result();
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addFamily($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('mfamilies', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mparishindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['family_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mparishindex', array('family_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index, 4);
        $family_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('mfamily_id' => $family_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('mfamilies', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $family_id;
        }
        return $result;
    }

    /* ---------- Start get family details  ---------- */

    /* ---------- Start get member details  ---------- */

    public function getMembers($id = false, $where = false) {
        $this->db->select('mmembers.*,'
                . ' mgenders.name as gender,'
                . ' mqualifications.name as qualification,'
                . ' moccupations.name as occupation,'
                . ' msccs.name as scc_name,'
                . ' mfamilies.firstname as family_firstname,'
                . ' mfamilies.lastname as family_lastname,'
                . ' mstates.name as state_name,'
                . ' mcountries.name as country_name, mcountries.id as country_id');
        $this->db->from('mmembers');
        $this->db->join('mgenders', 'mgenders.id = mmembers.mgender_id', 'left');
        $this->db->join('mqualifications', 'mqualifications.id = mmembers.mqualification_id', 'left');
        $this->db->join('moccupations', 'moccupations.id = mmembers.moccupation_id', 'left');
        $this->db->join('msccs', 'msccs.mscc_id = mmembers.mscc_id', 'left');
        $this->db->join('mfamilies', 'mfamilies.mfamily_id = mmembers.mfamily_id', 'left');
        $this->db->join('mstates', 'mstates.id = mmembers.mstate_id', 'left');
        $this->db->join('mcountries', 'mcountries.id = mstates.mcountry_id', 'left');
        $this->db->order_by('mmembers.firstname', 'ASC');
        if ($id) {
            $this->db->where($id);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($where) {
            $this->db->where($where);
            $result = $this->db->get();
            return $result->result();
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addMember($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('mmembers', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mparishindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['member_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mparishindex', array('member_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index, 6);
        $member_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('mmember_id' => $member_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('mmembers', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $member_id;
        }
        return $result;
    }

    /* ---------- End member details  ---------- */

    /* ---------- Start register details  ---------- */

    public function getRegisters($id = false, $member = false, $mevent_id = false, $where = false) {
        $select_member_data = ' mmembers.firstname as member_firstname, mmembers.lastname as member_lastname,';
        if ($mevent_id == 4) {
            $select_member_data = ' mgroom.firstname as groom_firstname, mgroom.lastname as groom_lastname,'
                    . 'mbride.firstname as bride_firstname, mbride.lastname as bride_lastname,';
        }
        $this->db->select('tevents.*,'
                . ' mevents.name as mevent_name,'
                . $select_member_data
                . ' venueparish.name as venueparish_name,'
                . ' venueparish.city as venueparish_city');
        $this->db->from('tevents');
        $this->db->join('mevents', 'mevents.id = tevents.mevent_id', 'left');
        $this->db->join('`mparishes` `homeparish`', 'homeparish.mparish_id = tevents.mparish_id', 'left');
        $this->db->join('`mparishes` `venueparish`', 'venueparish.mparish_id = tevents.venue_mparish_id', 'left');
        if ($mevent_id == 4) {
            $this->db->join('`mmembers` `mgroom`', 'mgroom.mmember_id = tevents.mgroom_id', 'left');
            $this->db->join('`mmembers` `mbride`', 'mbride.mmember_id = tevents.mbride_id', 'left');
        } else {
            $this->db->join('mmembers', 'mmembers.mmember_id = tevents.mmember_id', 'left');
        }
        $this->db->order_by('tevents.created_at', 'DESC');
        if (!empty($mevent_id)) {
            $this->db->where('tevents.mevent_id', $mevent_id);
        }
        $this->db->where('tevents.status', 1);
        if ($id) {
            $this->db->where($id);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($member) {
            $this->db->where($member);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($where) {
            $this->db->where($where);
            $result = $this->db->get();
            return $result->result();
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addRegister($data) {
        $result['result'] = false;
        $mevent_select = $this->db->get_where('mevents', array('id' => $data['mevent_id']));
        $mevent_data = $mevent_select->row_array();
        $mevent_index = strtolower($mevent_data['name']) . '_id';
        $this->db->trans_begin();
        $this->db->insert('tevents', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mregisterindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index[$mevent_index] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mregisterindex', array($mevent_index => $index));
        $padded_index = $this->customlibrary->getpaddedindexregister($index);
        $tevent_id = intval($data['mparish_id'] . $data['mevent_id'] . $padded_index);
        if ($data['mevent_id'] === '4') {
            $this->db->where('mmember_id', $data['mgroom_id']);
            $this->db->update('mmembers', array('marriage_flag' => 1));
            $this->db->where('mmember_id', $data['mbride_id']);
            $this->db->update('mmembers', array('marriage_flag' => 1));
        } else {
            $this->db->where('mmember_id', $data['mmember_id']);
            $this->db->update('mmembers', array(strtolower($mevent_data['name']) . '_flag' => 1));
        }
        $updation_data = array('tevent_id' => $tevent_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('tevents', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $tevent_id;
        }
        return $result;
    }

    /* ---------- End register details  ---------- */

    /* ---------- Start association details  ---------- */

    public function getAssociations($id = false, $where = false) {
        $this->db->select('tassociations.*, massociations.name as association_name, massociations.abbreviation as association_abbreviation');
        $this->db->from('tassociations');
        $this->db->join('massociations', 'massociations.id = tassociations.massociation_id', 'left');
        $this->db->order_by('tassociations.from_date', 'DESC');
        $this->db->where('tassociations.status', 1);
        if ($id) {
            $this->db->where($id);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($where) {
            $this->db->where($where);
            $result = $this->db->get();
            return $result->result();
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addAssociation($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('tassociations', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mparishindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['association_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mparishindex', array('association_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index, 5);
        $association_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('tassociation_id' => $association_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('tassociations', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $association_id;
        }
        return $result;
    }

    public function addAssociationMember($data) {
        $result = false;
        $this->db->trans_begin();
        $this->db->insert('tassociationmembers', $data);
        $id = $this->db->insert_id();
        $association_index = $this->db->get_where('tassociations', array('tassociation_id' => $data['tassociation_id'], 'status' => 1));
        $selected_index = $association_index->row_array();
        $index = $selected_index['member_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('tassociations', array('member_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index, 3);
        $tassociationmember_id = intval($data['tassociation_id'] . $padded_index);
        $updation_data = array('tassociationmember_id' => $tassociationmember_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('tassociationmembers', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result = true;
        }
        return $result;
    }

    /* ---------- End association details  ---------- */

    /* ---------- Start get convent details  ---------- */

    public function getConvents($id = false, $where = false) {
        $this->db->select('mconvents.*, mcongregations.name as congregation_name, mstates.name as state_name, mcountries.name as country_name, mcountries.id as country_id');
        $this->db->from('mconvents');
        $this->db->join('mcongregations', 'mcongregations.id = mconvents.mcongregation_id', 'left');
        $this->db->join('mstates', 'mstates.id = mconvents.mstate_id', 'left');
        $this->db->join('mcountries', 'mcountries.id = mstates.mcountry_id', 'left');
        $this->db->order_by('mconvents.name', 'ASC');
        $this->db->where('mconvents.status', 1);
        if ($id) {
            $this->db->where($id);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($where) {
            $this->db->where($where);
            $result = $this->db->get();
            return $result->result();
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addConvent($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('mconvents', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mparishindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['convent_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mparishindex', array('convent_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index, 4);
        $convent_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('mconvent_id' => $convent_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('mconvents', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $convent_id;
        }
        return $result;
    }

    public function addConventCommunity($data) {
        $result = false;
        $this->db->trans_begin();
        $this->db->insert('tsisters', $data);
        $id = $this->db->insert_id();
        $community_index = $this->db->get_where('mconvents', array('mconvent_id' => $data['mconvent_id'], 'status' => 1));
        $selected_index = $community_index->row_array();
        $index = $selected_index['member_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mconvents', array('member_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index, 3);
        $tcommunitymember_id = intval($data['mconvent_id'] . $padded_index);
        $updation_data = array('tsister_id' => $tcommunitymember_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('tsisters', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result = true;
        }
        return $result;
    }

    /* ---------- Start get convent details  ---------- */

    /* ---------- Start get institution details  ---------- */

    public function getInstitutions($id = false, $where = false) {
        $this->db->select('tinstitutions.*, minstitutions.name as institution_type_name, mstates.name as state_name, mcountries.name as country_name, mcountries.id as country_id');
        $this->db->from('tinstitutions');
        $this->db->join('minstitutions', 'minstitutions.id = tinstitutions.minstitution_id', 'left');
        $this->db->join('mstates', 'mstates.id = tinstitutions.mstate_id', 'left');
        $this->db->join('mcountries', 'mcountries.id = mstates.mcountry_id', 'left');
        $this->db->order_by('tinstitutions.name', 'ASC');
        $this->db->where('tinstitutions.status', 1);
        if ($id) {
            $this->db->where($id);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($where) {
            $this->db->where($where);
            $result = $this->db->get();
            return $result->result();
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addInstitution($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('tinstitutions', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mparishindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['convent_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mparishindex', array('institution_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index, 4);
        $institution_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('tinstitution_id' => $institution_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('tinstitutions', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $institution_id;
        }
        return $result;
    }

    /* ---------- Start get institution details  ---------- */

    /* ---------- Start get Catechist details  ---------- */

    public function getCatechists($where = false) {
        $this->db->select('mcatechists.*, mmembers.firstname as firstname, mmembers.lastname as lastname');
        $this->db->from('mcatechists');
        $this->db->join('mmembers', 'mmembers.mmember_id = mcatechists.mmember_id', 'left');
        $this->db->order_by('mmembers.firstname', 'ASC');
        $this->db->where('mcatechists.status', 1);
        if ($where) {
            $this->db->where($where);
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addCatechist($data) {
        $result = false;
        $this->db->trans_begin();
        $this->db->insert('mcatechists', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mparishindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['catechist_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mparishindex', array('catechist_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index);
        $catechist_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('mcatechist_id' => $catechist_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('mcatechists', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result = true;
        }
        return $result;
    }

    /* ---------- End get Catechist details  ---------- */

    /* ---------- Start get substation detils  ---------- */

    public function getSubstations($id = false, $where = false) {
        $this->db->select('msubstations.*');
        $this->db->from('msubstations');
        $this->db->order_by('msubstations.name', 'ASC');
        $this->db->where('msubstations.status', 1);
        if ($id) {
            $this->db->where($id);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($where) {
            $this->db->where($where);
            $result = $this->db->get();
            return $result->result();
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addSubstation($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('msubstations', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mparishindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['substation_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('mparishindex', array('substation_id' => $index));
        $padded_index = $this->customlibrary->getpaddedindexparish($index);
        $substation_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('msubstation_id' => $substation_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('msubstations', $updation_data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $substation_id;
        }
        return $result;
    }

    /* ---------- Start get scc details  ---------- */

    public function getStatistics($year) {
        $result = [];
        $this->db->select('count(tevents.id) as nos');
        $this->db->from('tevents');
        $this->db->join('mmembers', 'mmembers.mmember_id = tevents.mmember_id', 'left');
        $this->db->where('datediff(tevents.date,mmembers.dateofbirth)/365.25 < 1');
        $this->db->where('year(tevents.date)', $year);
        $this->db->where('tevents.mevent_id = 1');
        $this->db->where('tevents.status =1');
        $this->db->where('mmembers.status =1');
        $baptism_query = $this->db->get();
        $result['baptism<1'] = $baptism_query->row_array();
        $this->db->select('count(tevents.id) as nos');
        $this->db->from('tevents');
        $this->db->join('mmembers', 'mmembers.mmember_id = tevents.mmember_id', 'left');
        $this->db->where('datediff(tevents.date,mmembers.dateofbirth)/365.25 >= 1');
        $this->db->where('datediff(tevents.date,mmembers.dateofbirth)/365.25 <= 7');
        $this->db->where('year(tevents.date)', $year);
        $this->db->where('tevents.mevent_id = 1');
        $this->db->where('tevents.status =1');
        $this->db->where('mmembers.status =1');
        $baptism_query = $this->db->get();
        $result['baptism1to7'] = $baptism_query->row_array();
        $this->db->select('count(tevents.id) as nos');
        $this->db->from('tevents');
        $this->db->join('mmembers', 'mmembers.mmember_id = tevents.mmember_id', 'left');
        $this->db->where('datediff(tevents.date,mmembers.dateofbirth)/365.25 > 7');
        $this->db->where('year(tevents.date)', $year);
        $this->db->where('tevents.mevent_id = 1');
        $this->db->where('tevents.status =1');
        $this->db->where('mmembers.status =1');
        $baptism_query = $this->db->get();
        $result['baptism>7'] = $baptism_query->row_array();
        $this->db->select('count(tevents.id) as nos');
        $this->db->from('tevents');
        $this->db->join('mmembers', 'mmembers.mmember_id = tevents.mmember_id', 'left');
        $this->db->where('year(tevents.date)', $year);
        $this->db->where('tevents.mevent_id = 3');
        $this->db->where('tevents.status =1');
        $this->db->where('mmembers.status =1');
        $confirmation_query = $this->db->get();
        $result['confirmations'] = $confirmation_query->row_array();
        $this->db->select('count(tevents.id) as nos');
        $this->db->from('tevents');
        $this->db->join('mmembers', 'mmembers.mmember_id = tevents.mmember_id', 'left');
        $this->db->where('year(tevents.date)', $year);
        $this->db->where('tevents.mevent_id = 2');
        $this->db->where('tevents.status =1');
        $this->db->where('mmembers.status =1');
        $communion_query = $this->db->get();
        $result['communions'] = $communion_query->row_array();
        $this->db->select('count(tevents.id) as nos');
        $this->db->from('tevents');
        $this->db->join('mmembers', 'mmembers.mmember_id = tevents.mmember_id', 'left');
        $this->db->where('year(tevents.date)', $year);
        $this->db->where('tevents.mevent_id = 6');
        $this->db->where('tevents.status =1');
        $this->db->where('mmembers.status =1');
        $death_query = $this->db->get();
        $result['deaths'] = $death_query->row_array();
        $this->db->select('count(tevents.id) as nos');
        $this->db->from('tevents');
        $this->db->join('mmembers', 'mmembers.mmember_id = tevents.mgroom_id', 'left');
        $this->db->where('year(tevents.date)', $year);
        $this->db->where('tevents.mevent_id = 4');
        $this->db->where('tevents.status =1');
        $this->db->where('mmembers.status =1');
        $marraige_query = $this->db->get();
        $result['marriages'] = $marraige_query->row_array();
        $this->db->select('count(mcatechists.id) as nos');
        $this->db->from('mcatechists');
        $this->db->join('mmembers', 'mmembers.mmember_id = mcatechists.mmember_id', 'left');
        $this->db->where('mcatechists.status =1');
        $this->db->where('mmembers.status =1');
        $catechist_query = $this->db->get();
        $result['catechists'] = $catechist_query->row_array();
        $this->db->select('count(id) as nos');
        $this->db->from('mmembers');
        $this->db->where('mmembers.membersince <= ', $year . '-12-31');
        $this->db->where('mmembers.active =1');
        $this->db->where('mmembers.death_flag = 0');
        $this->db->where('mmembers.status =1');
        $members_query = $this->db->get();
        $result['members'] = $members_query->row_array();
        return $result;
    }

    /* ---------- End statistics details  ---------- */

    /* ---------- Start donation details  ---------- */

    public function getDonations($id = false, $where = false) {
        $this->db->select('ttransactions.*');
        $this->db->select('tledgers.name as particular');
        $this->db->from('ttransactions');
        $this->db->join('tledgers', 'tledgers.tledger_id=ttransactions.tledger_id', 'left');
        $this->db->where('ttransactions.status', 1);
        $this->db->order_by('ttransactions.date', 'DESC');
        if ($id) {
            $this->db->where($id);
            $result = $this->db->get();
            return $result->row_array();
        }
        if ($where) {
            $this->db->where($where);
        }
        $result = $this->db->get();
        return $result->result();
    }

    /* ---------- End donation details  ---------- */

    public function getTables($name = false) {
        if ($name) {
            $result['fields'] = $this->db->list_fields($name);
            $table_data_select = $this->db->get($name);
            $result['rows'] = $table_data_select->result();
        } else {
            $result = $this->db->list_tables();
        }
        return $result;
    }

    public function getTableRowData($table, $id) {
        $result['fields'] = $this->db->field_data($table);
        $table_row_data_select = $this->db->get_where($table, array('id' => $id));
        $result['row_data'] = $table_row_data_select->row_array();
        return $result;
    }

}
