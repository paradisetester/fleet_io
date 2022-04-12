<?php

namespace App\Traits;
use Auth, DateTime, Uuid;
use App\Models\User;
use App\Models\CompanyDetails;
use App\Models\SitesDetails;
use App\Traits\{
    UserTrait,
};

trait CompanyDetailsTrait {
    
    use UserTrait;
    public function insertUpdate($request, $id = null)
    {
        if (!$companyDetail = CompanyDetails::find($id)) {
            $companyDetail = new CompanyDetails();
        }
        $uuid = Uuid::generate(1,$this->getCurrentUserID(), Uuid::NS_DNS)->string;
        $companyDetail->uid = $uuid;
        $companyDetail->user_id = $this->getCurrentUserID();
        $companyDetail->client_name = $this->getCurrentUserName();
        $companyDetail->client_number = $request->input('client_number');
        $companyDetail->company_name = $request->input('company_name');
        $companyDetail->fleet_size = $request->input('fleet_size');
        $companyDetail->industry = $request->input('industry');
        $companyDetail->time_zone = $request->input('time_zone');
        $companyDetail->currency = $request->input('currency');
        $companyDetail->tagline = $request->input('tagline');
        $companyDetail->folder_size = 0;
        $companyDetail->package_id = 0;
        // $companyDetail->database_name = $this->getuniqueDBNameWithEmail($this->getCurrentUserEmail());
        $companyDetail->database_name = $request->header('tenantId');
        $companyDetail->company_status = '2';
        $companyDetail->save();
        return $companyDetail;
    }
    public function insertUserSiteDetails($uniqueDBName = null, $email = null)
    {
        if (!$userSite = SitesDetails::where('email', $email)->get()->first()) {
            $userSite = new SitesDetails();
            $userSite->email = $email;
            $userSite->uid = $uniqueDBName;
            $userSite->created_at = new DateTime;
            $userSite->updated_at = new DateTime;
            $userSite->save();
            $this->importTODB($uniqueDBName);
        }
    }
    public function getuniqueDBNameWithEmail($email)
    {
        return SitesDetails::where('email', $email)->get()->pluck('uid')->first();
    }
    public function importTODB($uniqueDBName = null) 
    {
        ini_set('max_execution_time', 600);
        if (!$uniqueDBName) {
            return false;
        }
        $config = config('database');
        $default = $config['default'];
        $host = config('database.connections.'.$default.'.host');
        $username = config('database.connections.'.$default.'.username');
        $password = config('database.connections.'.$default.'.password');

        $connection = mysqli_connect($host, $username, $password);
        if($connection === false){
            return false;
        }
        $sql = "CREATE DATABASE IF NOT EXISTS ".$uniqueDBName;
        if(mysqli_query($connection, $sql)) {
            $this->importOldDBToNewDB($uniqueDBName);
            return true;
        } else {
            return false;
        }
        mysqli_close($connection);
    }
    public function importOldDBToNewDB($uniqueDBName = null)
    {
        if (!$uniqueDBName) {
            return false;
        }   
        $config = config('database');
        $default = $config['default'];
        $host = config('database.connections.'.$default.'.host');
        $username = config('database.connections.'.$default.'.username');
        $password = config('database.connections.'.$default.'.password');
        $oldDatabase = config('database.connections.'.$default.'.database');
        $oldPassportOuths = \DB::table('oauth_clients')->select('*')->get()->toArray();
        \Config::set('database.connections.'.$default.'.database', $uniqueDBName);
        \DB::purge($default);
        \DB::statement('CREATE TABLE IF NOT EXISTS '.$uniqueDBName.'.oauth_access_tokens LIKE '.$oldDatabase.'.oauth_access_tokens; ');
        \DB::statement('CREATE TABLE IF NOT EXISTS '.$uniqueDBName.'.oauth_auth_codes LIKE '.$oldDatabase.'.oauth_auth_codes; ');
        \DB::statement('CREATE TABLE IF NOT EXISTS '.$uniqueDBName.'.oauth_clients LIKE '.$oldDatabase.'.oauth_clients; ');
        \DB::statement('CREATE TABLE IF NOT EXISTS '.$uniqueDBName.'.oauth_personal_access_clients LIKE '.$oldDatabase.'.oauth_personal_access_clients; ');
        \DB::statement('CREATE TABLE IF NOT EXISTS '.$uniqueDBName.'.oauth_refresh_tokens LIKE '.$oldDatabase.'.oauth_refresh_tokens; ');
        foreach ($oldPassportOuths as $oldPassportOuth) {
            $oldPassportOuth = (array)$oldPassportOuth;
            $row = \DB::table('oauth_clients')->where('id', $oldPassportOuth['id'])->get()->first();
            if (!$row) {
                \DB::table('oauth_clients')->insert($oldPassportOuth);
            }            
        }        
        \Artisan::call('migrate:refresh --seed');
    }
}