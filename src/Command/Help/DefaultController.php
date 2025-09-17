<?php

namespace BananaFramework\Command\Help;

use Minicli\Command\CommandController;


class DefaultController extends CommandController {

    public function Handle() :void
    {
        $this->getPrinter()->info("What is Your name ? ");

        $name = trim(fgets(STDIN));
        
        

        $this->getPrinter()->info("Do you want to continue? (y/n): ");
        $confirm = strtolower(trim(fgets(STDIN)));

        if(strtolower($confirm[0]) == 'y' ) {
            $this->getPrinter()->success("Data has Been Stored");
        } 

        else {
            $this->getPrinter()->error("Sorry $name, we missed you thank you so much");
        }
    }
}