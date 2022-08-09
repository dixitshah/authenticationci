<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_model extends CI_Model
{
 

    public function insert($post)
    {
        return $this->db->insert("file",$post);
    }
    
}
