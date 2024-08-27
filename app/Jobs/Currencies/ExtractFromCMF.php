<?php

namespace App\Jobs\Currencies;

use App\Repositories\CMFRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ExtractFromCMF implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $api_key,
        public string $path,
        public string $name,
        public string $type,
        public bool $monthly
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        CMFRepository::fetchFinancialIndicator(
            $this->api_key,
            $this->path,
            $this->name,
            $this->type,
            $this->monthly,
        );
    }
}
