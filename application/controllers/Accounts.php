<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("account_model");
        if ($this->session->has_userdata('user')) {
            $user = $this->session->userdata('user');
            if ($user['role_name'] !== 'Parish') {
                $this->session->set_userdata("warning_message", "Please login to continue.");
                redirect('logout');
            }
        } else {
            $this->session->set_userdata("warning_message", "Please login to continue.");
            redirect('logout');
        }
    }

    public function finanacialyearsetcheck() {
        if (!$this->session->has_userdata('financialyear')) {
            $financialyear = $this->account_model->getRowData('mfinancialyears', array('active' => 1, 'status' => 1));
            if (isset($financialyear)) {
                $this->session->set_userdata("financialyear", $financialyear);
            } else {
                $financialyears = $this->account_model->getData('mfinancialyears');
                if (!empty($financialyears)) {
                    $this->session->set_userdata("warning", "Select financial year");
                    redirect('accounts/financialyears');
                } else {
                    $this->session->set_userdata("error", "Add financial year first");
                    redirect('accounts/managefinancialyear');
                }
            }
        }
    }

    public function view($page = 'dashboard', $data = []) {
        if (!file_exists(APPPATH . 'views/accounts/' . $page . '.php')) {
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

        if ($page === "managefinancialyear") {
            $settings_data['name'] = "Managefinancialyear";
            $data['settings_data'] = $settings_data;
        } else if ($page === "financialyears") {
            $settings_data['name'] = "Financialyears";
            $data['settings_data'] = $settings_data;
        } else {
            $this->finanacialyearsetcheck();
        }



        // Reading user data
        $data['user'] = $this->session->userdata("user");
        $data['parishdetails'] = $this->session->userdata("parish");
        $data['base_url'] = base_url() . strtolower("accounts/");
        $data['title'] = ucfirst($page);

        if ($page === 'dashboard') {
            $data['financialyear'] = $this->session->userdata('financialyear');
            $data['dashboard_data'] = $this->account_model->getDashboardData(array('mparish_id' => $data['parishdetails']['mparish_id']), array('mfinancialyear_id' => $data['financialyear']['mfinancialyear_id']));
        }

        $data['themes'] = $this->session->userdata("themes");
        $this->load->view('accounts/header', $data);
        $this->load->view('accounts/' . $page, $data);
        $this->load->view('accounts/footer', $data);
    }

    /* ------------------ End view page ------------------ */

    /* ------------------ Start financial year ------------------ */

    public function financialyears() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('financialyear_id'));
            $data['financialyear'] = $this->account_model->getFinancialyears(array('mfinancialyears.mfinancialyear_id' => $id));
        } else {
            $data['financialyears'] = $this->account_model->getFinancialyears();
        }
        $settings_data['name'] = "Financialyear";
        $data['settings_data'] = $settings_data;
        $this->view('financialyears', $data);
    }

