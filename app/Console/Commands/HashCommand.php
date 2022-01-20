<?php

namespace App\Console\Commands;

use App\Services\HashService;
use Illuminate\Console\Command;

class HashCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hash:test {term} {--requests=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testa a geração de hashs';

    private $hashService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(HashService $hashService)
    {
        $this->hashService = $hashService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $term = $this->argument('term');
        for ($i = 0; $i < $this->option('requests'); $i++) {
            $hash = $this->hashService->calculate($term);
            print_r("Hash: {$hash}\n");
            print_r("Key: {$this->hashService->keyService->key}\n");
            print_r("Attempts: {$this->hashService->attempts}\n");

            print_r("\n-------------------------------\n\n");
        }
    }
}
