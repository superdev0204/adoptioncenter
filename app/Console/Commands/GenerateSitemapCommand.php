<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\States;
use App\Models\Agency;
use App\Models\Cities;

class GenerateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate XML sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $linkCount = 0;

        $xml = new \XMLWriter();

        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $uris = ['/', '/about'];

        foreach ($uris as $uri) {
            $linkCount++;

            $xml->startElement('url');
            $xml->writeElement('loc', 'https://' . env('DOMAIN') . $uri);
            $xml->endElement();
        }

        $states = States::all();
        
        foreach ($states as $state) {
            $linkCount++;

            $xml->startElement('url');
            $location = 'https://' . env('DOMAIN') . '/' . $state->statefile . '-adoption';

            $xml->writeElement('loc', $location);
            $xml->endElement();
        }

        $cities = Cities::where("agencies_count", ">", 0)
                        ->get();
        
        foreach ($cities as $city) {
            $linkCount++;

            $xml->startElement('url');
            $location = 'https://' . env('DOMAIN') . '/agencies/' . $city->filename . '_city';

            $xml->writeElement('loc', $location);
            $xml->endElement();
        }

        $agencies = Agency::where("approved", 1)->get();
        
        foreach ($agencies as $agency) {
            $linkCount++;

            $xml->startElement('url');
            $location = 'https://' . env('DOMAIN') . '/agency-' . $agency->id;

            $xml->writeElement('loc', $location);
            $xml->endElement();
        }

        $xml->endElement();
        $xml->endDocument();

        $content = $xml->outputMemory();

        $filename = 'sitemap.xml';
        file_put_contents(public_path() . '/' . $filename, $content);

        $this->info(sprintf('%s has been generated. Link count = %s', $filename, $linkCount));
    }
}
