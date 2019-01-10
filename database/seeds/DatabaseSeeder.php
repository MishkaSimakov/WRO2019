<?php

use App\Archive;
use App\Current;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       factory(Archive::class, 10)->create()->each(
            function ($archive) {
                DB::table('currents')->insert([
                    'channel_id' => $archive->channel_id,
                    'value' => $archive->value,
                    'date' => $archive->date,
                    'longitude' => $archive->longitude,
                    'latitude' => $archive->latitude,
                    'status_id' => $archive->status_id,
                    'created_at' => $archive->created_at,
                    'updated_at' => $archive->updated_at
                ]);
            }
        );
    }
}
