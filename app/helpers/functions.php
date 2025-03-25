<?php

define('MOIS', [
  1 => 'Janvier',
  2 => 'Février',
  3 => 'Mars',
  4 => 'Avril',
  5 => 'Mai',
  6 => 'Juin',
  7 => 'Juillet',
  8 => 'Août',
  9 => 'Septembre',
  10 => 'Octobre',
  11 => 'Novembre',
  12 => 'Décembre',
]);


function format($number)
{
  return number_format(floatval($number), 2, '.', ' ');
}

function formatMois($mois)
{
  return MOIS[$mois] ?? 'Mois Invalide';
}

function add_annee()
{
  return isset($_GET['annee']) ? '?annee=' . $_GET['annee'] : '';
}
