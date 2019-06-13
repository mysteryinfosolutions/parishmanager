<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /* ------------------ Start put data ------------------ */

    public function putData($table, $data) {
        $result = $this->db->insert($table, $data);
        if ($result) {
            $this->checkSyncFlag($table);
        }
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
        $this->db->where('status', 1);
        if ($orderby) {
            $this->db->order_by($orderby['column'], $orderby['order']);
        }
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

    /* ------------------ Start get dashboard data ------------------ */

    public function getDashBoardData($mparish_id = false, $mfinancialyear_id = false) {
        $this->db->select('abs(ifnull(sum(cash_debit),0)-ifnull(sum(cash_credit),0)) as cash_balance');
        $this->db->select('abs(ifnull(sum(bank_credit),0)-ifnull(sum(bank_debit),0)) as bank_balance');
        $this->db->from('ttransactions');
        $this->db->where('ttransactions.fixed_deposit', 0);
        $this->db->where('ttransactions.status', 1);
        if ($mparish_id) {
            $this->db->where($mparish_id);
        }
        $result = $this->db->get();
        $dashboard_data = $result->row_array();
        $this->db->select('ifnull(sum(bank_credit),0) as fixed_deposits');
        $this->db->from('ttransactions');
        $this->db->where('ttransactions.fixed_deposit', 1);
        $this->db->where('ttransactions.status', 1);
        if ($mparish_id) {
            $this->db->where($mparish_id);
        }
        $result1 = $this->db->get();
        $fixed_deposit = $result1->row_array();
        $dashboard_data['fixed_deposits'] = $fixed_deposit['fixed_deposits'];
        $this->db->select('ttransaction_id');
        $this->db->from('ttransactions');
        $this->db->where('ttransactions.status', 1);
        if ($mfinancialyear_id) {
            $this->db->where($mfinancialyear_id);
        }
        $result2 = $this->db->get();
        $transactions = $result2->num_rows();
        $dashboard_data['transactions'] = $transactions;
        return $dashboard_data;
    }

    /* ------------------ End get dashboard data ------------------ */


    /* ---------- Start get financialyear detils  ---------- */

    public function getFinancialyears($id = false, $where = false) {
        $this->db->select('mfinancialyears.*');
        $this->db->from('mfinancialyears');
        $this->db->order_by('mfinancialyears.start_date', 'ASC');
        $this->db->where('mfinancialyears.status', 1);
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

    public function addFinancialyear($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('mfinancialyears', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('maccountindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['financialyear_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('maccountindex', array('financialyear_id' => $index, 'sync_flag' => 1));
        $this->db->where('name', 'maccountindex');
        $this->db->update('ttables', array('sync' => 1));
        $padded_index = $this->customlibrary->getpaddedindexparish($index);
        $financialyear_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('mfinancialyear_id' => $financialyear_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('mfinancialyears', $updation_data);
        $this->setSyncFlag('mfinancialyears');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $financialyear_id;
        }
        return $result;
    }

    /* ---------- Start get financialyear details  ---------- */

    /* ---------- Start get bank acccount detils  ---------- */

    public function getBankaccounts($id = false, $where = false) {
        $this->db->select('mbankaccounts.*');
        $this->db->from('mbankaccounts');
//        $this->db->order_by('mbankaccounts.created_at', 'ASC');
        $this->db->where('mbankaccounts.status', 1);
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

    public function getBankBalance($id = false, $where = false) {
        $this->db->select('IFNULL(sum(bank_credit),0)-IFNULL(sum(bank_debit), 0) as balance');
        $this->db->from('ttransactions');
        $this->db->where('ttransactions.fixed_deposit', 0);
        $this->db->where('ttransactions.status', 1);
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

    public function getBankFixedDeposits($id = false, $where = false) {
        $this->db->select('IFNULL(sum(bank_credit),0) as fixedamount');
        $this->db->from('ttransactions');
        $this->db->where('ttransactions.fixed_deposit', 1);
        $this->db->where('ttransactions.status', 1);
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

    public function addBankaccount($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('mbankaccounts', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('maccountindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['bankaccount_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('maccountindex', array('bankaccount_id' => $index, 'sync_flag' => 1));
        $this->setSyncFlag('maccountindex');
        $padded_index = $this->customlibrary->getpaddedindexparish($index);
        $bankaccount_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('mbankaccount_id' => $bankaccount_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('mbankaccounts', $updation_data);
        $this->setSyncFlag('mbankaccounts');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $bankaccount_id;
        }
        return $result;
    }

    /* ---------- Start get bank account details  ---------- */

    /* ---------- Start get transaction detils  ---------- */

    public function getTransactions($id = false, $where = false, $limit = false) {
        $this->db->select('ttransactions.*,mledgers.name as particular,mbankaccounts.name as account_name,mbankaccounts.account_number as bank_account_number');
        $this->db->from('ttransactions');
        $this->db->join('mledgers', 'mledgers.id = ttransactions.mledger_id', 'left');
        $this->db->join('mbankaccounts', 'mbankaccounts.mbankaccount_id = ttransactions.mbankaccount_id', 'left');
        $this->db->order_by('ttransactions.created_at', 'DESC');
        $this->db->order_by('ttransactions.ttransaction_id', 'DESC');
        $this->db->where('ttransactions.status', 1);
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
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function addtransaction($data, $mode) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('ttransactions', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('mfinancialyears', array('mfinancialyear_id' => $data['mfinancialyear_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        if ($mode === 'Cash Receipt' || $mode === 'Bank Withdrawal' || $mode === 'Received to Bank') {
            $index = $selected_index['receipt_voucher'] + 1;
            $this->db->where('id', $selected_index['id']);
            $this->db->update('mfinancialyears', array('receipt_voucher' => $index, 'syn_flag' => 1));
            $ttransaction_id = 'R' . $data['mfinancialyear_id'] . $index;
            $voucher_number = $selected_index['receipt_prefix'] . $index . $selected_index['receipt_suffix'];
        } else {
            $index = $selected_index['payment_voucher'] + 1;
            $this->db->where('id', $selected_index['id']);
            $this->db->update('mfinancialyears', array('payment_voucher' => $index, 'syn_flag' => 1));
            $ttransaction_id = 'P' . $data['mfinancialyear_id'] . $index;
            $voucher_number = $selected_index['payment_prefix'] . $index . $selected_index['payment_suffix'];
        }
        $this->setSyncFlag('mfinancialyears');
        $updation_data = array('ttransaction_id' => $ttransaction_id, 'voucher_number' => $voucher_number, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('ttransactions', $updation_data);
        $this->setSyncFlag('ttransactions');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $ttransaction_id;
        }
        return $result;
    }

    /* ---------- Start get transaction details  ---------- */

    /* ---------- Start get report  ---------- */

    public function getReport($report_data) {
        if (isset($report_data)) {
            $result['from_date'] = $report_data['from_date'];
            $result['to_date'] = $report_data['to_date'];
        }
        $this->db->select("ifnull(sum(cash_debit),0) as cash_debit");
        $this->db->select("ifnull(sum(cash_credit),0) as cash_credit");
        $this->db->select("ifnull(sum(bank_credit),0) as bank_credit");
        $this->db->select("ifnull(sum(bank_debit),0) as bank_debit");
        $this->db->from('ttransactions');
        $this->db->where('status', 1);
        $this->db->where('fixed_deposit', 0);
        if (isset($report_data)) {
            $this->db->where('date<', $report_data['from_date']);
        }
        $opening_balance_query = $this->db->get();
        $result['opening_balance'] = $opening_balance_query->row_array();
        $this->db->select("ttransactions.*");
        $this->db->select("mledgers.name as particular");
        $this->db->from('ttransactions');
        $this->db->join('mledgers', 'mledgers.id = ttransactions.mledger_id', 'left');
        $this->db->where('ttransactions.status', 1);
        $this->db->where('ttransactions.fixed_deposit', 0);
        if (isset($report_data)) {
            $this->db->where('ttransactions.date>=', $report_data['from_date']);
            $this->db->where('ttransactions.date <=', $report_data['to_date']);
        }
        $report_query = $this->db->get();
        $result['report_data'] = $report_query->result();
        return $result;
    }

    public function getSummarizedReport($report_data) {
        if (isset($report_data)) {
            $result['from_date'] = $report_data['from_date'];
            $result['to_date'] = $report_data['to_date'];
        }
        $this->db->select("ifnull(sum(cash_debit),0) as cash_debit");
        $this->db->select("ifnull(sum(cash_credit),0) as cash_credit");
        $this->db->select("ifnull(sum(bank_credit),0) as bank_credit");
        $this->db->select("ifnull(sum(bank_debit),0) as bank_debit");
        $this->db->from('ttransactions');
        $this->db->where('status', 1);
        $this->db->where('fixed_deposit', 0);
        if (isset($report_data)) {
            $this->db->where('date<', $report_data['from_date']);
        }
        $opening_balance_query = $this->db->get();
        $result['opening_balance'] = $opening_balance_query->row_array();
        $this->db->select("sum(ttransactions.cash_credit) as cash_credit,sum(ttransactions.cash_debit) as cash_debit,sum(ttransactions.bank_credit) as bank_credit,sum(ttransactions.bank_debit) as bank_debit,ttransactions.mledger_id");
        $this->db->select("mledgers.name as particular");
        $this->db->from('ttransactions');
        $this->db->join('mledgers', 'mledgers.id = ttransactions.mledger_id', 'left');
        $this->db->where('ttransactions.status', 1);
        $this->db->where('ttransactions.fixed_deposit', 0);
        if (isset($report_data)) {
            $this->db->where('ttransactions.date>=', $report_data['from_date']);
            $this->db->where('ttransactions.date <=', $report_data['to_date']);
        }
        $this->db->group_by('ttransactions.mledger_id');
//        $this->db->order_by('ttransactions.date', 'ASC');
        $report_query = $this->db->get();
        $result['report_data'] = $report_query->result();
//        echo $this->db->last_query();
//        var_dump($result);
//        exit(0);
        return $result;
    }

    /* ---------- End get report  ---------- */

    /* ---------- Start get tledger details  ---------- */

    public function getTledgers($id = false, $where = false) {
        $this->db->select('tledgers.*, mledgers.name as mledger_name, mledgers.id as mledger_id');
        $this->db->from('tledgers');
        $this->db->join('mledgers', 'mledgers.id = tledgers.mledger_id', 'left');
        $this->db->order_by('tledgers.name', 'ASC');
        $this->db->where('tledgers.status', 1);
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

    public function addTledger($data) {
        $result['result'] = false;
        $this->db->trans_begin();
        $this->db->insert('tledgers', $data);
        $id = $this->db->insert_id();
        $parish_index = $this->db->get_where('maccountindex', array('mparish_id' => $data['mparish_id'], 'status' => 1));
        $selected_index = $parish_index->row_array();
        $index = $selected_index['ledger_id'] + 1;
        $this->db->where('id', $selected_index['id']);
        $this->db->update('maccountindex', array('ledger_id' => $index, 'sync_flag' => 1));
        $this->setSyncFlag('maccountindex');
        $padded_index = $this->customlibrary->getpaddedindexparish($index, 4);
        $tledger_id = intval($data['mparish_id'] . $padded_index);
        $updation_data = array('tledger_id' => $tledger_id, 'status' => 1);
        $this->db->where('id', $id);
        $this->db->update('tledgers', $updation_data);
        $this->setSyncFlag('tledgers');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $result['result'] = true;
            $result['id'] = $tledger_id;
        }
        return $result;
    }

    /* ---------- Start get tledger details  ---------- */
}
