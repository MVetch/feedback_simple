<?php
require_once $_SERVER['DOCUMENT_ROOT']."/start.php";
try {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    if (!filter_var($email_a, FILTER_VALIDATE_EMAIL)){
        echo "E-mail введен неверно.";
        die();
    }
    if(empty($name)){
        echo "Имя не должно быть пустым.";
        die();
    }
    if(empty($message)){
        echo "Текст сообщения не должен быть пустым.";
        die();
    }

    //leave message query
    $lmq = $db->prepare("INSERT INTO feedback(name, email, message) VALUES(:name, :email, :message)");
    $lmq->bindParam("name", $name);
    $lmq->bindParam("email", $email);
    $lmq->bindParam("message", $message);

    $db->beginTransaction();
    $lmq->execute();
    $db->commit();

    Main::redirect("/feedback/message");

} catch (PDOException $e) {
    $db->rollBack();
    echo "Произошла ошибка: " . $e->getMessage();
}
?>