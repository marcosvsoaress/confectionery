<?php

namespace App\Jobs;

use App\Contracts\CakeRepositoryInterface;
use App\Mail\InterestEmail;
use App\Repositories\CakeRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInterestCakeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var CakeRepository $cakeRepository
     */
    private $cakeRepository;

    /**
     * Create a new job instance.
     *
     * @param CakeRepositoryInterface $cakeRepository
     */
    public function __construct(CakeRepositoryInterface $cakeRepository)
    {
        $this->cakeRepository = $cakeRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cakes = $this->interestList();
        foreach ($cakes as $cake){
            foreach ($cake->interestList as $list)
            Mail::to($list->email)
                ->send(new InterestEmail($cake));
        }
    }

    /**
     * get all interest list email with cake in stock
     *
     * @return Collection
     */
    private function interestList(): Collection
    {
        return $this->cakeRepository->getInterestListCakeWithStoke();
    }
}
