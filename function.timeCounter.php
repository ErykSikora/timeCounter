<?php

/*

   {timeCounter start=80 add=1 often=10 float="yes" how=1}
   @up -> plugin adds 1 to 80 every 10 days. finally divides by 10 to get the FLOAT value

   start -> $start - start adding from the base number
   add -> $toAdd - how much to add
   often -> $when - how often (days)

   float -> if the result value should be a FLOAT. Works only with "yes" or "y" parameter
   how -> indicates the number of decimal places

*/

function smarty_function_timeCounter($params, &$smarty)
{
   
   if (empty($params['start'])) {$start = 400;} else {$start = $params['start'];}
   if (empty($params['add'])) {$toAdd = 20;} else {$toAdd = $params['add'];}
   if (empty($params['often'])) {$when = 30;} else {$when = $params['often'];}
   
   $startTime  = strtotime('2018-01-01 00:00:00');
   $currentTime  = date('Y-m-d H:i:s');
   $date = strtotime($currentTime); //returns the value in unix time
   $timeDifference = ($date - $startTime) / ($when * 86400);
	 // *the time difference between start and end time* / *seconds per day* x *days*
   $total = floor($timeDifference); //rounding time down to INT
   $result = $start + $toAdd*$total;
   
   if (($params['float'])=="yes") {
      if (empty($params['how'])) {
         $result = $result / 10;
      } else {
         $result = $result / ($params['how']*10);
      }
   }
   
   return $result;
}
