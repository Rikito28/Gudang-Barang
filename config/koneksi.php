<?php

try {
$gud = new mysqli('localhost','root','','gudang');
} catch (Exception $e) {
	echo $e->getMessage();
}
?>