<template>
   <div>
      <div class="vx-row box_outter">
         <vx-card>
            <div class="mt-5 user_no_mg">
               <div class="vx-row box_outter">
                  <div class="vx-col sm:w-3/12 w-full">
                     <h5>Add / Edit Document</h5>
                     <form v-on:submit.prevent>
                       <div class="vx-row box_outter mt-5">
                         <vs-input
                            v-validate="'required'"
                            icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                            :label="'Document Name'"
                            data-vv-as="field"
                            v-model="document_name"
                            :name="'document_name'"
                            class="w-full mt-5"/>
                            <span class="text-danger text-sm" v-show="errors.has('document_name')">{{ errors.first('document_name') }}</span>
                       </div>
                       <div class="vx-row box_outter mt-5">
	                         <template v-if="documentImage">

	                           <!-- Image Container -->
	                           <div class="img-container mt-6 w-64 mx-auto flex items-center justify-center">
	                             <img :src="documentImage" alt="img" class="responsive">
	                           </div>

	                           <!-- Image upload Buttons -->
	                           <div class="modify-img flex justify-between mt-5">
	                             <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*">
	                             <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">Update Document File</vs-button>
	                             <vs-button type="flat" color="#999" @click="documentImage = null">Remove Document File</vs-button>
	                           </div>
	                         </template>
	                         <div class="upload-img mt-5" v-if="!documentImage">
	                           <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
	                           <vs-button @click="$refs.uploadImgInput.click()">Upload Document File</vs-button>
	                         </div>
                            <span class="text-danger text-sm" v-show="errors.has('document')">{{ errors.first('document') }}</span>
                       </div>
                       <div class="vx-col mt-5 sm:w-1/1 w-ful">
                          <div class="vx-col w-full">
                             <vs-button class="mr-3 mb-2" v-if="!id" @click.prevent="saveForm">Submit</vs-button>
                             <vs-button class="mr-3 mb-2" v-if="id" @click.prevent="updateForm">Update</vs-button>
                             <vs-button color="warning" type="border" class="mb-2" >Reset</vs-button>
                          </div>
                       </div>
                     </form>
                  </div>
                  <div class="vx-col sm:w-9/12 w-full document_show">
                     <h5>Documents</h5>
                     <div class="vx-card p-6">
                        <div class="vs-component vs-con-table stripe vs-table-primary clt_manage">
                           <div class="con-tablex vs-table--content">
                              <div class="vs-con-tbody vs-table--tbody ">
                                 <table class="vs-table vs-table--tbody-table">
                                    <thead class="vs-table--thead">
                                       <tr>
                                          <th>
                                             <div class="vs-table-text">Document name</div>
                                          </th>
                                          <th>
                                             <div class="vs-table-text">Document File</div>
                                          </th>
                                          <th>
                                             <div class="vs-table-text">Actions</div>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="tr-values vs-table--tr tr-table-state-null" v-for="(user, keyIndex) in usersData" :key="keyIndex">
                                        <td>{{user.document_name}}</td>
                                        <td><img v-if="user.document" :src="baseUrl+user.document" style="width:100px;"></td>
                                         <td class="td vs-table--td">
                                            <div class="demo-alignment">
                                               <vs-button color="success" type="filled" @click="editForm(user)" icon-pack="feather" icon="icon-edit-2"></vs-button>
                                               <vs-button color="warning" type="filled" @click="deleteForm(user.id)" icon-pack="feather" icon="icon-trash-2"></vs-button>
                                            </div>
                                         </td>
                                      </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </vx-card>
      </div>
   </div>
</template>

<script>
import { AgGridVue } from 'ag-grid-vue'
import '@/assets/scss/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'
import axios from 'axios';
import {API, siteIndexURL} from '../../../../../axios'
// Cell Renderer
export default {
  name: 'user-tab-documents',
  components: {
    AgGridVue,
    vSelect,
    // Cell Renderer
  },
  data () {
    return {
      document_name: "",
      document: "",
      documentImage:"",
      id:"",
      baseUrl:"https://api.paradisetechsoft.com/media/",
      usersData: []
    }
  },
  watch: {
  },
  computed: {
  },
  methods: {
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
        	var $this = this
    			const formData = new FormData();
    			formData.append("document_name", $this.document_name);
    			formData.append("profile_id", $this.client_id);
    			formData.append("document", $this.document);
    			
    			axios.post(siteIndexURL+"/v1/files/upload_files/", formData)
    			.then( result => {
    				if (result.data.success == true) {
    					this.responseHandle('success', result.data.message);
    					$this.getData();       
    					this.document_name = ""
          				this.document = ""
          				this.documentImage = ""
    				}
    			}).catch(function (error) {
    				if (error.response.data.detail) {
    					$this.getData();
    					$this.responseHandle('warning', error.response.data.detail);
    				}
    			});
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
    },
    updateForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          	var $this = this
  			const formData = new FormData();
  			formData.append("document_name", $this.document_name);
  			formData.append("profile_id", $this.client_id);
  			if ($this.document) {
  				formData.append("document", $this.document);
  			} else {
          formData.append("document", "");
        }	
  			
  			axios.put(siteIndexURL+"/v1/files/file/edit/"+this.id+"/", formData)
  			.then( result => {
  				if (result.data.success == true) {
  					this.responseHandle('success', result.data.message);
  					$this.getData();       
  					this.document_name = ""
    				this.document = ""
    				this.documentImage = ""
    				this.id = ""
  				}
  			}).catch(function (error) {
  				if (error.response.data.detail) {
  					$this.getData();
  					$this.responseHandle('warning', error.response.data.detail);
  				}
  			});
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
    },
    editForm: function(row)
    {
      this.document_name = row.document_name

      this.documentImage = this.baseUrl+row.document
      this.id = row.id
    },
    deleteForm: function(id)
    {
      if (!confirm('Are you sure, you want to delete')) {
        return false
      }
    	var $this = this;

    	axios.delete(siteIndexURL+'/v1/files/file/delete/'+id+'/')
	   	.then((result) => {
	      if (result.data.success == true) {
	         this.responseHandle('success', result.data.message);
         		$this.getData();	                                    
	      }
	   	}).catch(function (error) {
	      if (error.response.data.detail) {
	         this.usersData = [];
	         $this.responseHandle('warning', error.response.data.detail);
	      }
	    })
    },
    getData: function() 
    {
    	var $this = this;
    	var client_id = this.client_id

    	axios.get(siteIndexURL+'/v1/files/'+client_id+'/files/')
	   	.then((result) => {
	      if (result.data.success == true) {
	          this.usersData = result.data.data;	                                    
	      }
	   	}).catch(function (error) {
	      if (error.response.data.detail) {
	         $this.usersData = [];
	         $this.responseHandle('warning', error.response.data.detail);
	      }
	   	});
    },
    updateCurrImg (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.document = input.target.files[0]
          this.documentImage = e.target.result
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
  mounted () {
  },
  created () {
    
  },
  beforeMount() { 
     let currentRoute = this.$router.currentRoute.params;
     this.client_id = currentRoute.ID
     this.getData();     
  }
}

</script>
