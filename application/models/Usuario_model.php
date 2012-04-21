<?php
class Usuario_model extends CI_Model {
	private $table='usuario';
	
	function Usuario_model()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	 function existe_correo($email){
      $this->db->select('correo');
      $this->db->where('correo', $email); 
      $query = $this->db->get($this->table);
      if ($query->num_rows() > 0){
         return 1;
      }
      return 0;
   }
	 function existe_nombre_unico($nombre_unico){
      $this->db->select('nombre_unico');
      $this->db->where('nombre_unico', $nombre_unico); 
      $query = $this->db->get($this->table);
      if ($query->num_rows() > 0){
         return 1;
      }
      return 0;
    }
   
 	function insert($datos = array()){
 	
      $datos['password']=md5($datos['password']);
      $str = $this->db->insert_string($this->table, $datos);
      $res = $this->db->query($str);
      
   	  if ($res)
   	  	return true;
   	  else
   	  	return false;
   	  	
   }
	 
	function getData()
	{
		//Query the data table for every record and row
		$query = $this->db->get($this->table);
	  
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