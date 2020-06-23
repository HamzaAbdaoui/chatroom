<?php
session_start();
ini_set('display_errors', 'On');

require('connect_db.php');

if(isset($_POST)){
    $mail = '';
    $pwd  = '';
    if (isset($_POST['mail'])){
        $mail = (string) $_POST['mail'];
    }

    if (isset($_POST['pwd'])){
        $pwd = (string) $_POST['pwd'];
    }

    if ($mail == '' || $pwd == '')
        header('Location:index.php?requiredError');

    authenticate($conn, $mail, $pwd);
}

function authenticate(PDO $pdo, string $mail, string $pwd) {
    // SELECT user WHERE mail = $mail AND password = $pwd
    $selectQuery = 'SELECT * FROM users WHERE mail = :mail AND password = :pwd ';
    $stmt = $pdo->prepare($selectQuery);
    $stmt->execute([
        ':mail' => $mail,
        ':pwd'  => $pwd
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(isset($result['id']) && $result['id'] > 0) {
        // Compte existe
        $updateQuery = 'UPDATE users SET logged_in = TRUE WHERE id = :id';
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([
            ':id' => (int) $result['id']
        ]);

        $_SESSION['loggedUser'] = [
            'id' => $result['id'],
            'name' => $result['nom']
        ];

        header('Location:chat.php');

    } else {
        header('Location:index.php?credentialsError');
    }
}




