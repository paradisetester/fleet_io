<!-- =========================================================================================
  File Name: UserTabBasicProfile.vue
  Description: User Tab Broadcast
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->
<template>
   <div>
      <div class="vx-row box_outter">
         <vx-card>
            <div class="mt-5 user_no_mg">
               <vs-collapse accordion>
                  <vs-collapse-item>
                     <div class="tab_outter" slot="header">
                        Spouse 
                     </div>
                     <div class="buttonControl">
                        <vs-button v-if="spouses == ''" class="w-full ml-auto mt-6 sm:w-1/1" @click="popupActiveSpouse = true">Add</vs-button>
                     </div>
                     <div class="vx-row">
                        <div class="vs-component vs-con-table stripe vs-table-primary clt_manage">
                           <div class="con-tablex vs-table--content">
                              <div class="vs-con-tbody vs-table--tbody ">
                                 <table class="vs-table vs-table--tbody-table">
                                    <thead class="vs-table--thead">
                                       <tr>
                                          <th>
                                             <div class="vs-table-text">Name</div>
                                          </th>
                                          <th>
                                             <div class="vs-table-text">DOB</div>
                                          </th>
                                          <th>
                                             <div class="vs-table-text">RelationShip</div>
                                          </th>
                                          <th>
                                             <div class="vs-table-text">Actions</div>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr class="tr-values vs-table--tr tr-table-state-null" v-for="(spouse, index) in spouses">
                                          <td class="td vs-table--td"><span>{{spouse.name}}</span></td>
                                          <td class="td vs-table--td"><span>{{spouse.dob}}</span></td>
                                          <td class="td vs-table--td"><span>{{relationShipManage[spouse.relationship]}}</span></td>
                                          <td class="td vs-table--td">
                                             <div class="demo-alignment">
                                                <vs-button color="success" type="filled" icon-pack="feather" @click="getSingleSpouse(spouse.id)" icon="icon-edit-2"></vs-button>
                                                <vs-button color="warning" type="filled" icon-pack="feather" @click="deleteSpouse(spouse.id)" icon="icon-trash-2"></vs-button>
                                             </div>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </vs-collapse-item>
               </vs-collapse>
            </div>
         </vx-card>
      </div>
      <vs-popup fullscreen class="holamundo" :title="'Spouse'" :active.sync="popupActiveSpouse">
         <form v-on:submit.prevent>
            <div class="vx-row">
               <div class="vx-col sm:w-1/1 w-full">
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required|alpha_spaces'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        :label="'Name'"
                        data-vv-as="field"
                        v-model="spouse.name"
                        :name="'spouse_name'"
                        class="w-full mt-5"/>
                  </div>
                <div class="vx-row box_outter margin_tp_10">
                	<label>Birthday</label>
                     <datepicker 
                        class="selectExample w-full" 
                        :format="'yyyy-MM-dd'"
                        :name="'dob'" 
                        icon-pack="feather" icon="icon-edit-2" icon-before
                        :placeholder="'Birthday'"
                        :highlighted="highlightedFn"
                        v-model="spouse.dob" 
                        v-validate="'required'"
                        data-vv-as="field"></datepicker>
                    </div>
                    <div class="vx-row box_outter margin_tp_10">
                        <vs-select
                           placeholder="Select Relation"
                           v-validate="'required'"
                           class=""
                           style="width: 100%;"
                           :label="'Relationship'"
                           :label-placeholder="'Relationship'"
                           vs-multiple
                           autocomplete
                           v-model="spouse.relationship"
                           >
                           <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in relationshipoOtions" />
                        </vs-select>
                  </div>
                  <div class="vx-row">
                     <div class="vx-col w-full">
                        <vs-button class="mr-3 mb-2" @click="createUser()">Submit</vs-button>
                        <vs-button color="warning" type="border" class="mb-2" @click="spouse = {name:'',dob:'',gender:''}">Reset</vs-button>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </vs-popup>
   </div>
