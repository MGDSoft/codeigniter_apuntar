<?php
class Web_configuracion_separadores_model extends CI_Model {
	
	private $table='web_configuracion_separadores';
	
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
    function getById($id)
    {
    	//Query the data table for every record and row
    	$this->db->where('id_configuracion', $id);
    	
    	$query = $this->db->get($this->table);
    	 
    	if ($query->num_rows() > 0)
    	{
    		return $query->result();
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
    
    function deleteById($id){
    		
    	$this->db->where('id_configuracion', $id);

    	if ($this->db->delete($this->table))
    		return true ;
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