<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
class ControllerEventPagueveloz extends Controller {
	
	public function postOrderAdd($order_id) {
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($order_id);
		
		if ($order_info) {
			$this->load->model('payment/pagueveloz');
		
			$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
			
			$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
			if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
				$TelefoneDestino = '55' . $TelefoneDestino;
			}
			
			$data['TelefoneDestino'] = $TelefoneDestino;
			
			$data['AgendarPara'] = date('d/m/Y');
			
			$data['Conteudo'] = $this->config->get('pagueveloz_text_order_add');
			
			$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');
		}
	}
	
	public function postOrderEdit($order_id) {
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($order_id);
		
		if ($order_info) {
			$this->load->model('payment/pagueveloz');
		
			$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
			
			$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
			if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
				$TelefoneDestino = '55' . $TelefoneDestino;
			}
			
			$data['TelefoneDestino'] = $TelefoneDestino;
			
			$data['Conteudo'] = $this->config->get('pagueveloz_text_order_edit');
			
			$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');
		}
	}
	
	public function postOrderDelete($order_id) {
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($order_id);
		
		if ($order_info) {
			$this->load->model('payment/pagueveloz');
		
			$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
			
			$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
			if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
				$TelefoneDestino = '55' . $TelefoneDestino;
			}
			
			$data['TelefoneDestino'] = $TelefoneDestino;
			
			$data['Conteudo'] = $this->config->get('pagueveloz_text_order_delete');
			
			$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');
		}
	}
	
	public function postOrderHistoryAdd($order_id) {
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($order_id);
		
		if ($order_info) {
			$this->load->model('payment/pagueveloz');
		
			$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
			
			$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
			if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
				$TelefoneDestino = '55' . $TelefoneDestino;
			}
			
			$data['TelefoneDestino'] = $TelefoneDestino;
			
			$data['Conteudo'] = $this->config->get('pagueveloz_text_order_history_add');
			
			$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');
		}
	}
	
	public function postReviewAdd($data) {
		if ($this->customer->getId() > 0) {
			$this->load->model('account/customer');
		
			$account_info = $this->model_account_customer->getCustomer($this->customer->getId());
			
			if ($account_info) {
				$this->load->model('payment/pagueveloz');
			
				$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
				
				$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
				if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
					$TelefoneDestino = '55' . $TelefoneDestino;
				}
			
				$data['TelefoneDestino'] = $TelefoneDestino;
				
				$data['Conteudo'] = $this->config->get('pagueveloz_text_review_add');
				
				$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');	
			}
		}
	}
	
	public function postAffiliateAdd($data) {
		$this->load->model('affiliate/affiliate');
		
		$affiliate_info = $this->model_affiliate_affiliate->getAffiliate($this->affiliate->getId());
		
		if ($affiliate_info) {
			$this->load->model('payment/pagueveloz');
			
			$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
			
			$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
			if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
				$TelefoneDestino = '55' . $TelefoneDestino;
			}
			
			$data['TelefoneDestino'] = $TelefoneDestino;
			
			$data['Conteudo'] = $this->config->get('pagueveloz_text_affiliate_add');
			
			$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');
		}
	}
	
	public function postAffiliateEdit($data) {
		$this->load->model('affiliate/affiliate');
		
		$affiliate_info = $this->model_affiliate_affiliate->getAffiliate($this->affiliate->getId());
		
		if ($affiliate_info) {
			$this->load->model('payment/pagueveloz');
			
			$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
			
			$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
			if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
				$TelefoneDestino = '55' . $TelefoneDestino;
			}
			
			$data['TelefoneDestino'] = $TelefoneDestino;
			
			$data['Conteudo'] = $this->config->get('pagueveloz_text_affiliate_edit');
			
			$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');
		}
	}
	
	public function postCustomerAdd($customer_id) {
		
		$this->session->data['postCustomerAdd'] = $customer_id;
		
		if ($this->customer->getId() > 0) {
			$this->load->model('account/customer');
		
			$account_info = $this->model_account_customer->getCustomer($customer_id);
			
			if ($account_info) {
				$this->load->model('payment/pagueveloz');
			
				$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));

				$TelefoneDestino = !empty($account_info['fax']) ? $account_info['fax'] : $account_info['telephone'];
				
				if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
					$TelefoneDestino = '55' . $TelefoneDestino;
				}
				
				$data['TelefoneDestino'] = $TelefoneDestino;
				
				$data['Conteudo'] = $this->config->get('pagueveloz_text_customer_add');
				
				$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');
			}
		}
	}
	
	public function postCustomerEdit($customer_id) {
		if ($this->customer->getId() > 0) {
			$this->load->model('account/customer');
		
			$account_info = $this->model_account_customer->getCustomer($customer_id);
			
			if ($account_info) {
				$this->load->model('payment/pagueveloz');
			
				$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
				
				$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
				if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
					$TelefoneDestino = '55' . $TelefoneDestino;
				}
				
				$data['TelefoneDestino'] = $TelefoneDestino;
				
				$data['Conteudo'] = $this->config->get('pagueveloz_text_customer_edit');
				
				$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');	
			}
		}
	}
}