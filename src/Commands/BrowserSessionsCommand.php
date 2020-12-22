<?php

namespace Anubra266\BrowserSessions\Commands;

use Illuminate\Console\Command;

class BrowserSessionsCommand extends Command
{
    public $signature = 'browser-sessions:install';

    public $description = 'Setup Browser Sessions Package';

    public function handle()
    {
        $this->comment('All Done!');
    }
}
