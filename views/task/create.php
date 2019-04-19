<?php ob_start() ?>
    <form action="/task/insert" method="post">
        <div class="form-group">
            <label for="username">Имя пользователя:</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="text">Текст задачи:</label>
            <textarea class="form-control" rows="5" name="text" id="text" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
<?php $content = ob_get_clean() ?>
<?php require_once './views/layout.php' ?>