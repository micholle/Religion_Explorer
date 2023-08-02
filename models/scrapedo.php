<?php
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);

    $data = [
        "url" => $_GET['url'],
        "token" => "3be0e37c470e4ddca9fc08344258250d07086cafc12",
    ];

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_URL, "https://api.scrape.do?".http_build_query($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "Accept: */*",
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    echo $response;
?>