<?php
class Categorias_model extends CI_Model {

	private $table='categorias';

	function Categorias_model()
	{
		// Call the Model constructor
		parent::__construct();
	}

	
	 
	function getByIdUsuario($id){
			
		$this->db->where('id_usuario', $id);
		$this->db->order_by('orden');
		
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0)
			return $query->result();
		else
			return array();


	}
	
	
	function getByIdUsuarioParaOrdenar($id){
			
		$this->db->where('id_usuario', $id);
		$this->db->order_by('nombre');
	
		$query = $this->db->get($this->table);
	
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return null;
	
	
	}
	
	function getNivelById($id){
	
		$this->db->select('nivel');
		$this->db->where('id_categoria', $id);
		$query = $this->db->get($this->table);
	
		if ($query->num_rows() > 0)
			return $query->row()->nivel;
		else
			return null;
	
	
	}

	function insert($datos = array()){
		
		$datos['ip']= $_SERVER['REMOTE_ADDR'];
		$datos['nivel']= (($datos['id_padre'] == 0 ) ? 1 : $this->getNivelById($datos['id_padre'])+1);
		
		if (!isset($datos['id_usuario']))
			$datos['id_usuario']= $_SESSION['usuario']->id_usuario;
		
		$this->db->insert($this->table, $datos);
		 
		if ($this->db->affected_rows()>0)
			return $this->db->insert_id() ;
		else
			return false;
			
	}
	 
	function update($id_usuario,$id_categoria,$datos = array()){
		 
		$this->db->where('id_categoria', $id_categoria);
		$this->db->where('id_usuario', $id_usuario);
		
	
		//echo $this->db->last_query();
	
		if ($this->db->update($this->table, $datos))
			return true;
		else
			return false;
		 
	}
	
	function obtenerIdsCategoriasHijas($id_usuario,$id_categoria){
		$categorias=$this->getByIdUsuario($id_usuario);
		
		$in=0;
		$nivel=999;
		$result=array($id_categoria);
		foreach($categorias as $cat)
		{
			if ($cat->id_padre==$id_categoria)
			{
				$in=1;
				$nivel=$cat->nivel;
			}
				
				
			if ($in==1 && $nivel > $cat->nivel)
			{
				break;
			}
				
			if ($in==1)
				array_push($result,$cat->id_categoria);
				
		}
		return $result;
	}
	
	function delete($id_usuario,$id_categoria){
		
		$idsCategoriasHijas=$this->obtenerIdsCategoriasHijas($id_usuario,$id_categoria);
		
		$this->db->where_in('id_categoria', $idsCategoriasHijas);
		$this->db->where('id_usuario', $id_usuario);
	
		if ($this->db->delete($this->table))
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
	
	function getSugerencias($valor,$id_web)
	{
		//Query the data table for every record and row
		$this->db->select('nombre');
		$this->db->where('id_usuario', $id_web);
		$this->db->like('nombre',$valor);
		$this->db->limit(5);
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