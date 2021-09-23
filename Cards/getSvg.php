<?php 

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$allFiles['brown'] = [];
$allFiles['green'] = [];
$allFiles['yellow'] = [];

$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) {
 $dir .= $parts[$i] . "/";
}

foreach (glob("brown*.svg") as $filename) {
    array_push($allFiles['brown'], "http://".$dir.$filename);
}

foreach (glob("green*.svg") as $filename) {
    array_push($allFiles['green'], "http://".$dir.$filename);
}

foreach (glob("yellow*.svg") as $filename) {
    array_push($allFiles['yellow'], "http://".$dir.$filename);
}

echo json_encode($allFiles ,JSON_UNESCAPED_SLASHES);

 ?>