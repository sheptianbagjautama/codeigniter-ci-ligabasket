<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule_model extends CI_Model {

    public function all($hallId=NULL, $date=NULL){
        if($hallId && $date) {
            $this->db->where('hall_id',$hallId);
            $this->db->where('order_date',$date);
            $this->db->where_in('status', ['order','accept','paid']);
            $queryInvoices = $this->db->get('invoices');

            $invoice = $queryInvoices->row();

            $hallScheduleIds = explode(",", $invoice->hall_schedule_ids);

            $this->db->select('hs.id, hs.schedule_id, hs.active, SUBSTRING(sc.range_time,5) AS time');
            $this->db->from('halls_schedules AS hs');
            $this->db->join('schedules AS sc', 'sc.id = hs.schedule_id', 'right');
            $this->db->where(array('hs.hall_id' => $hallId));
            $hallSchedules = $this->db->get()->result_array();
            foreach ($hallSchedules as $hs) {
                if($hs['active'] ) {
                    $hs['available'] = in_array($hs['schedule_id'], $hallScheduleIds) ? false : true;
                } else {
                    $hs['available'] = false;
                }
                
            }

            $response = $hallSchedules;
        } else {

            $query = $this->db->get_where('schedules', array('active', true));
            $response = $query->result();
        }
       
        return $response;
    }
}