 <?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class ResidentModel extends CI_Model
{
    /**
     * This function is used to get the resident listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function residentListingCount($searchText = '')
    {
        $this->db->select("resident.res_id, resident.res_Fname, resident.res_Lname, resident.age, resident.gender, resident.status, resident.mobile_no, address.add_desc");
        $this->db->from('resident');
        $this->db->join('address', 'address.add_id = resident.add_id');
        if(!empty($searchText)) {
            $likeCriteria = "(resident.res_Fname  LIKE '%".$searchText."%'
                            OR  resident.res_Lname  LIKE '%".$searchText."%'
                            OR  address.add_desc  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the resident listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function residentListing($searchText = '', $page, $segment)
    {
        $this->db->select("resident.res_id, resident.res_Fname, resident.res_Lname, resident.age, resident.gender, resident.status, resident.mobile_no, address.add_desc");
        $this->db->from('resident');
        $this->db->join('address', 'address.add_id = resident.add_id');
        if(!empty($searchText)) {
            $likeCriteria = "(resident.res_Fname  LIKE '%".$searchText."%'
                            OR  resident.res_Lname  LIKE '%".$searchText."%'
                            OR  address.add_desc  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('resident.res_id', 'ASC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the resident roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to get the resident address information
     * @return array $result : This is result of the query
     */
    public function get_address()
    {
        $this->db->select('add_id, add_desc');
        $this->db->from('address');
        $this->db->where('add_id !=', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */

    /**
     * This function is used to add new resident to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewResident($residentInfo)
    {
        $this->db->trans_start();
        $this->db->insert('resident', $residentInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get resident information by id
     * @param number $res_id : This is resident id
     * @return array $result : This is resident information
     */
    function getResidentInfo($res_id)
    {
        $this->db->select('res_id, res_Fname, res_Lname,age, gender, status, mobile_no, add_id');
        $this->db->from('resident');
        $this->db->where('res_id', $res_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the resident information
     * @param array $residentInfo : This is resident updated information
     * @param number $res_id : This is resident id
     */
    function editResident($residentInfo, $res_id)
    {
        $this->db->where('res_id', $res_id);
        $this->db->update('resident', $residentInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the resident information
     * @param number $userId : This is resident id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteResident($res_id, $residentInfo)
    {
        $this->db->where('res_id', $res_id);
        $this->db->update('resident', $residentInfo);
        
        return $this->db->affected_rows();
    }


    
    

    /**
     * This function used to get resident information by id
     * @param number $res_id : This is resident id
     * @return array $result : This is resident information
     */
    function getResidentInfoById($res_id)
    {
        $this->db->select('res_id', 'res_Fname', 'res_Lname','age', 'gender', 'status', 'mobile_no', 'add_id');
        $this->db->from('resident');
        $this->db->where('res_id', $res_id);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function used to get resident information by id with address
     * @param number $res_id : This is resident id
     * @return aray $result : This is resident information
     */
    function getResidentInfoWithAddress($res_id)
    {
        $this->db->select("resident.res_id, resident.res_Fname, resident.res_Lname, resident.age, resident.gender, resident.status, resident.mobile_no, address.add_desc");
        $this->db->from('resident');
        $this->db->join('address', 'address.add_id = resident.add_id');
        $this->db->where('resident.res_id', $res_id);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  