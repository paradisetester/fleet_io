<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Service Task Edit</h6>
 <form v-on:submit.prevent>
<div class="mt-4">
<label class="text-sm">Name</label>
<vs-input class="w-full mb-base" v-model="name" v-validate="'required'" name="name"></vs-input>
</div>
<span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>

<div class="mt-5">
<label class="text-sm">Description</label>
<vs-textarea v-validate="'required'" v-model="description" name="description"/>
</div>
<span class="text-danger text-sm" v-show="errors.has('description')">{{ errors.first('description') }}</span>

<div class="mt-4">
      <label class="text-sm">Subtasks</label>
      <v-select v-model="subtask" :options="VehicleOptions" multiple :closeOnSelect="false" name="subtask" :dir="$vs.rtl ? 'rtl' : 'ltr'"/>
    </div>
  <span class="text-danger text-sm" v-show="errors.has('subtask')">{{ errors.first('subtask') }}</span>

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
      name:'',
      description:'',
      subtask:'',
      VehicleOptions: ['ATV','Boat','Bus','Car'],
         
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
          formData.append("name", this.name);
          formData.append("description", this.description);
          formData.append("subtask", this.subtask);
          formData.append("_method", 'PUT');
          axios.post(siteIndexURL+"/v1/servicetask/"+this.id, formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/services/task')
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
    getPost: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/servicetask/'+this.id+'/edit')
      .then((result)=>{
        if (result.data.status == true) {          
          var servicetask = result.data.response.ServiceTask;

          this.service_task_id = servicetask.id
          this.name = servicetask.name
          this.description = servicetask.description
          this.subtask = servicetask.subtask.split(",")
        }
      }).catch(function (error) {
        if (error.response) {
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
    getVehiclelist: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehiclemake')
      .then((result)=>{
         if (result.data.status == true) {   
         var make={}
         this.vehicleOptions=[]    
            result.data.response.vehiclemake.forEach((key) => {
              make={
                label:key.name,
                value:key.id
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
    let currentRoute = this.$router.currentRoute.params;
    this.id = currentRoute.taskid
    this.getPost();
    this.siteIndexUrl = siteURL;
  }
}
</script>