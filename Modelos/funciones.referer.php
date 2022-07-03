<?php
function getReferer(string $path): string{
    $newPath = str_replace("\\","/",__DIR__);
    $newPath = str_replace("C:/xampp/htdocs","http://localhost",$newPath);
    $newPath = dirname($newPath) . "/$path";
    return $newPath;
}