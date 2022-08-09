 <?php
require APPPATH . 'libraries/REST_Controller.php';

header('Access-Control-Allow-Origin: *');  

class User extends REST_Controller {
    public function __construct() {

       parent::__construct();


        $this->load->model('User_model');
        $this->load->model('File_model');
      

    }

    
    
    public function createCustomer_post(){
      $userans=$this->post();
      $key = $this->myclass->key_verification();
      
      if($key == 1){
            $userans=$this->post();
         $json = array();
         $config = [
                     [
                              'field' => 'phonenumber',
                              'label' => 'Phone Number',
                              'rules' => 'trim|required|regex_match[/^[0-9]{10}$/]',
                              'errors'=> [
                                          'regex_match'=>'Valid %s is required'
                                          ]
                     ]
                  ];
                  
                  
         $this->form_validation->set_data($userans);
         $this->form_validation->set_rules($config);
         $this->form_validation->set_message('required', 'You missed the input {field}!');
         if($this->form_validation->run()==FALSE){
               $json = $this->form_validation->error_array();
               $status = array("status"=>"failure");
               $merge = array_merge($status,$json);
               $this->output->set_content_type('application/json')->set_output(json_encode($merge));
         }
         else
         {  
            $customerid = $this->User_model->authentication($userans);
          
            if($customerid == 1){

            $rand = rand('111111','999999');
            $msg = $rand;
          
            $this->session->set_userdata('phonenumber', $userans['phonenumber']);
            $this->session->set_userdata('otp', $rand);
            $response = $this->myclass->msg($userans['phonenumber'],$msg);
            $this->response(array('status'=>'success','message'=>'Welcome to mywebsite.com thankyou for your registration we have receviced your registration and welcome to mywebsite. Kindly verify your OTP'.$msg,"otp"=> $msg),200);

            }
            else{
                $this->response(array('status'=>'failure','message'=>'User Not Exists Please Regiter With Admin'),200);
            }
            
         }
      }
      else
      {
          $this->response(array('status'=>'failure','message'=>'Invalide Key'),404);
      }
}
   
public function verifyCustomer_post(){
      $userans=$this->post();
      $key = $this->myclass->key_verification();
      
      if($key == 1){
         $userans=$this->post();
         $json = array();
         $config = [
                     [
                              'field' => 'otp',
                              'label' => 'OTP',
                              'rules' => 'trim|required|regex_match[/^[0-9]{6}$/]',
                              'errors'=> [   
                                 'regex_match'=>'Valid %s is required'
                              ]
                      ]
                      
                  ];
                  
                  
         $this->form_validation->set_data($userans);
         $this->form_validation->set_rules($config);
         $this->form_validation->set_message('required', 'You missed the input {field}!');
         if($this->form_validation->run()==FALSE){
               
               
               $json = $this->form_validation->error_array();
               $status = array("status"=>"failure");
               $merge = array_merge($status,$json);
                  
               $this->output->set_content_type('application/json')->set_output(json_encode($merge));
         }
         else
         {  
            $otp = $this->session->userdata('otp');
            if($otp == $userans['otp']){
                $phonenumber = $this->session->userdata("phonenumber");
                $otp = $this->myclass->select_data("phonenumber,typeuser","user","`phonenumber` = '$phonenumber'");
                $this->session->set_userdata("userobj",$otp);
                
                $this->response(array('status'=>'success','message'=>'OTP Entered Successfully'),200);
            }else{
                $this->response(array('status'=>'failure','message'=>'Invalide OTP you Entered Please check Your OTP'),404);
            }
         }
      }
      else
      {
          $this->response(array('status'=>'failure','message'=>'Invalide Key'),404);
      }

}

public function profileimage_post(){
      

      $key = $this->myclass->key_verification();
      
      if($key == 1){
       
      $profileId = $this->post('profile_id');
       $profileImg = $_FILES['profile_img'];
      
       $imagedata['upload_path'] = './assets/images/';
         $imagedata['allowed_types'] = 'jpg|jpeg|png|gif';
         $imagedata['encrypt_name'] = TRUE;
         
          $this->load->library('upload', $imagedata);
          
          if(!empty($_FILES['profile_img']['name'])){
               if ($this->upload->do_upload('profile_img')){
                   $img = $this->upload->data();
                   $target_path = "./assets/frontend_panel/images/profile/";
                   $this->myclass->singleimage($img['file_name'],$target_path); 
                   
                     $imagename = "".$img['file_name'];
              

               $filename = array("small"=>base_url()."assets/frontend_panel/images/profile/small/".$imagename,"medium"=>base_url()."assets/frontend_panel/images/profile/medium/".$imagename,"large"=>base_url()."assets/frontend_panel/images/profile/large/".$imagename);
               $dbfilname = array("usernumber" => $this->session->userdata('phonenumber'),"name"=> json_encode($filename));
              
               $this->File_model->insert($dbfilname);
               
               $this->response(array('status'=>'success','message'=>'Profile Image Updated Successfully'),200);   
               
               
               }
          }
          else
          {
                $this->response(array('status'=>'failure','message'=>'Please Upload Profile Image'),200);   
          }

       }
       else
         {
             $this->response(array('status'=>'failure','message'=>'Invalide Key'),404);
         }


   }    


   public function logout_get(){

        $key = $this->myclass->key_verification();
      
         if($key == 1){
           $this->session->unset_userdata('phonenumber'); 
           $this->session->unset_userdata('otp');
           $this->session->unset_userdata('userobj');
           $this->response(array('status'=>'success','message'=>'Logout User Profile Done Successfully'),200); 
         
         }
         else
         {
             $this->response(array('status'=>'failure','message'=>'Invalide Key'),404);
         }
   }



   public function multiuser_post(){
      $userans=$this->post();
      $key = $this->myclass->key_verification();
      
      if($key == 1){
         $userans=$this->post();
         $json = array();
         $config = [
                     [
                              'field' => 'phonenumber',
                              'label' => 'Phone Number',
                              'rules' => 'trim|required|regex_match[/^[0-9]{10}$/]',
                              'errors'=> [
                                          'regex_match'=>'Valid %s is required'
                                          ]
                     ],
                     [
                                    'field' => 'typeuser',
                                    'label' => 'User Role',
                                    'rules' => 'trim|required',
                                    'errors'=> [
                                    
                                    'required'=>'%s field is required'
                                    ]
                                    
                    ]
                  ];
                  
                  
         $this->form_validation->set_data($userans);
         $this->form_validation->set_rules($config);
         $this->form_validation->set_message('required', 'You missed the input {field}!');
         if($this->form_validation->run()==FALSE){
               $json = $this->form_validation->error_array();
               $status = array("status"=>"failure");
               $merge = array_merge($status,$json);
               $this->output->set_content_type('application/json')->set_output(json_encode($merge));
         }
         else
         {  
            $customerid = $this->User_model->usercheck($userans);
            if($customerid == 0)
            {

            $this->response(array('status'=>'failure','message'=>'User Already Exists'),200);
            }
            else
            {
                $this->response(array('status'=>'success','message'=>'User registration Done Successfully'),200);
            }
            

         }
      }
      else
      {
          $this->response(array('status'=>'failure','message'=>'Invalide Key'),404);
      }
}



}
