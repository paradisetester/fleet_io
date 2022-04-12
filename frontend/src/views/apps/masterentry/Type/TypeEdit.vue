<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Vehicle Type</h6>
  <!-- Info -->
  <form v-on:submit.prevent>
<vs-input class="w-full mb-base" v-validate="'required'" label-placeholder="Type Name" v-model="name" name="name" @change="typeChange()"></vs-input>
<span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>
  
   <div class="mt-4">
      <label class="text-sm">Vehicle Model</label>
      <select v-model="model_id" class="w-full form-control">
      <option :value="vehiclemodelOptions.value" v-for='vehiclemodelOptions in vehiclemodelOptions' :key="vehiclemodelOptions.value" v-validate="'required'" name="model_id">{{vehiclemodelOptions.label}}</option>
      </select>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('model_id')">{{ errors.first('model_id') }}</span>

     <div class="mt-5">
      <label class="text-sm">Description</label>
            <vs-textarea v-validate="'required'" v-model="description" name="description"/>
       </div>
       <span class="text-danger text-sm" v-show="errors.has('description')">{{ errors.first('description') }}</span>
  
  <div class="mt-4">
      <label class="text-sm">Status</label>
      <select v-model="status" class="w-full form-control">
      <option :value="pageStatusOptions.value" v-for='pageStatusOptions in pageStatusOptions' :key="pageStatusOptions.value" v-validate="'required'" name="status">{{pageStatusOptions.label}}</option>
      </select>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('status')">{{ errors.first('status') }}</span>
  
    <!-- Save & Reset Button -->
         <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click.prevent="saveForm" :disabled="loginBtn">Save Changes</vs-button>
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
// import definedStrings from '../../../../definedStrings'
import { quillEditor } from 'vue-quill-editor'
import { siteIndexURL} from '../../../../axios'
import axios from 'axios';
export default {
  components: {
    flatPickr,
    vSelect,
   quillEditor,
  },
  data () {
 
    return {
      pageFile: '',
      pageImage: '',
      name:'', 
      model_id:'', 
      description:'',  
      status:'',
      loginBtn : true,
      vehiclemodelOptions:[],   
      pageStatusOptions: [
        { label: 'Active',  value: '1'  },
        { label: 'InActive',  value: '0'  },
        { label: 'Pending',  value: '2'  },       
      ],     
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    typeChange: function()
    {
        this.loginBtn = false;
          var dataString = {
            name: this.name,          
          };    
          var $this = this;
          axios.post(siteIndexURL+'/v1/verifyvehicletype',dataString)
          .then((result)=>{
              if(result.data.response.vehicletype > 0)
              {
                this.loginBtn = true;
                $this.responseHandle('warning', 'Vehicle Type Already Exists');
              }
              else{
                this.loginBtn = false;
              }
          }).catch(function (error) {
            if (error.response !== undefined) {
              if (error.response.data.message) {
                $this.responseHandle('warning', error.response.data.message);
              } 
            }        
          });
    },
    getPost: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehicletype/'+this.id+'/edit')
      .then((result)=>{

        if (result.data.status == true) {          
          var type = result.data.response.vehicletype;
          this.id = type.id
          this.name = type.name
          this.model_id = type.model_id
          this.status = type.status         
          this.description = type.description
          this.loginBtn = false;
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
          formData.append("name", this.name);
          formData.append("model_id", this.model_id);
          formData.append("description", this.description);
          formData.append("status", this.status);
          // formData.append("pageFile", this.pageFile); 
          // formData.append("user_id", '39');
          formData.append("_method", 'PUT');
          axios.post(siteIndexURL+"/v1/vehicletype/"+this.id, formData)
          .then( result => {    
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/type')
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
    responseHandle: function (type = 'warning', message = '') {
     this.$vs.notify({
        color: type,
        title: '',
        text: message
     })
    }
  },
  beforeMount() {
    let currentRoute = this.$router.currentRoute.params;
    this.id = currentRoute.typeid
    this.getPost();
    this.getInspectiontemplates();
    // this.definedStrings = definedStrings
  }
}
</script>
