<html>
 <head>
  <title><?=$page_title?></title>
 </head>
 <body>
  <?php foreach($result as $row){?>
  <h3><?=$row->nombre?></h3>
  <p><?=$row->apellidos?></p>
   
 
  <?php } ?>
 </body>
</html>