<?php

function format($number)
{
  return number_format(floatval($number), 2, '.', ' ');
}
