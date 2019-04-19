<?php

require_once 'models/TaskModel.php';

class TaskController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->model = new TaskModel();
    }

    public function actionIndex()
    {
        $page = $_GET['page'] ?: 1;
        $offset = $_GET['offset'] ?: CFG['defaultOffset'];


        $sort = [
            'sort' => $_GET['sort'] ??  false,
            'type' => $_GET['type'] ??  false,
        ];

        $tasks = $this->model->getAll($offset, $page, $sort);
        $count = $this->model->getCount();
        $pageParams = [
            'tasks' => $tasks,
            'page' => $page,
            'offset' => $offset,
            'orderBy' => $sort
        ];
        $pageParams = array_merge($pageParams, $count);
        $this->render($pageParams);
    }

    public function actionCreate()
    {
        $this->render();
    }

    public function actionSave()
    {
        if ($this->isPost()) {
            $this->model->id = $_POST['id'];
            $this->model->username = $_POST['username'];
            $this->model->email = $_POST['email'];
            $this->model->text = $_POST['text'];
            $this->model->status = $_POST['status'];
            $this->model->save();
            $this->redirectHome();
        } else {
            $this->redirect404();
        }

    }

    public function actionInsert()
    {
        if ($this->isPost()) {
            $this->model->username = $_POST['username'];
            $this->model->email = $_POST['email'];
            $this->model->text = $_POST['text'];
            $this->model->insert();
            $this->redirectHome();
        } else {
            $this->redirect404();
        }
    }

    /**
     * @param int $id
     */
    public function actionEdit($id)
    {
        if ($_SESSION['admin']) {
            $task = $this->model->get($id);
            $this->render(['task' => $task]);
        } else {
            $this->redirect404();
        }
    }

}