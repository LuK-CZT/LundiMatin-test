<?php

function getClients($id = null) {
    $url = ($id !== null)
        ? "https://evaluation-technique.lundimatin.biz/api/clients/$id"
        : "https://evaluation-technique.lundimatin.biz/api/clients";

    $params = ($id !== null)
        ? ""
        : "?sort=-nom&fields=nom,ville,tel,adresse";

    $username = "";
    $password = "20240130-65b8fc8a841b9198168397"; 

    $headers = [
        'Accept: application/api.rest-v1+json',
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode("$username:$password")
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $responseData = json_decode($response, true);
    curl_close($ch);

    echo json_encode($responseData);
}

function updateClientViaAPI() {
   
    $id = isset($_GET['id']) ? $_GET['id'] : null;

  
    if (empty($id)) {
        echo json_encode(['error' => 'ID manquant dans les paramètres de la requête']);
        return;
    }

    
    $putData = file_get_contents("php://input");

    if (empty($putData)) {
        echo json_encode(['error' => 'Aucune donnée reçue dans le corps de la requête PUT']);
        return;
    }
    
    $body = json_decode($putData, true);

    if ($body === null) {
        echo json_encode(['error' => 'Données JSON invalides']);
        return;
    }

    $url = "https://evaluation-technique.lundimatin.biz/api/clients/$id";
    $username = "";
    $password = "20240130-65b8fc8a841b9198168397"; 

    if (!is_string($id) || empty($body)) {
        echo json_encode(['error' => 'Invalid input']);
        return;
    }

    $headers = [
        'Accept: application/api.rest-v1+json',
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode("$username:$password")
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['error' => 'Curl error: ' . curl_error($ch)]);
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode >= 200 && $httpCode < 300) {     
            echo $response;
        } else {
            echo json_encode(['error' => 'HTTP Error: ' . $httpCode]);
        }
    }

    curl_close($ch);
}



header("Access-Control-Allow-Origin: *", false);
header("Access-Control-Allow-Methods: *", false);
header("Access-Control-Allow-Headers: *", false);

// Appel des fonctions en fonction de la requête HTTP
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        getClients($_GET['id']);
    } else {
        getClients();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    updateClientViaAPI();
} else {
    echo json_encode(['error' => 'Cette page ne prend en charge que les requêtes GET et PUT']);
}
?>
