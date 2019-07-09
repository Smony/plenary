<?php namespace Kitsoft\Plenary\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Kitsoft\Plenary\Models\Plenary;

use RainLab\Builder\Classes\PluginBaseModel;
use System\Classes\PluginManager;

class MyCommand extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'plenary:count';

    /**
     * @var string The console command description.
     */
    protected $description = 'kitsoft.plenary::lang.plugin.description';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $name = $this->argument('name');
        $plugins = $this->option('plagins');

        $this->info('Hello');
        $this->line($name);

        $results = Plenary::where('published', 1)->count();
        $this->output->writeln("Plenaries: " . $results);

        if ($plugins == 'all'){
            $plugins = $this->listAllPlugins();

            dd($plugins);
            $this->info($plugins);
        }
    }

    /**
     * @return array
     */
    public function listAllPlugins()
    {
        $plugins = PluginManager::instance()->getPlugins();

        return array_keys($plugins);
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of the new user'),
        );
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('plagins', null, InputOption::VALUE_REQUIRED, 'this plagins')
        );
    }

}
