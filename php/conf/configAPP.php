<?php
    /*
        Parametros de conexión a la DB
    */
	//DATOS DE CONEXIÓN MYSQL
	const SERVERURL = "../";
	const SERVEREMPRESA = "San Juan";
    const SERVER = "localhost";
    const DB = "sanjuan";
    const USER = "kireds_sanjuan";
	const PASS = "Sjd2021hn05%";
    //const PASS = "Sjd202|hn05%#";
	
	//DATOS DE CONEXIÓN POSTGRESQL
    const SERVERPS = "192.168.1.230";
    const PORTPS = "5432";
	const DBPS = "hsdedioshn";
	//const DBPS = "hsjdd-prueba";
    const USERPS = "postgres";
    const PASSPS = "Soportehn";
	const URLPS = "http://192.168.1.230";
	
	//CONEXION ODOO
	const USER_NAMEPS = "admin";
	const PASSWORDPS = "Soportehn";
    /*
        Para encriptar y Desencriptar
        Nota: Estos valores no se deben cambiar, si hay datos en la DB    
    */
    const METHOD = "AES-256-CBC";
    const SECRET_KEY = '$DP_@2020';
    const SECRET_IV = '10172';