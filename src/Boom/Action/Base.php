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
namespace Boom\Action;

abstract class Base extends \Yaf\Action_Abstract {
	
	/**
	 * @brief 输入参数校验器
	 * @var type 
	 */
	protected $_validator = null;
	
	/**
	 * @brief 排除XSS安全处理的名单，一般很少会使用，正常情况下都需要进行安全处理
	 * @var type 
	 */
	protected $_xssFilterExcept = array();

	/**
	 * @brief 重写 增加基础类库的钩子
	 */
	public function execute() {
		try {
			$this->_beforeInvoke();
			
			$this->invoke();
			
			$this->_afterInvoke();
		} catch (\Exception $ex) {
			$error = array(
				'code'		=> $ex->getCode(),
				'message'	=> $ex->getMessage(),
				'file'		=> $ex->getFile(),
				'line'		=> $ex->getLine(),
				'trace'		=> debug_backtrace(3)
			);
			//打LOG
			
			$this->renderFailJson();
		}
	}
	
	/**
	 * 执行具体动作之前
	 */
	protected function _beforeInvoke() {
		//如果控制动作里设置了不需要进行XSS过滤的白名单，需要加入
		if ( !empty($this->_xssFilterExcept) ) {
			$this->_view->setXssFilterExcept($this->_xssFilterExcept);
		}
		
	}

	/**
	 * @brief 具体动作的处理逻辑
	 */
	abstract public function invoke();
	
	/**
	 * 执行具体动作之后
	 */
	protected function _afterInvoke() {
		
	}
	
	/**
	 * @brief 把view的方法给controller
	 * @param type $name
	 * @param type $value
	 */
	protected function assign($name, $value = null) {
		$this->_view->assign($name, $value);
	}
	
	/**
	 * @brief 把view的方法给controller
	 * @param type $data
	 * @param type $errno
	 * @param type $errmsg
	 */
	protected function renderJson($data=array(), $errno= \Boom\Util\Error::ERR_SUCCESS, $errmsg='') {
		$this->_view->renderJson($data, $errno, $errmsg);
	}
	
	/**
	 * @brief 把view的方法给controller
	 * @param type $data
	 */
	protected function renderFailJson($data=array()) {
		$this->_view->renderFailedJson($data);
	}
	
}