<?php

namespace Citadel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class BuildCommand extends Command
{
    protected $name = "Citadel JS Build Command";
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'citadel:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the Citadel JS File';

    /**
     * Execute the console command.
     */
    public function handle()
    {
                
        File::copy(__DIR__ . '/../../dist/manifest.json', public_path('citadelkit/manifest.json'));
        $this->info('Copied manifest.json to '.public_path('citadelkit'));

        $this->call('vendor:publish', ['--tag' => 'citadel']);
    }
}
