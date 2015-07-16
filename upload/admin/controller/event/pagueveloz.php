<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
class ControllerEventPagueveloz extends Controller {
	
	public function postAdminOrderAdd($order_id) {
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
			
			$data['Conteudo'] = $this->config->get('pagueveloz_text_order_add');
			
			$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');
		}
	}
	
	public function postAdminOrderEdit($order_id) {
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
	
	public function postAdminOrderDelete($order_id) {
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
	
	public function postAdminOrderHistoryAdd($order_id) {
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
	
	public function postAdminCustomerAdd($customer_id) {
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
				
				$data['Conteudo'] = $this->config->get('pagueveloz_text_customer_add');
				
				$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');	
			}
		}
	}
	
	public function postAdminCustomerEdit($customer_id) {
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

	public function postAdminReviewEdit($review_id) {
		$this->load->model('catalog/review');
	
		$review_info = $this->model_account_customer->getReview($review_id);
		
		if ($review_info['customer_id'] > 0) {
			$this->load->model('account/customer');
			
			$account_info = $this->model_account_customer->getCustomer($review_info['customer_id']);
			
			if ($account_info) {
				$this->load->model('payment/pagueveloz');
			
				$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
				
				$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
				if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
					$TelefoneDestino = '55' . $TelefoneDestino;
				}
				
				$data['TelefoneDestino'] = $TelefoneDestino;
				
				$data['Conteudo'] = $this->config->get('pagueveloz_text_admin_review_edit');
				
				$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');	
			}
		}
	}
	
	public function postAdminAffiliateApprove($affiliate_id) {
		$this->load->model('marketing/affiliate');
		
		$affiliate_info = $this->model_marketing_affiliate->getAffiliate($affiliate_id);
		
		if ($affiliate_info) {
				$this->load->model('payment/pagueveloz');
			
				$data['TelefoneRemetente'] = preg_replace('/\D/', '', $this->config->get('pagueveloz_sms_telephone'));
				
				$TelefoneDestino = !empty($order_info['fax']) ? $order_info['fax'] : $order_info['telephone'];
				
				if (strlen($TelefoneDestino) == 10 || strlen($TelefoneDestino) == 11) {
					$TelefoneDestino = '55' . $TelefoneDestino;
				}
				
				$data['TelefoneDestino'] = $TelefoneDestino;
				
				$data['Conteudo'] = $this->config->get('pagueveloz_text_admin_affiliate_approve');
				
				$this->model_payment_pagueveloz->transition('v1/MensagemSMS', $data, 'POST');	
			}
	}
}