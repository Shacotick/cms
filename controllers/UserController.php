<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\User;
use models\Projects;

/**
 * Контроллер сторінки з користувачами
 */
class UserController extends Controller
{

    public function indexAction()
    {
        if (!User::isAdmin()) {
            return $this->error(403);
        }

        $users = User::getUsersAndProjects();
        $userData = [];
        foreach ($users as $row) {
            $userId = $row['id'];
            $projectName = $row['name'];
        
            if (!isset($userData[$userId])) {
                $userData[$userId] = [
                    'id' => $row['id'],
                    'login' => $row['login'],
                    'lastname' => $row['lastname'],
                    'firstname' => $row['firstname'],
                    'access_level' => $row['access_level'],
                    'projects' => []
                ];
            }
            $userData[$userId]['projects'][] = $projectName;
        }


        return $this->render(null, 
        [
            "users" => $userData
        ]);
    }

    public function addAction()
    {
        if (!User::isAdmin()) {
            return $this->error(403);
        }

        $projects = Projects::getAll();
        if (Core::getInstance()->requestMethod === "POST")
        {
            //! ПАРОЛЬ НЕ ПОВИНЕН БУТИ ПІД TRIM І ІНША ПЕРЕВІРКА(ДОБАВИТИ ПОВТОР ПАРОЛЮ)
            $errors = [];
            $_POST["lastname"] = trim($_POST["lastname"]);
            $_POST["firstname"] = trim($_POST["firstname"]);
            $_POST["login"] = trim($_POST["login"]);
            $_POST["password"] = trim($_POST["password"]);
            if (empty($_POST['login']) || empty($_POST['password']) ||
                empty($_POST['lastname']) || empty($_POST['lastname'])) {
                $errors['name'] = 'Не усі поля заповнені';
            }
            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model,
                ]);
            }

            User::addUser(
                $_POST['login'],
                $_POST['password'],
                $_POST['lastname'],
                $_POST['firstname']
            );

            $user = User::getLastAddedValues();
            foreach($_POST['projectId'] as $project_id)
                User::addProjectForJournalist($user['id'], $project_id);
            return $this->redirect("/user");
        }

        return $this->render(null, [
            "projects" => $projects
        ]);
    }

    public function editAction($params)
    {
        $id = intval($params[0]);
        
        if (!User::isUserAunthenticated() || $id <= 0)
            return $this->error(403);
        if($params[1] != "account" && !User::isAdmin())
            return $this->error(403);

        $user = User::showUsers([
            "id" => $id
        ]);
        $user = $user[0];
        
        if (Core::getInstance()->requestMethod === "POST")
        {
            $errors = [];
            $_POST["lastname"] = trim($_POST["lastname"]);
            $_POST["firstname"] = trim($_POST["firstname"]);
            if (empty($_POST['lastname']) || empty($_POST['lastname'])) {
                $errors['name'] = 'Прізвище або ім\'я не вказана';
            }
            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }

            User::updateUser($user['id'], [
                'lastname' => $_POST["lastname"],
                'firstname' => $_POST["firstname"]
            ]);
            return $this->redirect("/user");
        }

        return $this->render(null,
        [
            "user" => $user
        ]);
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        if (!User::isAdmin() || $id <= 0) {
            return $this->error(403);
        }

        $user = User::showUsers([
            "id" => $id
        ]);

        if (boolval($params[1] === "true")) {
            User::deleteUser($id);
            return $this->redirect("/user");
        }
        return $this->render(null,
        [
            "user" => $user[0]
        ]);
    }

    public function registerAction()
    {
        if (User::isUserAunthenticated())
            $this->redirect("/");

        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            if (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
                $errors['login'] = 'Помилка при введені електронної пошти';
            }

            if (User::isEmailExists($_POST['login'])) {
                $errors['login'] = 'Даний логін зайнятий';
            }

            if ($_POST['password'] != $_POST['password2'])
                $errors['password'] = 'Паролі не співпадають';

            /* 
                ! ВАЛІДАЦІЯ ІНШИХ ПОЛІВ
            */

            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            } else {
                User::addUser($_POST['login'], $_POST['password'], $_POST['secondname'], $_POST['firstname'], 10);
                return $this->renderView("register-success");
            }
        } else {
            return $this->render();
        }
    }

    public function loginAction()
    {
        if (User::isUserAunthenticated())
            $this->redirect("/");

        if (Core::getInstance()->requestMethod === 'POST') {
            $user = User::getUserByLoginAndPassword($_POST['login'], $_POST['password']);

            $error = null;
            if (empty($user)) {
                $error = 'Неправильний логін або пароль';
            } else {
                User::authenticateUser($user);
                $this->redirect("/");
            }

            return $this->render(null, [
                'error' => $error
            ]);
        } else {
            return $this->render();
        }
    }

    public function logoutAction()
    {
        User::logoutUser();
        $this->redirect("/user/login");
    }
}
