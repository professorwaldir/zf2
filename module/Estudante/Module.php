<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Estudante;

use Zend\Db\TableGateway\TableGateway;

use Estudante\Model\Estudante;

use Zend\Db\ResultSet\ResultSet;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {
    public function onBootstrap(MvcEvent $e) {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig() {
    	
    	return array(   			
    					'factories' => array(
    							'Estudante\Model\AlunoTable' => function ($sm) {
    																$tableGateway = $sm -> get('AlunoTableGataway');
    																$table = new AlunoTable($tableGateway);
    															},
    							'AlunoTableGataway' => function ($sm) {
    														$dbAdapter = $sm -> get('Zend\Db\Adapter\Adapter') ;
    														$resultSetPrototype = new ResultSet() ;
    														$resultSetPrototype = setArrayObjectPrototype( new Estudante());
    														return new TableGateway(estudante, $dbadapter,null,$resultSetPrototype);
    													},
    						),
    				);
    }
    
}
