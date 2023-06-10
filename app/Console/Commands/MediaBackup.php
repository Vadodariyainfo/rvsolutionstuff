<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use File;
use ZipArchive;
use Redirect;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class MediaBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mediaBackup:cron';

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
         $zip = new ZipArchive;

         $filename = \Carbon\Carbon::now()->format('m-d-Y')."-media-backup.zip";

        $zip->open(storage_path('app/public/mediaBackup/'.$filename), \ZIPARCHIVE::CREATE);

        $folderName = ['blog','category','download','images','language','media','site-logos','userImage'];

        foreach (Storage::allFiles('public') as $file) {
            $name = basename($file);
            $dr = explode('/', dirname($file))['1'];

            if (in_array($dr,$folderName)) {
                $this->addDirectoryToZip($zip, storage_path('app/public/'.$dr), $dr);
            }
        }

        $zip->close();

        // Delete existing backup files 
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        $dateRange = CarbonPeriod::create($startDate, $endDate);
        $dates = ['.gitignore'];
        foreach ($dateRange->toArray() as $key => $value) {
            $dates[] = $value->format('m-d-Y')."-media-backup.zip";
        }

        $files = Storage::allfiles('public/mediaBackup/');
        foreach ($files as $key => $value) {
            if (!in_array(basename($value), $dates)) {
                Storage::delete($value);
            }
        }
    }

    public function addDirectoryToZip($zip, $dir, $base)
    {
        $zip->addEmptyDir($base);
        foreach(glob($dir . '/*') as $file)
        {
            $zip->addFile($file, $base.'/'.basename($file));
        }
        return $zip;
    }
}