// manage
    public function managefinancialyear() {
        $data = [];
        if ($this->input->post('submit')) {
            $financialyear_data = array(
                'yearset' => $this->input->post('form_yearset'),
                'start_date' => $this->input->post('form_start_date'),
                'end_date' => $this->input->post('form_end_date'),
                'receipt_prefix' => $this->input->post('form_receipt_prefix'),
                'receipt_suffix' => $this->input->post('form_receipt_suffix'),
                'payment_prefix' => $this->input->post('form_payment_prefix'),
                'payment_suffix' => $this->input->post('form_payment_suffix'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));

                $result = $this->account_model->setData('mfinancialyears', array('mfinancialyear_id' => $id), $financialyear_data);
                $action = "Updation";
            } else {
                $insert_result = $this->account_model->addFinancialyear($financialyear_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('accounts/financialyears?financialyear_id=' . $this->myencrypt->encrypt_url($id) . '&view=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['financialyear'] = $this->account_model->getFinancialyears(array('mfinancialyears.mfinancialyear_id' => $id));
            } else {
                if ($this->input->get('delete')) {
                    $result = $this->account_model->deleteByStatus('mfinancialyears', array('mfinancialyear_id' => $id));
                    $action = "Deletion";
                    if ($result) {
                        $this->session->set_userdata('success', $action . ' successful.');
                    } else {
                        $this->session->set_userdata('error', $action . ' failed');
                    }
                    redirect('accounts/financialyears');
                } else if ($this->input->get('activate')) {
                    $inactivate = $this->account_model->setData('mfinancialyears', array('active' => 1, 'status' => 1), array('active' => 0));

                    $activate = $this->account_model->setData('mfinancialyears', array('mfinancialyear_id' => $id, 'status' => 1), array('active' => 1));
                    $financialyear = $this->account_model->getRowData('mfinancialyears', array('active' => 1, 'status' => 1));
                    if (isset($financialyear)) {
                        $this->session->set_userdata("financialyear", $financialyear);
                        $this->session->set_userdata('success', "Financial year has been changed.");
                    }
                    if ($activate) {
                        redirect('accounts/dashboard');
                    } else {
                        $this->session->set_userdata('error', 'Something went wrong');
                        redirect('accounts/financialyears');
                    }
                }
            }
        }
        $this->view('managefinancialyear', $data);
    }

    /* ------------------ End financial year ------------------ */

    /* ------------------ Start Bank Accounts ------------------ */

    public function bankaccounts() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('bankaccount_id'));
            $data['bankaccount'] = $this->account_model->getBankaccounts(array('mbankaccounts.mbankaccount_id' => $id));
            $data['balance'] = $this->account_model->getBankBalance(array('mbankaccount_id' => $id));
            $data['fixed_deposit'] = $this->account_model->getBankFixedDeposits(array('mbankaccount_id' => $id));
            $data['transactions'] = $this->account_model->getTransactions(false, array('ttransactions.mbankaccount_id' => $id, 'ttransactions.status' => 1));
        } else {
            $data['bankaccounts'] = $this->account_model->getBankaccounts();
        }
        $bank_data['name'] = "accounts";
        $data['bank_data'] = $bank_data;
        $this->view('bankaccounts', $data);
    }

// manage
    public function managebankaccount() {
        $data = [];
        if ($this->input->post('submit')) {
            $bankaccount_data = array(
                'name' => $this->input->post('form_name'),
                'bank_name' => $this->input->post('form_bank_name'),
                'branch' => $this->input->post('form_branch'),
                'account_number' => $this->input->post('form_account_number'),
                'ifsc_code' => $this->input->post('form_ifsc_code'),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks')
            );
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));

                $result = $this->account_model->setData('mbankaccounts', array('mbankaccount_id' => $id), $bankaccount_data);
                $action = "Updation";
            } else {
                $insert_result = $this->account_model->addBankaccount($bankaccount_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('accounts/bankaccounts?bankaccount_id=' . $this->myencrypt->encrypt_url($id) . '&view=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['bankaccount'] = $this->account_model->getBankaccounts(array('mbankaccounts.mbankaccount_id' => $id));
            } else {
                if ($this->input->get('delete')) {
                    $result = $this->account_model->deleteByStatus('mbankaccounts', array('mbankaccount_id' => $id));
                    $action = "Deletion";
                    if ($result) {
                        $this->session->set_userdata('success', $action . ' successful.');
                    } else {
                        $this->session->set_userdata('error', $action . ' failed');
                    }
                    redirect('accounts/bankaccounts');
                }
            }
        }
        $bank_data['name'] = "accounts";
        $data['bank_data'] = $bank_data;
        $this->view('managebankaccount', $data);
    }

    /* ------------------ End Bank Accounts ------------------ */

    /* ------------------ Start transaction ------------------ */

    public function transactions() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('transaction_id'));
            $data['transaction'] = $this->account_model->getTransactions(array('ttransactions.ttransaction_id' => $id));
        } else {
            $mfinancialyear_id = null;
            if ($this->session->has_userdata('financialyear')) {
                $financialyear_data = $this->session->userdata('financialyear');
                $mfinancialyear_id = $financialyear_data['mfinancialyear_id'];
            }
            if ($this->input->get('unlimited')) {
                $data['unlimited'] = true;
                $data['transactions'] = $this->account_model->getTransactions(false, array('mfinancialyear_id' => $mfinancialyear_id));
            } else {
                $data['transactions'] = $this->account_model->getTransactions(FALSE, array('mfinancialyear_id' => $mfinancialyear_id), 10);
            }
        }
        $this->view('transactions', $data);
    }

