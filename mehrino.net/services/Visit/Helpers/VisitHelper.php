<?php
// Visit helper
function getVisitService($service)
{
    switch ($service) {
        case "story":
            return \Services\Story\Models\Story::class;
        default:
            return null;
    }
}
