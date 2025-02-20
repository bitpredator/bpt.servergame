<?php
// URL dell'API del server di ETS2 per ottenere la lista dei giocatori online
$api_url = "http://your_server_ip:port/players.json";

// Inizializza una sessione cURL
$ch = curl_init();

// Imposta l'URL e altre opzioni
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

// Esegui la richiesta e ottieni la risposta
$response = curl_exec($ch);

// Chiudi la sessione cURL
curl_close($ch);

// Verifica se la risposta è valida
if ($response === false) {
    echo json_encode(["error" => "Unable to fetch player list"]);
    exit;
}

// Decodifica la risposta JSON
$player_list = json_decode($response, true);

// Se la decodifica fallisce, restituisci un errore
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["error" => "Invalid JSON response"]);
    exit;
}

// Restituisci la lista dei giocatori come JSON
header('Content-Type: application/json');
echo json_encode($player_list);
?>