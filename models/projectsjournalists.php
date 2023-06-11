<?php

namespace Models;

use core\Model;
use core\Core;

class ProjectsJournalists extends Model
{
    protected static $tableName = "projectsjournalists";

    public static function getProjectsByJournalist($journalist_id)
    {
        $rows = Core::getInstance()->db->select(self::$tableName,
        [
            "projects.id", "projects.name",
        ],
        [
            "journalist_id" => $journalist_id
        ],
        ["projects"],
        [
            "projects.id = projectsjournalists.project_id"
        ]);
        return $rows;
    }
}
