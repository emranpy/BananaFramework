<?php

declare(strict_types=1);

namespace BananaFramework;

use BananaFramework\Exception\LoadingConfigError;
use BananaFramework\Config\Repository;
use BananaFramework\Router\Factory\RouterFactory;

class Application
{


    private static Application $instance;
    private bool $booted = false;

    private Repository $config;

    private function __construct(
        private string $basePath
    ) {}

    public static function boot(string $basePath): Application
    {
        if (!isset(Application::$instance)) {
            Application::$instance = new static(
                basePath: $basePath
            );
        }

        $app = static::$instance;
        $app->loadConfig();
        $app->booted = true;
        return $app;

    }

    public function loadConfig(): void
    {
        $configPath = $this->basePath . 'config/';

        if (!is_dir($configPath)) {
            throw new LoadingConfigError(
                message: "Config folder missing at: {$configPath}"
            );
        }

        $files = scandir($configPath);
        $files = array_diff($files, ['.', '..']);

        $config = [];
        foreach ($files as $file) {
            $fullPath = $configPath . $file;

            if (is_file($fullPath) && pathinfo($fullPath, PATHINFO_EXTENSION) === 'php') {
                $configName = pathinfo($fullPath, PATHINFO_FILENAME);
                $config[$configName] = require $fullPath;
            }
        }

        $this->config = Repository::build(
            items: $config
        );
    }

    public function config(): Repository
    {
        return $this->config;
    }

    public function basePath(): string
    {
        return $this->basePath;
    }

    public function isBooted(): bool
    {
        return $this->booted;
    }

    public static function run()
    {
        $router = RouterFactory::build();
           
    }

}

$app = Application::boot(__DIR__ . "/../");


