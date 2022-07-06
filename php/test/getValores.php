<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    session_start();   
    include('../funtions.php');

    //CONEXION A DB
    $mysqli = connect_mysqli();

    $fechai = "2021-12-01";
    $fechaf = "2021-12-31";
    $servicio_id = 1;
    $puesto_id = 2;
    $totalh = 0;
    $totalm = 0;

    $query = "SELECT DISTINCT a.expediente AS 'expediente'
        FROM ata AS a
        INNER JOIN colaboradores AS c
        ON a.colaborador_id = c.colaborador_id
        WHERE a.fecha BETWEEN '$fechai' AND '$fechaf' AND a.servicio_id = '$servicio_id' AND c.puesto_id = '$puesto_id'
        ORDER BY a.expediente ASC"; 
    $result = $mysqli->query($query);  
    
    while($row = $result->fetch_assoc()){
        $expediente = $row["expediente"];

        //CONSULTAR EL TOTAL DE PACIENTES POR GENERO
        $query_genero = "SELECT sexo
            FROM pacientes
            WHERE expediente = '$expediente'";
        $result_genero = $mysqli->query($query_genero); 
        
        if($result_genero->num_rows>0){
            $row_genero = $result_genero->fetch_assoc();
            $genero = $row_genero["sexo"];

            if($genero == "H"){
                $totalh++;
            }else{
                $totalm++;
            }
        }
    }

    echo "Total Hombres: ".$totalh."<br/>";
    echo "Total Mujeres: ".$totalm."<br/>";