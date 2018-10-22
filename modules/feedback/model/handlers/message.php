<?php
require_once $_SERVER['DOCUMENT_ROOT']."/start.php";
try {
    //leave message query
    $lmq = $db->prepare("INSERT INTO feedback(name, email, message) VALUES(:name, :email, :message)");
    $lmq->bindParam("name", $name);
    $lmq->bindParam("email", $email);
    $lmq->bindParam("message", $message);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $db->beginTransaction();
    $lmq->execute();
    $db->commit();

    Main::redirect("/feedback/message");

} catch (PDOException $e) {
    $db->rollBack();
    echo "Произошла ошибка: " . $e->getMessage();
}
?>