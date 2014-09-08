<?php
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
define('WWWROOT_PATH', dirname(dirname(__FILE__)));
require_once APPLICATION_PATH . '/bootstrap.php';
Bootstrap::instance();

/**
 * 修复篮球比赛没有同步球队到Data库的数据
 *
 * @author Antisan Gao
 * @version $Id$
 */

$match_id		= $_SERVER['argv'][1];//dirname(__FILE__).'/basketball_result.csv';

if ($match_id)
{
    $match = Data_Model_Basketball_Match::find('id = ?', $match_id)->getOne();

    if ( ! $match->host_team_id || ! $match->guest_team_id)
    {
        $match2 = Basketball_Model_Match::find('id = ?', $match_id)->getOne();

        foreach ($match2->participate as $participate)
        {
            if ($participate->type == 1)
            {
                $match->host_team_id    = $participate->team_id;
            }
            else
            {
                $match->guest_team_id   = $participate->team_id;
            }
        }

        $match->save();
    }
}
