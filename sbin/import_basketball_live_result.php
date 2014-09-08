<?php
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
define('WWWROOT_PATH', dirname(dirname(__FILE__)));
require_once APPLICATION_PATH . '/bootstrap.php';
Bootstrap::instance();

/**
 * 导入篮球比分直播比分脚本
 *
 * csv file format
 *
 * 比赛id,比赛日期,球队id,主客[1-主,2-客],比赛状态,1st,2nd,3rd,4th,5th
 * 5323977,2014-09-05 03:30:00,181,1,100,23,19,24,20,0
 * 5323977,2014-09-05 13:30:00,377,2,100,13,14,11,25,0
 *
 * @author Antisan Gao
 * @version $Id$
 */

$file		= $_SERVER['argv'][1];//dirname(__FILE__).'/basketball_result.csv';

if (($handle = fopen($file, "r")) !== FALSE)
{
	while (($row = fgetcsv($handle, 1000, ",")) !== FALSE)
	{
        if (count($row) < 10)
            continue;

		$match_id	= (int)$row[0];
		$match_time	= $row[1];
		$team_id	= (int)$row[2];
		$is_home	= (int)$row[3];
		$status		= (int)$row[4];
		$sorce_1st	= get_arr($row, 5, 0);
		$sorce_2nd	= get_arr($row, 6, 0);
		$sorce_3rd	= get_arr($row, 7, 0);
		$sorce_4th	= get_arr($row, 8, 0);
		$sorce_5th	= get_arr($row, 9, 0);

        if ( ! $match_id)
            continue;

        //var_dump(date("Y-m-d", shift_date($match_time, 3600*12)));

		$conditions = array('lottery_no' => date("Y-m-d", shift_date($match_time, 3600*12)), 'lottery_type' => 'SportteryHWL');

		$update = array(
			$match_id.'.period1.'.$team_id	=> "$sorce_1st",
			$match_id.'.period2.'.$team_id	=> "$sorce_2nd",
			$match_id.'.period3.'.$team_id	=> "$sorce_3rd",
			$match_id.'.period4.'.$team_id	=> "$sorce_4th",
			$match_id.'.period5.'.$team_id	=> "$sorce_5th",
			$match_id.'.state'				=> (int)$status,
			$match_id.'.time'				=> 0,
		);

        $collection = Mongo_Database::instance('match')->get_collection('basketball_live')->update($conditions, array('$set'=>$update), array('upsert' => true));

        $conditions = array('_id' => (int)$match_id);

        $update = array(
			'current_score.period1.'.$team_id	=> "$sorce_1st",
			'current_score.period2.'.$team_id	=> "$sorce_2nd",
			'current_score.period3.'.$team_id	=> "$sorce_3rd",
			'current_score.period4.'.$team_id	=> "$sorce_4th",
			'current_score.period5.'.$team_id	=> "$sorce_5th",
			'state'				                => (int)$status,
			$match_id.'.time'		        	=> 0,
        );

        $collection = Mongo_Database::instance('match')->get_collection('basketball_live_event')->update($conditions, array('$set'=>$update), array('upsert' => true));

		print_r($update);
	}

    echo "over\n";
}


function get_arr($arr, $key, $default = NULL)
{
	return isset($arr[$key]) ? $arr[$key] : $default;
}

/**
 * 时间偏移后的日期
 *
 * @example
 *  shift_date('2014-09-05 03:30:00', 3600*12) return strtotime('2014-09-04')
 *  shift_date('2014-09-05 13:30:00', 3600*12) return strtotime('2014-09-05')
 *
 * @param   string  $time
 * @param   int     $seconds
 * @return  int
 */
function shift_date($time, $seconds = 0)
{
    list($time1, $time2) = explode(' ', $time);

    $line = strtotime($time1) + $seconds;

    if (strtotime($time) >= $line)
    {
        return strtotime($time1);
    }

    return strtotime('-1 day', strtotime($time1));
}

