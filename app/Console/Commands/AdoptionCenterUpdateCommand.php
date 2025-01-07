<?php

namespace App\Console\Commands;

use App\Models\Agency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AdoptionCenterUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:adoption-center-update {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update adoption centers from CSV file';

    public function handle()
    {
        $filePath = public_path('/datafiles/adoptionagencies_' . $this->argument('number') . '.csv');
        
        if (!file_exists($filePath)) {
            $this->error('Unable to open the data file.');
            return;
        }

        $file = fopen($filePath, 'r');
        $row = 0;
        $existCount = 0;
        $newCount = 0;

        while (($data = fgetcsv($file, 3000, ";")) !== false) {
            $row++;
            
            if ($row == 1 || empty($data[1])) {
                continue;
            }

            $this->info("test $row = " . $data[1]);

            $agency = null;

            if ($data[0] <> '') {
                $agency = Agency::find($data[0]);
            }

            if (!$agency) {
                $agency = new Agency();
                $agency->created_date = now();
                $agency->approved = 1;
                $newCount++;
                $this->info("new record $newCount " . $data[1]);
            } else {
                $existCount++;
                $this->info("existing $existCount " . $agency->name . " | " . $data[1]);
            }
            
            $agency->name = $data[1];
            $agency->status = $data[2];
            $agency->address = $data[3];
            $agency->city = $data[4];
            $agency->state = $data[5];
            $agency->zip = $data[6];

            $city = DB::table('cities')
                    ->where('state', $agency->state)
                    ->where('city', $agency->city)
                    ->first();

            if ($city) {
                $agency->county = $city->county;
            }

            $agency->phone = $data[7];
            $agency->contact = $data[8];
            $agency->district_office = $data[9];
            $agency->do_phone = $data[10];
            $agency->license_no = $data[11];
            $agency->email = $data[12];
            $agency->website = $data[13];
            $agency->details = $data[14];
            $agency->services = $data[15];
            $agency->adoption_process = $data[16];
            $agency->ludate = now();
            $agency->lat = 0;
            $agency->lng = 0;

            $agency->save();
        }

        fclose($file);
    }
}
