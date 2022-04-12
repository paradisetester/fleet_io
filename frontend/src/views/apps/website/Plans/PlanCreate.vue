<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Plan</h6>
	<!-- Info -->
	  <form v-on:submit.prevent>  
		<vs-input class="w-full mb-base" label-placeholder="Plan Title" v-model="heading"></vs-input>
    <div class="mt-5">
       <label class="text-sm">Description</label>
        <vs-textarea v-model="description" />
    </div>

    <ul class="centerx">
        <li>
          <vs-checkbox v-model="free_trial" :value="1">Free Trial</vs-checkbox>
        </li>
    </ul>
    <vs-input class="w-full mb-base" label-placeholder="Plan Price" v-model="price"></vs-input>
    <vs-input class="w-full mb-base" label-placeholder="Discount" v-model="discount"></vs-input>
    <div class="mt-4">
      <label class="text-sm">Color</label>
      <v-select label-placeholder="Color" v-model="color" :options="ColourOptions"  />
    </div>

		<div class="mt-4">
		  <label class="text-sm">Plan Time</label>
		  <v-select v-model="type" :options="timeOptions"  />
		</div>

		<div class="mt-4">
			<label class="text-sm">Status</label>
			<v-select v-model="status" :options="pageStatusOptions"  />
		</div>
	<div class="centerx">
		<label class="text-sm">Features List</label>
         <ul class="centerx">
			  <li v-for="(region, index) in featuresOptions" :key="index" class="mainFeautre">
			
         <input  type="checkbox" v-model="form.mainfeature" :value="region.id" v-bind:id="{ index }" @change="selectChild(region.childId,region.dependent_on,$event)" :checked="false" >
          {{ region.name }}

				<ul class="centerx innercheckbox">
					  <li v-for="(reg, ind) in region.slugs" :key="ind"  class="subFeautre">
						 <vs-checkbox v-model="form.feature" :vs-value="reg.id" >  {{ reg.name }}</vs-checkbox>
					  </li>
				</ul>
		
			  </li>
		</ul>
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
import vSelect from 'vue-select'
import { siteIndexURL} from '../../../../axios'
import axios from 'axios';
export default {
  components: {
    vSelect
  },
  data () { 
    return {
  		heading:'',
  		description:'',
  		features:'',
  		discount:'',
		price:'',
  		free_trial:'',    
      permission_group:'',
      status:'',
      type:'', 
	  color:'',
      ColourOptions:[
      { label: 'Pink',  value: 'pink'  },
      { label: 'Green',  value: 'green'  },
      { label: 'Blue',  value: 'blue'  }, 
      { label: 'Silver',  value: 'silver'  },
      { label: 'Gold',  value: 'gold'  }, 
      ],
      pageStatusOptions: [
        { label: 'Publish',  value: '2'  },
        { label: 'UnPublish',  value: '1'  },
        { label: 'Draft',  value: '0'  },       
      ],
      timeOptions: [
        { label: '14 Days Trial',  value: '0'  },
        { label: 'Monthly',  value: '1'  },
        { label: 'Yearly',  value: '2'  },            
      ],
	    featuresOptions: [
		{ id: 1, name: 'Inspection' },
		{ id: 2, name: 'Vehicle' },
		{ id: 3, name: 'Fuel' },
	  ],
	   form: {
		feature: [],
		mainfeature: []
	  },
    }
  },
  computed: {
  },
  methods: {
      selectChild: function(childIds,dependent_on,event){ 

             if(event.target.checked==true){
                     
                      childIds.forEach((dataa) => {
                      this.form.feature.push(dataa)
                      })

                       dependent_on.forEach((dataa) => {
                      this.form.feature.push(dataa)
                      })

             }else{

                    childIds.forEach((data) => { 
                        const index = this.form.feature.indexOf(data);                      
                            if (index > -1) {                           
                              this.form.feature.splice(index, 1);
                            }                           
                      }) 

                     dependent_on.forEach((data) => { 
                        const index = this.form.feature.indexOf(data);                      
                            if (index > -1) {                           
                              this.form.feature.splice(index, 1);
                            }                           
                      }) 
             }
 },
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("heading", $this.heading);
          formData.append("description", $this.description);
          formData.append("features", $this.features);         
          formData.append("discount", $this.discount); 
          formData.append("price", $this.price);  
          formData.append("color", $this.color.value);  
          formData.append("feature", $this.form.feature);  
          if ($this.free_trial == true) {
            formData.append("free_trial", 1);  
          } else {
            formData.append("free_trial", 0);  
          }
         
          formData.append("status", $this.status.value); 
          formData.append("type", $this.type.value);  
          
          axios.post(siteIndexURL+"/v1/plans", formData)
          .then( result => {		 
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/plan')
            }
          }).catch(function (error) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            }
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
            }
          });
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
    },
	getFeatures: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/permission?from=plan_page')
      .then((result)=>{
	
         if (result.data.status == true) {
          this.usersData = result.data.response;		
		  
		    var template={}
		    
			this.featuresOptions=[]

            result.data.response.forEach((data) => {
			var section={}
			this.sectionLoop=[]
			var childId = [];
			if(data.submenu !=false){
			
				data.submenu.forEach((data) => {
				section = {
  					name:data.name,
  					id:data.id,
  					url:data.url,
  					icon:data.icon,					
  					slug:data.slug,					
					},
					this.sectionLoop.push(section)
					childId.push(data.id)
				})
			}
				  var dep = data.dependent_on;
               template={
        					childId:childId,
                  dependent_on:dep,
                  name:data.name,
                  id:data.id,
                  url:data.url,
                  icon:data.icon,
                  i18n:data.i18n,           
                  slugs:this.sectionLoop,   		
        				},
                       this.featuresOptions.push(template)       
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
   this.getFeatures();
  }
}
</script>
