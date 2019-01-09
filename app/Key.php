<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Key {
    public static function create(string $key, User $user) {
        // Check for key duplicate
        $keysearch = DB::table('keys')->where('key', $key)->value('key');
        if ($keysearch == $key) {
            return false;
        }
        // Insert
        DB::table('keys')->insert(['key' => $key, 'userid' => $user->id, 'lastedit' => time()]);
        return DB::table('keys')->where('key', $key)->first();
    }

    public static function delete($id) {
        return DB::table('keys')->where('id', $id)->delete();
    }

    public static function edit($id, Array $updates) {
        $updates['lastedit'] = time();
        DB::table('keys')->where('id', $id)->update($updates);
        return DB::table('keys')->where('id', $id)->first();
    }

    public static function getById($id) {
        return DB::table('keys')->where('id', $id)->first();
    }

    public static function getByUser(User $user) {
        return DB::table('keys')->where('userid', $user->id)->get();
    }

    public static function fetch($key) {
        return DB::table('keys')->where('key', $key)->first();
    }
}