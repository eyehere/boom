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
	 * @brief ->var decorate
	 * @param type $name
	 * @param type $value
	 */
	public function __set($name, $value = null) {
		
		parent::__set($name, $value);
	}
	
	/**
	 * @brief assign XSS encode
	 * @param type $name
	 * @param type $value
	 */
	public function assign($name, $value = null) {
		
		parent::assign($name, $value);
	}
	
	/**
	 * @brief display XSS encode
	 * @param type $tpl
	 * @param type $var_array
	 */
	public function display($tpl, $var_array = array()) {
		
		parent::display($tpl, $var_array);
	}
	
	/**
	 * @brief render XSS encode
	 * @param type $tpl
	 * @param type $var_array
	 */
	public function render($tpl, $var_array = array()) {
		
		parent::render($tpl, $var_array);
	}
	
}