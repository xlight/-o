<?php
class Model_Map_Soccer_League extends OK_ActiveRecord_Abstract
{
	/**
	 * 返回对象的定义
	 *
	 * @static
	 *
	 * @return array
	 */
	static function __define()
	{
		return array (
				// 用什么数据表保存对象
				'table_name' => 'map_soccer_league',          
				'table_config' => array('dsn'	=> 'data_map'),

				// 指定数据表记录字段与对象属性之间的映射关系
				// 没有在此处指定的属性，QeePHP 会自动设置将属性映射为对象的可读写属性
				'props' => array (
					// 主键应该是只读，确保领域对象的“不变量”
					'id' => array('readonly' => true),
					),

				/**
				 * 允许使用 mass-assignment 方式赋值的属性
				 *
				 * 如果指定了 attr_accessible，则忽略 attr_protected 的设置。
				 */
				'attr_accessible' => '',

				/**
				 * 拒绝使用 mass-assignment 方式赋值的属性
				 */
				'attr_protected' => 'recid',

				/**
				 * 指定在数据库中创建对象时，哪些属性的值不允许由外部提供
				 *
				 * 这里指定的属性会在创建记录时被过滤掉，从而让数据库自行填充值。
				 */
				'create_reject' => '',

				/**
				 * 指定更新数据库中的对象时，哪些属性的值不允许由外部提供
				 */
				'update_reject' => '',

				/**
				 * 指定在数据库中创建对象时，哪些属性的值由下面指定的内容进行覆盖
				 *
				 * 如果填充值为 self::AUTOFILL_TIMESTAMP 或 self::AUTOFILL_DATETIME，
				 * 则会根据属性的类型来自动填充当前时间（整数或字符串）。
				 *
				 * 如果填充值为一个数组，则假定为 callback 方法。
				 */
				'create_autofill' => array (
						'create_time'   => self::AUTOFILL_DATETIME ,
						'update_time'   => self::AUTOFILL_DATETIME ,
						),

				/**
				 * 指定更新数据库中的对象时，哪些属性的值由下面指定的内容进行覆盖
				 *
				 * 填充值的指定规则同 create_autofill
				 */
				'update_autofill' => array (
						'update_time'   => self::AUTOFILL_DATETIME ,
						),

				/**
				 * 在保存对象时，会按照下面指定的验证规则进行验证。验证失败会抛出异常。
				 *
				 * 除了在保存时自动验证，还可以通过对象的 ::meta()->validate() 方法对数组数据进行验证。
				 */
				'validations' => array (),

				// 指定该 ActiveRecord 要使用的行为插件
				'behaviors' => '',

				// 指定行为插件的配置
				'behaviors_settings' => array (),

				);
	}
/* ------------------ 以下是自动生成的代码，不能修改 ------------------ */

	/**
	 * 开启一个查询，查找符合条件的对象或对象集合
	 *
	 * @static
	 *
	 * @return OK_Select
	 */
	static function find()
	{
		$args = func_get_args();
		return OK_ActiveRecord_Meta::instance(__CLASS__)->findByArgs($args);
	}

	/**
	 * 返回当前 ActiveRecord 类的元数据对象
	 *
	 * @static
	 *
	 * @return OK_ActiveRecord_Meta
	 */
	static function meta()
	{
		return OK_ActiveRecord_Meta::instance(__CLASS__);
	}
    
   /** 
    * 执行一条SQL语句 , 如果执行的查询是 SELECT 等会返回结果集的操作，
    * 则 execute() 执行成功后会返回一个 Result 对象，失败时将抛出异常。
    * 获得查询的数据，需要调用 Result 对象的 fetchAll() 等方法。
    *
    * @param sting $sql SQL 表达式 支持占位符 ?
    * @param array $inputarr SQL 占位符替代变量
    * @return OK_Result_Mysql | Boolean
    */
    static function dbtool($sql , $inputarr = null)
    {   
        return self::meta()->table->getConn()->execute($sql , $inputarr);
    }
    static function dbtool_slave($sql , $inputarr = null)
	{
		return self::meta()->table->getConn(0)->execute($sql , $inputarr);
	}
/* ------------------ 以上是自动生成的代码，不能修改 ------------------ */
}
