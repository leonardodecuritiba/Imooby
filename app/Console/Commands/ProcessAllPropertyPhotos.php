<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\ImageHelper;
use App\Models\Property;
use Image;

class ProcessAllPropertyPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:processallphotos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process all property photos';

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
        foreach(Property::all() as $property) {
            foreach($property->properties_photo as $photo) {
                if($photo->photo != NULL) {
                    $path = public_path( ImageHelper::PATH_NAME . '/properties/' );
                    $image = Image::make($path . $photo->photo->link)->encode('jpg');

                $image->save($path.$photo->photo->filename().'_enc.jpg'); // save original encoded
                foreach($photo->sizes as $size) {
                    $wh = explode("x",$size);
                    $image = $image->fit($wh[0],$wh[1]);
                    $image->save($path.$photo->photo->filename().'_'.$size.'.jpg');
                }
            }
        }
    }
}
}
