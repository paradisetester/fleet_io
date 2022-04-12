<!-- =========================================================================================
  File Name: PlanList.vue
  Description: Plan List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->
<template>
  <div id="vehicle-list" class="data-list-container">
     <vx-card>
    <vs-table ref="table" v-model="selected" pagination :max-items="itemsPerPage" search :data="usersData">

      <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">

        <div class="flex flex-wrap-reverse items-center data-list-btn-container">

          <!-- ADD NEW -->
          <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
              <span class="ml-2 text-base text-primary">Add New Plan</span>
          </div>
        </div>

        <!-- ITEMS PER PAGE -->
        <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler">
          <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
            <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ usersData.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : usersData.length }} of {{ queriedItems }}</span>
            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
          </div>
          <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
          <vs-dropdown-menu>

            <vs-dropdown-item @click="itemsPerPage=4">
              <span>4</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=10">
              <span>10</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=15">
              <span>15</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=20">
              <span>20</span>
            </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
      </div>

      <template slot="thead">
        <vs-th sort-key="name">Plan Title</vs-th>
        <vs-th sort-key="name">Price</vs-th>
        <vs-th sort-key="status">Status</vs-th>
        <vs-th sort-key="status">Created At</vs-th>
        <vs-th>Action</vs-th>
      </template>

        <template slot-scope="{data}">
          <tbody>
            <vs-tr :key="indextr" v-for="(tr, indextr) in data">

              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.heading }}</p>
              </vs-td>
              <vs-td>
                <p class="product-name font-medium truncate">${{ tr.price }}</p>
              </vs-td>
              <vs-td>
                <p class="product-name font-medium truncate">{{ planStatus(tr.status) }}</p>
              </vs-td>           
              <vs-td>
                <p class="product-price">{{ tr.created_at | YYYYMMDD }}</p>
              </vs-td>
              <vs-td class="whitespace-no-wrap">
                <div class="demo-alignment">
                   <vs-button color="success" type="filled" icon-pack="feather" icon="icon-edit-2" @click.stop="manageRecord(tr)"></vs-button>
                   <vs-button color="warning" type="filled" icon-pack="feather" icon="icon-trash-2" @click.stop="deleteRecord(tr.id)"></vs-button>
                </div>
              </vs-td>

            </vs-tr>
          </tbody>
        </template>
    </vs-table>
	</vx-card>
  </div>
</template>

<script>

import '@/assets/scss/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'
import axios from 'axios';
import {siteIndexURL} from '../../../../axios'

export default {
  components: {
    vSelect,
  },
  data () {
    return {
      definedStrings:{},
      selected: [],
      itemsPerPage: 20,
      isMounted: false,
      usersData: [],
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
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.usersData.length
    }
  },
  methods: {
    planStatus(status){
      if (status == 0) {
        return 'Draft';
      } else if(status == 1) {
        return 'Unpublish';
      } else if (status == 2) {
        return 'Publish';
      }
    },
    addNewData: function()
    {
      this.$router.push('/plan/create')
    },
    setColumnFilter (column, val) {
      const filter = this.gridApi.getFilterInstance(column)
      let modelObj = null

      if (val !== 'all') {
        modelObj = { type: 'equals', filter: val }
      }

      filter.setModel(modelObj)
      this.gridApi.onFilterChanged()
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
    getProfile: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/plans')
      .then((result)=>{
         if (result.data.status == true) {
          this.usersData = result.data.response.plans;		
        }
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    manageRecord (row) {
      this.$router.push(`/plan/edit/${row.id}`).catch(() => {})
    },
    deleteRecord (id) {
      if (!confirm('Are you sure, you want to delete')) {
        return false
      }
      var $this = this;
      axios.delete(siteIndexURL+'/v1/plans/'+id)
      .then((result)=>{
        $this.responseHandle('success', result.data.message);
        this.getProfile();
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
        if (error.response.data.message) {
          $this.responseHandle('warning', error.response.data.message);
        } 
      });
    },
    responseHandle: function(type = 'warning', message = '')
    {
      this.$vs.notify({
        color: type,
        title: '',
        text: message
      })
    },

  },
  mounted () {
    this.isMounted = true
  },
  beforeMount() { 
    this.getProfile();
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
