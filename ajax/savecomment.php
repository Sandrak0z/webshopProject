<?php
session_start();
include_once(__DIR__ . "/../classes/Comment.php");
if (!empty($_POST)) {

    $c = new Comment();
    $c->setText($_POST["text"]);
    $c->setProductId($_POST["productId"]);
    $c->setUserId($_SESSION['customerId']);

    $c->save();
    
    $reponse = [
            'status' => 'success',
            'body' => htmlspecialchars($c->getText()),
            'message' => 'Comment saved'
        ];
        header('Content-Type: application/json');
        echo json_encode($reponse);
    
}