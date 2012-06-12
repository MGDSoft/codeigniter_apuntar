<?php
class Comentarios_model extends Master_model {

	private $table='comentarios';

	function Comentarios_model()
	{
		// Call the Model constructor
		parent::__construct();
	}

	
	function getByIdNoticia($id,$pagina=0,$count=false){
	
		if (!$count)
		{
			//$this->db->limit(NUMERO_POR_PAGINA,$pagina);
			$this->db->order_by('comentarios.fecha','asc');
		}
		
		$this->db->where('id_noticia', $id);
		$this->db->join('usuario', 'comentarios.id_usuario = usuario.id_usuario');

		if ($count)
			return $this->db->count_all_results($this->table);
		else
			$query = $this->db->get($this->table);
		
		//echo $this->db->last_query();
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return array();

	}
	
	function getById($id){
			
		$this->db->where('id_comentario', $id);
		$query = $this->db->get($this->table);
	
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return null;
	
	
	}
	
	function countByIdNoticia($id){
			
		$this->db->select('count(id_comentario) as num',FALSE);
		$this->db->where('id_noticia', $id);
		$query = $this->db->get($this->table);
	
		if ($query->num_rows() > 0)
			return $query->row()->num;
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
	 
	
	function deleteById($id){
			
		$this->db->where('id_comentario', $id);
		
		
	
		if ($this->db->delete($this->table))
			return true ;
		else
			return false;
			
	}
	
	
	function update($id_comentario,$datos = array()){
		 
		$this->db->where('id_comentario', $id_comentario);
		
		if ($this->db->update($this->table, $datos))
			return true;
		else
			return false;
		 
	}
	
	function updateMasUpdate($id_comentario,$id_usuario,$datos = array()){
			
		$this->db->where('id_comentario', $id_comentario);
		$this->db->where('id_usuario', $id_usuario);

		$this->db->set('editado', 'editado +  1', FALSE);
		
		if ($this->db->update($this->table, $datos))
			return true;
		else
			return false;
			
	}
	
	function update_votos($id_comentario,$voto_positivo,$voto_negativo){
			
		$this->db->where('id_comentario', $id_comentario);
		
		if ($voto_positivo)
			$this->db->set('votos_positivos', 'votos_positivos + ('.$voto_positivo.')', FALSE);
		
		if ($voto_negativo)
			$this->db->set('votos_negativos', 'votos_negativos + ('.$voto_negativo.')', FALSE);
		
		if ($this->db->update($this->table))
			return true;
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