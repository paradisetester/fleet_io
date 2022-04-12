<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Page</h6>
	<!-- Info -->
	 <form v-on:submit.prevent>  
  	<vs-input class="w-full mb-base" v-validate="'required'" label-placeholder="Name" name="title" v-model="title"></vs-input>
    <span class="text-danger text-sm"  v-show="errors.has('title')">{{ errors.first('title') }}</span>
	
		<div class="mt-5">
			<label class="text-sm">Description</label>
        <vs-textarea v-validate="'required'" name="description" v-model="description" />
        <span class="text-danger text-sm"  v-show="errors.has('description')">{{ errors.first('description') }}</span>
       </div>
		<div class="mt-4">
		  <label class="text-sm">Items Template</label>
		  <v-select v-model="item" :options="templateOptions"  />
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
import definedStrings from '../../../../definedStrings'
import axios from 'axios';
import {siteIndexURL} from '../../../../axios'
export default {
  components: {
    flatPickr,
    vSelect,

  },
  data () {
 
    return {
    definedStrings:{},
		
			title:'',			
			description:'',
			items:'default',			
		  templateOptions:[{labe:"Default",value:"default"}], 
      item:'default'   
    }
  },
  methods: { 
    getInspectiontemplates: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/inspectiontemplates')
      .then((result)=>{
       
         if (result.data.status == true) {     
          var template={}
          this.templateOptions=[]

            result.data.response.inspectiontemplates.forEach((data) => {
               template={
                label:data.title,
                value:data.id
              }

               this.templateOptions.push(template);         
            });
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
    },
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this;
          const formData = new FormData();
          formData.append("title", $this.title);         
          formData.append("description", $this.description); 
          formData.append("selected_template", $this.item.value);
          axios.post(siteIndexURL+"/v1/inspectiontemplates", formData)
          .then( result => {
            if (result.data.status == true) {
              this.$router.push('/inspection/forms')
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
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
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
  computed: {
  },
  beforeMount() { 
    this.definedStrings = definedStrings
    this.getInspectiontemplates();
  }
}
</script>
