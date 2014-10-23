<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;

class ResetController extends AbstractActionController
{
    public function indexAction()
    {
    	$this->dataAction();
    }
    
    public function dataAction()
    {
        $dbAdpater = $this->serviceLocator->get('dbAdapter');
        $this->createTables();
        //Cities
        $insertStr = 'INSERT INTO city VALUES';
        $cityArray = array();
        for ($i = 0; $i < 30 ;$i++){
        	$insertStr .= '(';
        	$name = $this->serviceLocator->get('alienNameGenerator')->getName(5);
        	$cityArray[] = $name;
        	$insertStr .= '"' . $name .'"';
        	$insertStr .= '),';
        }
        $insertStr = trim($insertStr,',;');
        $dbAdpater->query($insertStr,Adapter::QUERY_MODE_EXECUTE);
        //Inhabitants
        for ($j = 0; $j < 300 ; $j ++){
        	$insertStr = 'INSERT INTO alien VALUES';
            for ($i = 0; $i < 100 ;$i++){
                $insertStr .= '(';
            	$firstName = $this->serviceLocator->get('alienNameGenerator')->getName(2);
            	$lastName = $this->serviceLocator->get('alienNameGenerator')->getName(4);
            	$city = $cityArray[rand(0,count($cityArray)-1)];
            	$insertStr .= 'NULL,';
            	$insertStr .= '"' . $firstName .'",';
            	$insertStr .= '"' . $lastName .'",';
            	$insertStr .= '"' . $city .'"';
                $insertStr .= '),';
                
            }
            $insertStr = trim($insertStr,',;');
            $dbAdpater->query($insertStr,Adapter::QUERY_MODE_EXECUTE);
        }
        
    }
    
    protected function createTables()
    {
        $dbAdpater = $this->serviceLocator->get('dbAdapter');
        //Alien table
        $dbAdpater->query('DROP TABLE IF EXISTS alien',Adapter::QUERY_MODE_EXECUTE);
        $tableAlienStr = 'CREATE TABLE alien (';
        $tableAlienStr .= 'id INT AUTO_INCREMENT,';
        $tableAlienStr .= 'firstName VARCHAR(50),';
        $tableAlienStr .= 'lastName VARCHAR(50),';
        $tableAlienStr .= 'city VARCHAR(30),';
        $tableAlienStr .= 'PRIMARY KEY ( id )';
        $tableAlienStr .= ')';
        $dbAdpater->query($tableAlienStr,Adapter::QUERY_MODE_EXECUTE);
        //City table
        $dbAdpater->query('DROP TABLE IF EXISTS city',Adapter::QUERY_MODE_EXECUTE);
        $tableCityStr = 'CREATE TABLE city (';
        $tableCityStr .= 'name VARCHAR(30),';
        $tableCityStr .= 'PRIMARY KEY (name)';
        $tableCityStr .= ')';
        $dbAdpater->query($tableCityStr,Adapter::QUERY_MODE_EXECUTE);
    }
}