<?php 

class Sms_model extends CI_Model
{
   
   
   function saverecords($sent)
	{
          $this->db->insert('inbox',$sent);
          return $this->db->insert_id();
	}

   function saveoutbox($outbox)
   {
      $this->db->insert('outbox',$outbox);
      return $this->db->insert_id();
      
   }

   function getResident($postData){

      $response = array();                                                
 
      if(isset($postData['search']) ){
        // Select record
        $this->db->select("CONCAT(res_Fname,' ',res_Lname) AS `name`, add_desc");
        $this->db->from('resident');
        $this->db->join('address', 'address.add_id = resident.add_id');
        $this->db->where("CONCAT(res_Fname,' ',res_Lname) like '%".$postData['search']."%' ");
        $records = $this->db->get()->result();
 
        foreach($records as $row ){
           $response[] = array("label"=>$row->name, "address"=>$row->add_desc);
           
        }
 
      }
 
      return $response;
   }

   public function get_keyword()
    {
        $this->db->select('SMS_Keyword_ID, Keyword_desc');
        $this->db->from('sms_keyword');
        $this->db->where('SMS_Keyword_ID !=', -1);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_incharge()
    {
       $this->db->select('inCharge_ID, inCharge_person');
       $this->db->from('incharge');
       $this->db->where('inCharge_ID !=', 0);
       $querys = $this->db->get();

       return $querys->result();

      }

 

  
   

  

  

   

}

?>