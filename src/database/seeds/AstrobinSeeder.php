<?php

use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image as Intervention;
use SpaceDB\Image;

class AstrobinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startingId = 287209;
        $imageCount = 50;

        for ($i = 0; $i < 200; $i++) {
            try {
                $targetUrl = 'https://www.astrobin.com/full/' . rand(150000, 280000) . '/0/';
                echo('Leeching ' .$targetUrl. PHP_EOL);
                $html = file_get_contents($targetUrl);

                $html = $string = trim(preg_replace('/\s\s+/', ' ', $html));
                preg_match('/(http:\/\/cdn.+?)\"\s/', $html, $matches);
                print_r($matches). PHP_EOL;
                $url = trim(preg_replace('/\s\s+/', ' ', $matches[1]));
                $url = str_replace(' ', '%20', $url);
                $imageInstance = Intervention::make($url);

                $mimeType = $imageInstance->mime();
                $sizeBytes = $imageInstance->filesize();

                Image::create([
                    'user_id' => 1,
                    'name' => 'import_from_astrobin',
                    'description' => 'import_from_astrobin',
                    'height' => $imageInstance->height(),
                    'width' => $imageInstance->width(),
                    'filename' => $url,
                    'mime_type' => $mimeType,
                    'bytes' => $sizeBytes
                ]);
            } catch (Exception $e) {
                echo $e->getMessage(). PHP_EOL;
            }
        }
    }
}
