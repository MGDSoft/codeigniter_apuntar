<?php 
class Master_model extends CI_Model{
    
	public function __construct(){
        parent::__construct();
        
        $this->set_timezone();
    }
    
    public function set_timezone(){
    	
    	if (!isset($_SESSION['timezone']))
    		$_SESSION['timezone']='Europe/Brussels';
    	
    	if ($_SESSION['timezone']!='Europe/Brussels')
        	$this->db->query("SET time_zone='".$_SESSION['timezone']."'");
    }
}
?>