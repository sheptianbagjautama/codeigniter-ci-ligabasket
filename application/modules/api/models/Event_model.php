<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {
    
    public function findByTeamId($teamId, $eventId=NULL, $userId=NULL) {
        $mediaUrl = base_url();

        if($eventId) {
            $this->db->select('ev.id, ev.name, u.email, u.phone, ev.price, ev.event_date, v.name AS location, ev.description, CONCAT("'.$mediaUrl.'media/", ev.image) AS image, ev.latitude, ev.longitude');
            $this->db->from('events AS ev');
            $this->db->join('vendors AS v', 'v.id = ev.vendor_id');
            $this->db->join('users AS u', 'u.id = ev.user_id');
            $this->db->where(array('ev.id'=>$eventId));
            $response = $this->db->get()->result()[0];
        } else {
            $this->db->select('ev.id, ev.name, u.email, u.phone, ev.price, ev.event_date, v.name AS location, ev.description, CONCAT("'.$mediaUrl.'media/", ev.image) AS image, ev.latitude, ev.longitude');
            $this->db->from('events AS ev');
            $this->db->join('vendors AS v', 'v.id = ev.vendor_id');
            $this->db->join('users AS u', 'u.id = ev.user_id');
            $this->db->order_by('event_date', 'ASC');
            $response = $this->db->get()->result();
        }

        return  $response;
    }

    public function findEventCurrentLocation($currentLatitude, $currentLongitude) {
        
        $response = $this->db->query('SELECT
            *,
            ( 6371 * acos( cos( radians('.$currentLatitude.') ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians('.$currentLongitude.') ) + sin( radians('.$currentLatitude.') ) * sin( radians( `latitude` ) ) ) ) AS distance
        FROM `events`
        HAVING distance <= 0.05
        ORDER BY distance ASC LIMIT 1')->result();

        // distance in kilometer

        return $response;
    }
}