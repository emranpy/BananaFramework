<?php

declare(strict_types=1);

namespace BananaFramework\Command\Database;

use Minicli\Command\CommandController;

// Make sure your Helper.php defines this function
if (!function_exists('yesOrNo')) {
    /**
     * Convert user input to boolean yes/no
     */
    function yesOrNo(string $input): bool
    {
        $input = strtolower(trim($input));
        return in_array($input, ['y', 'yes']);
    }
}

class DefaultController extends CommandController
{
    private string $db_host;
    private string $db_username;
    private string $db_password;
    private string $db_name;

    public function handle(): void
    {
        $this->getPrinter()->info("Do you have an existing database? (y/n): ");
        $haveDb = trim(fgets(STDIN));

        if (yesOrNo($haveDb)) {
            // Ask for database host
            $this->getPrinter()->info("Enter Database Host: ");
            $this->db_host = trim(fgets(STDIN));

            // Ask for username
            $this->getPrinter()->info("Enter Database Username: ");
            $this->db_username = trim(fgets(STDIN));

            // Ask for password
            $this->getPrinter()->info("Enter Database Password: ");
            $this->db_password = trim(fgets(STDIN));

            // Ask for database name
            $this->getPrinter()->info("Enter Database Name: ");
            $this->db_name = trim(fgets(STDIN));

            // Output summary
            $this->getPrinter()->success("Database configuration collected:");
            $this->getPrinter()->info("Host: {$this->db_host}");
            $this->getPrinter()->info("Username: {$this->db_username}");
            $this->getPrinter()->info("Password: {$this->db_password}");
            $this->getPrinter()->info("Database: {$this->db_name}");

        } else {
            $this->getPrinter()->info("Would you like to create a Database ? ");

        }
    }


    // private CreateDb
}
