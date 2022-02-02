<?php

namespace App\Console\Commands;

use App\Models\Drug;
use App\Models\PasswordReset;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteunacceptedDrugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkforUnacceptedDrugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

       Drug::where('is_accepted',0)->whereRaw('HOUR(TIMEDIFF(created_at,now())) >= 12')->delete();

    }
}
