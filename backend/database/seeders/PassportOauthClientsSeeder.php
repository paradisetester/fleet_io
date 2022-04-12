<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PassportOauthClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = new \App\Models\PassportClient();
        $developer->user_id = NULL;
        $developer->name = 'fleet';
        $developer->secret = 'ZWYgA8ng7grxFOrwfAgmFLtt6mYCMNjwJ9b0CqmX';
        $developer->provider = 'users';
        $developer->redirect = 'http://localhost';
        $developer->personal_access_client = 0;
        $developer->password_client = 1;
        $developer->revoked = 0;
        $developer->save();        
    }
}