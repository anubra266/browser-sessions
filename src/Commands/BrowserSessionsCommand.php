<?php

namespace Anubra266\BrowserSessions\Commands;

use Illuminate\Console\Command;

class BrowserSessionsCommand extends Command
{
    public $signature = 'browser-sessions';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
