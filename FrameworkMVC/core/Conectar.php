<?php
class Conectar{
    private $driver;
    private $host, $user, $pass, $database, $charset, $port;
  
    public function __construct() {
       
    }
    
    public function conexion(){
        
        if($this->driver=="pgsql" || $this->driver==null){
       
        //$con = pg_connect("host=192.168.100.2 port=5432 dbname=coactiva user=postgres password=.Romina.2012 ");
        $con = pg_connect("host=186.4.203.42 port=5432 dbname=contabilidad_des user=postgres password=.Romina.2012 ");
        	if(!$con){
        		echo "No se puedo Conectar a la Base";
        		exit();
        	} else {
        		
        	}
       
        }
        
        return $con;
    }
    
    public function startFluent(){
        require_once "FluentPDO/FluentPDO.php";
        
        if($this->driver=="pgsql" || $this->driver==null){
        	
        	try
        	{
        		//$pdo = new PDO('pgsql:host=192.168.100.2;port=5432;dbname=coactiva', 'postgres', '.Romina.2012' );
            	$pdo = new PDO('pgsql:host=186.4.203.42;port=5432;dbname=contabilidad_des', 'postgres', '.Romina.2012' );
            	$fpdo = new FluentPDO($pdo);
            	
            }
            catch(Exception $err)
            {
            	echo "PDO No se puedo Conectar a la Base";
            	exit();
            }
        }
       
        return $fpdo;
    }
  
}

?>