// manage
    public function managetransaction() {
        $data = [];
        $data['mode'] = "Cash Receipt";
        if ($this->input->get('mode')) {
            $data['mode'] = $this->input->get('mode');
        }
        if ($this->input->post('submit')) {
            $insert = true;
            $cash_debit = null;
            $cash_credit = null;
            $bank_credit = null;
            $bank_debit = null;
            $mbankaccount_id = null;
            $fixed_deposit = 0;
            $mfinancialyear_id = null;
            if ($this->session->has_userdata('financialyear')) {
                $financialyear_data = $this->session->userdata('financialyear');
                $mfinancialyear_id = $financialyear_data['mfinancialyear_id'];
            }

            $mode = $this->input->post('mode');
            if ($mode === 'Cash Receipt') {
                $cash_debit = $this->input->post('form_amount');
            } else if ($mode === 'Cash Payment') {
                $cash_credit = $this->input->post('form_amount');
            } else if ($mode === 'Bank Deposit' || $mode === 'Received to Bank') {
                if ($mode === 'Bank Deposit') {
                    $cash_credit = $this->input->post('form_amount');
                    $fixed_deposit = empty($this->input->post('form_fixed_deposit')) ? 0 : 1;
                }
                $bank_credit = $this->input->post('form_amount');
                $mbankaccount_id = $this->myencrypt->decrypt_url($this->input->post('form_mbankaccount_id'));
            } else if ($mode === 'Bank Withdrawal' || $mode === 'Payment from Bank') {
                if ($mode === 'Bank Withdrawal') {
                    $cash_debit = $this->input->post('form_amount');
                }
                $bank_debit = $this->input->post('form_amount');
                $mbankaccount_id = $this->myencrypt->decrypt_url($this->input->post('form_mbankaccount_id'));
                $bank_balance = $this->account_model->getBankBalance(array('mbankaccount_id' => $mbankaccount_id));
                if (isset($bank_balance['balance'])) {
                    if ($bank_debit > $bank_balance['balance']) {
                        $insert = FALSE;
                        $this->session->set_userdata('warning', 'Insufficient account balance');
                    }
                }
            }
            $transaction_data = array(
                'cash_debit' => $cash_debit,
                'cash_credit' => $cash_credit,
                'mbankaccount_id' => $mbankaccount_id,
                'bank_credit' => $bank_credit,
                'bank_debit' => $bank_debit,
                'fixed_deposit' => $fixed_deposit,
                'date' => $this->input->post('form_date'),
                'mfinancialyear_id' => $mfinancialyear_id,
                'mledger_id' => $this->myencrypt->decrypt_url($this->input->post('form_mledger_id')),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id')),
                'remarks' => $this->input->post('form_remarks')
            );
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
                redirect('accounts/transactions');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['transaction'] = $this->account_model->getTransactions(array('ttransactions.ttransaction_id' => $id));
                $trans_data = $data['transaction'];
                if (isset($trans_data['cash_credit'])) {
                    if (isset($trans_data['bank_credit'])) {
                        $data['mode'] = "Bank Deposit";
                    } else {
                        $data['mode'] = "Cash Payment";
                    }
                } else {
                    if (isset($trans_data['bank_credit'])) {
                        $data['mode'] = "Received to Bank";
                    }
                }
                if (isset($trans_data['cash_debit'])) {
                    if (isset($trans_data['bank_debit'])) {
                        $data['mode'] = "Bank Withdrawal";
                    } else {
                        $data['mode'] = "Cash Receipt";
                    }
                } else {
                    if (isset($trans_data['bank_debit'])) {
                        $data['mode'] = "Payment from Bank";
                    }
                }
            } else {
                if ($this->input->get('delete')) {
                    $result = $this->account_model->deleteByStatus('ttransactions', array('ttransaction_id' => $id));
                    $action = "Deletion";
                } else if ($this->input->get('release')) {
                    $result = $this->account_model->setData('ttransactions', array('ttransaction_id' => $id, 'status' => 1), array('fixed_deposit' => 0));
                    $action = "Fixed deposit released";
                }
                if ($result) {
                    $this->session->set_userdata('success', $action . ' successful.');
                } else {
                    $this->session->set_userdata('error', $action . ' failed');
                }
                redirect('accounts/transactions');
            }
        }
        $data['bankaccounts'] = $this->pm_model->getData('mbankaccounts', array('status' => 1));
        $data['ledgers'] = $this->pm_model->getData('mledgers', array('status' => 1), array('column' => 'name', 'order' => 'ASC'));
        $this->view('managetransaction', $data);
    }

    /* ------------------ End transaction ------------------ */

    /* ------------------ Start Tledgers ------------------ */

    public function tledgers() {
        if ($this->input->get('view')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('tledger_id'));
            $data['tledger'] = $this->account_model->getTledgers(array('tledgers.tledger_id' => $id));
        } else {
            $data['tledgers'] = $this->account_model->getTledgers();
        }
        $settings_data['name'] = "Tledgers";
        $data['settings_data'] = $settings_data;
        $this->view('tledgers', $data);
    }

