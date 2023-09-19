<?php
$ncUser = "testuser";
$ncPassword = "testuser123456";
$ncBaseUrl = "cloud.example.org";

$webdavURL = "https://cloud.example.org/remote.php/dav/files/testuser/testusershare";

/////////////////////////////////

// can be removed with PHP 8
function str_ends_with($Haystack, $Needle){
    // Recommended version, using strpos
    return strrpos($Haystack, $Needle) === strlen($Haystack)-strlen($Needle);
}

// load XML from NextCloud
$xmlPayload = '<?xml version="1.0" encoding="UTF-8"?><d:propfind xmlns:d="DAV:" xmlns:oc="http://owncloud.org/ns" xmlns:nc="http://nextcloud.org/ns"></d:propfind>';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $webdavURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PROPFIND");
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlPayload);
curl_setopt($ch, CURLOPT_USERPWD, $ncUser . ":" . $ncPassword);  
$xml = curl_exec($ch);
curl_close($ch);      


// parse XML
$result = simplexml_load_string($xml);
$ns = $result->getNamespaces(true);
$child = $result->children($ns['d']);

$fileResults = [];

foreach ($child->response as $files) {
    $url = (string) $files->href;
    if (str_ends_with($url, '.jpg') OR str_ends_with($url, '.png')) {
        $fileResults[] = $url;
    }
}
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
const images = ['<?php echo implode("','", $fileResults) ?>'];
const ncUser = '<?php echo $ncUser; ?>';
const ncPassword = '<?php echo $ncPassword; ?>';
const ncBaseUrl = '<?php echo $ncBaseUrl; ?>';
</script>
    <div id="container"></div>
    <img id="preloadImg" style="display: none">
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
