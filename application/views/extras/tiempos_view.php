<?php
if (1==0)
{
	echo 'code + html :'. $this->benchmark->elapsed_time(). ' memo : ' . $this->benchmark->memory_usage();
	$this->output->enable_profiler(true);
}  
 
 ?>