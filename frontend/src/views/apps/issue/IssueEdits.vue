template>
  <vx-card no-shadow>
 <h6 class="mb-4">Issue Detailsrrt</h6>
 <form v-on:submit.prevent>
  <div class="mt-4">
      <label class="text-sm">Vehicle</label>
      <select v-model="vehicle_id" class="w-full form-control">
        <option :value="vehicleOptions.value" v-for='vehicleOptions in vehicleOptions' :key="vehicleOptions.value" v-validate="'required'" name="vehicle_id">{{vehicleOptions.label}}</option>
      </select>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('vehicle_id')">{{ errors.first('vehicle_id') }}</span>
  
  <div class="mt-4">
      <label class="text-sm">Reported Date</label>
       <flat-pickr v-model="reported_date" :config="{ dateFormat: 'Y-m-d' }" class="w-full" v-validate="'required'" name="reported_date" />
    </div>
  <span class="text-danger text-sm" v-show="errors.has('reported_date')">{{ errors.first('reported_date') }}</span>
    <div class="mt-4">
      <label class="text-sm">Summary</label>
    <vs-input class="w-full mb-base" v-model="summery" v-validate="'required'" name="summery"></vs-input>
    </div>
     <span class="text-danger text-sm" v-show="errors.has('summery')">{{ errors.first('summery') }}</span>
    <div class="mt-5">
    <label class="text-sm">Description</label>
    <vs-textarea v-model="description" v-validate="'required'" name="description"/>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('description')">{{ errors.first('description') }}</span>
        <div class="mt-4">
      <label class="text-sm">Odometer</label>
    <vs-input class="w-full mb-base" v-model="odometer" v-validate="'required'" name="odometer"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('odometer')">{{ errors.first('odometer') }}</span>
  <div class="mt-4">
      <vs-checkbox v-model="checkBox1"> Mark as void</vs-checkbox>
    </div>
    <div class="mt-4">
      <label class="text-sm">Labels</label>
      <!-- <v-select v-model="labels" :options="FuelOptions" v-validate="'required'" name="labels"/> -->

      <select v-model="labels" class="w-full form-control">
        <option :value="FuelOptions.value" v-for='FuelOptions in FuelOptions' :key="FuelOptions.value" v-validate="'required'" name="labels">{{FuelOptions.label}}</option>
      </select>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('labels')">{{ errors.first('labels') }}</span>
  <div class="mt-4">
      <label class="text-sm">Reported By</label>
  <!--     <v-select v-model="reported_by" :options="reported_by_option"  v-validate="'required'" name="reported_by"/> -->

      <select v-model="reported_by" class="w-full form-control">
        <option :value="usersOptions.value" v-for='usersOptions in usersOptions' :key="usersOptions.value" v-validate="'required'" name="reported_by">{{usersOptions.label}}</option>
      </select>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('reported_by')">{{ errors.first('reported_by') }}</span>
  <div class="mt-4 mb-6">lk;l
      <label class="text-sm">ddddghh Assigned To ertret</label>
      <!-- <v-select v-model="assigned_to" :options="Assigned_to_option"  v-validate="'required'" name="assigned_to"/> -->

      <select v-model="assigned_to" class="w-full form-control">
        <option :value="usersOptions.value" v-for='usersOptions in usersOptions' :key="usersOptions.value" v-validate="'required'" name="assigned_to">{{usersOptions.label}}</option>
      </select>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('assigned_to')">{{ errors.first('assigned_to') }}</span>
     <h6 class="mb-4">Photo</h6>
  <div class="vx-row box_outter mt-5">
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
            <div class="upload-img mt-5" v-if="!pageImage">
               <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
               <vs-button @click="$refs.uploadImgInput.click()">Upload Photo</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageFile')">{{ errors.first('pageFile') }}</span>
         </div>

  <h6 class="mb-4">Document</h6>
         <div class="vx-row box_outter mt-5">
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
            <div class="upload-img mt-5" v-if="!pageDocument">
               <input type="file" class="hidden" ref="uploadDocInput" @change="updateCurrDocument" accept="image/*">
               <vs-button @click="$refs.uploadDocInput.click()">Upload Document</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageDocFile')">{{ errors.first('pageDocFile') }}</span>
         </div>
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
import { siteIndexURL, siteURL} from '../../../axios'

export default {
  components: {
    flatPickr,
    vSelect,
   quillEditor,
  },
  data () {
    return {
      vehicle_id: '',
      user_id:'',
      configdateTimePicker: {
      enableTime: true,
      enableSeconds: true,
      noCalendar: true
      },
      pageFile: '',
      pageImage: '',
      pageDocFile: '',
      pageDocument: '',
      reported_date:'',  
      summery:'',
      description:'',
      odometer:'',
      labels:'',
      reported_by:'',
      assigned_to:'',
      checkBox1:'',
      vehicleOptions:[],
      usersOptions:[],
      FuelOptions: [
        { label: 'CNG(Compressed Natural Gas)',  value: '1'  },
        { label: 'Diesel',  value: '2'},
        { label: 'Gasoline',  value: '3'},       
        { label: 'Propane',  value: '4' },      
      ]     
    }
  },
  methods: {
    getPost: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/issue/'+this.id+'/edit')
      .then((result)=>{
        if (result.data.status == true) {          
          var issue = result.data.response.issue;

          this.issue_id = issue.id
          this.vehicle_id = issue.vehicle_id
          this.reported_date  = issue.reported_date  
          this.summery  = issue.summery   
          this.description  = issue.description   
          this.odometer  = issue.odometer   
          this.labels  = issue.labels   
          this.reported_by  = issue.reported_by
          this.assigned_to  = issue.assigned_to
          this.pageImage = this.siteIndexUrl+'/'+issue.photo
          // this.pageFile = this.siteIndexUrl+'/'+issue.photo
          this.pageDocument = this.siteIndexUrl+'/'+issue.document
          // this.pageDocFile = this.siteIndexUrl+'/'+issue.document  
        }
      }).catch(function (error) {
        if (error.response) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("vehicle_id", this.vehicle_id);
          formData.append("reported_date", this.reported_date);
          formData.append("summery", this.summery);
          formData.append("description", this.description);
          formData.append("odometer", this.odometer);
          formData.append("labels", this.labels);
          formData.append("assigned_to", this.assigned_to);
          formData.append("pageFile", this.pageFile);
          formData.append("pageDocFile", this.pageDocFile);
          formData.append("reported_by", this.reported_by);
          formData.append("_method", 'PUT');
          axios.post(siteIndexURL+"/v1/issue/"+this.id, formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/issues')
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
    getAssignedby: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/users')

      .then((result)=>{
         if (result.data.status == true) {   
         var make={}
         this.usersOptions=[]    
            result.data.response.users.forEach((key) => {
              make={
                label:key.name,
                value:key.id
              }
               this.usersOptions.push(make);      
            });
        }
      
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
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
    responseHandle: function (type = 'warning', message = '') {
     this.$vs.notify({
        color: type,
        title: '',
        text: message
     })
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  beforeMount() {
    this.getVehiclelist();
    this.getAssignedby();
    let currentRoute = this.$router.currentRoute.params;
    this.id = currentRoute.issueID
    this.getPost();
    this.siteIndexUrl = siteURL;
  }
}
</script>
