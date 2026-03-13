<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Wallet_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_balance($member_id)
    {
        $wallet = $this->db->get_where('wallets', array('member_id' => $member_id))->row_array();
        return $wallet ? $wallet['balance'] : 0.00;
    }

    public function deposit($member_id, $amount, $description = '', $reference = '')
    {
        $this->db->trans_start();

        // Ensure wallet exists
        $wallet = $this->db->get_where('wallets', array('member_id' => $member_id))->row_array();
        if (!$wallet) {
            $this->db->insert('wallets', array('member_id' => $member_id, 'balance' => 0));
            $wallet_id = $this->db->insert_id();
        } else {
            $wallet_id = $wallet['id'];
        }

        // Update balance
        $this->db->set('balance', 'balance + ' . (float)$amount, FALSE);
        $this->db->where('id', $wallet_id);
        $this->db->update('wallets');

        // Log transaction
        $this->db->insert('wallet_transactions', array(
            'wallet_id' => $wallet_id,
            'amount' => $amount,
            'type' => 'deposit',
            'description' => $description,
            'reference' => $reference
        ));

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function pay($member_id, $amount, $description = '', $reference = '')
    {
        $balance = $this->get_balance($member_id);
        if ($balance < $amount) {
            return false;
        }

        $this->db->trans_start();
        $wallet = $this->db->get_where('wallets', array('member_id' => $member_id))->row_array();
        $wallet_id = $wallet['id'];

        $this->db->set('balance', 'balance - ' . (float)$amount, FALSE);
        $this->db->where('id', $wallet_id);
        $this->db->update('wallets');

        $this->db->insert('wallet_transactions', array(
            'wallet_id' => $wallet_id,
            'amount' => $amount,
            'type' => 'payment',
            'description' => $description,
            'reference' => $reference
        ));

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
