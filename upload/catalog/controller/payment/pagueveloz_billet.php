<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
class ControllerPaymentPagueVelozBillet extends Controller {
	public function index() {
		$this->language->load('payment/pagueveloz');
		
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_cpf_cnpj'] = $this->language->get('text_cpf_cnpj');
		$data['text_error'] = $this->language->get('text_error');
		
		$data['button_confirm'] = $this->language->get('button_confirm');
		$data['button_print'] = $this->language->get('button_print');
		
		$data['order_id'] = isset($this->session->data['order_id']) ? $this->session->data['order_id'] : 'invalid';

		$data['continue'] = $this->url->link('payment/pagueveloz_billet/confirm');
		
		if (isset($this->session->data['payment_address']['firstname']) && isset($this->session->data['payment_address']['lastname'])) {
			$data['customer'] = $this->session->data['payment_address']['firstname'] . ' ' . $this->session->data['payment_address']['lastname'];
		} else {
			$data['customer'] = '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pagueveloz_billet.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/pagueveloz_billet.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/pagueveloz_billet.tpl', $data);
		}
	}

	public function generate() {
		
		$this->language->load('payment/pagueveloz');
		
		$this->load->model('payment/pagueveloz');
		
		$this->response->addHeader('Content-Type: application/json');
		
		$json = array();
		
		if (!isset($this->request->get['order_id']) || !is_numeric($this->request->get['order_id'])) {
			$json['error'] = true;
			$json['errors']['error_order_id'] = $this->language->get('error_order_id');
		}
		
		$cpf_cnpj_cedente = preg_replace('/\D/', '', $this->request->post['pagueveloz_cpf']);
		
		if ((strlen($cpf_cnpj_cedente) == 11) && $this->model_payment_pagueveloz->validateCPF($cpf_cnpj_cedente) === false) {
			$json['error'] = true;
			$json['errors']['error_cpf'] = $this->language->get('error_cpf_invalid');
		} 
		
		if ((strlen($cpf_cnpj_cedente) == 15) && $this->model_payment_pagueveloz->validateCNPJ($cpf_cnpj_cedente) === false) {
			$json['error'] = true;
			$json['errors']['error_cnpj'] = $this->language->get('error_cnpj_invalid');
		}
		
		if (!$json) {
			$order_id = (int)$this->request->get['order_id'];
			
			$this->load->model('checkout/order');
			
			$order_info = $this->model_checkout_order->getOrder($order_id);
			
			$date = new DateTime();
			
			$data = array();
			
			$data['Email'] = $order_info['email'];
			$data['Valor'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
			$data['Vencimento'] = $date->modify('+' . $this->config->get('pagueveloz_billet_expiration') . ' days')->format('Y-m-d');
			$data['Sacado'] = $order_info['firstname'] . ' ' . $order_info['lastname'];
			$data['CPFCNPJSacado'] = preg_replace('/[^0-9]/', '', $this->request->post['pagueveloz_cpf']);
			
			if ($this->config->get('pagueveloz_billet_note_1')) {
				$data['Linha1'] = $this->config->get('pagueveloz_billet_note_1');
			}
			
			if ($this->config->get('pagueveloz_billet_note_2')) {
				$data['Linha2'] = $this->config->get('pagueveloz_billet_note_2');
			}
			
			if ($this->config->get('pagueveloz_billet_cedente')) {
				$data['Cedente'] = $this->config->get('pagueveloz_billet_cedente');
			}
			
			if ($this->config->get('pagueveloz_billet_cpfcedente')) {
				$data['CPFCNPJCedente'] = $this->config->get('pagueveloz_billet_cpfcedente');
			}
			
			$result = $this->model_payment_pagueveloz->transition('v3/boleto', $data);
			
			if (filter_var($result, FILTER_VALIDATE_URL)) {
				$json['error'] = false;
				$json['url'] = $result;
			} else {
				$json['error'] = true;
				$json['errors'] = $result;
			};
			
			$this->session->data['pagueveloz_data'] = array();
			$this->session->data['pagueveloz_data']['order_id'] = $order_id;
			$this->session->data['pagueveloz_data']['billet_id'] = preg_replace('/[^0-9$]/', '', $result);
			$this->session->data['pagueveloz_data']['doc'] = preg_replace('/[^0-9]/', '', $this->request->post['pagueveloz_cpf']);
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'pagueveloz_billet') {
			$this->load->model('payment/pagueveloz');
			
			$this->model_payment_pagueveloz->addOrder($this->session->data['pagueveloz_data']);
			
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('pagueveloz_billet_pending'));
			
			$this->response->redirect($this->url->link('checkout/success'));
		}
	}
}