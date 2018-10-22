<form action="<?=HANDLER_DIR?>/message" method="POST">
    <div>
        <p>Имя</p>
        <input required="required" type="text" name="name">
    </div>
    <div>
        <p>E-mail</p>
        <input required="required" type="email" name="email">
    </div>
    <div>
        <p>Сообщение</p>
        <textarea required="required" name="message"></textarea>
    </div>
    <button type="submit">Отправить</button>
</form>