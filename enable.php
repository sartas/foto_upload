<?php if(!defined('DEBUG')) die;
 
/*
	Get connection
*/
$PDO = Record::getConnection();
$driver = strtolower($PDO->getAttribute(Record::ATTR_DRIVER_NAME));



/*
	Table structure for table: comment
*/
if( $driver == 'mysql' )
{
$PDO->exec("ALTER TABLE ".TABLE_PREFIX."page ADD foto_count int NOT NULL default '0' AFTER status_id");
}
elseif( $driver == 'sqlite')
{
    $PDO->exec("ALTER TABLE page ADD foto_count int NOT NULL default '0'");
	
}