<?php

class ComplaintHelpers{
    public function status($status){
        switch ($status){
            case 0:
                return "در صف بررسی";
                break;
            case 1:
                return "حل شده";
                break;
            case 2:
                return "در حال رسیدگی";
                break;
            case 3:
                return "ارجاع داده شده";
                break;
            case 4:
                return "عدم پاسخگویی شاکی";
                break;
            default:
                return "خطا در تشخیص";
                break;
        }
    }
}