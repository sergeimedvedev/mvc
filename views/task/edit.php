<?php ob_start() ?>
    <form action="/task/save" method="post">
        <input type="hidden" name="id" value="<?= $param['task']['id'] ?>">
        <div class="form-group">
            <label for="username">Имя пользователя:</label>
            <input type="text" class="form-control" name="username" id="username" value="<?= $param['task']['username'] ?>" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" name="email" id="" value="<?= $param['task']['email'] ?>" required>
        </div>
        <div class="form-group">
            <label for="text">Текст задачи:</label>
            <textarea class="form-control" rows="5" name="text" id="text" required><?= $param['task']['text'] ?></textarea>
        </div>
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="status" id="status" <?php if ($param['task']['status'] > 0) : ?>checked=""<? endif; ?>>
                <label class="custom-control-label" for="status" name="status">Выполнено</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
<?php $content = ob_get_clean() ?>

<?php require_once './views/layout.php' ?>