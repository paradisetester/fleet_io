<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PassportManagerCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate passport key.';

    /**
     * Execute the console command.
     *
     * @return int
     * 
     * because tenant_id and database are same.
     * 
     */
    public function handle() {
        $this->migrate(
                \App\Models\Tenant::find(\App\Models\Tenant::where('tenant_id', "fleet_admin")->first()->id)
        );
    }

    public function migrate($tenant) {

        $tenant->configure()->use();

        $this->line("");
        $this->line("---------------------------------");
        $this->line("Migrating Tenant Passport. #{$tenant->id} ({$tenant->name})");
        $this->line("---------------------------------");

        $options_second = ['--class' => 'PassportOauthClientsSeeder'];
        $this->call('db:seed', $options_second);
        #$options = ['--password' => true];
        #$this->call('passport:client', $options);
    }

}
