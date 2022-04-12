<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Vendor Details</h6>
 <form v-on:submit.prevent>
  <div class="mt-4">
      <label class="text-sm">Name</label>
    <vs-input class="w-full mb-base" v-model="name" v-validate="'required'" name="name"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>

<div class="mt-4">
      <label class="text-sm">Phone</label>
    <vs-input class="w-full mb-base" v-model="phone" v-validate="'required'" name="phone"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('phone')">{{ errors.first('phone') }}</span>

    <div class="mt-4">
      <label class="text-sm">Website</label>
    <vs-input class="w-full mb-base" v-model="website" v-validate="'required'" name="website"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('website')">{{ errors.first('website') }}</span>

    <div class="mt-4">
      <label class="text-sm">Labels</label>
      <v-select v-model="labels" :options="pageStatusOptions" v-validate="'required'" name="labels"/>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('labels')">{{ errors.first('labels') }}</span>

  <div class="mt-4">
      <label class="text-sm">Address</label>
      <vs-input class="w-full mb-base" v-model="address" v-validate="'required'" name="address"></vs-input>
      <p>Street address,P.O.box,etc</p>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('address')">{{ errors.first('address') }}</span>

  <div class="mt-4">
      <label class="text-sm">Address Line 2</label>
      <vs-input class="w-full mb-base" v-model="address_line_2" v-validate="'required'" name="address_line_2"></vs-input>
      <p>Suit,Unit,Building,Floor,etc</p>
    </div>
   <span class="text-danger text-sm" v-show="errors.has('address_line_2')">{{ errors.first('address_line_2') }}</span>
     
    <div class="mt-4">
      <label class="text-sm">City</label>
      <vs-input class="w-full mb-base" v-model="city" v-validate="'required'" name="city"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('city')">{{ errors.first('city') }}</span>

    <div class="mt-4">
      <label class="text-sm">State/Province/Region</label>
      <vs-input class="w-full mb-base" v-model="state" v-validate="'required'" name="state"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('state')">{{ errors.first('state') }}</span>

    <div class="mt-4">
      <label class="text-sm">Zip/Postal Code</label>
    <vs-input class="w-full mb-base" v-model="postal_code" v-validate="'required'" name="postal_code"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('postal_code')">{{ errors.first('postal_code') }}</span>

  <div class="mt-4">
      <label class="text-sm">Country</label>
      <v-select v-model="country" :options="CountryOptions" v-validate="'required'" name="country"/>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('country')">{{ errors.first('country') }}</span>
  <br><br>
  <h6 class="mb-4">Contact Person</h6>
  <div class="mt-4">
      <label class="text-sm">Contact Name</label>
    <vs-input class="w-full mb-base" v-model="contact_name" v-validate="'required'" name="contact_name"></vs-input>
    </div>
     <span class="text-danger text-sm" v-show="errors.has('contact_name')">{{ errors.first('contact_name') }}</span>

    <div class="mt-4">
      <label class="text-sm">Contact Phone</label>
    <vs-input class="w-full mb-base" v-model="contact_phone" v-validate="'required'" name="contact_phone"></vs-input>
    <p>Contact person's direct line or mobile number</p>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('contact_phone')">{{ errors.first('contact_phone') }}</span>
    <div class="mt-4">
      <label class="text-sm">Email</label>
    <vs-input class="w-full mb-base" v-model="contact_email" v-validate="'required'" name="contact_email"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('contact_email')">{{ errors.first('contact_email') }}</span>
<h6 class="mb-4">Classification</h6>
<div class="mt-4">
       <vs-checkbox v-model="fuel" vs-value="1" name="fuel">Fuel</vs-checkbox>
      Fuel classification allows vendor to be listed on Fuel Entries
    </div>
    <span class="text-danger text-sm" v-show="errors.has('fuel')">{{ errors.first('fuel') }}</span>

    <div class="mt-4">
      <vs-checkbox v-model="service" vs-value="1" name="service">Service</vs-checkbox>
      Service classification allows vendor to be listed on Service Entries and Work Orders
    </div>
     <span class="text-danger text-sm" v-show="errors.has('service')">{{ errors.first('service') }}</span>

    <div class="mt-4">
      <vs-checkbox v-model="vehicle" vs-value="1" name="vehicle"> Vehicle</vs-checkbox>
      Vehicle classification allows vendor to be listed on Vehicle Acquisitions
    </div>
    <span class="text-danger text-sm" v-show="errors.has('vehicle')">{{ errors.first('vehicle') }}</span>
    <!-- Save & Reset Button -->
         <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click.prevent="saveForm">Save Changes</vs-button>
            <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
         </div>
      </form>
  </vx-card>
</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import { quillEditor } from 'vue-quill-editor'
import axios from 'axios';
import {siteIndexURL} from '../../../axios'



export default {
  components: {
    flatPickr,
    vSelect,
    quillEditor,
  },
  data () {
    return {
      name:'', 
      phone:'', 
      website:'',  
      labels:'', 
      address:'', 
      address_line_2:'', 
      city:'', 
      state:'', 
      postal_code:'', 
      country:'', 
      contact_name:'', 
      contact_email:'', 
      contact_phone:'', 
      fuel:0, 
      service:0, 
      vehicle:0, 
      vehiclemodelOptions:[], 
      pageStatusOptions: [
        { label: 'Active',  value: '1'  },
        { label: 'InActive',  value: '0'  },
        { label: 'Pending',  value: '2'  },       
      ],
      CountryOptions: []    
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("name", $this.name);
          formData.append("phone", $this.phone);
          formData.append("website", $this.website);
          formData.append("labels", $this.labels.value);
          formData.append("address", $this.address);
          formData.append("address_line_2", $this.address_line_2);
          formData.append("city", $this.city);
          formData.append("state", $this.state);
          formData.append("postal_code", $this.postal_code);
          formData.append("country", $this.country.label);
          formData.append("contact_name", $this.contact_name);
          formData.append("contact_email", $this.contact_email);
          formData.append("contact_phone", $this.contact_phone);
          formData.append("fuel", $this.fuel);
          formData.append("service", $this.service);
          formData.append("vehicle", $this.vehicle);
          axios.post(siteIndexURL+"/v1/vendor", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/vendor/lists')
            }
          }).catch(function (error) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            }
          });
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
    },
    getInspectiontemplates: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehiclemodel')
      .then((result)=>{
         if (result.data.status == true) {   
         var make={}
         this.vehiclemodelOptions=[]    
            result.data.response.vehiclemodel.forEach((key) => {
              make={
                label:key.name,
                value:key.id
              }
               this.vehiclemodelOptions.push(make);      
            });
        }
      
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    getCountry: function ()
    {
      
       //var siteIndexURLBase = siteIndexURL.replace('api','')
      axios.get('/country-by-name.json')
      .then((result)=>{
        this.CountryOptions = result.data;
      
      });
    },

    responseHandle: function (type = 'warning', message = '') {
     this.$vs.notify({
        color: type,
        title: '',
        text: message
     })
    }
  },
  beforeMount() {
    this.getInspectiontemplates();
    this.getCountry();
     
  }
}
</script>
