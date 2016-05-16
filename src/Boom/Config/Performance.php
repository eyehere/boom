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

namespace Boom\Config;

//性能分析白名单配置
class Performance {
	
	/**
	 * @brief 线上性能分析白名单
	 * @var array 
	 */
	public static $arrWhiteList = array(
		
	);
	
	/**
	 * @brief 判断用户是否是性能debug白名单用户
	 * @param int $userId
	 * @return bool
	 */
	public static function isWhite( $userId ) {
		return in_array( intval($userId), self::$arrWhiteList, true );
	}
	
}