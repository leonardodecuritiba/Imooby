<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Helpers\ImageHelper;
use App\Models\Property;
use Image;

class ProcessPropertyPhotos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $property_id;

    public function __construct($property_id)
    {
        $this->property_id = $property_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($property = Property::find($this->property_id)) {
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
