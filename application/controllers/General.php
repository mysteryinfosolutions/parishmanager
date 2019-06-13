<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
    /* --------------- ajax controller --------------- */

    public function __construct() {
        parent::__construct();
        $this->load->model('pm_model');
    }

    public function getStates() {
        $id = $this->myencrypt->decrypt_url($this->input->post('id'));
        $states = $this->pm_model->getData('mstates', (array('mcountry_id' => $id, 'status' => 1)));
        $out = '<option value="">No results found</option>';
        if (isset($states)) {
            $out = '<option value="">Nothing selected</option>';
            foreach ($states as $state) :
                $out .= '<option value="' . $this->myencrypt->encrypt_url($state->id) . '">' . $state->name . '</option>';
            endforeach;
        }
        echo $out;
    }

    public function getFamilies() {
        $id = $this->myencrypt->decrypt_url($this->input->post('id'));
        $families = $this->pm_model->getData('mfamilies', array('mscc_id' => $id, 'status' => 1));
        $out = '<option value="">No results found</option>';
        if (isset($families)) {
            $out = '<option value="">Nothing selected</option>';
            foreach ($families as $family) :
                $out .= '<option value="' . $this->myencrypt->encrypt_url($family->mfamily_id) . '">' . ucfirst($family->firstname) . " " . ucfirst($family->lastname) . '</option>';
            endforeach;
        }
        echo $out;
    }

    public function getFamilyAddress() {
        $id = $this->myencrypt->decrypt_url($this->input->post('id'));
        $op = $this->input->post('op');
        $countries = $this->pm_model->getData('mcountries', array('status' => 1));
        $family['addressline1'] = "";
        $family['addressline2'] = null;
        $family['city'] = null;
        $family['pincode'] = null;
        if (isset($countries)) {
            $country_data = '<option value="">Nothing selected</option>';
            foreach ($countries as $country) :
                $country_data .= '<option value="' . $this->myencrypt->encrypt_url($country->id) . '"';
                $country_data .= '>' . $country->name . '</option>';
            endforeach;
        }
        $state_data = '<option value="">Nothing selected</option>';
        if ($id) {
            if ($op === '1') {
                $family = $this->pm_model->getFamilies(array('mfamily_id' => $id));
                $family_state = $this->pm_model->getRowData('mstates', array('id' => $family['mstate_id']));
                $states = $this->pm_model->getData('mstates', array('mcountry_id' => $family_state['mcountry_id']));

                if (isset($countries)) {
                    $country_data = '<option value="">Nothing selected</option>';
                    foreach ($countries as $country) :
                        $country_data .= '<option value="' . $this->myencrypt->encrypt_url($country->id) . '"';
                        if (isset($family_state)) {
                            if ($family_state['mcountry_id'] === $country->id) {
                                $country_data .= 'selected="true"';
                            }
                        }
                        $country_data .= '>' . $country->name . '</option>';
                    endforeach;
                }
                if (isset($states)) {
                    $state_data = '<option value="">Nothing selected</option>';
                    foreach ($states as $state) :
                        $state_data .= '<option value="' . $this->myencrypt->encrypt_url($state->id) . '"';
                        if (isset($family)) {
                            if ($family['mstate_id'] === $state->id) {
                                $state_data .= 'selected="true"';
                            }
                        }
                        $state_data .= '>' . $state->name . '</option>';
                    endforeach;
                }
            }
        }
        $out = array(
            'family' => $family,
            'country' => $country_data,
            'state' => $state_data
        );
        echo json_encode($out);
    }

}
