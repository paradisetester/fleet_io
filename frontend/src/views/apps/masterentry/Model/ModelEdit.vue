<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Vehicle Model</h6>
  <!-- Info -->
  <form v-on:submit.prevent>
<vs-input class="w-full mb-base" v-validate="'required'" label-placeholder="Model Name" v-model="name" name="name" @change="modelChange()"></vs-input>
<span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>
  
   <div class="mt-4">
      <label class="text-sm">Vehicle Make</label>
      <select v-model="make_id" class="w-full form-control">
      <option :value="vehiclemakeOptions.value" v-for='vehiclemakeOptions in vehiclemakeOptions' :key="vehiclemakeOptions.value" v-validate="'required'" name="make_id">{{vehiclemakeOptions.label}}</option>
      </select>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('make_id')">{{ errors.first('make_id') }}</span>

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
      make_id:'', 
      description:'',  
      status:'',
      loginBtn : true, 
      vehiclemakeOptions:[],   
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
    modelChange: function()
    {
        this.loginBtn = false;
        var dataString = {
            name: this.name,         
          };    
        var $this = this;
          axios.post(siteIndexURL+'/v1/verifyvehiclemodel',dataString)
          .then((result)=>{
              if(result.data.response.vehiclemodel > 0)
              {
                this.loginBtn = true;
                $this.responseHandle('warning', 'Vehicle Model Already Exists');
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
      axios.get(siteIndexURL+'/v1/vehiclemodel/'+this.id+'/edit')
      .then((result)=>{

        if (result.data.status == true) {          
          var model = result.data.response.vehiclemodel;

          this.id = model.id
          this.name = model.name
          this.make_id = model.make_id
          this.status = model.status         
          this.description = model.description
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
          formData.append("make_id", this.make_id);
          formData.append("description", this.description);
          formData.append("status", this.status);
          // formData.append("pageFile", this.pageFile); 
          // formData.append("user_id", '39');
          formData.append("_method", 'PUT');
          axios.post(siteIndexURL+"/v1/vehiclemodel/"+this.id, formData)
          .then( result => {    
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/model')
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
      axios.get(siteIndexURL+'/v1/vehiclemake')
      .then((result)=>{
         if (result.data.status == true) {   
         var make={}
         this.vehiclemakeOptions=[]    
            result.data.response.vehiclemake.forEach((key) => {
              make={
                label:key.name,
                value:key.id
              }
               this.vehiclemakeOptions.push(make);      
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
    this.id = currentRoute.modelid
    this.getPost();
    this.getInspectiontemplates();
    // this.definedStrings = definedStrings
  }
}
</script>