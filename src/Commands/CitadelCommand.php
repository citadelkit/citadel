<?php

namespace Citadel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class CitadelCommand extends Command
{
    protected $name = "component";
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'citadel:make { component : CitadelComponent } { name : Component Name }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->name = $this->argument('name');

        if (static::hasMacro($this->argument('component'))) {
            return call_user_func(static::$macros[$this->argument('component')], $this);
        }

        if (! in_array($this->argument('component'), ['sidebar', 'header'])) {
            throw new InvalidArgumentException('Invalid component.');
        }

        $this->{$this->argument('component')}();
    }

    public function sidebar()
    {
        $path = base_path('resources/views/citadel/sidebar/'. ($this->name ?? "default") .".blade.php");
        File::ensureDirectoryExists(dirname($path));
        copy(
            $source = __DIR__.'/../../resources/views/templates/dash/navbar-vertical.blade.php',
            $path
        );
        info("Copied from [\"$source\"] to [\"$path\"]");
    }
}
