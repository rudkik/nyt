<?php

if (isset($_POST['q'])){
    $value = $_POST['q'];
}else{
    $value = "";
}

if (isset($_POST['page'])){
    $page = $_POST['page'];
}else{
    $page = "0";
}


$info = file_get_contents("https://api.nytimes.com/svc/search/v2/articlesearch.json?q=$value&api-key=nxSnXMrVoM5YbnKBbA5FMwS6Jr83YB3a&page=$page");
$info = json_decode($info, true);

$answer = [];


foreach ($info['response']['docs'] as $key => $one) {
    $answer[$key]['web_url'] = $one['web_url'];
    $answer[$key]['headline'] = $one['headline']['main'];
}
print_r( json_encode($answer, true));
?>




