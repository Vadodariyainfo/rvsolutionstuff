<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use File;
use Redirect;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'databaseBackup:cron';

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
        // Genrate backup files 
        // $filename = \Carbon\Carbon::now()->format('m-d-Y')."-backup.gz";
        // $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " .Storage::path("public/db-backup/". $filename);
        // $returnVar = NULL;
        // $output  = NULL;
  
        // exec($command, $output, $returnVar);

        // // Delete existing backup files 
        // $startDate = Carbon::now()->subDays(7);
        // $endDate = Carbon::now();
        // $dateRange = CarbonPeriod::create($startDate, $endDate);
        // $dates = ['.gitignore'];
        // foreach ($dateRange->toArray() as $key => $value) {
        //     $dates[] = $value->format('m-d-Y')."-backup.gz";
        // }

        // $files = Storage::allfiles('public/db-backup/');
        // foreach ($files as $key => $value) {
        //     if (!in_array(basename($value), $dates)) {
        //         Storage::delete($value);
        //     }
        // }

        // Genrate backup files 
        $filename = \Carbon\Carbon::now()->format('m-d-Y')."-backup.gz";
        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " .Storage::path("public/db-backup/". $filename);
        $returnVar = NULL;
        $output  = NULL;
  
        exec($command, $output, $returnVar);

        // Delete existing backup files 
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();
        $dateRange = CarbonPeriod::create($startDate, $endDate);
        $dates = ['.gitignore'];
        foreach ($dateRange->toArray() as $key => $value) {
            $dates[] = $value->format('m-d-Y')."-backup.gz";
        }

        $files = Storage::allfiles('public/db-backup/');
        foreach ($files as $key => $value) {
            if (!in_array(basename($value), $dates)) {
                Storage::delete($value);
            }
        }

    }
}
