<?php



class Invoice_model extends CI_Model {



    public function getAll($status=NULL){

        $this->load->model('vendor/Vendor_model', 'Vendor');

        $mediaUrl = base_url();

        if($this->ion_auth->is_admin()) {

            $this->db->select('i.id, i.customer, h.name AS hall, i.order_date, v.name AS vendor, i.rent_hour, i.message, i.status, i.total_bill, i.bank_account_number, i.bank_account_name, CONCAT("'.$mediaUrl.'media/", i.receipt_of_transfer) as receipt_of_transfer, image_raw, pic_latitude, pic_longitude');

            $this->db->from('invoices AS i');

            $this->db->join('halls AS h', 'h.id = i.hall_id');

            $this->db->join('vendors AS v', 'v.id = h.vendor_id');

            $query = $this->db->get();

        } else {

            $vendorId = $this->Vendor->getAll()[0]->id;

            

            $this->db->select('i.id, i.customer, h.name AS hall, i.order_date, v.name AS vendor, i.rent_hour, i.message, i.status, i.total_bill, i.bank_account_number, i.bank_account_name, CONCAT("'.$mediaUrl.'media/", i.receipt_of_transfer) as receipt_of_transfer, image_raw, pic_latitude, pic_longitude');

            $this->db->from('invoices AS i');

            $this->db->join('halls AS h', 'h.id = i.hall_id');

            $this->db->join('vendors AS v', 'v.id = h.vendor_id');

            $this->db->where(array('h.vendor_id' => $vendorId ));

            $this->db->order_by('i.order_date', 'ASC');

            $this->db->order_by('i.status', 'DESC');

            if($status) {

                if(is_array($status)) {

                    $this->db->where_in('i.status', $status);

                } else {

                    $this->db->where(array('i.status' => $status));

                }

            }

            // var_dump($this->db->get_compiled_select());die();

           

            $query = $this->db->get();

            

        }

        

        return $query->result();

    }



    public function update($invoiceId, $status) {

        $data = array('status' => $status);

        $this->db->where('id', $invoiceId);

        return $this->db->update('invoices', $data);

    }



    public function count() {

        $this->load->model('vendor/Vendor_model', 'Vendor');

        $vendorId = $this->Vendor->getAll()[0]->id;

        $this->db->select('*');

        $this->db->from('invoices AS i');

        $this->db->join('halls AS h', 'h.id = i.hall_id');

        $this->db->join('vendors AS v', 'v.id = h.vendor_id');

        $this->db->where('v.id', $vendorId);

        $query = $this->db->get();

        return count($query->result_array());

    }

}