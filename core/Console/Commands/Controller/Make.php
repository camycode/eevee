<?php

namespace Core\Console\Commands\Controller;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class Make extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:controller {controller name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new controller with template.';


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
        $name = $this->argument('controller name');

        config(['view.paths' => []]);

        View::addLocation(base_path('core/Console/Commands/Controller'));
        
        $code = View::make('controller', [
            'StartTag' => '<?php ',
            'ControllerNamespacePath' => $this->generateControllerNamespacePath($name),
            'ControllerName' => $this->generateControllerName($name),
            'ControllerNameToLower' => $this->generareControllerNameToLower($name),
        ]);

        $ControllerFileName = base_path('core/Controllers' . str_replace('\\', '/', $this->generateControllerNamespacePath($name)) . 'Controller.php');


        if (Storage::has(ltrim($ControllerFileName, base_path()))) {
            $this->error('Controller ' . $ControllerFileName . ' has exists');
        } else {

            Storage::put(ltrim($ControllerFileName, base_path()), $code);

            $this->info('Create Controller ' . $ControllerFileName . ' success.');
        }


    }


    protected function generateControllerName($name)
    {
        $items = explode('/', $name);

        return ucfirst($items[count($items) - 1]);
    }

    protected function generareControllerNameToLower($name)
    {
        return strtolower($this->generateControllerName($name));
    }

    protected function generateControllerNamespacePath($name)
    {
        $path = '\\';

        $items = explode('/', $name);

        foreach ($items as $item) {
            $path .= ucfirst($item) . '\\';
        }

        return rtrim($path, '\\');
    }

}
