<?php
/*
  +----------------------------------------------------------------------+
  | Boom                                                                 |
  +----------------------------------------------------------------------+
  | This source file is subject to version 2.0 of the Apache license,    |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.apache.org/licenses/LICENSE-2.0.html                      |
  | If you did not receive a copy of the Apache2.0 license and are unable|
  | to obtain it through the world-wide-web, please send a note to       |
  | yiming_6weijun@163.com so we can mail you a copy immediately.        |
  +----------------------------------------------------------------------+
  | Author: Weijun Lu  <yiming_6weijun@163.com>                          |
  +----------------------------------------------------------------------+
*/
namespace Boom\Plugin;

class Scheduler extends \Yaf\Plugin_Abstract {
    
    /**
     * @brief 在路由之前执行,这个钩子里，可以做url重写等功能
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     */
    public function routerStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response) {
        
    }
	
    /**
     * @brief 路由完成后，在这个钩子里，可以做登陆检测,权限控制等功能
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     */
    public function routerShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response) {
    	$objConfig		= \Yaf\Application::app()->getConfig();
		$arrPath		= explode('/', trim($objConfig->application->baseUri, '/'));
		$strController	= array_pop( $arrPath );
		if ( !empty($strController) ) {
			$request->setControllerName($strController);
		}
    }
    
	/**
	 * @brief brfore dispatchLoop
	 * @param \Yaf\Request_Abstract $request
	 * @param \Yaf\Response_Abstract $response
	 */
    public function dispatchLoopStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response) {
    	
    }
    
    /**
     * @brief api在dispatch之前加上一个版本号 让分发都走到actions目录
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     */
    public function preDispatch(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response) {
        
    }
    
	/**
	 * @brief after controller invoke
	 * @param \Yaf\Request_Abstract $request
	 * @param \Yaf\Response_Abstract $response
	 */
    public function postDispatch(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response) {
    	
    }
    
    /**
     * @brief final hoook in this hook user can do loging or implement layou
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     */
    public function dispatchLoopShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response) {
    	
    }

}