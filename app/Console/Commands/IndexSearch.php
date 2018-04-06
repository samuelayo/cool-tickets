<?php

namespace App\Console\Commands;

use Laravel\Scout\Console\ImportCommand;

class IndexSearch extends ImportCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:search {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index Event model on algolia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

//    /**
//     * Execute the console command.
//     *
//     * @return mixed
//     */
//    public function handle()
//    {
//        //
//    }
}
