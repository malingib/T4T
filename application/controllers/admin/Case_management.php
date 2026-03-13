<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Case_management extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('case_model');
        $this->load->model('student_model');
        $this->load->model('wallet_model');
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('case_management', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Welfare');
        $this->session->set_userdata('sub_menu', 'case_management/index');
        $data['title'] = 'Case List';
        $data['cases'] = $this->case_model->get();
        $this->load->view('layout/header', $data);
        $this->load->view('admin/cases/index', $data);
        $this->load->view('layout/footer', $data);
    }

    public function create()
    {
        if (!$this->rbac->hasPrivilege('case_management', 'can_add')) {
            access_denied();
        }
        $this->form_validation->set_rules('member_id', $this->lang->line('member'), 'required');
        $this->form_validation->set_rules('relative_name', 'Relative Name', 'required');
        $this->form_validation->set_rules('relationship', 'Relationship', 'required');
        $this->form_validation->set_rules('target_amount', 'Target Amount', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['members'] = $this->student_model->get();
            $this->load->view('layout/header');
            $this->load->view('admin/cases/create', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'member_id' => $this->input->post('member_id'),
                'relative_name' => $this->input->post('relative_name'),
                'relationship' => $this->input->post('relationship'),
                'description' => $this->input->post('description'),
                'target_amount' => $this->input->post('target_amount'),
                'status' => 'active'
            );
            $this->case_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Case created successfully</div>');
            redirect('admin/case_management');
        }
    }

    public function contribute()
    {
        $case_id = $this->input->post('case_id');
        $member_id = $this->input->post('member_id');
        $amount = $this->input->post('amount');

        // Try to pay from wallet
        if ($this->wallet_model->pay($member_id, $amount, "Contribution for case ID: $case_id", "CASE_$case_id")) {
            $data = array(
                'case_id' => $case_id,
                'member_id' => $member_id,
                'amount' => $amount,
                'payment_method' => 'wallet'
            );
            $this->case_model->add_contribution($data);
            echo json_encode(array('status' => 'success', 'message' => 'Contribution successful'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Insufficient wallet balance'));
        }
    }
}
