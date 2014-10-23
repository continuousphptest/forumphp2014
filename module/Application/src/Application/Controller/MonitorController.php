<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class MonitorController extends AbstractActionController
{
    /**
     * This action generate a slow request
     */
    public function slowrequestAction()
    {
    	$delay = $this->params()->fromQuery('delay',1);
    	sleep($delay);
    	return array(
    		'delay' => $delay,
    	);
    }
    
    /**
     * This action generate a high memory usage request
     */
    public function highmemoryusageAction()
    {
    	$mbyte = $this->params()->fromQuery('mb',1);
    	$str = '';
    	for ($i = 0; $i< $mbyte; $i++) {
    		$str .= file_get_contents(__DIR__ . '/../../../../../data/bigfile.txt');
    	}
    	return array(
    			'mbyte' => $mbyte,
    	);
    }
    
    /**
     * This action create and catch an exception
     * @throws \Exception
     */
    public function exceptionAction()
    {
    	try{
    		throw new \Exception('I am a faked exception', 42);
    	}
    	catch (\Exception $e){
    		
    	}
    }
    
    /**
     * This action generate some PHP errors
     */
    public function errorAction()
    {
    	error_reporting(0);
    	$errorType = $this->params()->fromQuery('type','notice');
    	switch ($errorType) {
    		case 'notice' : trigger_error('I am a Notice',E_USER_NOTICE); break;
    		case 'warning': trigger_error('I am a Warning',E_USER_WARNING); break;
    		case 'error'  : trigger_error('I am a Error',E_USER_ERROR); break;
    		case 'deprecated' : trigger_error('I am a deprecated',E_USER_DEPRECATED); break;
    	}
    	return array(
    			'type' => $errorType,
    	);
    }
    
    /**
     * This action perfromed a slow function requets.
     * It launch a CUrl request to a slow request.
     */
    public function slowfunctionAction()
    {
        $delay = $this->params()->fromQuery('delay',1);
        $ch = curl_init();
        $curlRequet = $this->getRequest();
        $curlRequet->getUri()->setPath('/application/monitor/slowrequest');
        $curlRequet->getUri()->setQuery('delay='.$delay);
        $curlUrl = $curlRequet->getUri()->__toString();
        curl_setopt($ch, CURLOPT_URL, $curlUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return array(
        		'delay' => $delay,
        );
    }
    
    public function slowqueryAction()
    {
    	
    }
}