<!DOCTYPE html>
<html>
<head>
    <title>
        Форма обратной связи
    </title>
</head>
<body>
    <form action="formHandle.php" method="POST">
        <div><p>Имя</p><input required="required" type="text" name="name"></div>
        <div><p>E-mail</p><input required="required" type="email" name="email"></div>
        <div><p>Сообщение</p><textarea required="required" name="message"></textarea></div>
        <button>Отправить</button>
    </form>
</body>
</html>