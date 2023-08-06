<?php

$folder = '/var/www/html/pictures/';
$arrFiles = glob($folder . '*.jpg');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slideshow</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<script>
const images = [<?php for($i = 0; $i < count($arrFiles); $i++) { $img = $arrFiles[$i]; ?>'<?php echo substr($img, strlen($folder), 1000) ?>',<?php } ?>];
</script>
    <div id="container"></div>
    <img id="preloadImg" style="display: none">
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
