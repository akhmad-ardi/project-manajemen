<?php

function format_date($date, $format = 'Y-m-d H:i:s', $formatResult = 'F j, Y')
{
  return DateTime::createFromFormat($format, $date)->format($formatResult);
}
