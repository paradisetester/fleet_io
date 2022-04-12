<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;


class FleetTenantsMigrateCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate {tenant_id?} {--fresh} {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate tenant (single / all).';

    /**
     * If tenant is not "admin". then migrate. 
     * database is equal to tenant ID.
     */
    public function handle() {
        $tenant_id = $this->argument("tenant_id");
        if (!in_array($tenant_id, ['fleet_mcp', 'fleet_admin']) && !empty($tenant_id)) {
            $this->migrate(
                    \App\Models\Tenant::find(\App\Models\Tenant::where('tenant_id', $tenant_id)->first()->id)
            );
        } else if (empty($tenant_id)) {
            Tenant::all()
                    ->each(function($tenant) {
                        if (!in_array($tenant->tenant_id, ['fleet_mcp', 'fleet_admin'])) {
                            return $this->migrate($tenant);
                        }
                    });
        } else {
            $this->line("This is MCP or Admin migration.");
        }
    }

    public function migrate($tenant) {

        if (!empty($tenant)) {

            $tenant->configure()->use();

            $this->line("");
            $this->line("---------------------------------");
            $this->line("Migrating Tenant #{$tenant->id} ({$tenant->name})");
            $this->line("---------------------------------");

            $options = ['--force' => true];

            if ($this->option('seed')) {
                $options['--seed'] = true;
            }

            $this->call(
                    $this->option('fresh') ? 'migrate:fresh' : 'migrate',
                    $options
            );
            $options_second = ['--class' => 'PassportOauthClientsSeeder'];
            $this->call('db:seed', $options_second);
        }else{
            $this->line("The tenant is not configured.");
        }
    }

}
