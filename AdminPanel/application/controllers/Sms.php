<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';


//IMPORT BASECONTROLLER TO ACCESS BASECONTROLLER

class Sms extends BaseController{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Sms_model');
        $this->isLoggedIn();   
       
    } 

    public function index(){
        $this->global['pageTitle'] = 'Barangay : Resident Registration';

        $this->loadViews("compose", $this->global, NULL, NULL);
    }

  

    public function sending(){


        if ($_POST) {
            $mobileNo = $_POST['mobileNo'];
            $Message = $_POST['Message'];
            $api = "TR-JOYBA557321_2H9IH";

            $result = $this->itexmo($mobileNo,$Message,$api);
            echo $result;

            

        if (!empty($result)){

            if ($result == ""){ 
                // echo "iTexMo: No response from server!!!
                // Please check the METHOD used (CURL or CURL-LESS). If you are using 
                // CURL then try CURL-LESS and vice versa.  
                //  Please CONTACT US for help. ";  
           } else if ($result == 0){
               echo 'Message sent';
           
           }
            else { 
               echo "Error Num ". $result . " was encountered!";
           }    
          
            }
    
        }
    }
      public function itexmo($mobileNo,$Message,$api){
        $url = 'https://www.itexmo.com/php_api/api.php';
        
        $itexmo = array('1'=> $mobileNo, '2' => $Message, 'api' => $api
            
        
        );
        
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
                
            ),
            
        );
        
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
    }


    

    public function noticeOfHearing(){
        $this->global['pageTitle'] = 'Barangay : report form';
        $this->loadViews("noticeHearing", $this->global, NULL, NULL); 
    }

//     public function autocomplete()
// {
//      // load model
//      $this->load->model('Sms_model');

//      $search_data = $this->input->post('search_data');

//      $result = $this->Sms_model->get_autocomplete($search_data);

//      if (!empty($result))
//      {
//           foreach ($result as $row):
//                echo "<li><a href='#'>" . $row->res_Fname . "</a></li>";
//           endforeach;
//      }
//      else
//      {
//            echo "<li> <em> Not found ... </em> </li>";
//      }
//  }\





    public function residentlist(){
        //post data
        $postData = $this->input->post();

        //get data
        $data = $this->Sms_model->getResident($postData);

        echo json_encode ($data);

    }

    function complaint_form()
    {
            $data['incharge'] = $this->Sms_model->get_incharge();
            $data['sms_keyword']=$this->Sms_model->get_keyword();  
            $this->global['pageTitle'] = 'Barangay : complaint form';


            // $incharge['incharge'] = $this->Sms_model->get_incharge();

            $this->loadViews("form", $this->global, $data, NULL);
    }
 

}