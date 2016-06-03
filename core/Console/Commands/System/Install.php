<?php

namespace Core\Console\Commands\System;

use Core\Models\Installer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install system.';


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        define('APP_ID', null);
        define('SYSTEM_IS_INSTALLED', null);

        $status = (new Installer())->install();
    }

}
