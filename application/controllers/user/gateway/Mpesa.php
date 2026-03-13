<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpesa extends Studentgateway_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('mpesa_lib');
		$this->load->model('paymentsetting_model');
		$this->load->model('wallet_model');
	}

	public function index()
	{
		$data = array();
		$data['params'] = $this->session->userdata('params');
		$data['setting'] = $this->setting_model->get();
		$this->load->view('user/gateway/mpesa/index', $data);
	}

	public function stk_push()
	{
		$params = $this->session->userdata('params');
		$amount = $params['total'];
		$phone = $this->input->post('phone');

		$mpesa_config = $this->paymentsetting_model->getActiveMethod();
		$configs = array(
			'key' => $mpesa_config->api_publishable_key,
			'secret' => $mpesa_config->api_secret_key,
			'passkey' => $mpesa_config->api_password,
			'shortcode' => $mpesa_config->api_signature,
			'env' => 'sandbox' // or 'live'
		);

		$this->mpesa_lib->__construct($configs);
		$response = $this->mpesa_lib->request($phone, $amount, 'T4T_CONTRIBUTION', 'Contribution Payment');

		if (isset($response['ResponseCode']) && $response['ResponseCode'] == '0') {
			echo json_encode(array('status' => 'success', 'message' => 'STK Push sent. Please check your phone.'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Failed to initiate M-Pesa payment.'));
		}
	}

	public function callback()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		// Log the callback data
		file_put_contents(APPPATH . 'logs/mpesa_callback.log', print_r($data, true), FILE_APPEND);

		if (isset($data['Body']['stkCallback']['ResultCode']) && $data['Body']['stkCallback']['ResultCode'] == 0) {
			// Success! Process payment
			$meta = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
			$amount = 0;
			$mpesa_receipt = '';
			foreach($meta as $item) {
				if ($item['Name'] == 'Amount') $amount = $item['Value'];
				if ($item['Name'] == 'MpesaReceiptNumber') $mpesa_receipt = $item['Value'];
			}

			// Logic to update wallet or contribution goes here
			// For simplicity, we assume we know the member_id from reference or session (though callback is async)
		}

		echo json_encode(array('ResultCode' => 0, 'ResultDesc' => 'Accepted'));
	}
}
