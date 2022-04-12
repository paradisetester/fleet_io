
<template>
  <div id="page-user-edit">
    <div id="user-edit-tab-info">
      <!-- Avatar Row -->
      <vx-card>
        <div slot="no-body" class="tabs-container px-6 pt-6">
          <vs-tabs v-model="activeTab" class="tab-action-btn-fill-conatiner">
            <vs-tab label="Tenant" icon-pack="feather" icon="icon-user">
              <div class="tab-text">
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3 font-bold">Name :</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.name }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3 font-bold">Email :</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.email }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3 font-bold">Mobile :</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.mobile }}</div>
                        </div>
                    </div>
                </div>
              </div>
            </vs-tab>
            <vs-tab label="Company" icon-pack="feather" icon="icon-user">
              <div class="tab-text">
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Name</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.company.name }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Tagline</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.company.tagline }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Email</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.company.email }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Mobile</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.company.mobile }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Industry</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.company.industry }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Database</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.company.database }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Plan (Type)</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                            <div class="vx-col w-full py-3">{{ tenant.company.plan_name }} ( {{ tenant.company.plan_type }} )</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Timezone</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3">{{ tenant.company.timezone }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Currency</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3">{{ tenant.company.currency }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Plan Valid Till</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                              <div class="vx-col w-full py-3">{{ tenant.company.plan_valid_till | YYYYMMDD }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Size</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                              <div class="vx-col w-full py-3">{{ tenant.company.fleet_size }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Under Maintenance</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                              <div class="vx-col w-full py-3">{{ tenant.company.under_maintenance }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Status</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                              <div class="vx-col w-full py-3">{{ tenant.company.status }}</div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 w-1/3">
                        <div class="vx-row">
                             <div class="vx-col w-full py-3 font-bold">Created At</div>
                        </div>
                    </div>
                    <div class="vx-col md:w-3/4 w-2/3">
                        <div class="vx-row">
                               <div class="vx-col w-full py-3">{{ tenant.company.created_at | YYYYMMDD }}</div>
                        </div>
                    </div>
                </div>
              </div>
            </vs-tab>
          </vs-tabs>
        </div>

      </vx-card>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import {siteIndexURL} from '@/axios'
export default {
    data(){
        return {
            activeTab : 0,
            tenant: {
                "id": '',
                "name": "",
                "email": "",
                "mobile": "",
                "company": {
                    "name": "",
                    "tagline": "",
                    "email": "",
                    "mobile": "",
                    "industry": "",
                    "database": "",
                    "plan_id": '',
                    "plan_name": "",
                    "plan_type": "",
                    "timezone": "",
                    "currency": "",
                    "plan_valid_till": "2001-01-01T10:36:32.000000Z",
                    "fleet_size": "",
                    "under_maintenance": "",
                    "status": "",
                    "created_at": "2001-01-01T10:36:32.000000Z"
                }
            },
            tanantId : ''
        }
    },
    methods: {
        getTenantData: function (id = null){
            let tenantId = id ? id : this.tanantId;
            var $this = this;
            if(tenantId){
                axios.get(siteIndexURL+'/v1/tenants/'+tenantId).then((result)=>{
                    if (result.data.status == true) {
                        $this.tenant = result.data.response.tenant;
                    }
                }).catch(function (error) {
                    if (error.response.data.detail) {
                    $this.responseHandle('warning', error.response.data.detail);
                    } 
                });
            }
            
        },
    },
    beforeMount() { 
        let currentParams = this.$router.currentRoute.params;
        this.tanantId = currentParams.tenantId
        this.getTenantData(this.tanantId);
    }
}
</script>