<?php
/**
 * Created by PhpStorm.
 * User: mrshin
 * Date: 1/8/19
 * Time: 5:32 PM
 */

namespace Src\Library;


use Src\Exception\ProjectConfigurationException;

class ProjectConfiguration
{
    /**
     * @var self
     */
    private static $instance;

    private $variables = [];

    public function __construct()
    {
        $file = __DIR__ . '/../../configs/project.ini';
        if (!file_exists($file)) {
            throw new ProjectConfigurationException('file configuration is not exits');
        }

        $this->variables = parse_ini_file($file);
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof ProjectConfiguration) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get(string $key): string
    {
        if (!$this->has($key)) {
            throw new ProjectConfigurationException("key {$key} is not exists");
        }
        return $this->variables[$key];
    }

    public function has(string $key): bool
    {
        return isset($this->variables[$key]) ? true : false;
    }

    /**
     * @return array|bool
     */
    public function getVariables()
    {
        return $this->variables;
    }
}