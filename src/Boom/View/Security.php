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
namespace Boom\View;

/**
 * 针对输出进行安全处理，默认都经过XSS处理，不处理的需要提前配置
 */
class Security extends \Yaf\View\Simple {
	
	/**
	 * @brief 不需要XSS filter白名单
	 * array('name','parent.child.sub')
	 * @var type 
	 */
	protected $_xssFilterExcept = array();

	/**
	 * @brief ->var decorate
	 * @param type $name
	 * @param type $value
	 */
	public function __set($name, $value = null) {
		$this->_xssSafe($value, $name);
		parent::__set($name, $value);
	}
	
	/**
	 * @brief assign XSS encode
	 * @param type $name
	 * @param type $value
	 */
	public function assign($name, $value = null) {
		$this->_xssSafe($value, $name);
		parent::assign($name, $value);
	}
	
	/**
	 * @brief display XSS encode
	 * @param type $tpl
	 * @param type $var_array
	 */
	public function display($tpl, $var_array = array()) {
		$this->_xssSafe($var_array);
		parent::display($tpl, $var_array);
	}
	
	/**
	 * @brief render XSS encode
	 * @param type $tpl
	 * @param type $var_array
	 */
	public function render($tpl, $var_array = array()) {
		$this->_xssSafe($var_array);
		parent::render($tpl, $var_array);
	}
	
	/**
	 * @brief 输出Json 串
	 * @param array $data
	 * @param int $errno
	 * @param string $errmsg
	 */
	public function renderJson($data=array(), $errno= \Boom\Util\Error::ERR_SUCCESS, $errmsg='') {
		$this->_xssSafe($data);
		if ( empty($errmsg) ) {
			$errmsg = \Boom\Util\Error::getMsg($errno);
		}
		echo json_encode( compact('errno', 'errmsg', 'data') );
	}
	
	/**
	 * @brief 失败输出Json 串
	 * @param array $data
	 * @param int $errno
	 * @param string $errmsg
	 */
	public function renderFailJson($data=array()) {
		$this->_xssSafe($data);
		$errno	= \Boom\Util\Error::ERR_SERVER_EXCEPTION;
		$errmsg = \Boom\Util\Error::getMsg($errno);
		echo json_encode( compact('errno', 'errmsg', 'data') );
	}
	
	/**
	 * @brief 强制不要XSS处理的名单
	 * @param type $xssFilterExcept
	 */
	public function setXssFilterExcept($xssFilterExcept) {
		$this->_xssFilterExcept = $xssFilterExcept;
	}

	/**
	 * @brief XSS安全处理逻辑
	 * @param type $var
	 * @param type $prefix
	 * @return type
	 */
	protected function _xssSafe(&$var, $prefix='') {
		
		if ( is_array($var) ) {
			foreach ( $var as $name=>&$value ) {
				$xssPrefix = !empty($prefix) ? "{$prefix}.{$name}" : $name;
				if ( is_array($value) ) {
					return $this->_xssSafe($value, $xssPrefix);
				}
				elseif ( !in_array($xssPrefix, $this->_xssFilterExcept, true) ) {
					$value = htmlspecialchars($value);
				}
			}
		}
		elseif (is_scalar($var) ) {
			if ( !empty($prefix) && !in_array($prefix, $this->_xssFilterExcept, true) ) {
				$var = htmlspecialchars($var);
			}
		}
		
	}
	
}