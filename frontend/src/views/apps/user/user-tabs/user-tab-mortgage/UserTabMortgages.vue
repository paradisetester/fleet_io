<template>
   <div id="page-user-edit">
      <div >
         <h4>Mortgage</h4>
         <div class="vx-row box_outter" v-for="(tab, keyInner, indexInner) in userTabFields.tabs.Renewables" :key="indexInner">
            <vx-card>
               <div class="mt-5 user_no_mg">
                  <vs-collapse accordion @click="refreshFormArray(keyInner)">
                     <vs-collapse-item> 
                        <div class="tab_outter" slot="header">
                           <span class="user_hd">{{tab.title}}</span>
                        </div>
                        <div class="buttonControl">
                           <vs-button class="w-full ml-auto mt-6 sm:w-1/1" v-on:click="openModalPopup(keyInner, tab.title)">Add</vs-button>
                        </div>
                        <div class="vx-row">
                           <div class="vs-component vs-con-table stripe vs-table-primary clt_manage">
                              <div class="con-tablex vs-table--content">
                                 <div class="vs-con-tbody vs-table--tbody ">
                                    <table class="vs-table vs-table--tbody-table">
                                       <thead class="vs-table--thead">
                                          <tr>
                                             <th v-for="(field, fieldKey) in userTabFields.formFields" :key="fieldKey" v-if="field.tab[keyInner] == true && field.show_in.table == true">
                                                <div class="vs-table-text">{{field.title}}</div>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr class="tr-values vs-table--tr tr-table-state-null" v-for="(tabsTableData, keyIndex) in tabsTableDatas[keyInner]" :key="keyIndex">
                                             <td class="td vs-table--td" v-for="(field, fieldKey) in userTabFields.formFields" :key="fieldKey" v-if="field.tab[keyInner] == true && field.show_in.table == true">
                                                <div class="demo-alignment" v-if="field.type == 'link'">
                                                   <vs-button color="success" @click="openEditModalPopup(keyInner, tab.title, tabsTableData)" type="filled" icon-pack="feather" icon="icon-edit-2"></vs-button>
                                                   <vs-button v-if="tabsTableData.joint_by_id == client_id" color="warning" @click="deleteRecord(tabsTableData.id)" type="filled" icon-pack="feather" icon="icon-trash-2"></vs-button>
                                                </div>
                                                <span v-else-if="field.type == 'date'">{{tabsTableData[field.key] | YYYYMMDD}}</span>
                                                <span v-else-if="field.type == 'select'">{{definedStrings.mortgage[field.key][tabsTableData[field.key]]}}</span>
                                                <span v-else-if="field.key == 'purchase_price' || field.key == 'tenure'">{{tabsTableData[field.key] | PRICEFORMAT}}</span>
                                                <span v-else>{{tabsTableData[field.key]}}</span>
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
      </div>
      <vs-popup fullscreen class="holamundo" :title="activeTabTitle" :active.sync="popupActive">
         <form v-on:submit.prevent>
            <div class="vx-row">
               <div class="vx-col w-full" :class="field.type == 'heading'?'sm:w-1/1':'sm:w-1/3'" v-for="(field, fieldKey) in userTabFields.formFields" :key="fieldKey" v-if="field.tab[activeKey] == true && field.show_in.fields == true">
                  <div class="vx-row box_outter">
                     <h4 v-if="field.type == 'heading'">{{field.title}}</h4>
                     <div v-if="field.type == 'show_totalPayment'">
                        <vs-input
                           readonly =""
                           icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                           :label="field.title"
                           class="w-full mt-5" :value="getTotalPayment() | PRICEFORMAT"/>
                     </div>
                     <vs-input
                        v-if="field.type == 'text'"
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        :data-vv-as="field.title"
                        v-model="activeyKeyFormData[field.key]"
                        :name="field.key"
                        :label="field.title"
                        class="w-full mt-5" :class="field.class"/>
                     <vs-input
                        v-if="field.type == 'number'"
                        v-validate="'required|numeric'"
                        icon-pack="feather" icon="icon-sliders" icon-before icon-no-border
                        :data-vv-as="field.title"
                        v-model="activeyKeyFormData[field.key]"
                        :name="field.key"
                        :label="field.title"
                        class="w-full mt-5" :class="field.class"/>
                     <vs-input
                        v-if="field.type == 'priceNumber'"
                        v-validate="'required|numeric'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        :data-vv-as="field.title"
                        v-model="activeyKeyFormData[field.key]"
                        :name="field.key"
                        :label="field.title"
                        class="w-full mt-5" :class="field.class"/>
                     <vs-textarea
                        v-if="field.type == 'textarea'"
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-edit-2" icon-before
                        :data-vv-as="field.title"
                        v-model="activeyKeyFormData[field.key]"
                        :name="field.key"
                        :label="field.title"
                        class="w-full" :class="field.class" />
                     <vs-select
                        v-if="field.type == 'select'"
                        placeholder="Search and select"
                        v-validate="'required'"
                        :disabled="field.key == 'type_of_account' && activeyKeyFormData.joint_by_id != client_id && editBox == true?true:false"
                        class=" "
                        style="width: 100%;"
                        :label="field.title"
                        vs-multiple
                        autocomplete
                        v-model="activeyKeyFormData[field.key]"
                        >
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in field.options" />
                     </vs-select>
                     <vs-select
                        v-if="field.type == 'selectProfile' && activeyKeyFormData.type_of_account == 'J' && editBox == true"
                        placeholder="Search and select"
                        v-validate="'required'"
                        class=" "
                        :disabled="activeyKeyFormData.joint_by_id == client_id?false:true"
                        style="width: 100%;"
                        :label="field.title"
                        vs-multiple
                        autocomplete
                        v-model="activeyKeyFormData[field.key]"
                        >
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in profileOptions" />
                     </vs-select>
                     <vs-select
                        v-if="field.type == 'selectProfile' && activeyKeyFormData.type_of_account == 'J' && editBox == false"
                        placeholder="Search and select"
                        v-validate="'required'"
                        class=" "
                        style="width: 100%;"
                        :label="field.title"
                        vs-multiple
                        autocomplete
                        v-model="activeyKeyFormData[field.key]"
                        >
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in profileOptions" />
                     </vs-select>
                     <div v-if="field.type == 'date'" class="margin_tp_10 sm:w-1/1 w-full">
                        <label>{{field.title}}</label>
                        <datepicker
                          
                           class="selectExample w-full"
                           :format="'yyyy-MM-dd'"
                           :name="field.key"
                           :placeholder="field.title"
                           icon-pack="feather" icon="icon-edit-2" icon-before
                           v-model="activeyKeyFormData[field.key]"
                           v-validate="'required'"
                           :data-vv-as="field.title"
                           :class="field.class"></datepicker>
                        </div>
                     <span class="text-danger text-sm" v-show="errors.has(field.key)">{{ errors.first(field.key) }}</span>
                  </div>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col w-full">
                  <vs-button class="mr-3 mb-2" @click.prevent="saveForm">Submit</vs-button>
                  <vs-button color="warning" type="border" class="mb-2" @click="activeyKeyFormData = []">Reset</vs-button>
               </div>
            </div>
         </form>
      </vs-popup>
   </div>
