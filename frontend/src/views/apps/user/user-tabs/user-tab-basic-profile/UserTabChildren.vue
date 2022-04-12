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
                        Children 
                     </div>
                     <div class="buttonControl">
                        <vs-button class="w-full ml-auto mt-6 sm:w-1/1" @click="popupActiveChildren = true">Add</vs-button>
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
                                             <div class="vs-table-text">Gender</div>
                                          </th>
                                          <th>
                                             <div class="vs-table-text">Actions</div>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr class="tr-values vs-table--tr tr-table-state-null" v-for="(children, index) in childrens">
                                          <td class="td vs-table--td"><span>{{children.name}}</span></td>
                                          <td class="td vs-table--td"><span>{{children.dob}}</span></td>
                                          <td class="td vs-table--td"><span>{{gender[children.gender]}}</span></td>
                                          <td class="td vs-table--td">
                                             <div class="demo-alignment">
                                                <vs-button color="success" type="filled" icon-pack="feather" @click="getSingleChildren(children.id)" icon="icon-edit-2"></vs-button>
                                                <vs-button color="warning" type="filled" icon-pack="feather" @click="deleteChildren(children.id)" icon="icon-trash-2"></vs-button>
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
      <vs-popup fullscreen class="holamundo" :title="'Children'" :active.sync="popupActiveChildren">
         <form v-on:submit.prevent>
            <div class="vx-row">
               <div class="vx-col sm:w-1/1 w-full">
                  <div class="vx-row box_outter ">
                     <vs-input
                        v-validate="'required|alpha_spaces'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        :label="'Name'"
                        data-vv-as="field"
                        v-model="children.name"
                        :name="'spouse_name'"
                        class="w-full mt-5"/>
                  </div>
                  <div class="vx-row box_outter margin_tp_10">
                    <label>Birthday</label>
                     <datepicker 
                        class="w-full" 
                        :format="'yyyy-MM-dd'"
                        :highlighted="highlightedFn"
                        :name="'dob'" 
                        :placeholder="'Birthday'"
                        v-model="children.dob" 
                        v-validate="'required'"
                        data-vv-as="field"></datepicker>
                  </div>
                  <div class="vx-row box_outter ">
                     <ul class="centerx mt-6">
                       <li>
                         <vs-radio v-model="children.gender" vs-value="1">Male</vs-radio>
                       </li>
                       <li>
                         <vs-radio v-model="children.gender" vs-value="2">Female</vs-radio>
                       </li>
                    </ul>
                  </div>
                  <div class="vx-row">
                     <div class="vx-col w-full">
                        <vs-button class="mr-3 mb-2" @click="createUser()">Submit</vs-button>
                        <vs-button color="warning" type="border" class="mb-2" @click="children = {name:'',dob:'',gender:'',relationship:''}">Reset</vs-button>
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
            popupActiveChildren: false,
            childrens:[],
            children:{
               id:0,
               name: '',
               dob:'',
               gender: '',
               profile_del_id:0,
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
                  text: 'Father',
                  value: 'father'
               },
               {
                  text: 'Mother',
                  value: 'mother'
               },
               {
                  text: 'Father In Law',
                  value: 'father_in_law'
               },
               {
                  text: 'Mother In Law',
                  value: 'mother_in_law'
               }
            ],
            gender: {
            	1: "Male",
            	2: "Female"
            },
			}
		},
		watch: {

		},
		methods: {
			createUser() {
				var $this = this;
				if (!this.children.name) {
					this.responseHandle('warning', 'Name is required');
					return false;
				} else if (!this.children.dob) {
					this.responseHandle('warning', 'DOB is required');
					return false;
				} else if (!this.children.gender) {
					this.responseHandle('warning', 'Gender is required');
					return false;
				} 

				this.children.dob = this.formatDate2(this.children.dob);
            var dataString = {
               name: this.children.name,
               dob: this.children.dob,
               gender: this.children.gender,
               profile_id: this.children.profile_del_id
            };
            if (this.children.id == 0) {
               var url = '/v1/profile/create_children/';
               axios.post(siteIndexURL+url, dataString)
               .then((result) => {
                  $this.responseHandle('success', result.data.message);
                  this.getChildrens();
                  $this.popupActiveChildren = false
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
                     } else if (error.response.data.errors.gender) {
                        $this.responseHandle('warning', error.response.data.errors.gender[0]);
                     } 
                  }
               });
            } else {
               var url = '/v1/profile/children/edit/' + this.children.id + '/';
               axios.put(siteIndexURL+url, dataString)
               .then((result) => {
                  $this.responseHandle('success', result.data.message);
                  this.getChildrens();
                  this.chidren = {
                     id:0,
                     name: '',
                     dob:'',
                     gender: '',
                     profile_del_id:0,
                     relationship: 'FATH'
                  };
                  $this.popupActiveChildren = false
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
                     } else if (error.response.data.errors.gender) {
                        $this.responseHandle('warning', error.response.data.errors.gender[0]);
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
			getChildrens: function () {
				var $this = this;
				var client_id = this.client_id
				axios.get(siteIndexURL+'/v1/profile/' + client_id + '/children/')
					.then((result) => {
						if (result.data.success == true) {
							this.childrens = result.data.data;
						}
					}).catch(function (error) {
						if (error.response.data.detail) {
							$this.responseHandle('warning', error.response.data.detail);
						}
					});
			},
         getSingleChildren: function ($id = 0) {
            var $this = this;
            axios.get(siteIndexURL+'/v1/profile/children/'+$id+'/')
               .then((result) => {
                  this.children = result.data.data[0];
                  this.popupActiveChildren = true
               }).catch(function (error) {
                  if (error.response.data.detail) {
                     $this.responseHandle('warning', error.response.data.detail);
                  }
               });
         },
         deleteChildren: function($id)
         {
          if (!confirm('Are you sure, you want to delete')) {
            return false
          }
            var $this = this;
            axios.delete(siteIndexURL+'/v1/profile/children/delete/'+$id+'/')
               .then((result) => {
                  if (result.data.success == true) {
                     $this.responseHandle('success', result.data.message);
                     this.getChildrens();
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
		created() {},
		beforeMount() {
			let currentRoute = this.$router.currentRoute.params;
			this.client_id = currentRoute.ID
         this.children.profile_del_id = this.client_id
			this.getChildrens();
		}
	}
</script>
