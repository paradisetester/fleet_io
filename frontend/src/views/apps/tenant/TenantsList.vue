<template>
    <div>
        <div id="tenant-list" class="data-list-container">
            <vx-card>
                <vs-table ref="table" v-model="selected" pagination :max-items="itemsPerPage" search :data="tenantsData">
                    <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
                        <!-- ITEMS PER PAGE -->
                        <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler">
                            <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
                                <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ tenantsData.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : tenantsData.length }} of {{ queriedItems }}</span>
                                <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                            </div>
                            <vs-dropdown-menu>
                                <vs-dropdown-item @click="changeItemValue(4)"><span>4</span></vs-dropdown-item>
                                <vs-dropdown-item @click="changeItemValue(10)"><span>10</span></vs-dropdown-item>
                                <vs-dropdown-item @click="changeItemValue(15)"><span>15</span></vs-dropdown-item>
                                <vs-dropdown-item @click="changeItemValue(20)"><span>20</span></vs-dropdown-item>
                            </vs-dropdown-menu>
                        </vs-dropdown>
                    </div>
                    <template slot="thead">
                        <vs-th sort-key="comp_name">Company Name.</vs-th>
                        <vs-th sort-key="database"> Database Name </vs-th>
                        <vs-th sort-key="name">Tenant Name</vs-th>
                        <vs-th sort-key="email">Tenant Email</vs-th>
                        <vs-th sort-key="mobile">Tenant Mobile</vs-th>
                        <vs-th sort-key="timezone">Company Timezone</vs-th>
                        <vs-th sort-key="plan">Plan</vs-th>
                        <vs-th sort-key="is_paid">Plan Status</vs-th>
                        <vs-th sort-key="is_active">Is Active</vs-th>
                        <vs-th sort-key="under_maintenance">Under Maintenance</vs-th>
                        <vs-th sort-key="valid_till">Plan Valid Till</vs-th>
                        <vs-th sort-key="created_at">Created At</vs-th>
                        <vs-th sort-key="action">Action</vs-th>
                    </template>
                        <template slot-scope="{data}">
                        <tbody>
                            <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                                <vs-td><p class="product-name font-medium truncate">{{ tr.company_name }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.database }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.name }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.email ? 'Ordered' : 'Not-Ordered' }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.mobile }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.time_zone }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.plan_name }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.is_paid ? 'Paid' : 'Free' }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.is_active ? 'Active' : 'In-Active' }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.under_maintenance ? 'Yes' : 'No' }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.plan_valid_till | YYYYMMDD }}</p></vs-td>
                                <vs-td><p class="product-name font-medium truncate">{{ tr.created_at | YYYYMMDD }}</p></vs-td>
                                <vs-td class="whitespace-no-wrap">
                                    <div class="demo-alignment">
                                        <vs-button color="primary" type="filled" icon-pack="feather" icon="icon-eye" @click.stop="viewTenant(tr.id)"></vs-button>
                                        <vs-button color="danger" type="filled" icon-pack="feather" icon="icon-trash" @click.stop="deleteTenant(tr.id)"></vs-button>
                                    </div>
                                </vs-td>
                            </vs-tr>
                        </tbody>
                        </template>
                    </vs-table>
            </vx-card>
        </div>
    </div>
</template>

<script>
import '@/assets/scss/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'
import axios from 'axios';
import {siteIndexURL} from '@/axios'
export default {
    components: {
        vSelect,
    },
    data () {
        return {
            selected: [],
            itemsPerPage: 20,
            isMounted: false,
            tenantsData: [],
        }
    },
    computed: {
        currentPage () {
        if (this.isMounted) {
            return this.$refs.table.currentx
        }
        return 0
        },
        queriedItems () {
        return this.$refs.table ? this.$refs.table.queriedResults.length : this.tenantsData.length
        }
    },
    methods: {
        changeItemValue (value) {
            this.itemsPerPage = value;
        },
        setColumnFilter (column, val) {
            const filter = this.gridApi.getFilterInstance(column);
            let modelObj = null;
            if (val !== 'all') {
                modelObj = { type: 'equals', filter: val }
            }
            filter.setModel(modelObj);
            this.gridApi.onFilterChanged();
        },
        resetColFilters () {
            // Reset Grid Filter
            this.gridApi.setFilterModel(null)
            this.gridApi.onFilterChanged()

            // Reset Filter Options
            this.roleFilter = this.statusFilter = this.isVerifiedFilter = this.departmentFilter = { label: 'All', value: 'all' }

            this.$refs.filterCard.removeRefreshAnimation()
        },
        updateSearchQuery (val) {
            this.gridApi.setQuickFilter(val)
        },
        getTenants: function (){
            var $this = this;
            axios.get(siteIndexURL+'/v1/tenants')
            .then((result)=>{
                if (result.data.status == true) {
                this.tenantsData = result.data.response.tenants;
                }
            }).catch(function (error) {
                if (error.response.message) {
                $this.responseHandle('warning', error.response.message);
                } 
            });
        },
        viewTenant (id) {
            this.$router.push(`/tenants/view/${id}`).catch(() => {})
        },
        responseHandle: function(type = 'warning', message = ''){
            this.$vs.notify({
                color: type,
                title: '',
                text: message
            });
        },
        deleteTenant (id) {
            if (!confirm('Are you sure, you want to delete this tenant\'s all data')) {
                return false
            }
            var $this = this;
            axios.delete(siteIndexURL+'/v1/tenants/'+id)
            .then((result)=>{
                if (result.data.status == true) {
                    this.tenantsData = this.tenantsData.splice(id, 1);
                    $this.responseHandle('success', result.data.message);
                }
            }).catch(function (error) {
                if (error.data.message) {
                    $this.responseHandle('warning', error.data.message);
                } 
            });
        }
    },
    mounted () {
        this.isMounted = true
    },
    beforeMount() { 
        this.getTenants();
    }
}

</script>

<style lang="scss">
    #page-user-list {
        .user-list-filters {
            .vs__actions {
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-58%);
            }
        }
    }

</style>
<style>
    .vs-con-table .vs-con-tbody {
        background: #f8f8f8;
        border: 2px solid #efefef;
    }
    .vs-con-table .tr-values:nth-child(odd) {
        background: transparent!important;
    }
    .vs-con-table .tr-values:nth-child(even) {
        background: #fff!important;
    }
</style>