<template>
   <div id="page-user-edit">
      <div >
         <h4>Investments</h4>
         <div class="vx-row box_outter" v-for="(tab, keyInner, indexInner) in userTabFields.tabs.Renewables" :key="indexInner">
            <vx-card>
               <div class="mt-5 user_no_mg">
                  <vs-collapse accordion @click="refreshFormArray(keyInner)">
                     <vs-collapse-item> 
                        <div class="tab_outter" slot="header">
                           <span class="user_hd">{{tab.title}}</span><span class="user_premium">Total Premium Amount : {{sumArray(tabTotalPrice[keyInner]) | PRICEFORMAT}}</span>
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
                                                   <vs-button color="warning" @click="deleteRecord(tabsTableData.id)" type="filled" icon-pack="feather" icon="icon-trash-2"></vs-button>
                                                </div>
                                                <span v-else-if="field.type == 'date'">{{tabsTableData[field.key] | YYYYMMDD}}</span>
                                                <span v-else-if="field.type == 'select'">{{definedStrings.investment[field.key][tabsTableData[field.key]]}}</span>
                                                <span v-else-if="field.key == 'principal_paid'">{{tabsTableData[field.key] | PRICEFORMAT}}</span>
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
               <div class="vx-col sm:w-1/3 w-full" v-for="(field, fieldKey) in userTabFields.formFields" :key="fieldKey" v-if="field.tab[activeKey] == true && field.show_in.fields == true">
                  <div class="vx-row box_outter">
                     <vs-input
                        v-if="field.type == 'showText'"     
                        readonly                   
                        :value="showMeturityDate"
                        :label="field.title"
                        class="w-full mt-5"/>
                     <vs-input
                        v-if="field.type == 'text'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        :data-vv-as="field.title"
                        :readonly="field.readonly"
                        v-model="activeyKeyFormData[field.key]"
                        :name="field.key"
                        :label="field.title"
                        class="w-full mt-5" :class="field.class"/>
                     <vs-input
                        v-if="field.type == 'number'"
                        icon-pack="feather" icon="icon-sliders" icon-before icon-no-border
                        :data-vv-as="field.title"
                        v-model="activeyKeyFormData[field.key]"
                        :name="field.key"
                        :label="field.title"
                        class="w-full mt-5" :class="field.class"/>
                     <vs-input
                        v-if="field.type == 'priceNumber'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        :data-vv-as="field.title"
                        v-model="activeyKeyFormData[field.key]"
                        :name="field.key"
                        :label="field.title"
                        class="w-full mt-5" :class="field.class"/>
                     <vs-textarea
                        v-if="field.type == 'textarea'"
                        icon-pack="feather" icon="icon-edit-2" icon-before
                        :data-vv-as="field.title"
                        v-model="activeyKeyFormData[field.key]"
                        :name="field.key"
                        :label="field.title"
                        class="w-full" :class="field.class" />
                     <vs-select
                        v-if="field.type == 'select'"
                        placeholder="Search and select"
                        class=" "
                        style="width: 100%;"
                        :label="field.title"
                        vs-multiple
                        autocomplete
                        v-model="activeyKeyFormData[field.key]"
                        >
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in field.options" />
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
                           :data-vv-as="field.title"
                           :class="field.class"></datepicker>
                     </div>
                     <ul class="centerx" v-if="field.type == 'checkbox'">
                         <li>
                           <vs-checkbox v-model="activeyKeyFormData[field.key]" :value="1">{{field.title}}</vs-checkbox>
                         </li>
                     </ul>
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
import UserTabFields from './UserTabInvestment'
import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker';
import axios from 'axios';
import {API, siteIndexURL} from '../../../../../axios'
import definedStrings from '../../../../../definedStrings'
export default {
	name: 'user-tab-investments',
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
		}
	},
	computed: {
      showMeturityDate: function()
      {         
         if(!this.activeyKeyFormData.trade_date || !this.activeyKeyFormData.tenure){
            return ;
         }
         var maturity_date = this.addMonths(new Date(this.activeyKeyFormData.trade_date), this.activeyKeyFormData.tenure);
         this.activeyKeyFormData.maturity_date = this.formatDate2(maturity_date);
         return this.activeyKeyFormData.maturity_date;
      }
	},
	methods: {
      addMonths: function(date, months) {
          var d = date.getDate();
           if (this.activeyKeyFormData.mode_of_payment == 'ANL') {
             months = parseInt(months);
             date.setFullYear(date.getFullYear() + months);
             return date
           } else {
             date.setMonth(date.getMonth() + +(months-1));
             if (date.getDate() != d) {
               date.setDate(0);
             }
             return date;
          }
          return date;
      },
		openModalPopup: function (keyInner, tab) {
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
			this.popupActive = true;
		},
      openEditModalPopup: function (keyInner, tab, row) {
         this.activeKey = keyInner;
         this.activeTabTitle = tab;
         this.activeyKeyFormData = row;
         this.popupActive = true;
      },
		saveForm: function () {
			this.$validator.validateAll().then(result => {
				if (result) {
               
               if (this.activeyKeyFormData.trade_date != undefined && this.activeyKeyFormData.trade_date != '') {
                  this.activeyKeyFormData.trade_date = this.formatDate2(this.activeyKeyFormData.trade_date);
               }
               if (this.activeyKeyFormData.maturity_date != undefined && this.activeyKeyFormData.maturity_date != '') {
                  this.activeyKeyFormData.maturity_date = this.formatDate2(this.activeyKeyFormData.maturity_date);
               }
               if (this.activeyKeyFormData.managed_by == true) {
                  this.activeyKeyFormData.managed_by = 1
               } else {
                  this.activeyKeyFormData.managed_by = 2
               }
               var $this = this;
               this.activeyKeyFormData.profile_id = this.client_id;
               this.activeyKeyFormData.investment_type = this.arraySearch(this.activeKey);
               var dataString = this.activeyKeyFormData;
               var edit_id = this.activeyKeyFormData.id;

               if (edit_id == undefined) {
                  var newDataString = Object.assign({}, this.activeyKeyFormData);
                  var url = '/v1/investment/create_investment/';
                  axios.post(siteIndexURL+url, newDataString)
                  .then((result) => {
                     $this.responseHandle('success', result.data.message);
                     if (this.tabsTableDatas[this.activeKey] == undefined) {
                        this.tabsTableDatas[this.activeKey] = [];
                     }
                     var response = result.data.data[0];
                     this.tabsTableDatas[this.activeKey].push(response);

                     if (this.tabTotalPrice[this.activeKey] == undefined) {
                        this.tabTotalPrice[this.activeKey] = [];
                     }
                     this.tabTotalPrice[this.activeKey].push(response.principal_paid);

                     this.activeyKeyFormData = [];
                     this.popupActive = false;
                     this.getInsuranceData()
                  }).catch(function (error) {
                     if (error.response.data.detail) {
                        $this.responseHandle('warning', error.response.data.detail);
                     }
                     if (error.response.data.message) {
                        $this.responseHandle('warning', error.response.data.message);
                     }
                     if (error.response.data.errors) {
                        var errors = error.response.data.errors;
                        var keys = Object.keys(errors);
                        if (keys.length > 0) {
                           for (var i = 0; i < keys.length; i++) {
                              var key = keys[i]
                              var error = errors[key];
                              var slugTitle = key.replace('_',' ');
                              $this.responseHandle('warning', slugTitle+' '+error);
                           }
                        }                       
                     }
                  });
               } else {
                  axios.put(siteIndexURL+'/v1/investment/investment/edit/'+edit_id+'/', dataString)
                  .then((result) => {
                     $this.responseHandle('success', result.data.message);
                     if (this.tabTotalPrice[this.activeKey] == undefined) {
                        this.tabTotalPrice[this.activeKey] = [];
                     }
                     this.tabTotalPrice[this.activeKey].push(dataString.principal_paid);
                     this.popupActive = false;
                     this.getInsuranceData()
                  }).catch(function (error) {
                     if (error.response.data.detail) {
                        $this.responseHandle('warning', error.response.data.detail);
                     }
                     if (error.response.data.message) {
                        $this.responseHandle('warning', error.response.data.message);
                     }
                     if (error.response.data.errors) {
                        var errors = error.response.data.errors;
                        var keys = Object.keys(errors);
                        if (keys.length > 0) {
                           for (var i = 0; i < keys.length; i++) {
                              var key = keys[i]
                              var error = errors[key];
                              var slugTitle = key.replace('_',' ');
                              $this.responseHandle('warning', slugTitle+' '+error);
                           }
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
         axios.delete(siteIndexURL+'/v1/investment/investment/delete/'+id+'/')
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

         axios.get(siteIndexURL+'/v1/investment/'+client_id+'/investment/')
            .then((result) => {
               if (result.data.success == true) {
                  this.tabsTableDatas = [];
                  var rows = result.data.data;
                  for (var i = 0; i < rows.length; i++) {
                     var row = rows[i];
                     var insurance_type = row.investment_type;
                     var tabKey = this.getTabsArrayKey(insurance_type);
                     if (this.tabsTableDatas[tabKey] == undefined) {
                        this.tabsTableDatas[tabKey] = [];
                     }
                     if (this.tabTotalPrice[tabKey] == undefined) {
                        this.tabTotalPrice[tabKey] = [];
                     }
                     if (row.managed_by == 1) {
                        row.managed_by = true
                     } else {
                        row.managed_by = false
                     }
                     this.tabTotalPrice[tabKey].push(row.principal_paid);
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
         var $tabs = ['','UNIT_TRUST', 'STRUCTURED_DEPOSIT', 'STOCKS', 'STRUCTURED_NOTES', 'CORPORATE_BONDS', 'RETAILS_BONDS', 'ETF', 'HEDGED_FUNDS', 'OTHERS'];
         return $tabs[$indexID];
      },
      arraySearch: function(val) {
         var arr = ['','UNIT_TRUST', 'STRUCTURED_DEPOSIT', 'STOCKS', 'STRUCTURED_NOTES', 'CORPORATE_BONDS', 'RETAILS_BONDS', 'ETF', 'HEDGED_FUNDS', 'OTHERS'];
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