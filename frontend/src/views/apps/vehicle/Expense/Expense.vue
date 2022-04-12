<!-- =========================================================================================
  File Name: Expense.vue
  Description: Expense page
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
              <span class="ml-2 text-base text-primary">Add New</span>
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
        <vs-th sort-key="name">Vehicle</vs-th>
        <vs-th sort-key="status">Date</vs-th>
        <vs-th sort-key="type">expense_type</vs-th>
        <vs-th sort-key="Operator">Amount</vs-th>
        <vs-th>Action</vs-th>
      </template>

        <template slot-scope="{data}">
          <tbody>
            <vs-tr :key="indextr" v-for="(tr, indextr) in data">

              <vs-td>
				<p class="vehiclelist"><img width="50px" src="../../../../assets/images/car/20201003-3-1qcyfhb.jpg"></p>
                <p class="product-name font-medium truncate">{{ tr.vehiclename.name }}</p>
				<p class="vehiclelist">{{ tr.vehiclename.car_model }}</p>
				<p class="vehiclelist">{{ tr.vehiclename.car_model }}</p>
				<p class="vehiclelist"><span>VIN/SN:</span> {{ tr.vehiclename.vin }}</p>
				<p class="vehiclelist"><span>License Plate:</span> {{ tr.vehiclename.license_plate }}</p>
              </vs-td>
				<vs-td>
				<p class="product-name font-medium truncate">{{ tr.start_date }}</p>
				</vs-td>
				
				<vs-td>
				<p class="product-name font-medium truncate">{{ tr.expense_type }}</p>
				</vs-td>


              <vs-td>
                <p class="product-price">${{ tr.price }}</p>
              </vs-td>


              <vs-td class="whitespace-no-wrap">
                <div class="demo-alignment">
                   <vs-button color="success" type="filled" icon-pack="feather" icon="icon-edit-2" @click.stop="manageRecord(tr.expense_id)"></vs-button>
                   <vs-button color="warning" type="filled" icon-pack="feather" icon="icon-trash-2" @click.stop="deleteRecord(tr.expense_id)"></vs-button>
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
      selected: [],
      itemsPerPage: 20,
      isMounted: false,
      usersData: [],
	  definedStrings:[],
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
   addNewData: function()
    {
      this.$router.push('/expense/create')
    },
	 getProfile: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehicleexpensehistory')
      .then((result)=>{
         if (result.data.status == true) {
          this.usersData = result.data.response.VehicleExpenseHistory;
        }
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    manageRecord (id) {
      this.$router.push(`/expense/edit/${id}`).catch(() => {})
    },
    deleteRecord (id) {
      if (!confirm('Are you sure, you want to delete')) {
        return false
      }
      var $this = this;
      axios.delete(siteIndexURL+'/v1/vehicleexpensehistory/'+id)
      .then((result)=>{
        $this.responseHandle('success', result.data.message);
        this.getProfile();
      }).catch(function (error) {
        if (error.response) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
        if (error.response.data.message) {
          $this.responseHandle('warning', error.response.data.message);
        } 
      });
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
