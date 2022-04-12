<!-- =========================================================================================
  File Name: UserList.vue
  Description: User List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->
<template>
  <div id="data-list-list-view" class="data-list-container">
     <vx-card>
    <vs-table ref="table" v-model="selected" pagination :max-items="itemsPerPage" search :data="usersData">

      <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">

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
        <vs-th sort-key="name">Customer Name</vs-th>
        <vs-th sort-key="category">Insurance Type</vs-th>
        <vs-th sort-key="category">Insured Name</vs-th>
        <vs-th sort-key="category">Mode Of Payment</vs-th>
        <vs-th sort-key="category">Policy Number</vs-th>
        <vs-th sort-key="category">Total Premium Amount</vs-th>
        <vs-th sort-key="category">Date Of Maturity</vs-th>
      </template>

        <template slot-scope="{data}">
          <tbody>
            <vs-tr :key="indextr" v-for="(tr, indextr) in data" v-if="tr.insurance_type">
              <vs-td>
                <p class="product-name font-medium truncate">{{ tr.fk_client_profile__name }}</p>
              </vs-td>
              <vs-td>
                <p class="product-price">{{ insuranceTypes(tr.insurance_type) }}</p>
              </vs-td>
              <vs-td>
                <p class="product-price">{{ tr.insured_name }}</p>
              </vs-td>
              <vs-td>
                <p class="product-price">{{ definedStrings.insurance.mode_of_payment[tr.mode_of_payment] }}</p>
              </vs-td>
              <vs-td>
                <p class="product-price">{{ tr.policy_number }}</p>
              </vs-td>
              <vs-td>
                <p class="product-price">{{ tr.total_premium_amount }}</p>
              </vs-td>
              <vs-td>
                <p class="product-price">{{ tr.date_of_maturity }}</p>
              </vs-td>
            </vs-tr>
          </tbody>
        </template>
    </vs-table>
  </vx-card>
  </div>
</template>

<script>
import { AgGridVue } from 'ag-grid-vue'
import '@/assets/scss/vuexy/extraComponents/agGridStyleOverride.scss'
import definedStrings from '../../../definedStrings'
import vSelect from 'vue-select'
import axios from 'axios';
import {API, siteIndexURL} from '../../../axios'

export default {
  components: {
    vSelect,
  },
  data () {
    return {
      definedStrings: {},
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
    insuranceTypes: function(type)
    {
      var types = {
        '1': 'Term',
        '2': 'Endowment',
        '3': 'Life Plan(Main Plan)',
        '4': 'Life Plan (Rider Plan)',
        '5': 'Annuity',
        '6': 'ILP'
      };
      return types[type];
    },
    getClients: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/tasks/maturity_list/')
      .then((result)=>{
        if (result.data.success == true) {
          this.usersData = result.data.data;
        }
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
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
    }
  },
  mounted () {
    this.isMounted = true
  },
  beforeMount() { 
    this.definedStrings = definedStrings
    this.getClients();
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
