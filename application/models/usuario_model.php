<?php
class Usuario_model extends CI_Model {

	private $table='usuario';

	function __construct()
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
	function get_by_correo_y_uid($email,$uid=null)
	{
		$this->db->where('correo', $email);
		
		if ($uid!="" || $uid)
			$this->db->or_where('id_social', $uid);
		
		$this->db->join('zone_time', 'zone_time.id_zone_time = usuario.id_zone_time');
		$this->db->join('usuario_configuracion', 'usuario_configuracion.id_usuario = usuario.id_usuario');
		
		$query = $this->db->get($this->table);
		
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return null;
	}
	
	function getLast($desc='DESC',$limit=10)
	{
		$this->db->order_by('fecha',$desc);
		$this->db->join('usuario_configuracion', 'usuario.id_usuario = usuario_configuracion.id_usuario');
		$this->db->limit($limit,0);
		$query = $this->db->get($this->table);
		
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return array();
	}
	
	function login($email,$password){
		
		$this->db->where('correo', $email);
		
		if ($password)
			$this->db->where('password', $password);
		
		$this->db->join('zone_time', 'zone_time.id_zone_time = usuario.id_zone_time');
		$this->db->join('usuario_configuracion', 'usuario_configuracion.id_usuario = usuario.id_usuario');
		$query = $this->db->get($this->table);

		
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return null;


	}
	 
	function getById($id,$getZone=true,$usuarioConfiguracion=false){
			
		
		$this->db->where('usuario.id_usuario', $id);
		
		if ($getZone)
			$this->db->join('zone_time', 'zone_time.id_zone_time = usuario.id_zone_time');
		
		if ($usuarioConfiguracion)
			$this->db->join('usuario_configuracion', 'usuario_configuracion.id_usuario = usuario.id_usuario');
		
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

		if ($this->db->update($this->table, $datos))
			return true ;
		else
			return false;
		 
	}
	 
	function updateByCorreo($correo,$datos = array()){
			
		$this->db->where('correo', $correo);
	
		if ($this->db->update($this->table, $datos))
			return true ;
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
		$this->db->join('zone_time', 'zone_time.id_zone_time = usuario.id_zone_time');
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