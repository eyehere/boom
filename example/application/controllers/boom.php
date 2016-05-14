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
class Boom_Controller extends \Yaf\Controller_Abstract {
    
    /**
     * @brief action的路由代理
     * @throws \Exception
     */
    public function init( ) {
        $strAction		= $this->getRequest()->getActionName();
		$arrActionPath	= explode('_', $strAction);
        
        $strSuffix		= \Yaf\Registry::get('application')->ext;
        $strActionPath	=  'actions' . DS . implode(DS, $arrActionPath) . ".$strSuffix";
        $this->actions[$strAction] = $strActionPath;
    }
    
}