<?php

/**
 * @param int $status
 * @return string
 */
function status_to_str(int $status): string
{
    try {
        switch ($status) {
            default:
            case \Services\Support\Enum\Status::Waiting:
                return \Services\Support\Enum\Type::Waiting;
            case \Services\Support\Enum\Status::Solved:
                return \Services\Support\Enum\Type::Solved;
            case \Services\Support\Enum\Status::Working:
                return \Services\Support\Enum\Type::Working;
            case \Services\Support\Enum\Status::NoAnswer:
                return \Services\Support\Enum\Type::NoAnswer;
            case \Services\Support\Enum\Status::UserClose:
                return \Services\Support\Enum\Type::UserClose;
            case \Services\Support\Enum\Status::ManagerClose:
                return \Services\Support\Enum\Type::ManagerClose;
        }
    } catch (\Exception $exp) {
        InternalServerError500($exp);
    }

}

/**
 * @param string $status
 * @return int
 */
function str_to_status(string $status): int
{
    try {
        switch ($status) {
            case \Services\Support\Enum\Type::Waiting:
                return \Services\Support\Enum\Status::Waiting;
            case \Services\Support\Enum\Type::Solved:
                return \Services\Support\Enum\Status::Solved;
            case \Services\Support\Enum\Type::Working:
                return \Services\Support\Enum\Status::Working;
            case \Services\Support\Enum\Type::NoAnswer:
                return \Services\Support\Enum\Status::NoAnswer;
            case \Services\Support\Enum\Type::UserClose:
                return \Services\Support\Enum\Status::UserClose;
            case \Services\Support\Enum\Type::ManagerClose:
                return \Services\Support\Enum\Status::ManagerClose;
        }
    } catch (\Exception $exp) {
        InternalServerError500($exp);
    }
}


/**
 * SupportDepartment
 * @param int Department
 * @return string
 */
function dep_to_str(int $department): string
{
    try {
        switch ($department) {
            default:
            case \Services\Support\Enum\TicketDepartment::General:
                return "general";
            case \Services\Support\Enum\TicketDepartment::Finance:
                return "finance";
            case \Services\Support\Enum\TicketDepartment::Events:
                return "events";
            case \Services\Support\Enum\TicketDepartment::Corporations:
                return "corporations";
            case \Services\Support\Enum\TicketDepartment::Managers:
                return "managers";
        }
    } catch (\Exception $exp) {
        InternalServerError500($exp);
    }

}

/**
 * Departments
 * @return array
 */
function departments(): array
{
    return ["general", "finance", "events", "corporations", "managers"];

}

/**
 * Priorities
 * @return array
 */
function priorities(): array
{
    return [
        "normal",
        "nonSignificant",
        "important"
    ];
}

/**
 * attachmentType
 * @return array
 */
function attachmentType(): array
{
    return [
        "image",
        "file"
    ];
}

/**
 * getMimeType Image
 * @return array
 */
function getMimeTypeImage(): array
{
    return [
        "image/jpeg",
        "image/gif",
        "image/bmp",
        "image/webp",
        "image/png",
        "image/tiff"
    ];
}

/**
 * getMimeType Image
 * @return array
 */
function getMimeTypeFile(): array
{
    return [
        // .txt
        "text/plain",
        // .rar
        "application/vnd.rar",
        // .zip
        "application/zip",
        // .7z
        "application/x-7z-compressed",
        // .tar
        "application/x-tar",
        // .pdf
        "application/pdf",
    ];
}

/**
 * priority to string
 * @param int $priority
 * @return string
 */
function priority_to_str(int $priority): string
{
    try {
        switch ($priority) {
            default:
            case \Services\Support\Enum\TicketPriority::Normal:
                return "normal";
            case \Services\Support\Enum\TicketPriority::NonSignificant:
                return "nonSignificant";
            case \Services\Support\Enum\TicketPriority::Important:
                return "important";
        }
    } catch (\Exception $exp) {
        InternalServerError500($exp);
    }

}
/**
 *  string to  priority
 * @param string $priority
 * @return int
 */
function str_to_priority(string $priority): int
{
    try {
        switch ($priority) {
            default:
            case "normal":
                return \Services\Support\Enum\TicketPriority::Normal;
            case "nonSignificant":
                return \Services\Support\Enum\TicketPriority::NonSignificant;
            case "important":
                return \Services\Support\Enum\TicketPriority::Important;
        }
    } catch (\Exception $exp) {
        InternalServerError500($exp);
    }

}
