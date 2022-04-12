<!-- =========================================================================================
  File Name: UserTabBasicProfile.vue
  Description: User Tab Broadcast
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->
<template>
   <div class="bs_tab">
      <div class="vx-row box_outter">
         <vx-card>
            <div class="mt-5 user_no_mg">
               <vs-collapse accordion>
                  <vs-collapse-item>
                     <div class="tab_outter" slot="header">
                        Personal Info 
                     </div>
                     <div class="buttonControl edit">
                        <vs-button v-if="editUser == false" class="w-full ml-auto mt-6 sm:w-1/1" type="filled" icon-pack="feather" icon="icon-edit-2" @click.prevent="editUser = true"></vs-button>
                     </div>
                     <div class="vx-row bs_user" v-if="editUser == false">
                        <div class="vx-col lg:w-1/2 w-full">
                           <table>
                              <tr>
                                 <td class="font-semibold">Name</td>
                                 <td>{{ profile.name }}</td>
                              </tr>
                              <tr>
                                 <td class="font-semibold">Email</td>
                                 <td>{{ profile.email }}</td>
                              </tr>
                           </table>
                           <table>
                              <tr>
                                 <td class="font-semibold">Contact Number</td>
                                 <td>{{ profile.phone }}</td>
                              </tr>
                              <tr>
                                 <td class="font-semibold">Birth Date</td>
                                 <td>{{ profile.dob }}</td>
                              </tr>
                              <tr>
                                 <td class="font-semibold">Address</td>
                                 <td>{{ profile.address }}</td>
                              </tr>
                              <tr>
                                 <td class="font-semibold">Race</td>
                                 <td>{{ definedStrings.profile.race[profile.race] }}</td>
                              </tr>
                           </table>
                        </div>
                        <div class="vx-col lg:w-1/2 w-full">
                           <table>
                              <tr>
                                 <td class="font-semibold">Occupation</td>
                                 <td>{{ definedStrings.profile.occupation[profile.occupation] }}</td>
                              </tr>
                              <tr>
                                 <td class="font-semibold">Monthly income</td>
                                 <td>{{ profile.annual_income | PRICEFORMAT }}</td>
                              </tr>
                              <tr>
                                 <td class="font-semibold">Segment/Tiering:</td>
                                 <td>{{ definedStrings.profile.tier[profile.tier] }}</td>
                              </tr>
                           </table>
                           <table>
                              <tr>
                                 <td class="font-semibold">Region</td>
                                 <td>{{ definedStrings.profile.region[profile.region] }}</td>
                              </tr>
                              <tr>
                                 <td class="font-semibold">Source of Acquaintance</td>
                                 <td>{{ definedStrings.profile.source[profile.source] }}</td>
                              </tr>
                           </table>
                        </div>
                     </div>
                     <form v-if="editUser == true" v-on:submit.prevent>
                        <div class="buttonControl">
                           <vs-button 
                              v-if="editUser == true" 
                              class="w-full ml-auto mt-6 sm:w-1/1" 
                              @click.prevent="createUser">
                              Save
                           </vs-button>
                        </div>
                        <div class="vx-row">
                           <div class="vx-col md:w-1/3 w-full">
                              <div class="vx-row box_outter">
                                 <vs-input 
                                    class="w-full mt-4" 
                                    icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                                    :label="'Customer Name'" 
                                    v-model="profile.name" 
                                    v-validate="'required|alpha_spaces'" 
                                    name="name" />
                                 <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>
                              </div>
                           </div>
                           <div class="vx-col md:w-1/3 w-full">
                              <div class="vx-row box_outter">
                                 <vs-input 
                                    type="email"
                                    class="w-full mt-4" 
                                    icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                                    :label="'Customer Email'" 
                                    v-model="profile.email" 
                                    v-validate="'required|email'" 
                                    name="email" />
                                 <span class="text-danger text-sm"  v-show="errors.has('email')">{{ errors.first('email') }}</span>
                              </div>
                           </div>
                           <div class="vx-col md:w-1/3 w-full">
                              <div class="vx-row box_outter margin_tp_10">
                                 <label>Birth Date</label>
                                 <datepicker 
                                    class="selectExample w-full" 
                                    :format="'yyyy-MM-dd'"
                                    :name="'dob'" 
                                    icon-pack="feather" icon="icon-edit-2" icon-before
                                    :label-placeholder="'Birthday'"
                                    :highlighted="highlightedFn"
                                    v-model="profile.dob" 
                                    v-validate="'required'"
                                    data-vv-as="field">
                                 </datepicker>
                                 <span class="text-danger text-sm"  v-show="errors.has('dob')">{{ errors.first('dob') }}</span>
                              </div>
                           </div>
                        </div>
                        <div class="vx-row">
                           <div class="vx-col md:w-1/3 w-full">
                              <div class="vx-row box_outter margin_tp_10">
                                 <label>Race</label>
                                 <select 
                                    class="w-full form-control" 
                                    v-model="profile.race" 
                                    v-validate="'required'" 
                                    name="race">
                                    <option value="">Select</option>
                                    <option :value="raceKey" v-for="(raceValue, raceKey, index) in definedStrings.profile.race" :key="index">{{raceValue}}</option>
                                 </select>
                                 <span class="text-danger text-sm"  v-show="errors.has('race')">{{ errors.first('race') }}</span>
                              </div>
                           </div>
                           <div class="vx-col md:w-1/3 w-full">
                              <div class="vx-row box_outter margin_tp_10">
                                 <label>Occupation</label>
                                 <select 
                                    class="w-full form-control" 
                                    v-model="profile.occupation" 
                                    v-validate="'required'" 
                                    name="occupation">
                                    <option value="">Select</option>
                                    <option :value="occupationKey" v-for="(occupationValue, occupationKey, index) in definedStrings.profile.occupation" :key="index">{{occupationValue}}</option>
                                 </select>
                                 <span class="text-danger text-sm"  v-show="errors.has('occupation')">{{ errors.first('occupation') }}</span>
                              </div>
                           </div>
                           <div class="vx-col md:w-1/3 w-full">
                              <div class="vx-row box_outter margin_tp_10">
                                 <label>Segment/Tiering:</label>
                                 <select 
                                   class="w-full form-control"
                                   v-model="profile.tier" 
                                   v-validate="'required'" 
                                   name="tier">
                                     <option value="">Select</option>
                                     <option :value="tierKey" v-for="(tierValue, tierKey, index) in definedStrings.profile.tier" :key="index">{{tierValue}}</option>
                                 </select>
                                 <span class="text-danger text-sm"  v-show="errors.has('tier')">{{ errors.first('tier') }}</span>
                              </div>
                           </div>
                        </div>
                        <div class="vx-row">
                           <div class="vx-col md:w-1/2 w-full">
                              <div class="vx-row box_outter margin_tp_10">
                                 <label>Region</label>
                                 <select 
                                    class="w-full form-control"
                                    v-model="profile.region" 
                                    v-validate="'required'" 
                                    name="region">
                                    <option value="">Select</option>
                                    <option :value="regionKey" v-for="(regionValue, regionKey, index) in definedStrings.profile.region" :key="index">{{regionValue}}</option>
                                 </select>
                                 <span class="text-danger text-sm"  v-show="errors.has('region')">{{ errors.first('region') }}</span>
                              </div>
                           </div>
                           <div class="vx-col md:w-1/2 w-full">
                              <div class="vx-row box_outter margin_tp_10">
                                 <label>Source of Acquaintance</label>
                                 <select 
                                    class="w-full form-control" 
                                    v-model="profile.source" 
                                    v-validate="'required'" 
                                    name="source">
                                    <option value="">Select</option>
                                    <option :value="sourceKey" v-for="(sourceValue, sourceKey, index) in definedStrings.profile.source" :key="index">{{sourceValue}}</option>
                                 </select>
                                 <span class="text-danger text-sm"  v-show="errors.has('source')">{{ errors.first('source') }}</span>
                              </div>
                           </div>
                        </div>
                        <div class="vx-row">
                           <div class="vx-col md:w-1/3 w-full">
                              <div class="vx-row box_outter ">
                                 <vs-input 
                                    class="w-full mt-4" 
                                    label="Monthly income" 
                                    v-model="profile.annual_income" 
                                    data-vv-as="Monthly income"
                                    v-validate="'required|numeric'" 
                                    name="annual_income" />
                                 <span class="text-danger text-sm"  v-show="errors.has('annual_income')">{{ errors.first('annual_income') }}</span>
                              </div>
                           </div>
                           <div class="vx-col md:w-1/3 w-full">
                              <div class="vx-row box_outter">
                                 <vs-input 
                                    class="w-full mt-4" 
                                    label="contact number" 
                                    v-model="profile.phone" 
                                    v-validate="'required|numeric'" 
                                    name="phone" />
                                 <span class="text-danger text-sm"  v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                              </div>
                           </div>
                           <div class="vx-col md:w-1/3 w-full">
                              <div class="vx-row box_outter">
                                 <vs-input 
                                    class="w-full mt-4" 
                                    label="Address" 
                                    v-model="profile.address" 
                                    v-validate="'required'" 
                                    name="address" />
                                 <span class="text-danger text-sm"  v-show="errors.has('address')">{{ errors.first('address') }}</span>
                              </div>
                           </div>
                        </div>
                     </form>
                  </vs-collapse-item>
               </vs-collapse>
            </div>
         </vx-card>
      </div>
      <user-tab-spouse></user-tab-spouse>
      <user-tab-children></user-tab-children>
      <user-tab-parent></user-tab-parent>
   </div>
