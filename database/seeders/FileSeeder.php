<?php

namespace Database\Seeders;

use App\Models\File\RootFile;
use Illuminate\Database\Seeder;
use App\Models\File\File;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RootFile::firstOrCreate(
            [
                RootFile::PATH => '/storage/92521880a68019ffe52189ecb15ecc5983a46477.jpeg',
                RootFile::SIZE => 28817,
                RootFile::MIME_TYPE => 'image/jpeg',
                RootFile::CONTENT_HASH => '92521880a68019ffe52189ecb15ecc5983a46477',
            ]
        );
        File::firstOrCreate([
            File::ROOT_FILE_ID => 1,
            File::NAME => 'daryabar.jpeg',
        ],[
            File::EXTENSION => "jpeg",
            File::ENABLED => true,
            File::ROOT_FILE_ID => 1,
            File::NAME => 'daryabar.jpeg',
        ]);

    }
}
