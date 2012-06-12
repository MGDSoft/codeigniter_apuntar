<?php if(!defined('BASEPATH'))	exit('No direct script access allowed');

class Huso_horario
{
	function auto_load_huso_horario()
	{
		if (isset($_SESSION['usuario']))
		{
			date_default_timezone_set($_SESSION['usuario']->tz);
		}
		
	}
}