 <?php 	
   require_once "conf/configAPP.php";
   
   function conectar(){   
     $port= PORTPS;
     $host = SERVERPS;
     $dbname = DBPS; 
     $user = USERPS;
     $pass = PASSPS; 
	
	 $cadenaConexion = "host=$host port=$port dbname=$dbname user=$user password=$pass";
     $conexion = pg_connect($cadenaConexion) or die("Error en la Conexion: ".pg_last_error());	
	
	 return $conexion;
   }
   
	function connectMySQL(){         
        $mysqli=mysqli_connect(SERVER,USER,PASS,DB);

        $mysqli->set_charset("utf8");

        return $mysqli;		
	}
	
   function insertOdoo($expediente, $identidad, $nombre, $fecha_nacimiento, $telefono1, $telefono2, $telefono3, $telefono4, $sexo, $street, $pacientes_id, $departamento, $pais, $correo,$estado_civil){  	   
	   //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
	   $conexion = conectar();   
	   $mysqli = connectMySQL();
	   
       //EVALUAMOS EL CODIGO DEL DEPARTAMENTO Y LO MOSTRAMOS CON EL VALOR QUE ODOO RECIBE	
       switch($departamento){
	  	  case 1: $state_id = 63; break;
          case 2: $state_id = 67; break;		
          case 3: $state_id = 69; break;		
          case 4: $state_id = 71; break;		
          case 5: $state_id = 61; break;		
          case 6: $state_id = 65; break;		
          case 7: $state_id = 73; break;		
          case 8: $state_id = 75; break;		
          case 9: $state_id = 98; break;		
          case 10: $state_id = 77; break;		
          case 11: $state_id = 79; break;		
          case 12: $state_id = 81; break;		
          case 13: $state_id = 83; break;		
          case 14: $state_id = 85; break;		
          case 15: $state_id = 87; break;		
          case 16: $state_id = 89; break;		
          case 17: $state_id = 99; break;		
          case 18: $state_id = 91; break;				
	   } 	
   
       //OBTENER LA EDAD DEL USUARIO 
       /*********************************************************************************/
      $fecha_actual = date ("Y-m-d"); 

      // separamos en partes las fechas 
      $array_nacimiento = explode ( "-", $fecha_nacimiento ); 
      $array_actual = explode ( "-", $fecha_actual ); 

      $anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años 
      $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
      $dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días 

      //ajuste de posible negativo en $días 
      if ($dias < 0) { 
        --$meses; 

        //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual  
        switch ($array_actual[1]) { 
           case 1:     $dias_mes_anterior=31; break; 
           case 2:     $dias_mes_anterior=31; break; 
           case 3:  
                if (bisiesto($array_actual[0])){ 
                    $dias_mes_anterior=29; break; 
                } else { 
                    $dias_mes_anterior=28; break; 
                } 
           case 4:     $dias_mes_anterior=31; break; 
           case 5:     $dias_mes_anterior=30; break; 
           case 6:     $dias_mes_anterior=31; break; 
           case 7:     $dias_mes_anterior=30; break; 
           case 8:     $dias_mes_anterior=31; break; 
           case 9:     $dias_mes_anterior=31; break; 
           case 10:     $dias_mes_anterior=30; break; 
           case 11:     $dias_mes_anterior=31; break; 
           case 12:     $dias_mes_anterior=30; break; 
        } 

        $dias=$dias + $dias_mes_anterior; 
     }  

     //ajuste de posible negativo en $meses 
     if ($meses < 0){ 
       --$anos; 
       $meses=$meses + 12; 
     } 
     /*********************************************************************************/   
	   
	 if($sexo == 'M'){
	    $genero = 'female';
	 }else{
	    $genero = 'male';
	 }
	
	 if($telefono1 == 0 || $telefono1 == ""){
	    $telefono1 = "";
	 }
	 
	 if($telefono2 == 0 || $telefono2 == ""){
	    $telefono2 = "";
	 }
	
	 if($telefono3 == 0 || $telefono4 == ""){
	   $telefono3 = "";
	 }

	 if($telefono4 == 0 || $telefono4 == ""){
	    $telefono4 = "";
	 }
	
     /*
	 if( strlen($identidad)<13 ){
	    $identidad_nueva = $identidad;
	 }else{
	    $identidad_nueva = SUBSTR($identidad,0,4)."-".SUBSTR($identidad,4,4)."-".SUBSTR($identidad,8,5);
	 }*/
	  
     $identidad_nueva = $identidad;
    //OBTENER CORRELATIVO  
	 $query_correlativo = "SELECT DISTINCT MAX(id) AS max, COUNT(id) AS count FROM res_partner";
	 $resultado_correlativo = pg_query($conexion, $query_correlativo);

     $correlativo = pg_fetch_array($resultado_correlativo);

     $numero = $correlativo['max'];
     $cantidad = $correlativo['count'];

     if ( $cantidad == 0 )
	    $numero = 1;
     else
        $numero = $numero + 1;	

    $query = "SELECT d.nombre AS 'departamento', m.nombre AS 'municipio'
           FROM pacientes AS p
           INNER JOIN departamentos AS d
           ON d.departamento_id = p.departamento_id
           INNER JOIN municipios AS m
           ON p.municipio_id = m.municipio_id
           WHERE pacientes_id = '$pacientes_id'";
		   
	$result = $mysqli->query($query);

    $consulta1 = $result->fetch_assoc();
    $city = $consulta1['municipio'];	   
	   
	$fecha_sistema = date("Y-m-d H:i:s");
	$date = date("Y-m-d");
	$company_id = 1;
	$tz = "America/Tegucigalpa";
	$lang = "es_GT";
		   
    if(isExistUsuario($expediente) == ""){//EVALUMAOS QUE NO EXISTA EL REGISTRO	 
       header('Access-Control-Allow-Origin: *');  
       $GLOBALS['xmlrpc_internalencoding']='UTF-8';
	   
	   $url = URLPS;
	   $host = SERVERPS;
	   $dbname = DBPS; 
       $username = USER_NAMEPS;
       $password = PASSWORDPS; 
	   $db = $dbname;
	   
       require_once('ripcord-master/ripcord.php');
       $models = ripcord::client("$url/xmlrpc/2/common");
       //Authenticate the credentials
       $uid = $models->authenticate($db, $username, $password, array());
       $models = ripcord::client("$url/xmlrpc/2/object");
	 
       $new_partner_id = $models->execute_kw($db, $uid, $password,
        'res.partner',
        'create', // Function name
        array( // Values-array
           array( // First record
              'name'=>$nombre,
			  'company_id'=>$company_id,
			  'create_date'=>$fecha_sistema,
			  'color'=>'0',
			  'display_name'=>$nombre,
			  'supplier'=>'f',
			  'ref'=>$expediente,
			  'customer'=>'t',	
			  'employee'=>'f',
			  'write_date'=>$fecha_sistema,
			  'active'=>'t',
			  'tz'=>$tz,
			  'write_uid'=>'1',
			  'lang'=>$lang,
			  'create_uid'=>'1',
              'phone'=> $telefono1,			
			  'type'=>'contact',
			  'use_parent_address'=>'f',
			  'birth_date'=>$fecha_nacimiento,
			  'age'=>'27',
			  'date'=>$date,
			  'state_id'=>$state_id,
			  'city'=>$city,
			  'street'=>$street,
			  'country_id'=>$pais,
			  'commercial_partner_id'=>$numero,
			  'notify_email'=>'always',
			  'opt_out'=>'f',
			  'last_reconciliation_date'=>$fecha_sistema,
			  'vat_subjected'=>'f',
			  'x_identidad'=>$identidad_nueva,
			  'x_tel_2'=>$telefono2,
			  'x_tel_3'=>$telefono3,
			  'x_tel_4'=>$telefono4,
			  'gender'=>$genero,
			  'is_doctor'=>'f',
			  'is_pharmacy'=>'f',	
			  'is_person'=>'f',	
			  'is_insurance_company'=>'f',	
			  'is_school'=>'f',	
			  'is_patient'=>'t',	
			  'is_work'=>'f',	
			  'is_institution'=>'f',	
			  'picking_warn'=>'no-message',	
			  'sale_warn'=>'no-message',	
			  'purchase_warn'=>'no-message',	
			  'invoice_warn'=>'no-message',	
			  'email'=>$correo,	
          )
        )
    );
	
	if(isMedical_Patient($numero) == ""){
		 //OBTENER CORRELATIVOS MEDICAL PATIENT ID
	    $query_correlativo_medical_patient = "SELECT DISTINCT MAX(id) AS max, COUNT(id) AS count FROM medical_patient";
	    $resultado_correlativo_medical_patient = pg_query($conexion, $query_correlativo_medical_patient);

        $correlativo_medical_patient = pg_fetch_array($resultado_correlativo_medical_patient);

        $numero_medical_patient = $correlativo_medical_patient['max'];
        $cantidad_medical_patient = $correlativo_medical_patient['count'];

        if ( $cantidad_medical_patient == 0 )
	       $numero_medical_patient = 1;
        else
          $numero_medical_patient = $numero_medical_patient + 1;
	  
        //OBTENER CORRELATIVO  
	    $query_correlativo_secuence = "SELECT MAX(number_next) AS max FROM ir_sequence WHERE code = 'medical.patient'";
	    $resultado_correlativo_secuence = pg_query($conexion, $query_correlativo_secuence);

        $correlativo_secuence = pg_fetch_array($resultado_correlativo_secuence);

        $numero_secence = $correlativo_secuence['max'];

        if ( $numero_secence == 0 )
	       $numero_secence1 = 1;
        else
           $numero_secence1 = $numero_secence;
		
		//OBTENER PREFIJO
		$query_correlativo_prefijo = "SELECT prefix FROM ir_sequence WHERE code = 'medical.patient'";
	    $resultado_correlativo_prefijo = pg_query($conexion, $query_correlativo_prefijo);

        $correlativo_prefijo = pg_fetch_array($resultado_correlativo_prefijo);

        $prejijo = $correlativo_prefijo['prefix'];		
		$medical_code_internal = $prejijo."000".$numero_secence1;
			
        //EVALUAMOS EL GENERO EN ODOO	
        switch($genero){
	  	   case 'female': $genero_odoo = 'f'; break;
           case 'male': $genero_odoo = 'm'; break;				
	    } 	
	   
        //EVALUAMOS EL ESTADO CIVIL	
        switch($estado_civil){
	  	   case 1: $estado_civil_odoo = 's'; break;//SOLTERO
           case 2: $estado_civil_odoo = 'm'; break;//CASADO
	  	   case 3: $estado_civil_odoo = 'd'; break;//DIVORCIADO
           case 4: $estado_civil_odoo = 'z'; break;//VIODO
           case 5: $estado_civil_odoo = 'w'; break;//UNION LIBRE 
           case 6: $estado_civil_odoo = 'x'; break;//SEPARADO
		   default: $estado_civil_odoo = 's'; break;
	    } 	   
	   
	    $date = date("Y-m-d", strtotime($fecha_sistema));
		
        $new_patient = $models->execute_kw($db, $uid, $password,
           'medical.patient',
           'create', // Function name
           array( // Values-array
              array( // First record
                 'create_uid'=>'1',
			     'create_date'=>$fecha_sistema,
			     'dob'=>$fecha_nacimiento,
			     'gender'=>$genero_odoo,
			     'marital_status'=>$estado_civil_odoo,
				 'medical_center_id'=>$numero,
			     'write_uid'=>'1',
			     'write_date'=>$fecha_sistema,
			     'active'=>'t',
				 'gerneral_info'=>'',
			     'partner_id'=>$numero,
			     'identification_code'=>$medical_code_internal,
				 'age'=>'27y 3m 4d',
              )
            )
         );	
		
		 //GUARDAMOS LA SECUENCIA
         //OBTENER CORRELATIVO  
	     $query_correlativo_secuence = "SELECT DISTINCT MAX(number_next) AS max, COUNT(number_next) AS count FROM ir_sequence WHERE code = 'medical.patient'";
	     $resultado_correlativo_secuence = pg_query($conexion, $query_correlativo_secuence);

         $correlativo_secuence = pg_fetch_array($resultado_correlativo_secuence);

         $numero_secence = $correlativo_secuence['max'];
         $cantidad_secuence = $correlativo_secuence['count'];

         if ( $cantidad_secuence == 0 )
	        $numero_secence = 1;
         else
            $numero_secence = $numero_secence + 1;
				
		 $query_insert_Partner_id = "UPDATE ir_sequence SET number_next = $numero_secence WHERE code = 'medical.patient'";
         pg_exec($conexion,$query_insert_Partner_id);
	   }
	
	   if(is_int($new_partner_id)){
          destroy($conexion);
       }else{
         echo "";
       }  
	}
	
	  $result->free();//LIMPIAR RESULTADO
      $mysqli->close();//CERRAR CONEXIÓN
   }

   //CONSULTAMOS LA EXISTENCIA DEL REGISTRO EN LA ENTIDAD res_partner
   function isExistUsuario($expediente){
	  //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
      $conexion = conectar();	 	  
      $query_cosultar_expediente = "SELECT id FROM res_partner WHERE ref = '$expediente'";
      $resultado_cosultar_expediente = pg_query($conexion, $query_cosultar_expediente);
      $consulta1 = pg_fetch_array($resultado_cosultar_expediente);
	 
      $numReg = $consulta1['id'];
	  
	  return $numReg;
   }
   
   //CONSULTAMOS LA EXISTENCIA DEL REGISTRO MEDICAL PATIENT
   function isMedical_Patient($partner_id){
	  //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
      $conexion = conectar();	 	  
      $query_cosultar_partner_id = "SELECT id FROM medical_patient WHERE partner_id = '$partner_id'";
      $resultado_cosultar_partner_id = pg_query($conexion, $query_cosultar_partner_id);
      $consulta_partner_id = pg_fetch_array($resultado_cosultar_partner_id);
	 
      $numReg_partner_id = $consulta_partner_id['id'];
	  
	  return $numReg_partner_id;
   }   
   
   function updateOdoo($expediente, $identidad, $nombre, $fecha_nacimiento, $telefono1, $telefono2, $telefono3, $telefono4, $sexo, $steet, $pacientes_id, $departamento, $pais, $correo,$estado_civil){  
       header('Access-Control-Allow-Origin: *');  
       $GLOBALS['xmlrpc_internalencoding']='UTF-8';
       //LEER ARCHIVO DE CONFIGURACION PARA LA CONEXION	
	   
	   $url = URLPS;
	   $host = SERVERPS;
	   $dbname = DBPS; 
       $username = USER_NAMEPS;
       $password = PASSWORDPS; 
	   $db = $dbname;	   
	   
       require_once('ripcord-master/ripcord.php');
       $models = ripcord::client("$url/xmlrpc/2/common");
       //Authenticate the credentials
       $uid = $models->authenticate($db, $username, $password, array());
       $models = ripcord::client("$url/xmlrpc/2/object");
	   
	   //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
	   $conexion = conectar();
	   
	   //CONEXION A BASE DE DATOS MYSQL
	   $mysqli = connectMySQL();

       //EVALUAMOS EL CODIGO DEL DEPARTAMENTO Y LO MOSTRAMOS CON EL VALOR QUE ODOO RECIBE	
       switch($departamento){
	  	  case 1: $state_id = 63; break;
          case 2: $state_id = 67; break;		
          case 3: $state_id = 69; break;		
          case 4: $state_id = 71; break;		
          case 5: $state_id = 61; break;		
          case 6: $state_id = 65; break;		
          case 7: $state_id = 73; break;		
          case 8: $state_id = 75; break;		
          case 9: $state_id = 98; break;		
          case 10: $state_id = 77; break;		
          case 11: $state_id = 79; break;		
          case 12: $state_id = 81; break;		
          case 13: $state_id = 83; break;		
          case 14: $state_id = 85; break;		
          case 15: $state_id = 87; break;		
          case 16: $state_id = 89; break;		
          case 17: $state_id = 99; break;		
          case 18: $state_id = 91; break;				
	   } 	
 	 
       //OBTENER LA EDAD DEL USUARIO 
       /*********************************************************************************/
      $fecha_actual = date ("Y-m-d"); 

      // separamos en partes las fechas 
      $array_nacimiento = explode ( "-", $fecha_nacimiento ); 
      $array_actual = explode ( "-", $fecha_actual ); 

      $anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años 
      $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
      $dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días 
	  
      //ajuste de posible negativo en $días 
      if ($dias < 0) { 
        --$meses; 

        //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual  
        switch ($array_actual[1]) { 
           case 1:     $dias_mes_anterior=31; break; 
           case 2:     $dias_mes_anterior=31; break; 
           case 3:  
                if (bisiesto($array_actual[0])){ 
                    $dias_mes_anterior=29; break; 
                } else { 
                    $dias_mes_anterior=28; break; 
                } 
           case 4:     $dias_mes_anterior=31; break; 
           case 5:     $dias_mes_anterior=30; break; 
           case 6:     $dias_mes_anterior=31; break; 
           case 7:     $dias_mes_anterior=30; break; 
           case 8:     $dias_mes_anterior=31; break; 
           case 9:     $dias_mes_anterior=31; break; 
           case 10:     $dias_mes_anterior=30; break; 
           case 11:     $dias_mes_anterior=31; break; 
           case 12:     $dias_mes_anterior=30; break; 
        } 

        $dias=$dias + $dias_mes_anterior; 
     }  

     //ajuste de posible negativo en $meses 
     if ($meses < 0){ 
       --$anos; 
       $meses=$meses + 12; 
     } 
     /*********************************************************************************/
	 
      $query = "SELECT d.nombre AS 'departamento', m.nombre AS 'municipio'
             FROM pacientes AS p
             INNER JOIN departamentos AS d
             ON d.departamento_id = p.departamento_id
             INNER JOIN municipios AS m
             ON p.municipio_id = m.municipio_id
             WHERE pacientes_id = '$pacientes_id'";
	   $result = $mysqli->query($query);

       $consulta1 = $result->fetch_assoc();
       $city = $consulta1['municipio'];
	 
	   if($sexo == 'M'){
	      $genero = 'female';
	   }else{
	      $genero = 'male';
	   }
	
	   if($telefono1 == 0 || $telefono1 == ""){
	      $telefono1 = "";
	   }
	 
	   if($telefono2 == 0 || $telefono2 == ""){
	      $telefono2 = "";
	   }
	
	   if($telefono3 == 0 || $telefono4 == ""){
	     $telefono3 = "";
	   }

	   if($telefono4 == 0 || $telefono4 == ""){
	      $telefono4 = "";
	   }
	 
       /*
	   if( strlen($identidad)<13 ){
	      $identidad_nueva = $identidad;
	   }else{
	      $identidad_nueva = SUBSTR($identidad,0,4)."-".SUBSTR($identidad,4,4)."-".SUBSTR($identidad,8,5);
	   }*/
	   
       $identidad_nueva = $identidad;
	   //EDITAMOS LOS VALORES EN RES_PARTNER
	   $query_update = "UPDATE res_partner 
	      SET name = '$nombre', display_name = '$nombre', x_identidad = '$identidad_nueva', birth_date = '$fecha_nacimiento', phone = '$telefono1', x_tel_2 = '$telefono2', x_tel_3 = '$telefono3', x_tel_4 = '$telefono4', gender = '$genero', state_id = '$state_id', city = '$city', street = '$steet', country_id = '$pais', age = '$anos', email = '$correo'
		  WHERE ref = '$expediente'";	

	    pg_exec($conexion,$query_update);
		
       //EDITAMOS LOS VALORES EN MEDICAL_PATIENT	
	    //EVALUAMOS EL GENERO EN ODOO	
        switch($genero){
	  	   case 'female': $genero_odoo = 'f'; break;
           case 'male': $genero_odoo = 'm'; break;				
	    } 	
	   
        //EVALUAMOS EL ESTADO CIVIL	
        switch($estado_civil){
	  	   case 1: $estado_civil_odoo = 's'; break;//SOLTERO
           case 2: $estado_civil_odoo = 'm'; break;//CASADO
	  	   case 3: $estado_civil_odoo = 'd'; break;//DIVORCIADO
           case 4: $estado_civil_odoo = 'z'; break;//VIODO
           case 5: $estado_civil_odoo = 'w'; break;//UNION LIBRE 
           case 6: $estado_civil_odoo = 'x'; break;//SEPARADO
		   default: $estado_civil_odoo = 's'; break;
	    } 		
		
 	    //CONSULTAR PARTNER_ID 
	    $query_partner_id = "SELECT id FROM res_partner WHERE ref = '$expediente'";
	    $resultado_partner_id = pg_query($conexion, $query_partner_id);

        $consulta_partner_id = pg_fetch_array($resultado_partner_id);

        $partner_id = $consulta_partner_id['id'];
		$fecha_sistema = date("Y-m-d H:i:s");
		
		
	  if(isMedical_Patient($partner_id) == ""){
		  $numero = $partner_id;
		   //OBTENER CORRELATIVOS MEDICAL PATIENT ID
	      $query_correlativo_medical_patient = "SELECT DISTINCT MAX(id) AS max, COUNT(id) AS count FROM medical_patient";
	      $resultado_correlativo_medical_patient = pg_query($conexion, $query_correlativo_medical_patient);

          $correlativo_medical_patient = pg_fetch_array($resultado_correlativo_medical_patient);

          $numero_medical_patient = $correlativo_medical_patient['max'];
          $cantidad_medical_patient = $correlativo_medical_patient['count'];

          if ( $cantidad_medical_patient == 0 )
	         $numero_medical_patient = 1;
          else
             $numero_medical_patient = $numero_medical_patient + 1;
	  
          //OBTENER CORRELATIVO  
	      $query_correlativo_secuence = "SELECT MAX(number_next) AS max FROM ir_sequence WHERE code = 'medical.patient'";
	      $resultado_correlativo_secuence = pg_query($conexion, $query_correlativo_secuence);

          $correlativo_secuence = pg_fetch_array($resultado_correlativo_secuence);

          $numero_secence = $correlativo_secuence['max'];

          if ( $numero_secence == 0 )
	         $numero_secence1 = 1;
          else
             $numero_secence1 = $numero_secence;
		
		  //OBTENER PREFIJO
		  $query_correlativo_prefijo = "SELECT prefix FROM ir_sequence WHERE code = 'medical.patient'";
	      $resultado_correlativo_prefijo = pg_query($conexion, $query_correlativo_prefijo);

          $correlativo_prefijo = pg_fetch_array($resultado_correlativo_prefijo);

          $prejijo = $correlativo_prefijo['prefix'];		
		  $medical_code_internal = $prejijo."000".$numero_secence1;
	   
	      $date = date("Y-m-d", strtotime($fecha_sistema));
		
          $new_patient = $models->execute_kw($db, $uid, $password,
             'medical.patient',
             'create', // Function name
             array( // Values-array
                array( // First record
                   'create_uid'=>'1',
			       'create_date'=>$fecha_sistema,
			       'dob'=>$fecha_nacimiento,
			       'gender'=>$genero_odoo,
			       'marital_status'=>$estado_civil_odoo,
				   'medical_center_id'=>$numero,
			       'write_uid'=>'1',
			       'write_date'=>$fecha_sistema,
			       'active'=>'t',
				   'gerneral_info'=>'',
			       'partner_id'=>$numero,
			       'identification_code'=>$medical_code_internal,
				   'age'=>'27y 3m 4d',
                )
             )
           );	
		
		  //GUARDAMOS LA SECUENCIA
          //OBTENER CORRELATIVO  
	      $query_correlativo_secuence = "SELECT DISTINCT MAX(number_next) AS max, COUNT(number_next) AS count FROM ir_sequence WHERE code = 'medical.patient'";
	      $resultado_correlativo_secuence = pg_query($conexion, $query_correlativo_secuence);
 
          $correlativo_secuence = pg_fetch_array($resultado_correlativo_secuence);

          $numero_secence = $correlativo_secuence['max'];
          $cantidad_secuence = $correlativo_secuence['count'];

          if ( $cantidad_secuence == 0 )
	         $numero_secence = 1;
          else
             $numero_secence = $numero_secence + 1;
				
		  $query_insert_Partner_id = "UPDATE ir_sequence SET number_next = $numero_secence WHERE code = 'medical.patient'";
          pg_exec($conexion,$query_insert_Partner_id);
	   }else{
		   $query_medical_patient = "UPDATE medical_patient SET gender = '$genero_odoo', marital_status = '$estado_civil_odoo'";
		   pg_exec($conexion,$query_medical_patient); 
	   }
	  		  		 
        destroy($conexion);
		
		$result->free();//LIMPIAR RESULTADO        
		$mysqli->close();//CERRAR CONEXIÓN
   }  
   
   function insertFacturacion($expediente, $servicio_nombre, $tipo_unidad, $identidad_medico, $anos_paciente, $product_template_id1, $cantidad1, $product_template_id2, $cantidad2, $product_template_id3, $cantidad3, $product_template_id4, $cantidad4, $product_template_id5, $cantidad5, $servicio_id, $colaborador_id){	   
       header('Access-Control-Allow-Origin: *');  
       $GLOBALS['xmlrpc_internalencoding']='UTF-8';  
	   
	   $url = URLPS;
	   $host = SERVERPS;
	   $dbname = DBPS; 
       $username = USER_NAMEPS;
       $password = PASSWORDPS; 
	   $db = $dbname;	 
	   
       require_once('ripcord-master/ripcord.php');
       $models = ripcord::client("$url/xmlrpc/2/common");
       //Authenticate the credentials
       $uid = $models->authenticate($db, $username, $password, array());
       $models = ripcord::client("$url/xmlrpc/2/object");
	   
	   //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
	   $conexion = conectar();	
	   
	   $fecha_sistema = date("Y-m-d H:i:s");
	   $fecha = date("Y-m-d");
	   $date = date("Y-m-d");
	   $company_id = 1;
	   $tz = "America/Tegucigalpa";
	   $lang = "es_GT";	 
       $currency_id = '45';
	   $amount_untaxed = 0.000;
	   $amount_discount = 0.000;
	   $amount_total = 0.000;
	   
       //CONSULTAMOS EL PARTNER_ID EN LA ENTIDAD res_partner
       $query_ref_partner = "SELECT id FROM res_partner WHERE ref = '$expediente'";
       $resultado_busqueda_ref_partner = pg_query($conexion, $query_ref_partner); 
       $consulta_ref_partner = pg_fetch_array($resultado_busqueda_ref_partner);
       $partner_id = $consulta_ref_partner['id'];
	   	 	   
	   //INICIO CALCULO MEDICAMENTO1	   	   	   
	   //CONSULTAR DESCUENTO DE MEDICAMENTO1
	   if($product_template_id1 != "" && $cantidad1 != ""){
	      //CONSULTAR EL PRECIO DEL MEDICAMENTO/PRODUCTO
	      $costo_medicamento1 = costoMedicamento($product_template_id1); //PRECIO UNITARIO (COSTO)
		  $producto_descuento1 = descuentoMedicamento($product_template_id1);//DESCUENTO DEL MEDICAMENTO
	   
	      //CALCULAMOS EL TOTAL SIN DESCUENTO
	      $amount_untaxed += $costo_medicamento1;
	   
	      //CALCULAMOS EL DESCUENTO POR SEPARADO
	      $total_descuento = $amount_untaxed * $producto_descuento1;
	      //SUMAMOS EL ACUMULADO DEL DESCUENTO
	      $amount_discount += $total_descuento;
	   
	      //TOTAL CON DESCUENTO
	      $total_con_descuento = $costo_medicamento1 - $total_descuento;
	      $amount_total += $total_con_descuento;  
	   }
       //FIN CALCULO MEDICAMENTO1	

	   //CONSULTAR DESCUENTO DE MEDICAMENTO2
	   if($product_template_id2 != "" && $cantidad2 != ""){
	      //CONSULTAR EL PRECIO DEL MEDICAMENTO/PRODUCTO
	      $costo_medicamento2 = costoMedicamento($product_template_id2); //PRECIO UNITARIO (COSTO)
		  $producto_descuento2 = descuentoMedicamento($product_template_id2);//DESCUENTO DEL MEDICAMENTO
	   
	      //CALCULAMOS EL TOTAL SIN DESCUENTO
	      $amount_untaxed += $costo_medicamento2;
	   
	      //CALCULAMOS EL DESCUENTO POR SEPARADO
	      $total_descuento = $amount_untaxed * $producto_descuento2;
	      //SUMAMOS EL ACUMULADO DEL DESCUENTO
	      $amount_discount += $total_descuento;
	   
	      //TOTAL CON DESCUENTO
	      $total_con_descuento = $costo_medicamento2 - $total_descuento;
	      $amount_total += $total_con_descuento;  		   
	   }
       //FIN CALCULO MEDICAMENTO2	

	   //CONSULTAR DESCUENTO DE MEDICAMENTO3
	   if($product_template_id3 != "" && $cantidad3 != ""){
	      //CONSULTAR EL PRECIO DEL MEDICAMENTO/PRODUCTO
	      $costo_medicamento3 = costoMedicamento($product_template_id3); //PRECIO UNITARIO (COSTO)
		  $producto_descuento3 = descuentoMedicamento($product_template_id3);//DESCUENTO DEL MEDICAMENTO
	   
	      //CALCULAMOS EL TOTAL SIN DESCUENTO
	      $amount_untaxed += $costo_medicamento3;
	   
	      //CALCULAMOS EL DESCUENTO POR SEPARADO
	      $total_descuento = $amount_untaxed * $producto_descuento3;
	      //SUMAMOS EL ACUMULADO DEL DESCUENTO
	      $amount_discount += $total_descuento;
	   
	      //TOTAL CON DESCUENTO
	      $total_con_descuento = $costo_medicamento3 - $total_descuento;
	      $amount_total += $total_con_descuento;  		   
	   }
       //FIN CALCULO MEDICAMENTO3	

	   //CONSULTAR DESCUENTO DE MEDICAMENTO4
	   if($product_template_id4 != "" && $cantidad4 != ""){
	      //CONSULTAR EL PRECIO DEL MEDICAMENTO/PRODUCTO
	      $costo_medicamento4 = costoMedicamento($product_template_id4); //PRECIO UNITARIO (COSTO)
		  $producto_descuento4 = descuentoMedicamento($product_template_id4);//DESCUENTO DEL MEDICAMENTO
	   
	      //CALCULAMOS EL TOTAL SIN DESCUENTO
	      $amount_untaxed += $costo_medicamento3;
	   
	      //CALCULAMOS EL DESCUENTO POR SEPARADO
	      $total_descuento = $amount_untaxed * $producto_descuento4;
	      //SUMAMOS EL ACUMULADO DEL DESCUENTO
	      $amount_discount += $total_descuento;
	   
	      //TOTAL CON DESCUENTO
	      $total_con_descuento = $costo_medicamento4 - $total_descuento;
	      $amount_total += $total_con_descuento;  		   
	   }
       //FIN CALCULO MEDICAMENTO4	   
	   
	   //CONSULTAR DESCUENTO DE MEDICAMENTO5
	   if($product_template_id5 != "" && $cantidad5 != ""){
	      //CONSULTAR EL PRECIO DEL MEDICAMENTO/PRODUCTO
	      $costo_medicamento5 = costoMedicamento($product_template_id5); //PRECIO UNITARIO (COSTO)
		  $producto_descuento5 = descuentoMedicamento($product_template_id5);//DESCUENTO DEL MEDICAMENTO
	   
	      //CALCULAMOS EL TOTAL SIN DESCUENTO
	      $amount_untaxed += $costo_medicamento5;
	   
	      //CALCULAMOS EL DESCUENTO POR SEPARADO
	      $total_descuento = $amount_untaxed * $producto_descuento5;
	      //SUMAMOS EL ACUMULADO DEL DESCUENTO
	      $amount_discount += $total_descuento;
	   
	      //TOTAL CON DESCUENTO
	      $total_con_descuento = $costo_medicamento5 - $total_descuento;
	      $amount_total += $total_con_descuento; 
	   }
       //FIN CALCULO MEDICAMENTO5
	   
	   //OBTENER EL NOMBRE LA CUENTA ANALITICA
	   $query_cuenta_analitica = "SELECT id
           FROM account_analytic_account
           WHERE name = '$servicio_nombre'";
	   $resultado_cuenta_analitica = pg_query($conexion, $query_cuenta_analitica); 
       $consulta_cuenta_analitica = pg_fetch_array($resultado_cuenta_analitica);
       $producto_descuento1 = $consulta_cuenta_analitica['id'];//CUENTA ANALITICA
	   
	   //EVALUAMOS EL TIPO DE SERVICIO QUE SE ESTA DANDO AL USUARIO
	   $query_tipo_unidad = "SELECT id
          FROM x_tipo_unidad
          WHERE x_name = '$tipo_unidad'";
	   $resultado_tipo_unidad = pg_query($conexion, $query_tipo_unidad); 
       $consulta_tipo_unidad = pg_fetch_array($resultado_tipo_unidad);
       $x_tipo_unidad = $consulta_tipo_unidad['id'];//TIPO DE UNIDAD DE LA CUAL SE ATENDIO, SEGUN LA UNIDAD	  
	   
	   //CONSULTAR ID DE MEDICO EN LA ENTIDAD medical
	   $query_x_medico = "SELECT mp.id AS id_medicos
           FROM medical_physician AS mp
           INNER JOIN res_partner AS rp
           ON mp.partner_id = rp.id
           WHERE rp.x_identidad = '$identidad_medico'";
	   $resultado_x_medico = pg_query($conexion, $query_x_medico); 
       $consulta_x_medico = pg_fetch_array($resultado_x_medico);
       $x_medico = $consulta_x_medico['id_medicos'];//x_medico DE LA ENTIDAD medical_physician 	

       //EVALUAMOS EL TIPO DE CLIENTE
	   if($anos_paciente >= 60){//ES UN CLIENTE/USUARIO/PACIENTE DE LA TERCERA EDAD
		   $x_tipo_cliente = 5;
	   }else{//ES UN CLIENTE/USUARIO/PACIENTE NORMAL, SE TIENE QUE EVALUAR POR TRABAJO SOCIAL SI ASÍ SE REQUIERE
		   $x_tipo_cliente = 4;
	   }	

	   //CONSULTAR LA CUENTA ANALITICA, BASADOS EN EL NOMBRE DEL SERVICIO DE ATENCIÓN
	   $query_servicio_nombre = "SELECT id AS servicio_id
          FROM account_analytic_account
          WHERE name = '$servicio_nombre'";		  
	   $resultado_servicio_nombre = pg_query($conexion, $query_servicio_nombre); 
       $consulta_servicio_nombre = pg_fetch_array($resultado_servicio_nombre);
       $x_analytic_id = $consulta_servicio_nombre['servicio_id'];//Cuenta Analitica DE LA ENTIDAD account_analytic_account 
	   
	   //CONECTAR BASE DE DATOS MYSQL
	   $mysqli = connectMySQL();
	   
       //EVALUAR EL USAURIO QUE SE LE ENTREGARÁ LA FACTURA
       $colaborador_id = 14;
       $user_id = 1;
	   
	   //VALOR EN LETRAS
	   $amount_to_text = numtoletras($amount_total);  
	   
       $new_account_invoice = $models->execute_kw($db, $uid, $password,
           'account.invoice',
           'create', // Function name
           array( // Values-array
              array( // First record
                 'check_total'=>'0.000',
			     'company_id'=>$company_id,
			     'currency_id'=>$currency_id,
			     'create_date'=>$fecha_sistema,
			     'create_uid'=>$user_id,
				 'amount_untaxed'=>$amount_untaxed,
			     'partner_id'=>$partner_id,
			     'reference_type'=>'none',
			     'journal_id'=>'1',
				 'amount_tax'=>'0.0000',
				 'stete'=>'draf',
			     'type'=>'out_invoice',
			     'account_id'=>'8',
				 'reconciled'=>'f',
				 'residual'=>'0.0000',
				 'write_date'=>$fecha_sistema,
				 'user_id'=>$user_id,
				 'write_uid'=>$user_id,
				 'amount_total'=>$amount_total,
				 'sent'=>'f',
				 'commercial_partner_id'=>$partner_id,
				 'x_medico'=>$x_medico,
				 'amount_discount'=>$amount_discount,
				 'x_tipo_clientes'=>$x_tipo_cliente,//TIPO DE CLIENTE ATENDIDO, (TERCERA EDAD, EXTREMA POBREZA, OTROS)
				 'x_tipo_unidad'=>$x_tipo_unidad,//UNIDAD DE DONDE SE ATIENDE AL USUARIO
				 'amount_to_text'=>$amount_to_text,
				 'x_analytic_id'=>$x_analytic_id,//CUENTA ANALITICA
				 'pricelist_id'=>'1',		
				 'picking_transfer_id'=>'2',		
				 'picking_type_id'=>'1',		
				 'picking_count'=>'0',		
				 'move_count'=>'0',						 
              )
            )
       );  

       //ALMACENAMOS LOS DETALLES DE LOS MEDICAMENTOS/PRODUCTOS	 
       //CONSULTAMOS EL ULTIMO REGISTRO ALMACENADO EN LA FACTURACIÓN
       $sql_codigo_factura = "SELECT ai.id AS codigo_factura
           FROM account_invoice AS ai
           INNER JOIN res_partner AS rp
           ON ai.partner_id = rp.id
           WHERE rp.ref = '$expediente' AND CAST(ai.create_date AS DATE) = '$date ' AND ai.x_analytic_id = '$x_analytic_id'";
		   
	   $resultado_codigo_factura = pg_query($conexion, $sql_codigo_factura); 
       $consulta_codigo_factura = pg_fetch_array($resultado_codigo_factura);
       $invoice_id = $consulta_codigo_factura['codigo_factura'];//invoice_id DE LA ENTIDAD account_invoice PARA SABER QUE FACTURA SE GENERÓ	 

       //LLAMAMOS A LA FUNCION LA CUAL GUARDARÁ EL DETALLE DE LA FACTURA
       detalleFacturaMedicamentos($product_template_id1, $cantidad1, $product_template_id2, $cantidad2, $product_template_id3, $cantidad3, $product_template_id4, $cantidad4, $product_template_id5, $cantidad5, $user_id, $partner_id, $invoice_id);	
	   
       //GUARDAMOS LA INFORMACION EN LA BASE DE DATOS DE MYSQL EN LA ENTIDAD, FACUTRAS-ODOO
	   $correlativo_facturas_odoo = "SELECT MAX(facturas_id) AS max, COUNT(facturas_id) AS count 
	       FROM facturas_odoo";
	   $result = $mysqli->query($correlativo_facturas_odoo);
       $correlativo_facturas_odoo2 = $result->fetch_assoc();

       $numero = $correlativo_facturas_odoo2['max'];
       $cantidad = $correlativo_facturas_odoo2['count'];

       if ( $cantidad == 0 )
	      $numero = 1;
       else
          $numero = $numero + 1;

	   $insert = "INSERT INTO facturas_odoo VALUES ('$numero', '$invoice_id','$colaborador_id','$fecha','$fecha_sistema')";
	   $mysqli->query($insert);
	   
	   $result->free();//LIMPIAR RESULTADO
       $mysqli->close();//CERRAR CONEXIÓN	   
   }   
   
   function detalleFacturaMedicamentos($product_template_id1, $cantidad1, $product_template_id2, $cantidad2, $product_template_id3, $cantidad3, $product_template_id4, $cantidad4, $product_template_id5, $cantidad5, $user_id, $partner_id, $invoice_id){  
   	   //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
	   $conexion = conectar();	
	   
	   //INICIO DETALLES MEDICAMENTO1
	   if($product_template_id1 != "" && $cantidad1 != ""){
          $uos_id = medidaMedicamento($product_template_id1);
	      $product_id = codigoMedicamento($product_template_id1);
	      $name_medicamento = nombreMedicamento($product_template_id1);
	      $price_unit = costoMedicamento($product_template_id1);
	      $price_subtotal = $price_unit * $cantidad1;
		  
		  $invoice_line_tax_id = descuentoMedicamentoCodigo($product_template_id1);
		            
		  insertDetalleFacturasMedicamentos($user_id, $uos_id, $invoice_id, $price_unit, $price_subtotal, $product_id, $partner_id, $cantidad1, $name_medicamento, $invoice_line_tax_id);		  
	   }	
       //FIN DETALLES DE MEDICAMENTOS 1	
	     
	   //INICIO DETALLES MEDICAMENTO2
	   if($product_template_id2 != "" && $cantidad2 != ""){
          $uos_id = medidaMedicamento($product_template_id2);
	      $product_id = codigoMedicamento($product_template_id2);
	      $name_medicamento = nombreMedicamento($product_template_id2);
	      $price_unit = costoMedicamento($product_template_id2);
	      $price_subtotal = $price_unit * $cantidad2;
		  
		  $invoice_line_tax_id = descuentoMedicamentoCodigo($product_template_id2);
		            
		  insertDetalleFacturasMedicamentos($user_id, $uos_id, $invoice_id, $price_unit, $price_subtotal, $product_id, $partner_id, $cantidad2, $name_medicamento, $invoice_line_tax_id);			  
	   }	
       //FIN DETALLES DE MEDICAMENTOS 2	

	   //INICIO DETALLES MEDICAMENTO 3
	   if($product_template_id1 != "" && $cantidad3 != ""){
          $uos_id = medidaMedicamento($product_template_id3);
	      $product_id = codigoMedicamento($product_template_id3);
	      $name_medicamento = nombreMedicamento($product_template_id3);
	      $price_unit = costoMedicamento($product_template_id3);
	      $price_subtotal = $price_unit * $cantidad3;
		  
		  $invoice_line_tax_id = descuentoMedicamentoCodigo($product_template_id3);
		            
		  insertDetalleFacturasMedicamentos($user_id, $uos_id, $invoice_id, $price_unit, $price_subtotal, $product_id, $partner_id, $cantidad3, $name_medicamento, $invoice_line_tax_id);		  
	   }	
       //FIN DETALLES DE MEDICAMENTOS 3

	   //INICIO DETALLES MEDICAMENTO4
	   if($product_template_id4 != "" && $cantidad4 != ""){
          $uos_id = medidaMedicamento($product_template_id4);
	      $product_id = codigoMedicamento($product_template_id4);
	      $name_medicamento = nombreMedicamento($product_template_id4);
	      $price_unit = costoMedicamento($product_template_id4);
	      $price_subtotal = $price_unit * $cantidad4;
		  
		  $invoice_line_tax_id = descuentoMedicamentoCodigo($product_template_id4);
		            
		  insertDetalleFacturasMedicamentos($user_id, $uos_id, $invoice_id, $price_unit, $price_subtotal, $product_id, $partner_id, $cantidad4, $name_medicamento, $invoice_line_tax_id);		  
	   }	
       //FIN DETALLES DE MEDICAMENTOS 4

	   //INICIO DETALLES MEDICAMENTO5
	   if($product_template_id5 != "" && $cantidad5 != ""){
          $uos_id = medidaMedicamento($product_template_id5);
	      $product_id = codigoMedicamento($product_template_id5);
	      $name_medicamento = nombreMedicamento($product_template_id5);
	      $price_unit = costoMedicamento($product_template_id5);
	      $price_subtotal = $price_unit * $cantidad5;
		  
		  $invoice_line_tax_id = descuentoMedicamentoCodigo($product_template_id5);
		            
		  insertDetalleFacturasMedicamentos($user_id, $uos_id, $invoice_id, $price_unit, $price_subtotal, $product_id, $partner_id, $cantidad5, $name_medicamento, $invoice_line_tax_id);				  
	   }	
       //FIN DETALLES DE MEDICAMENTOS 5	  
   }   
   
   function insertDetalleFacturasMedicamentos($user_id, $uos_id, $invoice_id, $price_unit, $price_subtotal, $product_id, $partner_id, $quantity, $name_medicamento, $invoice_line_tax_id){
       header('Access-Control-Allow-Origin: *');  
       $GLOBALS['xmlrpc_internalencoding']='UTF-8';
	   
	   $url = URLPS;
	   $host = SERVERPS;
	   $dbname = DBPS; 
       $username = USER_NAMEPS;
       $password = PASSWORDPS; 
	   $db = $dbname;
	   
       require_once('ripcord-master/ripcord.php');
       $models = ripcord::client("$url/xmlrpc/2/common");
       //Authenticate the credentials
       $uid = $models->authenticate($db, $username, $password, array());
       $models = ripcord::client("$url/xmlrpc/2/object");
	   
	   $fecha_sistema = date("Y-m-d H:i:s");
	   $company_id = 1;
	   
       $new_account_invoice_line = $models->execute_kw($db, $uid, $password,
            'account.invoice.line',
            'create', // Function name
             array( // Values-array
                array( // First record
                   'create_uid'=>$user_id,
		           'uos_id'=>$uos_id,
		           'create_date'=>$fecha_sistema,
			       'account_id'=>'100',//100 ES EL CODIGO DE LA CUENTA CONTABLE QUE PERTENECE A LOS MEDICAMENTOS/PRODUCTOS
				   'sequence'=>'10',//PENDIENTE CONSEGUIR EL VALOR DE LA SECUENCA
			       'invoice_id'=>$invoice_id,
				   'price_unit'=>$price_unit,
			       'price_subtotal'=>$price_subtotal,
			       'company_id'=>$company_id,
				   'write_uid'=>$user_id,
				   'discount'=>'0.000',
			       'product_id'=>$product_id,
			       'write_date'=>$fecha_sistema,
				   'partner_id'=>$partner_id,
				   'quantity'=>$quantity,
				   'name'=>$name_medicamento,
                   'invoice_line_tax_id'=>$invoice_line_tax_id,			   
                )
             )
        );

	  //INSERTAR DESCUENTO LINEA DE FACTURAS
	  $query_account_invoice_line_id = "SELECT id AS account_invoice_line_id
	     FROM account_invoice_line WHERE invoice_id = '$invoice_id' AND product_id = '$product_id'";
		 		 
      $resultado_account_invoice_line_id = pg_query($conexion, $query_account_invoice_line_id); 
      $consulta_account_invoice_line_id = pg_fetch_array($resultado_account_invoice_line_id);
      $account_invoice_line_id = $consulta_account_invoice_line_id['account_invoice_line_id'];//amount_untaxed ES EL COSTO DEL MEDICAMENTO	 
	  	  
	  $query_insert_account_invoice_line = "INSERT INTO account_invoice_line_tax VALUES('$account_invoice_line_id','$invoice_line_tax_id')";
	  pg_exec($conexion,$query_insert_account_invoice_line);
   }
      
   function costoMedicamento($product_template_id){
     //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
     $conexion = conectar();
	   
	  $query_product_cost1 = "SELECT cost 
           FROM product_price_history AS ph
           INNER JOIN product_product AS pp
           ON pp.product_tmpl_id = ph.product_template_id
           WHERE pp.product_tmpl_id = '$product_template_id' ORDER BY ph.write_date DESC LIMIT 1";
      $resultado_product_cost1 = pg_query($conexion, $query_product_cost1); 
      $consulta_product_cost1 = pg_fetch_array($resultado_product_cost1);
      $costo_medicamento = $consulta_product_cost1['cost'];//amount_untaxed ES EL COSTO DEL MEDICAMENTO	 
 
      return $costo_medicamento;	  
   }
   
   function descuentoMedicamento($product_template_id){
     //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
     $conexion = conectar();
	 
	   $query_product_descuento1 = "SELECT ataxes.base_sign AS base_sign
           FROM product_taxes_rel As ptaxes
           INNER JOIN product_product AS pp
           ON pp.id = ptaxes.prod_id
           INNER JOIN product_template AS pt
           ON pp.product_tmpl_id = pt.id
           INNER JOIN account_tax AS ataxes
           ON ptaxes.tax_id = ataxes.id
           WHERE pp.product_tmpl_id = '$product_template_id' AND ataxes.is_discount = 'true'";
       $resultado_product_descuento1 = pg_query($conexion, $query_product_descuento1); 
       $consulta_product_descuento1 = pg_fetch_array($resultado_product_descuento1);
       $producto_descuento = $consulta_product_descuento1['base_sign'];//amount_untaxed ES EL COSTO DEL MEDICAMENTO		   
       
	   return $producto_descuento;
   }
   
   function descuentoMedicamentoCodigo($product_template_id){
     //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
     $conexion = conectar();
	 
	   $query_product_descuento_codigo = "SELECT ataxes.id AS cod_descuento
           FROM product_taxes_rel As ptaxes
           INNER JOIN product_product AS pp
           ON pp.id = ptaxes.prod_id
           INNER JOIN product_template AS pt
           ON pp.product_tmpl_id = pt.id
           INNER JOIN account_tax AS ataxes
           ON ptaxes.tax_id = ataxes.id
           WHERE pp.product_tmpl_id = '$product_template_id' AND ataxes.is_discount = 'true'";
       $resultado_product_descuento_codigo = pg_query($conexion, $query_product_descuento_codigo); 
       $consulta_product_descuento_codigo = pg_fetch_array($resultado_product_descuento_codigo);
       $producto_descuento_codigo = $consulta_product_descuento_codigo['cod_descuento'];//amount_untaxed ES EL COSTO DEL MEDICAMENTO		   
       
	   return $producto_descuento_codigo;
   }   
   
   function medidaMedicamento($product_template_id){
     //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
     $conexion = conectar();
	 
       $query_uos_id = "SELECT pu.id AS uos_id
          FROM product_uom AS pu
          INNER JOIN product_template as pt
          ON pu.id = pt.uom_po_id
          WHERE pt.id = '$product_template_id'";		  
       $resultado_uos_id = pg_query($conexion, $query_uos_id); 
       $consulta_uos_id = pg_fetch_array($resultado_uos_id);
       $uos_id = $consulta_uos_id['uos_id'];//uos_id CODIGO DE LA MEDIDA DEL MEDICAMENTO		  
	   return $uos_id;
   }
   
   function codigoMedicamento($product_template_id){
     //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
     $conexion = conectar();
	 
	  $query_product_id = "SELECT pp.id AS product_id
         FROM product_price_history AS ph
         INNER JOIN product_product AS pp
         ON pp.product_tmpl_id = ph.product_template_id
         WHERE pp.product_tmpl_id = '$product_template_id'";
      $resultado_product_id = pg_query($conexion, $query_product_id); 
      $consulta_product_id = pg_fetch_array($resultado_product_id);
      $product_id = $consulta_product_id['product_id'];//amount_untaxed ES EL COSTO DEL MEDICAMENTO	 

      return $product_id;	   
   }
   
   function nombreMedicamento($product_template_id){
     //ESTABLECEMOS LA CONEXION CON EL SERVIDOR postgreSQL
     $conexion = conectar();
	 
	  $query_nombre_medicamento = "SELECT CONCAT('[', pp.default_code, '] ', pp.name_template) AS nombre_medicamento
          FROM product_template AS pt
          INNER JOIN product_product AS pp
          ON pp.product_tmpl_id = pt.id
          WHERE pp.product_tmpl_id = '$product_template_id'";
      $resultado_nombre_medicamento = pg_query($conexion, $query_nombre_medicamento); 
      $consulta_nombre_medicamento = pg_fetch_array($resultado_nombre_medicamento);
      $nombre_medicamento = $consulta_nombre_medicamento['nombre_medicamento'];//amount_untaxed ES EL COSTO DEL MEDICAMENTO	 

      return $nombre_medicamento;	   
   }
   
   function destroy($conexion){
	   pg_close($conexion);
   } 


//------    CONVERTIR NUMEROS A LETRAS         ---------------
//------    Máxima cifra soportada: 18 dígitos con 2 decimales
//------    999,999,999,999,999,999.99
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE BILLONES
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE MILLONES
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE LPS 99/100 CTVS.
//------    Creada por:                        ---------------
//------             ULTIMINIO RAMOS GALÁN     ---------------
//------            uramos@gmail.com           ---------------
//------    10 de junio de 2009. México, D.F.  ---------------
//------    PHP Version 4.3.1 o mayores (aunque podría funcionar en versiones anteriores, tendrías que probar)
function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                            
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                            
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO LPS $xdecimales/100 CTVS.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO $xdecimales/100 CTVS. ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " LPS $xdecimales/100 CTVS. "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx){ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}   
?>