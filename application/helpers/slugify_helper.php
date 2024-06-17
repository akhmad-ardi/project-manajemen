<?php
function slugify($string)
{
  $string = strtolower($string);
  $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
  $string = preg_replace('/[\s-]+/', '-', $string);
  $string = trim($string, '-');

  return $string;
}