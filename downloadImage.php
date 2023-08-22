<?php
$imagePath = $_GET['image'];



header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($imagePath));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize(__DIR__ . DIRECTORY_SEPARATOR . $imagePath));
readfile(__DIR__ . DIRECTORY_SEPARATOR . $imagePath);
