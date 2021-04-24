<?php
// Project helper

function getProjectSupervision($project)
{
    $inst = $project->institute()->first();
    if ($inst) {
        return "مؤسسه $inst->title";
    }
    $user = $project->full_user()->first();
    return $user->name ? $user->name : ($user->mobile ?? $user->email);
}
