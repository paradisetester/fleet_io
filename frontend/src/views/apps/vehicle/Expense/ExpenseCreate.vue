<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Expense Entry Details</h6>
 
 	<div class="mt-4">
      <label class="text-sm">Vehicle</label>
      <v-select v-model="vehicle_id" :options="vehicleOptions" v-validate="'required'" name="vehicle_id" />
    </div>
	
	<div class="mt-4">
      <label class="text-sm">Expense Type </label>
      <v-select v-model="expense_type" :options="expenseOptions"  />
    </div>
	
	<vs-input class="w-full my-base" label-placeholder="Amount" v-model="price" name="price"></vs-input>
	
	<div class="mt-4">
      <label class="text-sm">Recurring</label>
        <vs-switch v-model="recurring" />
    </div>
	<div  v-if="recurring">
	 <div class="vx-row mb-6">
			<div class="vx-col sm:w-1/2 w-full">
			 <label class="text-sm">Start Date</label>
			 <flat-pickr v-model="start_date" :config="{ dateFormat: 'd F Y' }" class="w-full" />
			</div>
			<div class="vx-col sm:w-1/2 w-full">
				<label class="text-sm">End Date</label>
			 <flat-pickr v-model="end_date" :config="{ dateFormat: 'd F Y' }" class="w-full" />
			</div>
		</div>
	<div class="mt-4">
      <label class="text-sm">Frequency </label>
      <v-select v-model="frequency" :options="frequencyOptions"  />
    </div>
    </div>
	<div class="mt-4">
      <label class="text-sm">Vendor</label>
     <v-select v-model="vendor_id" :options="vendorOptions" v-validate="'required'" name="vendor_id" />
    </div>
	
	
	 <div class="mt-5">
	 	<label class="text-sm">Notes</label>
            <vs-textarea v-model="notes" name="notes"/>
        </div>
	
	  <h6 class="mt-6">Photo</h6>
  <div class="vx-row box_outter">
            <template v-if="pageImage">
               <!-- Image Container -->
               <div class="img-container mt-6 w-64 mx-auto flex items-center justify-center">
                  <img :src="pageImage" alt="img" class="responsive">
               </div>
               <!-- Image upload Buttons -->
               <div class="modify-img flex justify-between mt-5">
                  <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*">
                  <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">Update File</vs-button>
                  <vs-button type="flat" color="#999" @click="pageImage = null">Remove File</vs-button>
               </div>
            </template>
            <div class="upload-img " v-if="!pageImage">
               <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
               <vs-button @click="$refs.uploadImgInput.click()">Upload Photo</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageFile')">{{ errors.first('pageFile') }}</span>
         </div>

  <h6 class="mt-8">Document</h6>
         <div class="vx-row box_outter ">
            <template v-if="pageDocument">
               <!-- Image Container -->
               <div class="img-container mt-6 w-64 mx-auto flex items-center justify-center">
                  <img :src="pageDocument" alt="img" class="responsive">
               </div>
               <!-- Image upload Buttons -->
               <div class="modify-img flex justify-between mt-5">
                  <input type="file" class="hidden" ref="updateDocInput" @change="updateCurrDocument" accept="image/*">
                  <vs-button class="mr-4" type="flat" @click="$refs.updateDocInput.click()">Update File</vs-button>
                  <vs-button type="flat" color="#999" @click="pageDocument = null">Remove File</vs-button>
               </div>
            </template>
            <div class="upload-img" v-if="!pageDocument">
               <input type="file" class="hidden" ref="uploadDocInput" @change="updateCurrDocument" accept="image/*">
               <vs-button @click="$refs.uploadDocInput.click()">Upload Document</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageDocFile')">{{ errors.first('pageDocFile') }}</span>
         </div>

		
		<div class="mt-5">
	 	<label class="text-sm">Comment</label>
            <vs-textarea v-model="comment" name="comment"/>
        </div>			
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click.prevent="saveForm">Save Changes</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div>
  </vx-card>
  
  
