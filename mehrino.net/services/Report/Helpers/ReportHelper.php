<?php
// Report helper
function getReport($service)
{
    switch ($service) {
        case "project": {
                return" Service\Project\Models\Project";
                break;
            }
        case "voluntary": {
                return" Service\Voluntary\Models\VoluntaryWork";
                break;
            }
    }
}

function getReportName()
{
    return ["project", "voluntary"];
}


function success($name,$type){
    alert(__('message.alert.success.title')  , __('message.alert.success.message' , ['name' => $name , 'type' => $type]) , 'success');
}

function error(){
    alert(__('message.alert.error.title')  , __('message.alert.error.message') , 'error');
}
