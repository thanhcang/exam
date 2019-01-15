<?php

function assetCss(string $fileName)
{
    return \Src\Library\ProjectConfiguration::getInstance()->get('APP_URL') . '/css/' . $fileName . '.css';
}

function assetJs(string $fileName)
{
    return \Src\Library\ProjectConfiguration::getInstance()->get('APP_URL') . '/js/' . $fileName . '.js';
}

function renderHref(string $href)
{
    return \Src\Library\ProjectConfiguration::getInstance()->get('APP_URL') . '/' . $href;
}

function getAppUrl()
{
    return \Src\Library\ProjectConfiguration::getInstance()->get('APP_URL');
}