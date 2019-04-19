<?php
ob_start();

$sort = [
    'user' => $param['orderBy']['sort'] == 'user' && $param['orderBy']['type'] == 'desc',
    'email' => $param['orderBy']['sort'] == 'email' && $param['orderBy']['type'] == 'desc',
    'status' => $param['orderBy']['sort'] == 'status' && $param['orderBy']['type'] == 'desc',
];

$count = ceil($param['count'] / $param['offset']);

$sorting = $_GET['sort'] ?? '';
$sortType = $_GET['type'] ?? '';

$tail = ($sorting && $sortType) ? '&sort=' . $sorting . '&type=' . $sortType : '';

$prev = $param['page'] - 1 . '&offset=' . $param['offset'] . $tail;
$next = $param['page'] + 1 . '&offset=' . $param['offset'] . $tail;

$current = '/?page=' . $param['page'] . '&offset=' . $param['offset'];

?>
<table class="table table-dark table-striped">
    <thead>
    <tr>
        <th>
            <nobr>
                <a class="text-white" href="<?= $current ?>&sort=user&type=<?= $sort['user'] ? 'asc' : 'desc' ?>">
                    Имя пользователя <?= $sort['user'] ? '▼' : '▲' ?>
                </a>
            </nobr>
        </th>
        <th>
            <nobr>
                <a class="text-white" href="<?= $current ?>&sort=email&type=<?= $sort['email'] ? 'asc' : 'desc' ?>">
                    E-mail <?= $sort['email'] ? '▼' : '▲' ?>
                </a>
            </nobr>
        </th>
        <th>
            <nobr>Текст задачи</nobr>
        </th>
        <th>
            <nobr>
                <a class="text-white" href="<?= $current ?>&sort=status&type=<?= $sort['status'] ? 'asc' : 'desc' ?>">
                    Статус <?= $sort['status'] ? '▼' : '▲' ?>
                </a>
            </nobr>
        </th>
        <?php if ($_SESSION['admin']) : ?>
            <th>
                <nobr>Действия</nobr>
            </th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($param['tasks'] as $task) : ?>
        <tr<?php if ($task['status'] > 0) : ?> class='bg-success text-white'<?php endif; ?>>
            <td><?= $task['username'] ?></td>
            <td><?= $task['email'] ?></td>
            <td><?= $task['text'] ?></td>
            <td>
                <nobr><?= $task['status'] > 0 ? 'Выполнено' : 'Не выполнено' ?></nobr>
            </td>
            <?php if ($_SESSION['admin']) : ?>
                <td><a href="task/edit/<?= $task['id'] ?>" class="text-warning">Редактировать</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<ul class="pagination">
    <li class="page-item<?php if ($param['page'] == 1) : ?> disabled<?php endif; ?>">
        <a class="page-link" href="/?page=<?= $prev ?>">Назад</a>
    </li>
    <?php for ($i = 1; $i <= $count; $i++) : ?>
        <?php
            $target = $i . '&offset=' . $param['offset'] . $tail;
            $active = $i == $param['page'] ? ' active' : '';
        ?>
        <li class="page-item<?= $active ?>"><a class="page-link" href="/?page=<?= $target ?>"><?= $i ?></a></li>
    <?php endfor; ?>
    <li class="page-item<?php if ($param['page'] == $count || $count == 0) : ?> disabled<?php endif; ?>">
        <a class="page-link" href="/?page=<?= $next ?>">Вперед</a>
    </li>
</ul>

<script>

</script>


<?php $content = ob_get_clean() ?>

<?php require_once './views/layout.php' ?>
