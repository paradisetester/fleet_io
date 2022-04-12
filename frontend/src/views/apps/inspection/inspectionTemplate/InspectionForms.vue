<!-- =========================================================================================
  File Name: VehicleList.vue
  Description: Vehicle List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->
<template>
  <div id="vehicle-list" class="data-list-container">
     <div class="flex flex-wrap-reverse items-center data-list-btn-container">
          <!-- ADD NEW -->
          <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
              <span class="ml-2 text-primary">Add New Template</span>
          </div>
        </div>

    <div class="vx-row">
      <div class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base" v-for="(inspectionForm, index) in inspectionForms" :key="index">
        <vx-card>
	
          <h5 class="mb-2">{{ inspectionForm.title }} <vs-button color="warning" type="filled" icon-pack="feather" icon="icon-trash-2" class="pull-right" @click.stop="deleteRecord(inspectionForm.id)"></vs-button></h5>
          <p class="text-grey">{{ inspectionForm.description }}</p>
          <div class="flex justify-between flex-wrap">
              <vs-button class="mt-4" type="gradient" color="#7367F0" gradient-color-secondary="#CE9FFC" @click="editRecord(inspectionForm.id)">Edit</vs-button>
              <vs-button class="mt-4" type="border" color="#b9b9b9" @click="manageRecord(inspectionForm.id)">Manage Items</vs-button>
          </div>
        </vx-card>
      </div>
    </div>
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
      inspectionForms: [],
    }
  },
  computed: {
  },
  methods: {
   
    addNewData: function()
    {
      this.$router.push('/inspection/forms/create')
    },
    getProfile: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/inspectiontemplates')
      .then((result)=>{
        if (result.data.status == true) {
          this.inspectionForms = result.data.response.inspectiontemplates;
        }
      }).catch(function(error){
        if (error.response.data.message) {
          if (error.response.data.message == 'Unauthenticated.') {
            $this.responseHandle('warning', 'Your Session is expiry, Please login again to continue');
            $this.$router.push('/auth/login')
          } else {
            $this.responseHandle('warning', error.response.data.message);
          }               
        } 
      });
	   this.$vs.loading.close()
    },
    editRecord (id) {
      this.$router.push(`/inspection/forms/edit/${id}`).catch(() => {})
    },
    manageRecord (id) {
      this.$router.push(`/inspection/forms/items/${id}`).catch(() => {})
    },
    deleteRecord (id) {
      if (!confirm('Are you sure, you want to delete')) {
        return false
      }
      var $this = this;
      axios.delete(siteIndexURL+'/v1/inspectiontemplates/'+id)
      .then((result)=>{
        $this.responseHandle('success', result.data.message);
        this.getProfile();
      }).catch(function(error){
        if (error.response.data.message) {
          if (error.response.data.message == 'Unauthenticated.') {
            $this.responseHandle('warning', 'Your Session is expiry, Please login again to continue');
            $this.$router.push('/auth/login')
          } else {
            $this.responseHandle('warning', error.response.data.message);
          }               
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
