<?php
// Like helper
function getTypeService($service)
{
    switch ($service) {
        case "project":
            return \Services\Project\Models\Project::class;
            case "institute":
            return \Services\Institute\Models\Institute::class;
        default:
            return null;
    }
}
