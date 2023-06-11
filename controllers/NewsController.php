<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\User;
use models\News;
use models\Projects;
use models\Pages;


class NewsController extends Controller
{
    public function indexAction()
    {
        if (!User::isUserAunthenticated()) {
            return $this->error(403);
        }
        $rows = News::getAll();

        return $this->render(null, [
            "rows" => $rows
        ]);
    }

    public function deleteAction($params)
    {
        $project_id = intval($params[0]);
        $news_id = intval($params[1]);
        if (!User::isUserAunthenticated() || $project_id <= 0 || $news_id <= 0) {
            return $this->error(403);
        }

        $news = News::getById($news_id);
        if (boolval($params[2] === "true")) {
            News::delete($news_id);
            return $this->redirect("/projects/edit/{$project_id}");
        }
        return $this->render(
            null,
            [
                "news" => $news,
                "project_id" => $project_id
            ]
        );
    }

    public function editAction($params)
    {
        $project_id = intval($params[0]);
        if (!User::isUserAunthenticated() || $project_id <= 0) {
            return $this->error(403);
        }

        $news = News::getById($params[1]);
        if (Core::getInstance()->requestMethod === "POST")
        {
            News::edit([
                "title" => $_POST['title'],
                "content" => $_POST['content'],
                "date" => date('Y-m-d')
            ],
            [
                "id" => $news['id']
            ]);
            return $this->redirect("/projects/edit/{$project_id}");
        }

        return $this->render(null, [
            "projectId" => $project_id,
            "news" => $news
        ]);
    }

    public function addAction($params)
    {
        $project_id = intval($params[0]);
        if (!User::isUserAunthenticated() || $project_id <= 0) {
            return $this->error(403);
        }

        $user = User::getCurrentAunthenticatedUser();
        if (Core::getInstance()->requestMethod === "POST") {
            News::add([
                "title" => $_POST['title'],
                "content" => $_POST['content'],
                "date" => date('Y-m-d'),
                "project_id" => $project_id,
                "author" => $user['id']
            ]);

            return $this->render(null, [
                "projectId" => $project_id
            ]);
        }
        return $this->render(null, [
            "projectId" => $project_id
        ]);
    }
}