</template>
<script type="text/javascript">
import UserTabFields from './UserTabMortgage'
import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker';
import axios from 'axios';
import {API, siteIndexURL} from '../../../../../axios'
import definedStrings from '../../../../../definedStrings'

export default {
	name: 'user-tab-mortgages',
	components: {
		'v-select': vSelect,
		'datepicker': Datepicker
	},
	data() {
		return {
         definedStrings: {},
			user_data: null,
			user_not_found: false,
         client_id:0,
			activeTab: 0,
			userTabFields: [],
			activeKey: '',
			activeTabTitle: '',
			popupActive: false,
			activeyKeyFormDataFields: [],
			activeyKeyFormData: [],
			tabsTableDatas: [],
         userTabFieldsStore:[],
         tabTotalPrice: [],
         profileOptions:[],
         editBox: false
		}
	},
	watch: {

	},
	methods: {
      getTotalPayment: function()
      {
         if (!this.activeyKeyFormData.repayment_amount || !this.activeyKeyFormData.repayment_amount_by_cpf) {
            return 0;
         }
         return parseFloat(this.activeyKeyFormData.repayment_amount) + parseFloat(this.activeyKeyFormData.repayment_amount_by_cpf);
      },
      getProfiles: function(){
         var $this = this;
         var client_id = this.client_id
         this.profileOptions = [];
         axios.get(siteIndexURL+'/v1/profile/'+client_id+'/exclude_profiles/')
            .then((result) => {
               if (result.data.success == true) {
                  var profiles = result.data.data
                  if (profiles.length > 0) {
                     var profile;
                     for (var i = 0; i < profiles.length; i++) {
                        profile = {
                           text: profiles[i].name,
                           value: profiles[i].id
                        };

                        this.profileOptions.push(profile);
                     }
                  }           
               }
            }).catch(function (error) {
               if (error.response.data.detail) {
                  $this.responseHandle('warning', error.response.data.detail);
               }
            });
      },
		openModalPopup: function (keyInner, tab) {
         this.getProfiles();
         this.activeyKeyFormData = [];
			this.activeKey = keyInner;
			this.activeTabTitle = tab;
			if (this.userTabFields.formFields.length > 0) {
				const formFields = this.userTabFields.formFields;
				for (var i = 0; i < formFields.length; i++) {
					if (formFields[i].tab[keyInner] == true) {
						var fieldKey = formFields[i].key;
						this.activeyKeyFormDataFields.push(fieldKey);
					}
				}
			}
         this.editBox = false
			this.popupActive = true;
		},
      openEditModalPopup: function (keyInner, tab, row) {
         this.getProfiles();
         this.activeKey = keyInner;
         this.activeTabTitle = tab;
         this.editBox = true
         if (row.joint_by_id == this.client_id) {
            row.joint_to = row.joint_to_id
         } else {
            row.joint_to = row.joint_by_id
         }
         this.activeyKeyFormData = row;

         this.popupActive = true;
      },
		saveForm: function () {
			this.$validator.validateAll().then(result => {
				if (result) {
               
               if (this.activeyKeyFormData.rate_review_date != undefined && this.activeyKeyFormData.rate_review_date != '') {
                  this.activeyKeyFormData.rate_review_date = this.formatDate2(this.activeyKeyFormData.rate_review_date);
               }

               var $this = this;
               if (this.editBox == false) {
                  this.activeyKeyFormData.profile_id = this.client_id;
                  this.activeyKeyFormData.joint_by = this.client_id;               
               }
               if (this.editBox == true) {
                  this.activeyKeyFormData.profile_id = this.activeyKeyFormData.joint_by_id; 
                  this.activeyKeyFormData.joint_by = this.activeyKeyFormData.joint_by_id;  
                  if (this.activeyKeyFormData.joint_by_id != this.client_id) {
                     this.activeyKeyFormData.joint_to = this.activeyKeyFormData.joint_to_id;
                  }
               }
               
               if (this.activeyKeyFormData.type_of_account == 'S') {
                  this.activeyKeyFormData.joint_to = "";
               } else {
                  this.activeyKeyFormData.joint_to = this.activeyKeyFormData.joint_to;
               }
               
               var dataString = this.activeyKeyFormData;

               var edit_id = this.activeyKeyFormData.id;

               if (edit_id == undefined) {
                  var newDataString = Object.assign({}, this.activeyKeyFormData);
                  var url = '/v1/mortgage/create_mortgage/';
                  axios.post(siteIndexURL+url, newDataString)
                  .then((result) => {
                     $this.responseHandle('success', result.data.message);
                     this.getInsuranceData();

                     this.activeyKeyFormData = [];
                     this.popupActive = false;
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
               } else {
                  
                  axios.put(siteIndexURL+'/v1/mortgage/edit/'+edit_id+'/', dataString)
                  .then((result) => {
                     $this.responseHandle('success', result.data.message);
                     this.popupActive = false;
                     this.getInsuranceData();
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
               }
				} else {
               this.responseHandle('warning', 'Something went wrong, Please try after sometime.');
				}
			})
		},
      deleteRecord: function(id)
      {
         if (!confirm('Are you sure, you want to delete')) {
            return false
         }
         var $this = this;
         axios.delete(siteIndexURL+'/v1/mortgage/mortgage/delete/'+id+'/')
         .then((result) => {
            $this.responseHandle('success', result.data.message);
            $this.getInsuranceData();
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
      sumArray: function(value)
      {
         let total = 0;
         if (value != undefined && value.length > 0) {
            for (var i = 0; i < value.length; i++) {
               total += parseInt(value[i])
            }
         } 
         return total;
      },
      getInsuranceData: function()
      {
         var $this = this;
         var client_id = this.client_id

         axios.get(siteIndexURL+'/v1/mortgage/'+client_id+'/all/')
            .then((result) => {
               if (result.data.success == true) {
                  this.tabsTableDatas = [];
                  var rows = result.data.data;
                  for (var i = 0; i < rows.length; i++) {
                     var row = rows[i];
                     var insurance_type = 1;
                     var tabKey = this.getTabsArrayKey(insurance_type);
                     if (this.tabsTableDatas[tabKey] == undefined) {
                        this.tabsTableDatas[tabKey] = [];
                     }
                     this.tabsTableDatas[tabKey].push(row);  
                  }                            
               }
            }).catch(function (error) {
               if (error.response.data.detail) {
                  $this.responseHandle('warning', error.response.data.detail);
               }
            });
      },
      getTabsArrayKey: function($indexID)
      {
         var $tabs = ['','MORTGAGE_PORTFOLIO'];
         return $tabs[$indexID];
      },
      arraySearch: function(val) {
         var arr = ['','MORTGAGE_PORTFOLIO'];
         for (var i=0; i<arr.length; i++)
              if (arr[i] === val)                    
                  return i;
          return false;
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
      refreshFormArray: function(keyInner)
      {
         this.tabsTableDatas = this.tabsTableDatas;
         this.tabsTableDatas[keyInner].push([]);
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
      this.userTabFields = UserTabFields
      this.definedStrings = definedStrings
      this.getInsuranceData();     
   }
}
</script>