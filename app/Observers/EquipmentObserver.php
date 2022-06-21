<?php

namespace App\Observers;

use App\Models\Equipment;
use Stringable;
use Illuminate\Support\Str;

class EquipmentObserver
{
    /**
     * Handle the Equipment "created" event.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return void
     */
    public function created(Equipment $equipment)
    {
        $temp = substr(Str::uuid(),-9);
        $equipment->serial_number = strtoupper($temp);
        $equipment->save(); 
    }

    /**
     * Handle the Equipment "updated" event.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return void
     */
    public function updated(Equipment $equipment)
    {
        //
    }

    /**
     * Handle the Equipment "deleted" event.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return void
     */
    public function deleted(Equipment $equipment)
    {
        //
    }

    /**
     * Handle the Equipment "restored" event.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return void
     */
    public function restored(Equipment $equipment)
    {
        //
    }

    /**
     * Handle the Equipment "force deleted" event.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return void
     */
    public function forceDeleted(Equipment $equipment)
    {
        //
    }
}
