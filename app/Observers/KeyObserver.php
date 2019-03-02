<?php

namespace App\Observers;

use App\Key;
use App\Notifications\KeyAdded;
use App\Notifications\KeyRemoved;

class KeyObserver
{
    /**
     * Handle the key "created" event.
     *
     * @param  \App\Key  $key
     * @return void
     */
    public function created(Key $key)
    {
        $key->user->notify(new KeyAdded($key));
    }

    /**
     * Handle the key "updated" event.
     *
     * @param  \App\Key  $key
     * @return void
     */
    public function updated(Key $key)
    {
        //
    }

    /**
     * Handle the key "deleted" event.
     *
     * @param  \App\Key  $key
     * @return void
     */
    public function deleted(Key $key)
    {
        $key->user->notify(new KeyRemoved($key));
    }

    /**
     * Handle the key "restored" event.
     *
     * @param  \App\Key  $key
     * @return void
     */
    public function restored(Key $key)
    {
        //
    }

    /**
     * Handle the key "force deleted" event.
     *
     * @param  \App\Key  $key
     * @return void
     */
    public function forceDeleted(Key $key)
    {
        //
    }
}
