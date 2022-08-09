<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
 

    public function usercheck($post)
    { 
          $this->db->where('phonenumber', $post['phonenumber']);
          $query = $this->db->get('user');
          if($query->num_rows() > 0)
          {return 0;}
          else
          {
            $this->db->insert("user",$post);
            return true;
          }

    }
    

    

    public function authentication($post)
    {

          $this->db->where('phonenumber', $post['phonenumber']);
          $query = $this->db->get('user');
          if($query->num_rows() > 0)
          {
           
              
            return true;
          }
          else
          {
            return false;
          }

    }
}
