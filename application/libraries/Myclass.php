<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Myclass{
    var $ci='';
    public function __construct(){
        $this->ci=& get_instance();
    
    }
    public function select_data($col,$table,$con){
        $str="select $col from $table where $con";
        
        
        $ans=$this->ci->db->query($str);
        if($ans->result_id->num_rows>0){
            return $ans->result();
        }
        else
        {
            return 0;

        }
    }

    public function delete_data($table,$con){
        $str="delete from $table where $con";
        $ans=$this->ci->db->query($str);
        return 1;

    }

    public function update_data($table,$col,$con){
        // $str="update $table set $col where $con";
        
        $this->ci->db->where($con);
        $this->ci->db->update($table,$col);
        return true;
    }
    public function insert($table,$data){
       
            $this->ci->db->insert($table,$data);
            return true;
        }
   

    public function key_verification(){
        $headers = apache_request_headers();
            
            if(!isset($headers['X-Api-Key'])){

                return array('status'=>'failure','message'=>'Key Not Found');
            }   
            else{
                $keyuser = $headers['X-Api-Key'];
                
                $key = $this->select_data("*","`keys`"," `key` = '$keyuser'");
                
                if( $key == 0 ){
                    return array('status'=>'failure','message'=>'Invalide Key');
                }
                else
                {
                    return true;
                }
            }
    }
    
    
    public function singleimage($file_name,$target_path){
     
              $config = array(
            // Large Image
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/images/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 300,
                'height'        => 300,
                'new_image'     => $target_path."large/".$file_name
                ),
            // Medium Image
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/images/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 150,
                'height'        => 150,
                'new_image'     => $target_path.'medium/'.$file_name
                ),
            // Small Image
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/images/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 75,
                'height'        => 75,
                'new_image'     => $target_path.'small/'.$file_name
            ));
            
        $this->ci->load->library('image_lib');
        $this->ci->image_lib->initialize($config[0]);
            
        foreach ($config as $item){
            
          $ans =  $this->ci->image_lib->initialize($item);
           
            if(!$this->ci->image_lib->resize()){
                return false;
            }

            $this->ci->image_lib->clear();
        }
       
    }
    
    public function msg($number,$msg){
        //Your authentication key
                $authKey = "318698AOSCCnyYw5e4a5679P1";

                //Multiple mobiles numbers separated by comma
                $mobileNumber = $number;

                //Sender ID,While using route4 sender id should be 6 characters long.
                $senderId = "ALORIF";

                //Your message to send, Add URL encoding here.
                $message = urlencode("$msg");

                //Define route 
                $route = "4";
                //Prepare you post parameters
                $postData = array(
                    'authkey' => $authKey,
                    'mobiles' => $mobileNumber,
                    'message' => $message,
                    'sender' => $senderId,
                    'route' => $route
                );

                //API URL
                $url="http://api.msg91.com/api/sendhttp.php";

                // init the resource
                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postData
                    //,CURLOPT_FOLLOWLOCATION => true
                ));


                //Ignore SSL certificate verification
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


                //get response
                $output = curl_exec($ch);

                //Print error if any
                if(curl_errno($ch))
                {
                    echo 'error:' . curl_error($ch);
                }

                curl_close($ch);
                
                // echo $output;    
    
    }
    
    
}










 ?>