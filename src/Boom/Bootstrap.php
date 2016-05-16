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
namespace Boom;

class Bootstrap extends \Yaf\Bootstrap_Abstract {
    
    private $_arrLocalNameSpace = array('Page', 'Logic', 'Util');
	
	/**
	 * @brief 设置默认的配置信息
	 *		  如：restful api对应的版本设置为上下文调度对应版本逻辑的基础
	 *		  如：log_id
	 *		  如：基础环境初始化
	 * @param \Yaf\Dispatcher $dispatcher
	 */
	public function _initDefault( \Yaf\Dispatcher $dispatcher ) {
		
	}
	
	/**
     * @brief 注册app的本地命名空间
	 *		  可以再注册自己的自动加载器
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initLoader( \Yaf\Dispatcher $dispatcher ) {
        \Yaf\Loader::getInstance()->registerLocalNameSpace( $this->_arrLocalNameSpace );
    }
    
    /**
     * @brief 把配置信息加载进入注册表
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initConfig( \Yaf\Dispatcher $dispatcher ) {
        $config = \Yaf\Application::app()->getConfig();
        foreach ( $config as $section=>$arrConf ) {
            \Yaf\Registry::set($section, $arrConf);
        }
    }
	
	/**
	 * @brief 路由初始化
	 * @param \Yaf\Dispatcher $dispatcher
	 */
	public function _initRouter( \Yaf\Dispatcher $dispatcher ) {
		
	}
    
    /**
     * @brief 初始化插件，调度插件、小流量插件、A/B测试插件、authorize插件、performance测试插件、安全插件
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initPlugin( \Yaf\Dispatcher $dispatcher ) {
        $dispatcher->registerPlugin( new \Boom\Plugin\Scheduler() );
    }
    
    /**
     * @brief 初始化渲染相关
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initRender ( \Yaf\Dispatcher $dispatcher ) {
        $strViewPath = APPLICATION_PATH . DS . 'views';
		$dispatcher->setView( new \Boom\View\Security($strViewPath) )
				   ->autoRender(false);
    }
    
}