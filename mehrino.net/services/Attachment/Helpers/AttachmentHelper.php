<?php
// Attachment helper

use Illuminate\Support\Facades\Log;
use Services\Attachment\Jobs\ImageThumbnail;
use Services\Attachment\Jobs\DeleteGallery;

function attachMap($attachments)
{
    if (!$attachments) return null;
    return collect($attachments)->map(function ($item) {
        return [
            "path" => getBaseUri($item->path),
            "uuid" => $item->uuid,
        ];
    })->all();
}


function upload($url)
{
    $path = preg_replace('/\/\//', '/', $url);
    $file = \Image::make(\Storage::disk('liara')->url($path));
    $l = preg_replace('/^(.+)\/(.+)$/i', '${1}/large/$2', $path);
    $m = preg_replace('/^(.+)\/(.+)$/i', '${1}/medium/$2', $path);
    $s = preg_replace('/^(.+)\/(.+)$/i', '${1}/small/$2', $path);
    $large =  $file->resize(550, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
    \Storage::put($l, $large->stream()->__toString());

    $medium =  $file->resize(300, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
    \Storage::put($m, $medium->stream()->__toString());

    $small =  $file->resize(150, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
    \Storage::put($s, $small->stream()->__toString());
}

function deleteAll($path)
{
    $paths = [];
    array_push($paths, $path);
    $l = preg_replace('/^(.+)\/(.+)$/i', '${1}/large/$2', $path);
    array_push($paths, $l);
    $m = preg_replace('/^(.+)\/(.+)$/i', '${1}/medium/$2', $path);
    array_push($paths, $m);
    $s = preg_replace('/^(.+)\/(.+)$/i', '${1}/small/$2', $path);
    array_push($paths, $s);
    \Storage::disk('liara')->delete($paths);
}


function imageOnQueue($path)
{
    ImageThumbnail::dispatch($path)->onQueue('high');
}

function imageDeleteOnQueue($attached)
{
    DeleteGallery::dispatch($attached)->onQueue('low')->delay(now()->addMinutes(30));
}

function getBaseUri(?string $uri = null)
{
    if ($uri === null)
        return null;
    else
        return \Illuminate\Support\Facades\Storage::url(str_replace('//', '/', $uri));
}
function getLargeUri(?string $uri = null)
{
    if ($uri === null)
        return null;
    else {
        $path = preg_replace('/\/\//', '/', $uri);
        $s = preg_replace('/^(.+)\/(.+)$/i', '${1}/large/$2', $path);
        return \Illuminate\Support\Facades\Storage::url($s);
    }
}
function getMediumUri(?string $uri = null)
{
    if ($uri === null)
        return null;
    else {
        $path = preg_replace('/\/\//', '/', $uri);
        $s = preg_replace('/^(.+)\/(.+)$/i', '${1}/medium/$2', $path);
        return \Illuminate\Support\Facades\Storage::url($s);
    }
}
function getSmallUri(?string $uri = null)
{
    if ($uri === null)
        return null;
    else {
        $path = preg_replace('/\/\//', '/', $uri);
        $s = preg_replace('/^(.+)\/(.+)$/i', '${1}/small/$2', $path);
        return \Illuminate\Support\Facades\Storage::url($s);
    }
}
function uploadPath($path)
{
    try {
        if ($path === null) {
            return null;
        }
        $end = substr($path, 0, strlen(trim($path)) - 1);
        $url = $end . '/' === $path ? $end : $path;
        $date = date('Y-m');
        return str_replace('//', '/', $date . "/" . $url);
    } catch (\Exception $e) {
        return null;
    }
}
