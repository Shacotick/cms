<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\News;
use models\Pages;
use models\Projects;
use models\User;

/**
 * Контроллер проєктів
 */
class ProjectsController extends Controller
{
    public function indexAction()
    {
        if (!User::isUserAunthenticated()) {
            return $this->error(403);
        }

        $rows = Projects::getAll();
        return $this->render(
            null,
            [
                "rows" => $rows,
            ]
        );
    }

    public function addAction()
    {
        if (!User::isUserAunthenticated()) {
            return $this->error(403);
        }
        if (Core::getInstance()->requestMethod === "POST") {
            $errors = [];
            $_POST["name"] = trim($_POST["name"]);
            if (empty($_POST["name"])) {
                $errors["name"] = "Назва проєкту не вказана";
                //! Зробити щоб валідація працювала без перезагрузки сторінки
            }
            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    "errors" => $errors,
                    "model" => $model,
                ]);
            }

            Projects::add($_POST["name"]);
            $lastProject = Projects::getLastAddedValues();
            $page = Pages::getMainPageByProjectId($lastProject["id"]);

            $file_path = "views/projects/sites/" . $lastProject["id"] . "/" . $page['id'];

            $source_path = "templates/template_1/mainpage";

            Projects::copyFolder($source_path, $file_path);

            return $this->redirect("/projects");
        }
        return $this->render();
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        if (!User::isUserAunthenticated() || $id <= 0) {
            return $this->error(403);
        }

        $project = Projects::getById($id);

        if (boolval($params[1] === "true")) {
            Projects::delete($id);
            $file_path = "views/projects/sites/" . $project["id"];
            Projects::deleteDirectory($file_path);

            return $this->redirect("/projects");
        }
        return $this->render(
            null,
            [
                "project" => $project,
            ]
        );
    }

    public function editAction($params)
    {
        $id = intval($params[0]);
        if (!User::isUserAunthenticated() || $id <= 0) {
            return $this->error(403);
        }

        $project = Projects::getById($id);
        $user = User::getCurrentAunthenticatedUser();
        $news = News::getByProjectIdAndAuthor($project['id'], $user['id']);

        if (Core::getInstance()->requestMethod === "POST") {
            $errors = [];
            $_POST["name"] = trim($_POST["name"]);
            if (empty($_POST['name'])) {
                $errors['name'] = 'Назва проєкту не вказана';
            }
            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model,
                    'project' => $project,
                ]);
            }
            Projects::edit($id, $_POST["name"]);
            return $this->redirect("/projects");
        }

        return $this->render(
            null,
            [
                "project" => $project,
                "news" => $news,
            ]
        );
    }

    public function viewAction($params)
    {
        $projectId = intval($params[0]);
        $pageId = intval($params[1]);
        if ($projectId <= 0 || $pageId <= 0) {
            return $this->error(403);
        }

        if(!User::isUserAunthenticated())
        {
            return $this->renderPage([
                "projectId" => $projectId,
                "pageId" => $pageId,
            ],
                [
                    "projectId" => $projectId,
                    "pageId" => $pageId,
                ]);
        }

        return $this->renderPage([
            "projectId" => $projectId,
            "pageId" => $pageId,
        ],
            [
                "projectId" => $projectId,
                "pageId" => $pageId,
            ]);
    }

    public function newsredirectAction($params)
    {
        $projectId = intval($params[0]);
        $newsId = intval($params[1]);

        $news = News::getById($newsId);
        $user = User::showUsers([
            "id" => $news['author']
        ]);
        return $this->render("templates/template_1/newspage/index.php",
            [
                "news" => $news,
                "projectId" => $projectId,
                "user" => $user[0]
            ]);
    }
}
