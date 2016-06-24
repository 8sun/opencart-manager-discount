<?php

/**
 * History Model
 * The full description is in the root of a package
 * 
 * @copyright (c) 2016, 8sun Empire
 * @license https://opensource.org/licenses/mit-license.php The MIT License (MIT)
 * @author Simon Bran
 * @version 0.9.0
 * @package opencart_1.5.x_statuses
 */
class ModelAccountHistory extends Model
{

    public function addOrderHistory($order_id, $data)
    {
        $this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int) $data['order_status_id'] . "', date_modified = NOW() WHERE order_id = '" . (int) $order_id . "'");

        $this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int) $order_id . "', order_status_id = '" . (int) $data['order_status_id'] . "', notify = '" . (isset($data['notify']) ? (int) $data['notify'] : 0) . "', comment = '" . $this->db->escape(strip_tags($data['comment'])) . "', date_added = NOW()");
    }

    public function getOrderHistoryByOrder($order_id)
    {
        $query = $this->db->query("SELECT oh.date_added, os.name AS status, oh.comment, oh.notify, oh.order_status_id FROM " . DB_PREFIX . "order_history oh LEFT JOIN " . DB_PREFIX . "order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int) $order_id . "' AND os.language_id = '" . (int) $this->config->get('config_language_id') . "' ORDER BY oh.order_history_id DESC");

        return $query->row;
    }
}
