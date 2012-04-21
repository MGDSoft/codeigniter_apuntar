<?php
class Helloworld_model extends CI_Model {
 
    function Helloworld_model()
    {
        // Call the Model constructor
        parent::__construct();
    }
     
    function getData()
  {
   //Query the data table for every record and row
   $query = $this->db->get('usuario');
    
   if ($query->num_rows() > 0)
   {
    return $query->result();
   }else{
    return array();
    //show_error('Database is empty!');
   }
  }
 
}
?>