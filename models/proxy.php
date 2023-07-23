<?php

header("Access-Control-Allow-Origin: *");

if (isset($_GET['url'])) {
    $url = $_GET['url'];

    $context = stream_context_create([
        'http' => [
            'header' => "User-Agent: PHP\r\n",
        ],
    ]);

    $content = file_get_contents($url, false, $context);

    if ($content === false) {
        http_response_code(500);
        echo "Error: Failed to fetch data from the external website.";
    } else {        
        $cleanedContent = strip_tags($content);
        $cleanedContent = htmlspecialchars_decode($cleanedContent);
        $cleanedContent = str_replace("&nbsp;", " ", $cleanedContent);
        $cleanedContent = str_replace("&#39;", "'", $cleanedContent);
        $cleanedContent = str_replace("&rsquo;", "'", $cleanedContent);
        $cleanedContent = str_replace("&rsquo;", "'", $cleanedContent);
        $cleanedContent = trim($cleanedContent);

        $wordsToRemove = array("(image source)");
        $cleanedContent = str_replace($wordsToRemove, "", $cleanedContent);

        echo $cleanedContent;
    }
} else {
    http_response_code(400);
    echo "Error: URL parameter is missing.";
}
?>
