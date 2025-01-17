<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLogs extends Command
{
    protected $signature = 'logs:clear';
    protected $description = 'Clear application logs';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $logPath = storage_path('logs');
        File::cleanDirectory($logPath);

        $this->info('Application logs cleared!');
    }
}
