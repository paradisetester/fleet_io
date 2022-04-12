<template>
  <vx-card no-shadow>
    <h6 class="mb-4 mt-4">Personal Information</h6>
    <vs-input class="w-full" v-model="personal.job_title" label="Job Title" icon-no-border />
    <div>
      <label class="text-sm">Birth Date</label>
      <flat-pickr v-model="personal.dob"  class="w-full" />
    </div>
    <div v-if="tenantId != 'fleet_admin'">
      <div class="employee-group mb-4" v-if="personal.is_employee">
        <h6 class="mb-4 mt-4">Employee Details</h6>
        <vs-input class="w-full mt-2" v-model="personal.employee.number"  label="Employee number" icon-no-border />
        <div class="mt-2">
          <label class="text-sm">Start Date</label>
          <flat-pickr v-model="personal.employee.start_date" class="w-full" />
        </div>
        <div class="mt-2">
          <label class="text-sm">Leave Date</label>
          <flat-pickr v-model="personal.employee.leave_date"  class="w-full" />
        </div>
      </div>
      <div class="operator-group" v-if="personal.is_operator">
        <h6 class="mb-4 mt-4">Operator Details</h6>
        <vs-input class="w-full mt-2" v-model="personal.operator.license_number"  label="License Number" icon-no-border />
        <vs-input class="w-full mt-2" v-model="personal.operator.license_class"  label="License Class" icon-no-border />
        <vs-input class="w-full mt-2" v-model="personal.operator.license_state"  label="License State/Province/Region" icon-no-border />
      </div>
      <h6 class="mb-4 mt-4">Technician Details</h6>
      <vs-input class="w-full" v-model="personal.labour_rate"  label="Hourly Labor Rate" icon-no-border />
    </div>
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end mt-4">
      <vs-button class="ml-auto mt-2" @click.prevent="saveForm">Save Changes</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div>
  </vx-card>
</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import { siteIndexURL } from '@/axios'
import axios from 'axios';

export default {
    components: {
        flatPickr,
        vSelect
    },
    data () {
      return {
        userId:'',
		    activeName:'',
		    job_title:'',
		    personal:{
          employee:{},
          operator:{}
        },
        number:'',
        tenantId:''
      }
    },
    methods: {
	 getUserDetail: function (userID = null)
      {
        var $this = this;
        var userDataUrl = userID ? siteIndexURL+'/v1/users/'+userID+'/edit' : siteIndexURL+'/v1/users/show';
        axios.get(userDataUrl).then((result)=>{
          if (result.data.status == true) {         
            this.personal = result.data.response.user.personal;
          }
        }).catch(function (error) {
          if (error.response) {
            $this.responseHandle('warning', error.response.data.message);
          }
        });
      },
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          let userId = this.userId;
          var $this = this
          if (userId) {
            	var formData = new FormData();
              formData.append("job_title", $this.personal.job_title);
              formData.append("dob", $this.personal.dob );
              formData.append("number", $this.personal.employee.number);
              formData.append("start_date", $this.personal.employee.start_date);
              formData.append("leave_date", $this.personal.employee.leave_date);
              formData.append("license_number", $this.personal.operator.license_number );
              formData.append("license_class", $this.personal.operator.license_class);
              formData.append("license_state", $this.personal.operator.license_state);
              formData.append("labour_rate", $this.personal.labour_rate);
              formData.append("type", 'personal');
              formData.append("_method", 'PUT');
              formData.append("user_id", userId);
			
              axios.post(siteIndexURL+"/v1/users/"+userId, formData)
              .then( result => {
                if (result.data.status == true) {
                  $this.responseHandle('success', result.data.message);
                  $this.$router.replace({ name: $this.activeName, params: {userID:userId}, query: {activeTab: 4} });
                  this.$emit('nextActiveTab', 4);
                }
              }).catch(function (error) {
                if (error.response) {
                  $this.responseHandle('warning', error.response.data.message);
                }
              });
          }else {
            $this.responseHandle('warning', 'Please Create First Basic Information');
          }
        } else {
          $this.responseHandle('warning', 'Please solve errors');
        }
      })
      
    },
	  responseHandle: function (type = 'warning', message = '') {
      this.$vs.notify({
        color: type,
        title: '',
        text: message
      })
    },
    },
    computed: {
        activeUserInfo () {
            return this.$store.state.AppActiveUser
        }
    },
  beforeMount() {
      this.$session.start();
      this.tenantId = this.$session.get('tenant_id');
      let currentRoute = this.$router.currentRoute;   
      var user_id = currentRoute.params.userID;
      if(user_id && user_id != undefined){
        this.userId = user_id
        this.activeName = this.$router.currentRoute.name;
        this.getUserDetail(user_id);
      }else{
        this.getUserDetail();
      }
  }
}
</script>
