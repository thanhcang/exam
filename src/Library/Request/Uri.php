<?php

namespace Src\Library\Request;

class Uri
{
    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string`
     */
    private $path;

    /**
     * @var string
     */
    private $query;

    public function __construct()
    {
        $url          = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $urlContext   = parse_url($url);
        $this->host   = $urlContext['host'];
        $this->path   = !empty($urlContext['path']) ? $urlContext['path'] : "";
        $this->query  = !empty($urlContext['query']) ? $urlContext['query'] : "";
        $this->scheme = !empty($urlContext['scheme']) ? $urlContext['scheme'] : "";
    }

    public function pathComponent(): array
    {
        return explode('/', ltrim($this->getPath(), '/'));
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    public function isRootUrl(): bool
    {
        if ($this->getPath() === '/' || $this->getPath() === "") {
            return true;
        }

        return false;
    }
}