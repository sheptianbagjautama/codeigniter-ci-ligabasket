<?php

class Hallschedule_model extends CI_Model {
    public $hall_id;
    public $schedule_id;

    public function get($hallId, $date) {
        //schedule
        $schedules = $this->db->get('schedules')->result();
        
        foreach ($schedules as $key => $value) {

            $this->db->select('*');
            $this->db->from('halls_schedules');
            $this->db->join('schedules', 'schedules.id = halls_schedules.schedule_id');
            $this->db->where('hall_id', $hallId);  
            $this->db->where('date', $date);
            $this->db->where('schedule_id', $value->id);
            $query = $this->db->get();
            $halls_schedules =  $query->result();
            if (count($halls_schedules) == 0) {
                $schedules[$key]->checked = false;
            } else {
                $schedules[$key]->checked = true;
            }
            
        }

        // pengecekan jika ada jadwal yang sedang berlangsung checkbox wajib disabled
        $this->db->where('order_date', $date);
        $this->db->where('hall_id', $hallId);
        $this->db->where_in('status', ['accepted','paid']);
        $invoices = $this->db->get('invoices')->result();
        $hallids = "";
        foreach ($invoices as $key => $value) {
            $hallids .= ",".trim($value->hall_schedule_ids);
        }
        $hallids_array = [];
        $hallids_array = explode(",",$hallids);

        foreach ($schedules as $key => $value) {
            $schedules[$key]->booked = in_array($value->id, $hallids_array);
            if ($schedules[$key]->booked) {
                //jika sudah di booking lapangannya maka checkbox menjadi true
                $schedules[$key]->checked = true;
            }
        }

        return $schedules;

    }


    public function bulkInsert($hallId, $halldate,  $schedules){
        $this->db->delete('halls_schedules', array('hall_id'=>$hallId, 'date'   => $halldate ));
        $data = [];
        foreach ($schedules as &$value) {
            array_push($data, array(
                'hall_id' => $hallId,
                'date'      => $halldate,
                'schedule_id' => $value,
                'created_on' => now()
            ));

        }
        $this->db->insert_batch('halls_schedules', $data);
        echo "success";
    }

}