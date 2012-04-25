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

	function login($email,$password){
		$this->db->where('correo', $email);
		$this->db->where('password', $password);
		$query = $this->db->get($this->table);
			
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return null;


	}
	 
	function getById($id){
			
		$this->db->where('id_usuario', $id);
			
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0)
			return $query->row();
		else
			return null;


	}

	function insert($datos = array()){
		
		$datos['ip']= $_SERVER['REMOTE_ADDR'];
		
		$this->db->insert($this->table, $datos);
		 
		if ($this->db->affected_rows()>0)
			return $this->db->insert_id() ;
		else
			return false;
			
	}
	 
	function update($id_usuario,$datos = array()){
		 
		$this->db->where('id_usuario', $id_usuario);
		$this->db->update($this->table, $datos);


		if ($this->db->affected_rows()>0)
			return $this->db->insert_id() ;
		else
			return false;
		 
	}
	 
	function activar_cuenta($id_usuario,$password,$datos = array()){
		 
		$this->db->where('id_usuario', $id_usuario);
		$this->db->where('activar_cuenta', $password);
		$this->db->update($this->table, $datos);


		if ($this->db->affected_rows()>0)
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