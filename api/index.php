<?php

require_once 'Api.class.php';
require_once 'Youtube.class.php';


$youtube = new Youtube();
$results = $youtube->search( 'Arctic Monkeys Golden Trunks' );
preprint_r( $results );



function preprint_r( $arr = array() ) {
  echo '<pre>';
  print_r( $arr );
  echo '</pre>';
}