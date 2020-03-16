<?php

namespace Webkul\Classes\Observers;

use Illuminate\Support\Facades\Storage;
use Webkul\Classes\Models\Classes;
use Carbon\Carbon;

class ClassesObserver
{
    /**
     * Handle the Category "deleted" event.
     *
     * @param  Category $category
     * @return void
     */
    public function deleted($classes)
    {
        Storage::deleteDirectory('classes/' . $classes->id);
    }

    /**
     * Handle the Category "saved" event.
     *
     * @param Category $category
     */
    public function saved($classes)
    {
        foreach ($classes->children as $child) {
            $child->touch();
        }
    }
}