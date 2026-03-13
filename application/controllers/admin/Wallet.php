<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Wallet extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('wallet_model');
        $this->load->model('student_model');
    }

    public function index()
    {
        $this->session->set_userdata('top_menu', 'Welfare');
        $this->session->set_userdata('sub_menu', 'wallet/index');
        $data['title'] = 'Member Wallets';
        $data['members'] = $this->student_model->get();
        foreach($data['members'] as &$member) {
            $member['balance'] = $this->wallet_model->get_balance($member['id']);
        }
        $this->load->view('layout/header', $data);
        $this->load->view('admin/wallet/index', $data);
        $this->load->view('layout/footer', $data);
    }

    public function deposit()
    {
        $member_id = $this->input->post('member_id');
        $amount = $this->input->post('amount');
        $reference = $this->input->post('reference');

        if ($this->wallet_model->deposit($member_id, $amount, 'Manual Deposit', $reference)) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Deposit successful</div>');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Deposit failed</div>');
        }
        redirect('admin/wallet');
    }
}
