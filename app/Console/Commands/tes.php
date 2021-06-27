<?php

namespace App\Console\Commands;

use App\KeranjangMap;
use App\Kota;
use App\Resep;
use Illuminate\Console\Command;

class tes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tes:tes';

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
     * @return mixed
     */
    public function handle()
    {
        $tes = Kota::all()->toSql();

        dd($tes);
    }
}
