Para su instalacion
clonar el repositorio y agregar en su carpeta local  para su funcionamiento 

la base de datos se encuentra dentro del repositorio se llama conecta.sql 

para iniciar con las configuraciones

dirigirse a la documento aplication/config/config.php
modificacar la linea 26 

$config['base_url'] = 'http://localhost/prueba_conecta/'; y cambiarla por su direccion local

para modificar la conexion a la base de datos
dirigrise al documentos 
dirigirse a la documento aplication/config/database.php

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost', --->para modificar el hoosname
	'username' => 'root',--->para modificar el usario
	'password' => '',--->para modificar las password
	'database' => 'conecta', --->para modificar la base de datos
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);




las consultas en seco para el sql 
Realizar una consulta que permita conocer cuál es el producto más vendido
SELECT SUM(t1.cantidad) as total_vendidos,t2.nombre FROM `ventas` t1 JOIN productos t2 on t1.id_producto= t2.id GROUP BY id_producto LIMIT 1

Realizar una consulta que permita conocer cuál es el producto que más stock tiene
SELECT MAX(stock) as stock ,nombre FROM  productos  

Realizar una consulta que permita conocer cuál es el producto que más stock tiene
