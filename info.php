<?php

    // Identifica la procedencia de la IP del cliente
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    $mostrar = strpos($ipaddress, "150.214.182");

    $ip_interna = false;
    if ($mostrar !== 0)
      // La direccion no es local, no se hace nada y se mantiene la variable a FALSE
      $msg = "La dirección NO ES local " . $ipaddress . " ". $mostrar;
    else
      // La dirección es del servidor, y se cambia la variable a TRUE
     $msg =  "La dirección es local" . $ipaddress;
      $ip_interna = true;



  $uri_in = "$_SERVER[REQUEST_URI]";


   $fichero = 'archivo.txt';
   // Abre el fichero para obtener el contenido existente.

   // ñade en la columna que corresponda el indicador I o E

    if ($ip_interna == 1)
      $actual .= " I ". "  \t $uri_in \t". date("d-m-Y h:i:sa")." \n";
    else
      $actual .= "   ". " E \t $uri_in".date("d-m-Y h:i:sa")." \n";


   // Escribe el contenido al fichero
   file_put_contents($fichero, $actual, FILE_APPEND | LOCK_EX) or die("No se puede escribir el fichero. De permisos de escritura al fichero txt chmod 777");



   $uri_res = trim($uri_in, "/fondos/libros");

   $dir = 'sqlite:direcciones.sqlite3';
   $dbb = new PDO($dir) or die ("No se ha podido conectar con la BD.");
   $result = $dbb->query("SELECT * FROM redireccion WHERE origen ='$uri_res'");
   foreach($result as $row)
   {

      $in_uri = $row['destino'];


   }

   $dbb = NULL;

   if ($in_uri!=''){

     header("refresh: 0;" . $in_uri);
     echo "<h1>Petición en curso...<h1><p>Estamos buscando tu documento.<br> Puede que nos lleve uno o dos segundos; no es necesario que toques nada en ese tiempo.... Estaremos encantados de encargarnos de todo para tí.</p>";
   }else if ($in_uri==null){

      header('HTTP/1.1 404 Not Found');
      header("Refresh:0; /lost.html");
      exit();
      
      #echo $in_uri . "No se encuentra el libro solicitado";

   }




?>
