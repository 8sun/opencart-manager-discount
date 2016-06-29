<?php
/**
 * History Controller
 * The full description is in the root of a package
 * 
 * @copyright (c) 2016, 8sun Empire
 * @license https://opensource.org/licenses/mit-license.php The MIT License (MIT)
 * @author Simon Bran
 * @version 0.9.1
 * @package opencart_1.5.x_statuses
 */
class ControllerAccountHistory extends Controller
{

    public function index()
    {
        $json = array();
        $this->language->load('account/history');
        $this->load->model('account/history');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {

            if ($this->customer->isLogged()) {

                if ($this->hasStatus($this->request->get['order_id']) === true) {

                    $this->model_account_history->addOrderHistory($this->request->get['order_id'], $this->request->post);

                    $history_model = $this->model_account_history->getOrderHistoryByOrder($this->request->get['order_id']);

                    $history = array(
                        'date_added' => date($this->language->get('date_format_short'), strtotime($history_model['date_added'])),
                        'status' => $history_model['status'],
                        'comment' => nl2br($history_model['comment']),
                        'order_status_id' => $history_model['order_status_id'],
                    );

                    $json['answer'] = $history;
                } else {
                    $json['error'] = $this->language->get('error_order_satus');
                }
            } else {
                $json['error'] = $this->language->get('error_login');
            }
        } else {
            return $this->redirect($this->url->link('account/order'));
        }

        $this->response->setOutput(json_encode($json));
    }

    public function status()
    {

        $json = array();
        $this->language->load('account/history');
        $this->load->model('account/history');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ($this->customer->isLogged()) {
                $history_model = $this->model_account_history->getOrderHistoryByOrder($this->request->get['order_id']);

                $json['answer'] = $history_model;
            } else {
                $json['error'] = $this->language->get('error_login');
            }
        } else {
            return $this->redirect($this->url->link('account/order'));
        }
        $this->response->setOutput(json_encode($json));
    }

    private function hasStatus($order_id)
    {
        $this->load->model('account/history');
        $history_model = $this->model_account_history->getOrderHistoryByOrder($order_id);
        if ($history_model['order_status_id'] == $this->config->status["Closed"] || $history_model['order_status_id'] == $this->config->status["Canceled"]) {
            return false;
        } else {
            return true;
        }
    }
}
