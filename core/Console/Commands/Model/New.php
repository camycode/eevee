<?php

namespace Core\Console\Commands\Model;

use Illuminate\Console\Command;

class Checkout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create new model.';


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
