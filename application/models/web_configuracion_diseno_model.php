<?php
class Web_configuracion_diseno_model extends CI_Model {
	
	private $table='web_configuracion_diseno';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	 
 	function insert($datos = array()){
 		
      $this->db->insert($this->table, $datos);
      
   	  if ($this->db->affected_rows()>0)
   	  	return $this->db->insert_id();
   	  else
   	  	return false;
   	  	
    }
    function getById($id_user)
    {
    	//Query the data table for every record and row
    	$this->db->where('id_usuario', $id_user);
    	$this->db->join('zone_time', 'zone_time.id_zone_time = usuario_configuracion.id_zone_time');
    	$query = $this->db->get($this->table);
    	 
    	if ($query->num_rows() > 0)
    	{
    		return $query->row();
    	}else{
    		return array();
    		//show_error('Database is empty!');
    	}
    }
    
    function update($id,$datos = array()){
  
    	$this->db->where('id_configuracion', $id);
    
    	if ($this->db->update($this->table, $datos))
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