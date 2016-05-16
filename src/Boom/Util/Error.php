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
namespace Boom\Util;

/**
 * 错误码定义
 */
class Error {
	
	const ERR_SUCCESS = 0;		//成功响应码
	
	
	const ERR_SERVER_EXCEPTION = 50000;	//服务器内部异常
	
	/**
	 * @brief 错误码和错误消息的对应表
	 * @var type 
	 */
	public static $arrMsg = array(
		self::ERR_SUCCESS			=> '成功',
		self::ERR_SERVER_EXCEPTION	=> '服务器内部异常',
	);

	/**
	 * @brief 获取错误码对应的消息 
	 * @param type $errno
	 * @return string
	 */
	public static function getMsg($errno) {
		if ( isset(self::$arrMsg[$errno]) ) {
			return self::$arrMsg[$errno];
		}
		
		return '';
	}
	
}