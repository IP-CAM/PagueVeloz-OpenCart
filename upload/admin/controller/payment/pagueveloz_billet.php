<?php
/*
	Author: Valdeir Santana
	Site: http://www.valdeirsantana.com.br
*/
class ControllerPaymentPagueVelozBillet extends Controller {
	
	public function index() {
		$this->response->redirect($this->url->link('payment/pagueveloz', 'token=' . $this->session->data['token'], 'SSL'));
	}
}