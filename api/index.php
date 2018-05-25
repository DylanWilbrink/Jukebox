<?php

require_once 'Api.class.php';
require_once 'Youtube.class.php';


$youtube = new Youtube();
$results = $youtube->search( $_POST['song'] );
preprint_r( $results );


?>

    <form action="index.php" method="post">
        <input type="text" placeholder="Song" name="song">
        <input type="submit" value="search" name="submit">
    </form>

<?php

function preprint_r( $arr = array() ) {
  foreach ($arr as $result) {
      echo $result['title'] . '<br>';
      echo $result['url'] . '<br><br>';
  }
}

/*
 * ARRAY
 * title
 * url
 * playerUrl
 * type
 * source
 * id
 */