// manage
    public function managetledger() {
        $data = [];
        if ($this->input->post('submit')) {
            $tledger_data = array(
                'name' => $this->input->post('form_name'),
                'mledger_id' => $this->myencrypt->decrypt_url($this->input->post('form_mledger_id')),
                'mparish_id' => $this->myencrypt->decrypt_url($this->input->post('form_mparish_id'))
            );
            if ($this->input->post('edit_id')) {
                $id = $this->myencrypt->decrypt_url($this->input->post('edit_id'));

                $result = $this->account_model->setData('tledgers', array('tledger_id' => $id), $tledger_data);
                $action = "Updation";
            } else {
                $insert_result = $this->account_model->addTledger($tledger_data);
                $result = $insert_result['result'];
                if ($result) {
                    $id = $insert_result['id'];
                }
                $action = "Insertion";
            }
            if ($result) {
                $this->session->set_userdata('success', $action . ' successful.');
                redirect('accounts/tledgers?tledger_id=' . $this->myencrypt->encrypt_url($id) . '&view=true');
            } else {
                $this->session->set_userdata('error', $action . ' failed.');
            }
        }
        if ($this->input->get('id')) {
            $id = $this->myencrypt->decrypt_url($this->input->get('id'));
            if ($this->input->get('edit')) {
                $data['tledger'] = $this->account_model->getTledgers(array('tledgers.tledger_id' => $id));
            } else {
                if ($this->input->get('delete')) {
                    $result = $this->account_model->deleteByStatus('tledgers', array('tledger_id' => $id));
                    $action = "Deletion";
                    if ($result) {
                        $this->session->set_userdata('success', $action . ' successful.');
                    } else {
                        $this->session->set_userdata('error', $action . ' failed');
                    }
                    redirect('accounts/tledgers');
                }
            }
        }
        $settings_data['name'] = "Managetledger";
        $data['settings_data'] = $settings_data;
        $data['mledgers'] = $this->account_model->getData('mledgers');
        $this->view('managetledger', $data);
    }

    /* ------------------ End Tledgers ------------------ */

    /* ------------------ Start report ------------------ */

    public function report() {
        $data = [];
        if ($this->input->post('submit')) {
            $report_data['from_date'] = $this->input->post('form_from_date');
            $report_data['to_date'] = $this->input->post('form_to_date');
            if ($this->input->post('form_summarized')) {
                $data['summarized_report'] = $this->account_model->getSummarizedReport($report_data);
            } else {
                $data['report'] = $this->account_model->getReport($report_data);
            }
        } else {
            if ($this->session->has_userdata('financialyear')) {
                $data['financialyear'] = $this->session->userdata('financialyear');
            }
        }
        $this->view('report', $data);
    }

    /* ------------------ End report ------------------ */
    
    
  
}
