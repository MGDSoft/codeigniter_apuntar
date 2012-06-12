<?php
class Usuario_configuracion_model extends CI_Model {
	private $table='usuario_configuracion';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
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
    
    function update($id,$datos = array()){
    
    	$this->db->where('id_configuracion', $id);
    
    	if ($this->db->update($this->table, $datos))
    		return true;
    	else
    		return false;
    
    }
   
 	function insert($datos = array()){
 		
      $this->db->insert($this->table, $datos);
      
   	  if ($this->db->affected_rows()>0)
   	  	return $this->db->insert_id();
   	  else
   	  	return false;
   	  	
    }

    function getById($id_user,$web_configuracion_diseno=false)
    {
    	//Query the data table for every record and row
    	$this->db->where('id_usuario', $id_user);
    	$this->db->join('zone_time', 'zone_time.id_zone_time = usuario_configuracion.id_zone_time');
    	
    	if ($web_configuracion_diseno)
    		$this->db->join('web_configuracion_diseno', 'web_configuracion_diseno.id_configuracion = usuario_configuracion.id_configuracion');
    	 
    	
    	$query = $this->db->get($this->table);
    	 
    	if ($query->num_rows() > 0)
    	{
    		return $query->row();
    	}else{
    		return null;
    		//show_error('Database is empty!');
    	}
    }
    function getByNombreUnico($nombreunico,$web_configuracion_diseno=false)
    {
    	//Query the data table for every record and row
    	$this->db->where('nombre_unico', $nombreunico);
    	$this->db->join('zone_time', 'zone_time.id_zone_time = usuario_configuracion.id_zone_time');
    	
    	if ($web_configuracion_diseno)
    		$this->db->join('web_configuracion_diseno', 'web_configuracion_diseno.id_configuracion = usuario_configuracion.id_configuracion');
    	
    	//echo $this->db->last_query();
    	
    	$query = $this->db->get($this->table);
    
    	if ($query->num_rows() > 0)
    	{
    		return $query->row();
    	}else{
    		return null;
    		//show_error('Database is empty!');
    	}
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