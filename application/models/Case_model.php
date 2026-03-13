<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Case_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id = null)
    {
        $this->db->select('cases.*, students.firstname, students.lastname')->from('cases');
        $this->db->join('students', 'students.id = cases.member_id');
        if ($id != null) {
            $this->db->where('cases.id', $id);
            return $this->db->get()->row_array();
        } else {
            $this->db->order_by('cases.created_at', 'desc');
            return $this->db->get()->result_array();
        }
    }

    public function add($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('cases', $data);
        } else {
            $this->db->insert('cases', $data);
            return $this->db->insert_id();
        }
    }

    public function add_contribution($data)
    {
        $this->db->trans_start();
        $this->db->insert('case_contributions', $data);
        $this->db->set('collected_amount', 'collected_amount + ' . (float)$data['amount'], FALSE);
        $this->db->where('id', $data['case_id']);
        $this->db->update('cases');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
