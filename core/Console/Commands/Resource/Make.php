<?php

namespace Core\Console\Commands\Resource;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Make extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:resource {resource name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new resource with controller, model and routes.';


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
        $name = $this->argument('resource name');


        $this->call('make:model', [
            'model name' => $name,
        ]);

        $this->call('make:controller', [
            'controller name' => $name,
        ]);




    }

}
