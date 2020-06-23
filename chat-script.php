<?php
ini_set('display_errors', 'on');
session_start();
require('connect_db.php');

function getUsers(PDO $pdo, string $userName = '') {
    $bindParams = [];
    $selectQuery = 'SELECT id, nom, logged_in FROM users WHERE id <> :me';
    $bindParams[':me'] = (int) $_SESSION['loggedUser']['id'];
    
    if ($userName != '') {
        $selectQuery .= ' AND nom = :userName';
        $bindParams[':userName'] = $userName;
    }

    $stmt = $pdo->prepare($selectQuery);
    $stmt->execute(
        $bindParams
    );
    $connectedUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return json_encode($connectedUsers, true);
}

function getMessages(PDO $pdo, int $otherUser){
    $selectQuery = 'SELECT * FROM message 
                    WHERE sender_id = :me AND receiver_id = :he 
                    OR sender_id = :he AND receiver_id = :me ';
    $stmt = $pdo->prepare($selectQuery);
    $stmt->execute([
        ':me' => (int) $_SESSION['loggedUser']['id'],
        ':he' => $otherUser
    ]);

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return json_encode($messages, true);
}

function sendMessage(PDO $pdo, int $otherUser, string $message){
    $insertQuery = 'INSERT INTO message(sender_id, receiver_id, contenu)
                    VALUES (:me, :he, :msg)';
    $stmt = $pdo->prepare($insertQuery);
    $stmt->execute([
        ':me' => (int) $_SESSION['loggedUser']['id'],
        ':he' => $otherUser,
        ':msg' => $message
    ]);
}

if(isset($_GET['fnct']) ){
    if($_GET['fnct'] == 'getUsers')
        echo getUsers($conn);
    if($_GET['fnct'] == 'getMessages' && $_GET['otherId'] > 0)
        echo getMessages($conn, $_GET['otherId']);
}

if(isset($_POST['fnct']) && isset($_POST['fnct']) == 'sendMessage') {
    sendMessage($conn, $_POST['otherId'], $_POST['message']);
}