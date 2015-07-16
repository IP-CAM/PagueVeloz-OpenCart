<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
class ControllerPaymentPagueVeloz extends Controller {
	
	public function callback() {
		$this->load->model('payment/pagueveloz');
		$this->load->model('checkout/order');
		
		$orders = $this->model_payment_pagueveloz->getOrders('billet', array('complete' => 0));
		
		foreach($orders as $order) {
			$result = $this->model_payment_pagueveloz->transition('v3/Boleto?IncluirCancelados=true&Documento=' . $order['doc'], array(), 'GET');
			
			$billets = json_decode($result, true);
			
			foreach($billets as $billet) {
				$update = false;
				
				if (strpos($billet['Url'], $order['billet_id'])) {
					if ($billet['ValorPago'] >= $billet['Valor']) {
						$this->model_checkout_order->addOrderHistory($order['order_id'], $this->config->get('pagueveloz_billet_complete'), '', true);
						$update = true;
					} elseif ($billet['Cancelado'] == true) {
						$this->model_checkout_order->addOrderHistory($order['order_id'], $this->config->get('pagueveloz_billet_canceled'), '', true);
						$update = true;
					}
					
					if ($update) {
						$this->model_payment_pagueveloz->updateOrder($order['order_id']);
					
						if ($this->config->get('pagueveloz_sms_status')) {
							$this->load->controller('event/pagueveloz/postOrderHistoryAdd', $order['order_id']);
						}
					}
				}
			}
		}
	}
}