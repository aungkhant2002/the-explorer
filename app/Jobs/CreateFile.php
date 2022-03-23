<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

class CreateFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $newName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($newName)
    {
        $this->newName = $newName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //        square
        $img = Image::make(public_path("storage/cover/".$this->newName));
        $img->fit(300, 300)->save(public_path("storage/cover/square_".$this->newName));

//        preview
        $img = Image::make(public_path("storage/cover/".$this->newName));
        $img->resize(300, null,  function ($c) {
            $c->aspectRatio();
        })->save(public_path("storage/cover/preview_".$this->newName));

//        large
        $img = Image::make(public_path("storage/cover/".$this->newName));
        $img->resize(1024, null,  function ($c) {
            $c->aspectRatio();
        })->save(public_path("storage/cover/large_".$this->newName));
    }
}
