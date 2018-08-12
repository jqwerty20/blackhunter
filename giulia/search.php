<?php

error_reporting(0);

include "header.php";

include "lib.php";

$key = $_GET['key'];

$key1 = str_replace(" ","+",$key);

$keyword = strtolower($key1);
?>

<div class="showing">
Showing result for <b><?php echo $key; ?></b>
</div>

<?php
//ADDRESS AHMIA
$address = "https://ahmia.fi/search/?q=";
$url = $address . $keyword;

//ADDRESS Yahoo!
$y_address = "https://search.yahoo.com/search?p=";
$y_url = $g_address . $keyword;

//CREATE DOM DOCUMENT for AHMIA

$read = curlAhmia("$url");

$dom = new DOMDocument();

@$dom->loadHTML($read);

//SEARCH CLASS
$classname = "searchResult";
$finder = new DomXPath($dom);
$spaner = $finder->query("//*[contains(@class, '$classname')]");

//GRAB DATA FROM CLASS
$span = $spaner->item(0);

$title = $span->getElementsByTagName('h4');
$link = $span->getElementsByTagName('cite');

$number = $no++;

$data = array();
foreach ($title as $val){
  $data[] = array(
    'title' => $title->item($number)->nodeValue,
    'link' => $link->item($number)->nodeValue,
  );
  $number++;
}

?>
<div class="search-result">
<ul>
<?php

$total = count($data);
echo $total . " Result found";

//PAGINATION
$record = 10;
$page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
$paging = ceil($total / $record);

$page = max($page, 1);
$page = min($page, $paging);
$offset = ($page - 1) * $record;
if( $offset < 0 ) $offset = 0;

$data = array_slice( $data, $offset, $record );

foreach($data as $val)
{
?>

    <li><a href="//<?php echo $val['link']; ?>"><b><?php echo $val['title']; ?></b></a></br><?php echo $val['link']; ?></li>

<?php
}

?>
</ul>
</div>
<?php

$url_link = 'search?key=' . $keyword . '&q=Search&page=%d';

$pagerContainer = '<div style="width: 300px;">';
if( $paging != 0 )
{
  if( $page == 1 )
  {
    $pagerContainer .= '';
  }
  else
  {
    $pagerContainer .= sprintf( '<a href="' . $url_link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 );
  }
  $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $paging . '</span>';
  if( $page == $paging )
  {
    $pagerContainer .= '';
  }
  else
  {
    $pagerContainer .= sprintf( '<a href="' . $url_link . '" style="color: #c00"> next page &#187; </a>', $page + 1 );
  }
}
$pagerContainer .= '</div>';

echo $pagerContainer;

include "footer.php";
?>
