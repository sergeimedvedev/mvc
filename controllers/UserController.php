<?php

class UserController extends Controller {

    public function actionIndex() {
        $this->actionLogin();
    }

    public function actionLogin() {
        $this->render();
    }

    public function actionLogout() {
        $_SESSION['admin'] = false;
        $this->redirectHome();
    }

    public function actionSignin() {
        $user = $_POST['login'] ?? false;
        $password = $_POST['password'] ?? false;
        if ($user === CFG['admin']['login'] && $password === CFG['admin']['password']) {
            $_SESSION['admin'] = true;
        }
        $this->redirectHome();
    }


}