</template>
<script>
   import vSelect from 'vue-select'
   import Datepicker from 'vuejs-datepicker';
   import UserTabSpouse from './UserTabSpouse.vue'
   import UserTabParent from './UserTabParent.vue'
   import UserTabChildren from './UserTabChildren.vue'

	import axios from 'axios';
   import {API, siteIndexURL} from '../../../../../axios'
   import definedStrings from '../../../../../definedStrings'
	export default {
		components: {
			vSelect,
			'datepicker': Datepicker,
         'user-tab-spouse': UserTabSpouse,
         'user-tab-parent': UserTabParent,
         'user-tab-children': UserTabChildren
		},
		name: 'user-tab-basic-profile',
		data() {
			return {
				editUser: false,	 
            definedStrings:{},           
				profile: {
					name: '',
					email: '',
					phone: '',
					dob: '',
					address: '',
					race: '',
					occupation: '',
					annual_income: '',
					tier: '',
					region: '',
					source: '',
               is_client:'CLNT'
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
            }
			}
		},
		watch: {

		},
		methods: {
			createUser() {
				var client_id = this.client_id
				var $this = this;
				if (!this.profile.name) {
					this.responseHandle('warning', 'name is required');
					return false;
				} else if (!this.profile.email) {
					this.responseHandle('warning', 'email is required');
					return false;
				} else if (!this.profile.phone) {
					this.responseHandle('warning', 'phone is required');
					return false;
				} else if (!this.profile.dob) {
					this.responseHandle('warning', 'dob is required');
					return false;
				} else if (!this.profile.address) {
					this.responseHandle('warning', 'address is required');
					return false;
				} else if (!this.profile.race) {
					this.responseHandle('warning', 'race is required');
					return false;
				} else if (!this.profile.occupation) {
					this.responseHandle('warning', 'occupation is required');
					return false;
				} else if (!this.profile.annual_income) {
					this.responseHandle('warning', 'annual income is required');
					return false;
				} else if (!this.profile.tier) {
					this.responseHandle('warning', 'tier is required');
					return false;
				} else if (!this.profile.region) {
					this.responseHandle('warning', 'region is required');
					return false;
				} else if (!this.profile.source) {
					this.responseHandle('warning', 'source is required');
					return false;
				}

				this.profile.dob = this.formatDate2(this.profile.dob);
				var dataString = this.profile
				axios.put(siteIndexURL+'/v1/profile/profile/edit/' + client_id + '/', dataString)
					.then((result) => {
						$this.responseHandle('success', result.data.message);
                  this.getProfile();
						$this.editUser = false;
					}).catch(function (error) {
						if (error.response.data.detail) {
							$this.responseHandle('warning', error.response.data.detail);
						}
						if (error.response.data.message) {
							$this.responseHandle('warning', error.response.data.message);
						}
						if (error.response.data.errors) {
							var errors = error.response.data.errors;
                     for (let value of Object.values(errors)) {
                       $this.responseHandle('warning', value[0]);
                     }
						}
					});
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
			getProfile: function () {
				var $this = this;
				var client_id = this.client_id
				axios.get(siteIndexURL+'/v1/profile/profile/' + client_id + '/')
					.then((result) => {
						if (result.data.success == true) {
							this.profile = result.data.data[0];
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
         this.definedStrings = definedStrings
			this.getProfile();		
      }
	}
</script>
