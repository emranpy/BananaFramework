<?php

namespace BananaFramework\Command\Openapi;

use BananaFramework\Parsers\OpenApiParser;
use InvalidArgumentException;
use Minicli\Command\CommandController;
use \League\Flysystem\Local\LocalFilesystemAdapter;
use \League\Flysystem\Filesystem;
use Symfony\Component\VarDumper\VarDumper;


class DefaultController extends CommandController
{
    private null|string $file = null;
    private array $routes = [];


    public function handle(): void
    {
        $this->getPrinter()->info(content: "starting to process Openapi ...... ");
        $this->setFile();


        //check file existance in the given dir
        if (!file_exists($this->file)) {
            throw new InvalidArgumentException(
                message: "File does not exist [$this->file] "
            );
        }
        $this->syncRoutes();
    }

    private function syncRoutes()
    {
        $this->routes = OpenApiParser::parse($this->file, 'paths');

        $this->info(content: "Processing " . count($this->routes) . " routes");

        // Create a new Filesystem instance with that adapter

        //check file existance in the given dir
        $exist = static::filesystem()->has(
            'routes/' . 'api.php'
        );

        if (!$exist) {

            $routes_path = 'routes/api.php';

            $resource = fopen('php://memory', 'r+');


            //content to be append to api.php
            $content = <<<EOD
            <?php

            namespace routes;

            declare(strict_types=1);

            []; 
            EOD;

            fwrite($resource, $content);
            rewind($resource);

            static::filesystem()->writeStream(
                location: $routes_path,
                contents: $resource
            );

            fclose($resource);
        }


        //get template from stubs...
        $stub = static::filesystem()->read(
            location:  'Stubs/api.stub'
        );

        VarDumper::dump($stub);

    }

    private function setFile(): void
    {

        if ($this->hasParam('file')) {
            $this->file = BASE_DIR . $this->getParam('file');
        }

        if ($this->file === null) {
            $this->file = BASE_DIR . 'routes';
        }
    }

    private static function filesystem() {
        return new Filesystem(
            new LocalFilesystemAdapter(BASE_DIR));
    }



}






