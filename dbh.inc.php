<?php

$conn = mysqli_connect('localhost', 'phawkins2019', 'JmSBN1eD8e', 'phawkins2019');

if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
}