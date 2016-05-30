<?php

namespace Core\Console\Commands\Permission;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Parse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:resources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse system permissions and bind with resources.';


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

    }

}
