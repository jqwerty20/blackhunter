<?php
//ahmia.fi
function curlAhmia($url){
$session = curl_init();
curl_setopt($session, CURLOPT_URL, $url);
curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($session);
curl_close($session);
return $result;
}

?>
