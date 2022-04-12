<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FleetAdminMigrateCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:admin {--fresh} {--seed} --path=database/migrations/fleet_mcp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate admin migrations.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $this->migrate(
                \App\Models\Tenant::find(\App\Models\Tenant::where('tenant_id', 'fleet_admin')->first()->id)
        );
    }

    public function migrate($tenant) {
        
        $tenant->configure()->use();
        $this->line("");
        $this->line("---------------------------------");
        $this->line("Migrating Tenant #({$tenant->tenant_id})");
        $this->line("---------------------------------");

        $options = ['--force' => true];

        if ($this->option('seed')) {
            $options['--seed'] = true;
        }
        
        $options['--path'] = 'database/migrations/fleet_admin';

        $this->call(
                $this->option('fresh') ? 'migrate:fresh' : 'migrate',
                $options
        );
    }

}
