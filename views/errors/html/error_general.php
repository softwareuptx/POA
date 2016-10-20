<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title> Error </title>
<style type="text/css">

::selection { background-color: #3FAF37; color: white; }
::-moz-selection { background-color: #3FAF37; color: white; }

body {

    background-image: -webkit-linear-gradient(0deg, #312e50, #476DB5);
    background-image: -moz-linear-gradient(0deg, #312e50, #476DB5);
    background-image: -o-linear-gradient(0deg, #312e50, #476DB5);
    background-image: -ms-linear-gradient(0deg, #312e50, #476DB5);
    background-image: linear-gradient(90deg, #312e50, #476DB5);
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
	 margin: 50px;
	 font: 13px/20px normal Helvetica, Arial, sans-serif;
	 color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
	text-decoration: none;
}

h1 {
	color: #FFF;
  line-height: 50px;
  border-bottom: 1px solid #D0D0D0;
  font-size: 3rem;
  padding: 30px 0px 30px 0px;
  font-weight: 700;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	width: 70%;
  margin: 0 auto;
	text-align: center;
}

#container img {
  max-width: 230px;
}

p {
	color: #ffffff;
  font-weight: 700;
  margin-bottom: 30px;
  font-size: 17px;
}

.btn {
  display: inline-block;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: 600;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
}

.btn {
  border-radius: 3px;
  -webkit-box-shadow: none;
  box-shadow: none;
  border: 1px solid transparent;
}

.btn-default {
  background-color: #f4f4f4;
  color: #444;
  border-color: #ddd;
}
</style>
</head>
<body>
  <div id="container">
    <img src="<?php echo $url.'static/images/Robot_Frabrica.png' ?>" alt="">
    <h1><?php echo $heading; ?></h1>
    <?php echo $message; ?>
  </div>
</body>
</html>