<?php

namespace App\Console\Commands;

use App\Models\Drug;
use App\Models\User;
use App\Notifications\GeneralInfoSlackScheduler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Collection;

class SendSlackInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */




    protected $signature = 'send-slack-info';

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
        //geting data
        $countUsers = User::where('is_admin',0)->count();
        $countDrugs = Drug::where('is_accepted',1)->count();

        $totalSum = DB::table('payments')->sum('sum');


        Notification::route('slack', env('SLAC_WEEBHOOKGENERALINFO'))
            ->notify(new GeneralInfoSlackScheduler($countUsers,$countDrugs,$totalSum,$this->makeJokes()));

    }

    private function makeJokes(){

       return Collection::make(["Three SQL databases walk into a bar... then they leave. Why?
They couldn't find a table.",
           'What is worse than droping a database by accident in SQL ... Professor Ramiz with Arberin and Medinen dropping you from LAB 2 :eyes:',
           'Why did the database administrator leave his wife?
            She had one-to-many relationships.',
            'I saw a movie on databases today. Can’t wait for the SQL',
           'A SQL query goes to the bar, walks up to two tables
"Can I join you?"','Why does Pennywise make such a horrible SQL database architect?
He tries to cast all the data to float.'])->random();

    }
}
