<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TenancyProvider extends ServiceProvider {

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        
        $this->configureRequests();
        $this->configureQueue();
    }

    # change done by arun

    public function configureRequests() {
        
        $request_type = $this->app['request']->header("RequestType");
        $tenant_id = $this->app['request']->header("TenantId");

        $tenant_id = (!empty($tenant_id))?$tenant_id:"fleet_admin";        
        if (!$this->app->runningInConsole()) {
            \App\Models\Tenant::whereTenantId($tenant_id)->firstOrFail()->configure()->use();
        }
        
    }

    public function configureQueue() {
        
        $this->app['queue']->createPayloadUsing(function() {
            return $this->app['fleet_tenant'] ? ['tenant_id' => $this->app['fleet_tenant']->id] : [];
        });

        $this->app['events']->listen(\Illuminate\Queue\Events\JobProcessing::class, function($event) {
            if (isset($event->job->payload()['tenant_id'])) {
                \App\Models\Tenant::find($event->job->payload()['tenant_id'])->configure()->use();
            }
        });
        
    }

}
