<?php



function getAuthToken() {
    $url = "https://evaluation-technique.lundimatin.biz/api/auth";
    $headers = [
        'Accept: application/api.rest-v1+json',
        'Content-Type: application/json',
    ];
    $data = [
            "username" => "test_api",
            "password" => "api123456",
            "password_type" => 0,
            "code_application" => "webservice_externe",
            "code_version" => 1
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $responseData = json_decode($response, true);
    curl_close($ch);

    echo $responseData['datas']['token'];
}

getAuthToken();