</template>
<script>
    import vSelect from 'vue-select'
    import Datepicker from 'vuejs-datepicker';
	import axios from 'axios';
    import {API, siteIndexURL} from '../../../../../axios'
	export default {
		components: {
			vSelect,
			'datepicker': Datepicker
		},
		name: 'user-tab-basic-profile',
		data() {
			return {
				editUser: false,
	            popupActiveSpouse: false,
	            spouses:[],
	            spouse:{
	               	id:'',
	               	name: '',
	               	dob:'',
	               	profile_del_id:0,
	               	relationship: ''
	            },
			      highlightedFn: {
			        customPredictor(date) {
			          var selectedMOnth = date.getMonth()+1
			          var selectedgetDate = date.getDate()
			          var selectedDate = date.getFullYear()+''+''+((selectedMOnth < 10) ? "0" + selectedMOnth : selectedMOnth)+''+((selectedgetDate < 10) ? "0" + selectedgetDate : selectedgetDate);
			          var d = new Date(),
			            month = "" + (d.getMonth() + 1),
			            day = "" + d.getDate(),
			            year = d.getFullYear();
			          if (month.length < 2) month = "0" + month;
			          if (day.length < 2) day = "0" + day;
			          var getCurrentDate = [year, month, day].join("");
			          if (selectedDate >= getCurrentDate) {
			            return true;
			          }
			        }
			      },
	            relationshipoOtions:[
	               {
	                  text: 'Husband',
	                  value: 1
	               },
	               {
	                  text: 'Wife',
	                  value: 2
	               }
	            ],
	            relationShipManage: {
	            	1: "Husband",
	            	2: "Wife"
	            },
			}
		},
		watch: {

		},
		methods: {			
			createUser() {
	            var $this = this;
	            if (!this.spouse.name) {
	               this.responseHandle('warning', 'Name is required');
	               return false;
	            } else if (!this.spouse.dob) {
	               this.responseHandle('warning', 'DOB is required');
	               return false;
	            } else if (!this.spouse.relationship) {
	               this.responseHandle('warning', 'Gender is required');
	               return false;
	            } 

	            this.spouse.dob = this.formatDate2(this.spouse.dob);
	            var dataString = {
	            	name: this.spouse.name,
	            	dob: this.spouse.dob,
	            	relationship: this.spouse.relationship,
	            	profile_id: this.spouse.profile_del_id
	            };
	            if (!this.spouse.id) {
	               var url = '/v1/profile/create_spouse/';
	               axios.post(siteIndexURL+url, dataString)
	               .then((result) => {
	                  $this.responseHandle('success', result.data.message);
	                  this.getSpouses();
	                  $this.popupActiveSpouse = false
	               }).catch(function (error) {
	                  if (error.response.data.detail) {
	                     $this.responseHandle('warning', error.response.data.detail);
	                  }
	                  if (error.response.data.message) {
	                     $this.responseHandle('warning', error.response.data.message);
	                  }
	                  if (error.response.data.errors) {
	                     if (error.response.data.errors.name) {
	                        $this.responseHandle('warning', error.response.data.errors.name[0]);
	                     } else if (error.response.data.errors.dob) {
	                        $this.responseHandle('warning', error.response.data.errors.dob[0]);
	                     } else if (error.response.data.errors.relationship) {
	                        $this.responseHandle('warning', error.response.data.errors.relationship[0]);
	                     } 
	                  }
	               });
	            } else {
	               var url = '/v1/profile/spouse/edit/' + this.spouse.id + '/';
	               axios.put(siteIndexURL+url, dataString)
	               .then((result) => {
	                  $this.responseHandle('success', result.data.message);
	                  this.getSpouses();
	                  this.spouse  = {
	                     id:'',
	                     name: '',
	                     dob:'',
	                     relationship: '',
	                     profile_del_id:0,
	                  };
	                  $this.popupActiveSpouse = false
	               }).catch(function (error) {
	                  if (error.response.data.detail) {
	                     $this.responseHandle('warning', error.response.data.detail);
	                  }
	                  if (error.response.data.message) {
	                     $this.responseHandle('warning', error.response.data.message);
	                  }
	                  if (error.response.data.errors) {
	                     if (error.response.data.errors.name) {
	                        $this.responseHandle('warning', error.response.data.errors.name[0]);
	                     } else if (error.response.data.errors.dob) {
	                        $this.responseHandle('warning', error.response.data.errors.dob[0]);
	                     } else if (error.response.data.errors.relationship) {
	                        $this.responseHandle('warning', error.response.data.errors.relationship[0]);
	                     } 
	                  }
	               });
	            }            
	         },
	         formatDate2: function (date) {
	            var d = new Date(date),
	               month = "" + (d.getMonth() + 1),
	               day = "" + d.getDate(),
	               year = d.getFullYear();

	            if (month.length < 2) month = "0" + month;
	            if (day.length < 2) day = "0" + day;

	            return [year, month, day].join("-");
	         },
	         getSpouses: function () {
	            var $this = this;
	            var client_id = this.client_id
	            axios.get(siteIndexURL+'/v1/profile/' + client_id + '/spouse/')
	               .then((result) => {
	                  if (result.data.success == true) {
	                     this.spouses = result.data.data;
	                  }
	               }).catch(function (error) {
	                  $this.spouses = [];
	                  if (error.response.data.detail) {
	                     $this.responseHandle('warning', error.response.data.detail);
	                  }
	                  if (error.response.data.message) {
	                     $this.responseHandle('warning', error.response.data.message);
	                  }
	               });
	         },
	         getSingleSpouse: function ($id = 0) {
	            var $this = this;
	            axios.get(siteIndexURL+'/v1/profile/spouse/'+$id+'/')
	               .then((result) => {
	                  this.spouse = result.data.data[0];
	                  this.popupActiveSpouse = true
	               }).catch(function (error) {
	                  if (error.response.data.detail) {
	                     $this.responseHandle('warning', error.response.data.detail);
	                  }
	               });
	         },
	         deleteSpouse: function($id)
	         {
	         	if (!confirm('Are you sure, you want to delete')) {
	         	  return false
	         	}
	            var $this = this;
	            axios.delete(siteIndexURL+'/v1/profile/spouse/delete/'+$id+'/')
	               .then((result) => {
	                  if (result.data.success == true) {
	                     $this.responseHandle('success', result.data.message);
	                     this.getSpouses();
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
		created() {

		},
		beforeMount() {
			let currentRoute = this.$router.currentRoute.params;
			this.client_id = currentRoute.ID
         	this.spouse.profile_del_id = this.client_id
			this.getSpouses();
		}
	}
</script>
