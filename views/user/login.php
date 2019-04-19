<?php ob_start() ?>
<form action="/user/signin" method="post">
    <div class="form-group">
        <label for="login">Логин:</label>
        <input type="text" class="form-control" name="login" id="login" required>
    </div>
    <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" class="form-control" name="password" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
<?php $content = ob_get_clean() ?>
<?php require_once './views/layout.php' ?>
