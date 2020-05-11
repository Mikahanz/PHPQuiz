<?php
$file = 'DocumentationOfTheWebsite/Website_information.pdf';
$filename = 'Website_information.pdf';
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($file);
?>