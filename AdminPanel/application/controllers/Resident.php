<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Resident extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('residentmodel');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the registered residents
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Barangay : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the resident list
     */
    function residentListing()
    {
        // if($this->isAdmin() == TRUE)
        // {
        //     $this->loadThis();
        // }
        // else
        // {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            

            $count = $this->residentmodel->residentListingCount($searchText);

			$returns = $this->paginationCompress ( "residentListing/", $count, 10 );
            
            $data['residentRecords'] = $this->residentmodel->residentListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Barangay : Resident Listing';
            
            $this->loadViews("registerResidents", $this->global, $data, NULL);
        // }
    }

    /**
     * This function is used to load the add resident form
     */
    function addResident()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('residentmodel');
            $data['address'] = $this->residentmodel->get_address();
            
            $this->global['pageTitle'] = 'Barangay : Resident Registration';

            $this->loadViews("addResident", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    
    
    /**
     * This function is used to add resident to the system
     */
    function addNewResident()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $res_Fname = ucwords(strtolower($this->security->xss_clean($this->input->post('res_Fname'))));
            $res_Lname = ucwords(strtolower($this->security->xss_clean($this->input->post('res_Lname'))));
            $age = $this->security->xss_clean($this->input->post('age'));
            $gender = ucwords(strtolower($this->security->xss_clean($this->input->post('gender'))));
            $status = ucwords(strtolower($this->security->xss_clean($this->input->post('status'))));
            $mobile_no = $this->security->xss_clean($this->input->post('mobile_no'));
            $add_id = $this->security->xss_clean($this->input->post('add_desc'));

            $residentInfo = array('res_Fname'=>$res_Fname, 'res_Lname'=>$res_Lname, 'age'=>$age, 'gender'=>$gender, 'status'=>$status, 'mobile_no'=>$mobile_no, 'add_id'=>$add_id);
            
            $this->load->model('residentmodel');
            $result = $this->residentmodel->addNewResident($residentInfo);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Residents Registered successfully!');
            }
            
            else
            {
                $this->session->set_flashdata('error', 'Residents Registration failed');
            }
            
            redirect('addResident');
        }
    }

    
    /**
     * This function is used load resident edit information
     * @param number $res_id : Optional : This is resident id
     */
    function editOldResident($res_id)
    {
        if($res_id == null)
        {
            redirect('residentListing');
        }
        
        else
        {
        $data['address'] = $this->residentmodel->get_address();
        $data['residentInfo'] = $this->residentmodel->getResidentInfo($res_id);
        
        $this->global['pageTitle'] = 'Barangay : Edit Resident';
        
        $this->loadViews("editOldResident", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the resident information
     */
    function editResident()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $res_id = $this->input->post('res_id');

            $res_Fname = ucwords(strtolower($this->security->xss_clean($this->input->post('res_Fname'))));
            $res_Lname = ucwords(strtolower($this->security->xss_clean($this->input->post('res_Lname'))));
            $age = $this->security->xss_clean($this->input->post('age'));
            $gender = ucwords(strtolower($this->security->xss_clean($this->input->post('gender'))));
            $status = ucwords(strtolower($this->security->xss_clean($this->input->post('status'))));
            $mobile_no = $this->security->xss_clean($this->input->post('mobile_no'));
            $add_id = $this->input->post('add_id');
            
            $residentInfo = array('res_Fname'=>$res_Fname, 'res_Lname'=>$res_Lname, 'age'=>$age, 'gender'=>$gender, 'status'=>$status, 'mobile_no'=>$mobile_no, 'add_id'=>$add_id);
            
            $result = $this->residentmodel->editResident($residentInfo, $res_id);
            
            if($result == true)
            {
                $this->session->set_flashdata('success', 'Resident Data updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Resident update failed');
            }
            
            redirect('residentListing');
        }
    }


    /**
     * This function is used to delete the resident using res_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteResident()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $res_id = $this->input->post('res_id');
            $residentInfo = array('res_Fname'=>$res_Fname, 'res_Lname'=>$res_Lname, 'age'=>$age, 'gender'=>$gender, 'status'=>$status, 'mobile_no'=>$mobile_no, 'add_id'=>$add_id);
            
            $result = $this->residentmodel->deleteResident($res_id, $residentInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Barangay : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $res_id : This is resident id
     */
   

    /**
     * This function is used to show users profile
     */
    

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
   

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
}

?>