<?php
$key = $_GET['key'];
?>
<!DOCTYPE html>
  <head>
      <title><?php echo "$key | Giulia Search Engine Beta"; ?>
      </title>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="./style.css" type="text/css">
    </head>
    <body>
      <div id="main">
        <div id="wrapper">
          <div id="header">
            <div class="search2">
              <form action="search" method="GET" name="q">
                <input type="text" placeholder="Search" name="key"><input type="submit" value="Search" name="q">
              </form>
            </div>
          </div>
          <div class="content">
