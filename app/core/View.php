<?php


namespace core;


class View
{
    public function render($pageFile, $templateFile)
    {
        include_once 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'template' .DIRECTORY_SEPARATOR . $templateFile;
    }

}