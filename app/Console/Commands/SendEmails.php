<?php

namespace App\Console\Commands;

use App\Contracts\CakeRepositoryInterface;
use App\Jobs\SendInterestCakeEmail;
use Illuminate\Console\Command;

class SendEmails extends Command
{

    private $cakeRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'interest-list:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send interest list e-mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CakeRepositoryInterface $cakeRepository)
    {
        parent::__construct();

        $this->cakeRepository = $cakeRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SendInterestCakeEmail::dispatch($this->cakeRepository)->delay(now()->addMinutes(1));
    }
}