</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import axios from 'axios';
import {siteIndexURL} from '../../../../axios'


export default {
  components: {
    flatPickr,
    vSelect
  },
  data () {
    return {
	recurring: false,
	 time: null,
            configdateTimePicker: {
              enableTime: true,
              enableSeconds: true,
              noCalendar: true
            },
		pageFile: '',
		pageImage: '',
		pageDocFile: '',
		pageDocument: '',	
		price: 0,			
		vehicleOptions:[], 
		vendorOptions:[], 
		vehicle_id:'',
		vendor_id:'',
		expense_type:'',
		start_date:'',
		end_date:'',
		frequency:'',
    comment:'',
		notes:'',
		expenseOptions: [
						{ label: 'Annual Inspection Fees', value: 'Annual_Inspection_Fees'},
						{ label: 'Depreciation', value: 'Depreciation'},
						{ label: 'Down Payment', value: 'Down_Payment'},
						{ label: 'Equipment', value: 'Equipment'},
						{ label: 'Fines', value: 'Fines'},
						{ label: 'Insurance', value: 'Insurance'},
						{ label: 'Lease', value: 'Lease'},
						{ label: 'Legal/Court Costs', value: 'Legal_Costs'},
						{ label: 'Loan', value: 'Loan'},
						{ label: 'Loan Payment', value: 'Loan_Payment'},
						{ label: 'Miscellaneous', value: 'Miscellaneous'},
						{ label: 'Moving Violations', value: 'Moving_Violations'},
						{ label: 'Safety Technology', value: 'Safety_Technology'},
						{ label: 'Telematics Device', value: 'Telematics_Device'},
						{ label: 'Tolls', value: 'Tolls'},
						{ label: 'Vehicle Disposal Costs', value: 'Vehicle_Disposal_Costs'},
						{ label: 'Vehicle Registration and Taxes', value: 'Vehicle_Registration' },
						],
	   frequencyOptions: [
        { label: 'Monthly',  value: 'Monthly'  },
        { label: 'Annually',  value: 'Annually'  },    
      ],
    
     
    }
  },
   methods: {
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("vehicle_id", $this.vehicle_id.value);
          formData.append("date", $this.date);
          formData.append("time", $this.time);         
          formData.append("price", $this.price);
          formData.append("expense_type", $this.expense_type.value);
          formData.append("vendor_id", $this.vendor_id.value);
          formData.append("pageFile", $this.pageFile);
          formData.append("pageDocFile", $this.pageDocFile);       
          formData.append("comment", $this.comment);
          formData.append("notes", $this.notes);
          if ($this.recurring == false) {
            formData.append("recurring", 0);  
          } else {
            formData.append("recurring", 1);
          }
          
          formData.append("end_date", $this.end_date);
          formData.append("start_date", $this.start_date);
          formData.append("frequency", $this.frequency.value);
		  
          axios.post(siteIndexURL+"/v1/vehicleexpensehistory", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/expense')
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
    updateCurrImg (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.pageFile = input.target.files[0]
          this.pageImage = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    updateCurrDocument (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.pageDocFile = input.target.files[0]
          this.pageDocument = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    getVehiclelist: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehicledetails')

      .then((result)=>{
         if (result.data.status == true) {   
         var make={}
         this.vehicleOptions=[]    
            result.data.response.vehicleDetails.forEach((key) => {
              make={
                label:key.name,
                value:key.vehicle_id
              }
               this.vehicleOptions.push(make);      
            });
        }
      
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    getVendorlist: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vendor/?type=vehicle')

      .then((result)=>{
         if (result.data.status == true) {   
         var make={}
         this.vendorOptions=[]    
            result.data.response.vendors.forEach((key) => {
              make={
                label:key.name,
                value:key.vendor_id
              }
               this.vendorOptions.push(make);      
            });
        }
      
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
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
     this.getVehiclelist();
     this.getVendorlist();
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  }
}
</script>
