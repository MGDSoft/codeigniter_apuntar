<?php
class Noticias_model extends Master_model {

	private $table='noticias';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	
	function getByIdUsuario($id,$busqueda_visible,$pagina=0,$count=false){
	
		if (!$count)
		{
			$this->db->limit(NUMERO_POR_PAGINA,$pagina);
			$this->db->order_by('noticias.fecha','desc');
		}
		$this->db->select('*,noticias.fecha as noticia_fecha');
		$this->db->where('noticias.id_usuario', $id);
		
		$this->db->where('noticias.visible >=', $busqueda_visible);
		
		$this->db->join('categorias', 'categorias.id_categoria = noticias.id_categoria');
		

		if ($count)
			return $this->db->count_all_results($this->table);
		else
			$query = $this->db->get($this->table);
		
		
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return array();

	}
	
	function getById($id){
			
		$this->db->select('*,noticias.fecha as noticia_fecha');
		$this->db->where('id_noticia', $id);
		$this->db->join('categorias', 'categorias.id_categoria = noticias.id_categoria');
		
		$query = $this->db->get($this->table);
	
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return null;
	
	
	}
	
	function getByDates($id_usuario,$busqueda_visible,$fechaMin,$fechaMax,$pagina=0,$count=false){
			
		if ($count)
			$this->db->select('count(id_noticia) as num');
		else
			$this->db->select('*,noticias.fecha as noticia_fecha');
		
		$this->db->join('categorias', 'categorias.id_categoria = noticias.id_categoria');
		$this->db->where('noticias.id_usuario', $id_usuario);
		$this->db->where('noticias.fecha >=', $fechaMin);
		$this->db->where('noticias.fecha <=', $fechaMax);
		
		$this->db->where('noticias.visible >=', $busqueda_visible);
		
		if (!$count)
		{
			$this->db->limit(NUMERO_POR_PAGINA,$pagina);
			$this->db->order_by('noticias.fecha ','asc');
		}
		
		$query = $this->db->get($this->table);
		
		if ($count)
			return  $query->row()->num;
	
		
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return array();
	
	
	}
	
	function getByDatesOnlyDates($id_usuario,$busqueda_visible,$fechaMin,$fechaMax){
			
		$this->db->select('DISTINCT(DAYOFMONTH(fecha)) as dia',FALSE);
		$this->db->select('YEAR(fecha) as ano',FALSE);
		$this->db->select('MONTH(fecha) as mes',FALSE);
		$this->db->where('id_usuario', $id_usuario);
		$this->db->where('fecha >=', $fechaMin);
		$this->db->where('fecha <=', $fechaMax);
		
		$this->db->where('noticias.visible >=', $busqueda_visible);
	
		$query = $this->db->get($this->table);
		
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return array();
	
	
	}

	
	
	function insert($datos = array()){
		
		$datos['ip']= $_SERVER['REMOTE_ADDR'];
		
		$this->db->insert($this->table, $datos);
		 
		if ($this->db->affected_rows()>0)
			return $this->db->insert_id() ;
		else
			return false;
			
	}
	 
	
	function delete($id_usuario,$id_noticia){
			
		$this->db->where('id_noticia', $id_noticia);
		$this->db->where('id_usuario', $id_usuario);
	
		//echo $this->db->last_query();
		if ($this->db->delete($this->table))
			return true ;
		else
			return false;
			
	}
	
	function getSugerencias($valor,$busqueda_visible,$id_usuario,$categoria)
	{
		
		$this->db->select('titulo');
		//$this->db->select('noticias.titulo, MATCH( noticias.titulo , noticias.noticia ) AGAINST ("'.$valor.'") as score  ', NULL, FALSE);
		$this->db->where('(`titulo`  LIKE "%'.$this->db->escape_str($valor).'%" OR  `noticia`  LIKE "%'.$this->db->escape_str($valor).'%")',NULL, FALSE);

		//$this->db->where('MATCH (noticias.titulo,noticias.noticia) AGAINST ("'.$valor.'") ', NULL, FALSE);
		$this->db->where('noticias.visible >=', $busqueda_visible);
		
		if (!empty($categoria))
		{
			
			$this->db->join('categorias', 'categorias.id_categoria = noticias.id_categoria');
			$this->db->where('categorias.nombre', $categoria);
		}
		$this->db->limit(5); 
		//$this->db->order_by('score','desc');
		$query = $this->db->get($this->table);
		
		//echo $this->db->last_query();
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return array();
		}
	}
	
	
	function getNoticiasBusqueda($valor,$id_usuario,$categoria,$busqueda_visible,$pagina=0,$count=false)
	{
		//Query the data table for every record and row
		
		$this->db->where('noticias.id_usuario', $id_usuario);
		
		if (!$count)
		{
			$this->db->limit(NUMERO_POR_PAGINA,$pagina);
			$this->db->select('*,noticias.fecha as noticia_fecha');
		}else
			$this->db->select('id_noticia');
		
		if (!empty($valor))
		{
			
				//$this->db->select('* , MATCH( noticias.titulo , noticias.noticia ) AGAINST ("'.$this->db->escape($valor).'") as score  ', NULL, FALSE);
				//$this->db->order_by('score','desc');
			
			$this->db->like("titulo",$valor);
			$this->db->or_like("noticia",$valor);
			//$this->db->where('MATCH (noticias.titulo,noticias.noticia) AGAINST ("'.$this->db->escape($valor).'") ', NULL, FALSE);
		}
			
		$this->db->where('noticias.visible >=', $busqueda_visible);
		
		$this->db->join('categorias', 'categorias.id_categoria = noticias.id_categoria');
		if (!empty($categoria))
		{
			
			$this->db->where('categorias.nombre', $categoria);
		}
		$this->db->order_by('noticias.fecha','DESC');
		
		$query = $this->db->get($this->table);
		
	
		if ($count)
			return $query->num_rows();
		
		
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return array();
			//show_error('Database is empty!');
		}
	}
	
	
	
	function update($id_usuario,$id_noticia,$datos = array()){
		 
		$this->db->where('id_usuario', $id_usuario);
		$this->db->where('id_noticia', $id_noticia);
		
		if ($this->db->update($this->table, $datos))
			return true;
		else
			return false;
		 
	}
	
	function agregar_voto($id,$voto,$restar){
		
		if ($restar==0)
			$this->db->set('n_votos_valoracion', 'n_votos_valoracion + 1', FALSE);
		
		
		$this->db->set('valoracion', 'valoracion + ('.($voto - $restar).')', FALSE);
		$this->db->where('id_noticia', $id);
		
		if ($this->db->update($this->table))
			return true;
		else
			return false;
	}
	
	function sumarLeido($id_noticia){
			
		
		$this->db->where('id_noticia', $id_noticia);
		$this->db->set('leidos', 'leidos + 1', FALSE);
		
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
	function getData($usuario_configuracion=false)
	{
		//Query the data table for every record and row
		
		if ($usuario_configuracion)
			$this->db->join('usuario_configuracion', 'usuario_configuracion.id_usuario = noticias.id_usuario');
		
		
		
		$query = $this->db->get($this->table);

		//echo $this->db->last_query();
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