<?php
class Model_Data_Basketball_Alias extends OK_ActiveRecord_Abstract
{
	/**
	 * ���ض���Ķ���
	 *
	 * @static
	 *
	 * @return array
	 */
	static function __define()
	{
		return array (
				// ��ʲô���ݱ������
				'table_name' => 'bb_alias',          
				'table_config' => array('dsn'	=> 'data'),

				// ָ�����ݱ��¼�ֶ����������֮���ӳ���ϵ
				// û���ڴ˴�ָ�������ԣ�QeePHP ���Զ����ý�����ӳ��Ϊ����Ŀɶ�д����
				'props' => array (
					// ����Ӧ����ֻ����ȷ���������ġ���������
					'id' => array('readonly' => true),
					),

				/**
				 * ����ʹ�� mass-assignment ��ʽ��ֵ������
				 *
				 * ���ָ���� attr_accessible������� attr_protected �����á�
				 */
				'attr_accessible' => '',

				/**
				 * �ܾ�ʹ�� mass-assignment ��ʽ��ֵ������
				 */
				'attr_protected' => 'recid',

				/**
				 * ָ�������ݿ��д�������ʱ����Щ���Ե�ֵ���������ⲿ�ṩ
				 *
				 * ����ָ�������Ի��ڴ�����¼ʱ�����˵����Ӷ������ݿ��������ֵ��
				 */
				'create_reject' => '',

				/**
				 * ָ���������ݿ��еĶ���ʱ����Щ���Ե�ֵ���������ⲿ�ṩ
				 */
				'update_reject' => '',

				/**
				 * ָ�������ݿ��д�������ʱ����Щ���Ե�ֵ������ָ�������ݽ��и���
				 *
				 * ������ֵΪ self::AUTOFILL_TIMESTAMP �� self::AUTOFILL_DATETIME��
				 * ���������Ե��������Զ���䵱ǰʱ�䣨�������ַ�������
				 *
				 * ������ֵΪһ�����飬��ٶ�Ϊ callback ������
				 */
				'create_autofill' => array (
						'create_time'   => self::AUTOFILL_DATETIME ,
						'update_time'   => self::AUTOFILL_DATETIME ,
						),

				/**
				 * ָ���������ݿ��еĶ���ʱ����Щ���Ե�ֵ������ָ�������ݽ��и���
				 *
				 * ���ֵ��ָ������ͬ create_autofill
				 */
				'update_autofill' => array (
						'update_time'   => self::AUTOFILL_DATETIME ,
						),

				/**
				 * �ڱ������ʱ���ᰴ������ָ������֤���������֤����֤ʧ�ܻ��׳��쳣��
				 *
				 * �����ڱ���ʱ�Զ���֤��������ͨ������� ::meta()->validate() �������������ݽ�����֤��
				 */
				'validations' => array (),

				// ָ���� ActiveRecord Ҫʹ�õ���Ϊ���
				'behaviors' => '',

				// ָ����Ϊ���������
				'behaviors_settings' => array (),

				);
	}
/* ------------------ �������Զ����ɵĴ��룬�����޸� ------------------ */

	/**
	 * ����һ����ѯ�����ҷ��������Ķ������󼯺�
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
	 * ���ص�ǰ ActiveRecord ���Ԫ���ݶ���
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
    * ִ��һ��SQL��� , ���ִ�еĲ�ѯ�� SELECT �Ȼ᷵�ؽ�����Ĳ�����
    * �� execute() ִ�гɹ���᷵��һ�� Result ����ʧ��ʱ���׳��쳣��
    * ��ò�ѯ�����ݣ���Ҫ���� Result ����� fetchAll() �ȷ�����
    *
    * @param sting $sql SQL ���ʽ ֧��ռλ�� ?
    * @param array $inputarr SQL ռλ���������
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
/* ------------------ �������Զ����ɵĴ��룬�����޸� ------------------ */
}
