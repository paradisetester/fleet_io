<template>
   <div class="vx-row box_outter">
      <vx-card>
         <div class="mt-5 user_no_mg">
            <vs-collapse accordion>
               <vs-collapse-item> 
                  <div class="tab_outter" slot="header">
                     <span class="user_hd">Personal Accident</span><span class="user_premium">Total Premium Amount : {{sumArray(tabTotalPrice) | PRICEFORMAT}}</span>
                  </div>
                  <div class="buttonControl">
                     <vs-button class="w-full ml-auto mt-6 sm:w-1/1" v-on:click="openModalPopup">Add</vs-button>
                  </div>
                  <div class="vx-row">
                     <div class="vs-component vs-con-table stripe vs-table-primary clt_manage">
                        <div class="con-tablex vs-table--content">
                           <div class="vs-con-tbody vs-table--tbody ">
                              <table class="vs-table vs-table--tbody-table">
                                 <thead class="vs-table--thead">
                                    <tr>
                                       <th><div class="vs-table-text">Insured name</div></th>
                                       <th><div class="vs-table-text">Policy Holder</div></th>
                                       <th><div class="vs-table-text">Insurer</div></th>
                                       <th><div class="vs-table-text">Mode of payment</div></th>
                                       <th><div class="vs-table-text">Premium amount by cash</div></th>
                                       <th><div class="vs-table-text">Date of renewal</div></th>
                                       <th><div class="vs-table-text">Actions</div></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr class="tr-values vs-table--tr tr-table-state-null" v-for="(tabsTableData, keyIndex) in tabsTableDatas" :key="keyIndex">
                                       <td class="td vs-table--td">{{tabsTableData.insured_name}}</td>
                                       <td class="td vs-table--td">{{tabsTableData.policy_holder}}</td>
                                       <td class="td vs-table--td">{{tabsTableData.insurer}}</td>
                                       <td class="td vs-table--td">{{definedStrings.insurance.mode_of_payment[tabsTableData.mode_of_payment]}}</td>
                                       <td class="td vs-table--td">{{(fieldTotalPrice[tabsTableData.id]) | PRICEFORMAT}}</td>
                                       <td class="td vs-table--td" v-if="tabsTableData.mode_of_payment == 'LPS'">N/A</td>
                                       <td class="td vs-table--td" v-if="tabsTableData.mode_of_payment != 'LPS'">{{tabsTableData.date_of_renewal | YYYYMMDD}}</td>
                                       <td class="td vs-table--td">
                                          <div class="demo-alignment">
                                             <vs-button color="success" @click="openEditModalPopup(tabsTableData)" type="filled" icon-pack="feather" icon="icon-edit-2"></vs-button>
                                             <vs-button color="warning" @click="deleteRecord(tabsTableData.id)" type="filled" icon-pack="feather" icon="icon-trash-2"></vs-button>
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
      <vs-popup fullscreen class="holamundo" :title="'Personal Accident'" :active.sync="popupActive">
         <form v-on:submit.prevent>
            <h4>Policy Details</h4>
            <div class="vx-row">
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        data-vv-as="Insured Name"
                        v-model="activeyKeyFormData.insured_name"
                        name="insured_name"
                        label="Insured name"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('insured_name')">{{ errors.first('insured_name') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        data-vv-as="Policy Holder"
                        v-model="activeyKeyFormData.policy_holder"
                        name="policy_holder"
                        label="Policy Holder"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('policy_holder')">{{ errors.first('policy_holder') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        data-vv-as="Product name"
                        v-model="activeyKeyFormData.product_name"
                        name="product_name"
                        label="Product name"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('product_name')">{{ errors.first('product_name') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        data-vv-as="Insurer"
                        v-model="activeyKeyFormData.insurer"
                        name="insurer"
                        label="Insurer"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('insurer')">{{ errors.first('insurer') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        data-vv-as="Policy number"
                        v-model="activeyKeyFormData.policy_number"
                        name="policy_number"
                        label="Policy number"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('policy_number')">{{ errors.first('policy_number') }}</span>
                  </div>
               </div>
            </div>
            <h4>Premium Details</h4>
            <div class="vx-row">
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-select
                        placeholder="Search and select"
                        v-validate="'required'"
                        data-vv-as="Mode of payment"
                        class=" "
                        style="width: 100%;"
                        label="Mode of payment"
                        name="mode_of_payment"
                        vs-multiple
                        autocomplete
                        v-model="activeyKeyFormData.mode_of_payment"
                        >
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in definedStrings.insurance.mode_of_paymentOptions" />
                     </vs-select>
                     <span class="text-danger text-sm" v-show="errors.has('mode_of_payment')">{{ errors.first('mode_of_payment') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Premium amount by cash"
                        v-model="activeyKeyFormData.premium_amount_by_cash"
                        name="premium_amount_by_cash"
                        label="Premium amount by cash"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('premium_amount_by_cash')">{{ errors.first('premium_amount_by_cash') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter margin_tp_10">
                     <vs-input
                        readonly =""
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        :label="(activeyKeyFormData.mode_of_payment == 'LPS'? 'Total Premium Amount':'Total Premium Amount (Per annum)')"
                        class="w-full mt-5" :value="getTotalPremiumAmount() | PRICEFORMAT"/>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter margin_tp_10">
                     <label>Date in force</label>
                        <datepicker                          
                           class="selectExample w-full"
                           :format="'yyyy-MM-dd'"
                           name="date_in_force"
                           placeholder="Date in force"
                           icon-pack="feather" icon="icon-edit-2" icon-before
                           v-model="activeyKeyFormData.date_in_force"
                           v-validate="'required'"
                           data-vv-as="Date in force"></datepicker>
                     <span class="text-danger text-sm" v-show="errors.has('date_in_force')">{{ errors.first('date_in_force') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-clock" icon-before icon-no-border
                        data-vv-as="Date of Renewal(as per Anniversary date)"
                        v-model="date_of_renewal"
                        readonly
                        name="date_of_renewal"
                        label="Date of Renewal(as per Anniversary date)"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('date_of_renewal')">{{ errors.first('date_of_renewal') }}</span>
                  </div>
               </div>
            </div>
            <h4>Scope Of Coverage</h4>
            <div class="vx-row">
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Accidental death"
                        v-model="activeyKeyFormData.accidental_death"
                        name="accidental_death"
                        label="Accidental death"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('accidental_death')">{{ errors.first('accidental_death') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Accidental dismemberment"
                        v-model="activeyKeyFormData.accidental_dismemberment"
                        name="accidental_dismemberment"
                        label="Accidental dismemberment"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('accidental_dismemberment')">{{ errors.first('accidental_dismemberment') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Medical expenses limit"
                        v-model="activeyKeyFormData.medical_expenses_limit"
                        name="medical_expenses_limit"
                        label="Medical expenses limit"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('medical_expenses_limit')">{{ errors.first('medical_expenses_limit') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-sliders" icon-before icon-no-border
                        data-vv-as="Inflation Rate %"
                        v-model="activeyKeyFormData.inflation_rate"
                        name="inflation_rate"
                        label="Inflation Rate %"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('inflation_rate')">{{ errors.first('inflation_rate') }}</span>
                  </div>
               </div>
            </div>   
               <div class="vx-row">
                  <div class="vx-col sm:w-1/3 w-full" >
                     <div class="vx-row box_outter">
                        <vs-textarea
                           icon-pack="feather" icon="icon-edit-2" icon-before
                           data-vv-as="Remarks"
                           v-model="activeyKeyFormData.remarks"
                           name="remarks"
                           label="Remarks"
                           class="w-full" />
                        <span class="text-danger text-sm" v-show="errors.has('remarks')">{{ errors.first('remarks') }}</span>
                     </div>
                  </div>
                  <div class="vx-col sm:w-1/3 w-full" >
                     <div class="vx-row box_outter">
                        <ul class="centerx">
                            <li>
                              <vs-checkbox v-model="activeyKeyFormData.managed_by" :value="1">Managed By Self</vs-checkbox>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            <div class="vx-row">
               <div class="vx-col w-full">
                  <vs-button class="mr-3 mb-2" @click.prevent="saveForm">Submit</vs-button>
                  <vs-button color="warning" type="border" class="mb-2" @click="resetForm">Reset</vs-button>
               </div>
            </div>
         </form>
      </vs-popup>
   </div>
</template>
<script type="text/javascript">
import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker';
import axios from 'axios';
import {API, siteIndexURL} from '../../../../../axios'
import definedStrings from '../../../../../definedStrings'
export default {
	name: 'user-tab-insurances-renewables',
	components: {
		'v-select': vSelect,
		'datepicker': Datepicker
	},
	data() {
		return {
         definedStrings: {},
         client_id:0,
			popupActive: false,
			activeyKeyFormData: {},
			tabsTableDatas: [],
         tabTotalPrice: [],
         fieldTotalPrice:[],
         insurance_type: 1
		}
	},
	computed: {
      date_of_renewal: function (){
         if (this.activeyKeyFormData.mode_of_payment == 'LPS') {
            return 'N/A';
         }
         if (!this.activeyKeyFormData.date_in_force) {
            return;
         }
         return this.formatDate2(this.getRemainingTenureYearly())
      }
	},
	methods: {
      getRemainingTenureYearly: function(){
         if (!this.activeyKeyFormData.date_in_force) {
            return 0;
         }
         var date_in_force = new Date(this.activeyKeyFormData.date_in_force);
         var nmonth = "" + (date_in_force.getMonth() + 1);
         var nday = "" + date_in_force.getDate();
         var nyear = date_in_force.getFullYear();
         if (nmonth.length < 2) nmonth = "0" + nmonth;
         if (nday.length < 2) nday = "0" + nday;
         var newNGetDate = [nyear, nmonth].join("");

         var todayDate = new Date();
         var tmonth = "" + (todayDate.getMonth() + 1);
         var tday = "" + todayDate.getDate();
         var tyear = todayDate.getFullYear();
         if (tmonth.length < 2) tmonth = "0" + tmonth;
         if (tday.length < 2) tday = "0" + tday;
         var currentDate = [tyear, tmonth, tday].join("");
         var forceDate = [nyear, nmonth, nday].join("");

         if (currentDate > forceDate) {
            if (tyear > nyear) {
               if (tday >= nday) {
                  if (nyear < tyear) {
                     var addYear = 0;
                     if ((tmonth+''+tday) >= (nmonth+''+nday)) {
                        addYear = tyear - nyear;
                        forceDate = [(nyear+1)+addYear, nmonth, nday].join("-");
                     } else {
                        forceDate = [(tyear)+addYear, nmonth, nday].join("-");
                     }
                  } else{
                     forceDate = [(nyear + 1), nmonth, nday].join("-");
                  }                  
               } else {
                  forceDate = [(tyear), nmonth, nday].join("-");
               }           
               return new Date(forceDate);
            }
            forceDate = [(tyear+1), nmonth, nday].join("-");
            return new Date(forceDate);
         }
         forceDate = [nyear, nmonth, nday].join("-");
         return new Date(forceDate);
      },
      getTotalPremiumAmount: function()
      {
         return (this.activeyKeyFormData.mode_of_payment == 'MNT'?((this.activeyKeyFormData.premium_amount_by_cash*12)):(this.activeyKeyFormData.mode_of_payment == 'ANL' || this.activeyKeyFormData.mode_of_payment == 'LPS'?(this.activeyKeyFormData.premium_amount_by_cash):0));
      },
      resetForm: function()
      {
         this.activeyKeyFormData = {
            insured_name:'',
            policy_holder:'',
            product_name:'',
            insurer:'',
            policy_number:'',
            mode_of_payment:'',
            premium_amount_by_cash:'',
            date_in_force:'',
            date_of_renewal:'',
            scope_of_coverage:0,
            accidental_death:'',
            accidental_dismemberment:'',
            medical_expenses_limit:'',
            inflation_rate:'',
            remarks:'',
            managed_by:false
         }
      },
		openModalPopup: function () {
         this.resetForm();
			this.popupActive = true;
		},
      openEditModalPopup: function (row) {
         if (row.date_of_renewal) {
            row.date_of_renewal = this.formatDate2(row.date_of_renewal);
         }
         this.activeyKeyFormData = row;
         this.popupActive = true;
      },
		saveForm: function () {
			this.$validator.validateAll().then(result => {
				if (result) {
               
               if (this.activeyKeyFormData.date_in_force != undefined && this.activeyKeyFormData.date_in_force != '') {
                  this.activeyKeyFormData.date_in_force = this.formatDate2(this.activeyKeyFormData.date_in_force);
               }
               this.activeyKeyFormData.date_of_renewal = this.date_of_renewal;
               if (this.activeyKeyFormData.date_of_renewal != undefined && this.activeyKeyFormData.date_of_renewal != '') {
                  this.activeyKeyFormData.date_of_renewal = this.formatDate2(this.activeyKeyFormData.date_of_renewal);
               }
               if (this.activeyKeyFormData.mode_of_payment == 'LPS') {
                  this.activeyKeyFormData.date_of_renewal = '';
               }
               var $this = this;
               this.activeyKeyFormData.profile_id = this.client_id;
               this.activeyKeyFormData.insurance_type = this.insurance_type;
               this.activeyKeyFormData.total_premium_amount = this.getTotalPremiumAmount();
               var dataString = this.activeyKeyFormData;
               if (this.activeyKeyFormData.managed_by == true) {
                  dataString.managed_by = 1;
               } else {
                  dataString.managed_by = 2;
               }

               var edit_id = this.activeyKeyFormData.id;

               if (edit_id == undefined) {
                  var newDataString = Object.assign({}, this.activeyKeyFormData);
                  if (this.activeyKeyFormData.managed_by == true) {
                     newDataString.managed_by = 1;
                  } else {
                     newDataString.managed_by = 2;
                     this.activeyKeyFormData.managed_by = false
                  }
                  var url = '/v1/create_insurance_renewables/'+this.insurance_type+'/';
                  axios.post(siteIndexURL+url, newDataString)
                  .then((result) => {
                     $this.responseHandle('success', result.data.message);
                     this.getInsuranceData();
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
                  
                  axios.put(siteIndexURL+'/v1/insurance_renewables/edit/'+this.insurance_type+'/'+edit_id+'/', dataString)
                  .then((result) => {
                     $this.responseHandle('success', result.data.message);
                     this.getInsuranceData();
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
         axios.delete(siteIndexURL+'/v1/insurance_renewables/delete/'+id+'/')
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

         axios.get(siteIndexURL+'/v1/'+client_id+'/insurance_renewables/')
            .then((result) => {
               if (result.data.success == true) {
                  this.tabsTableDatas = [];
                  var rows = result.data.data;
                  this.tabTotalPrice = [];
                  for (var i = 0; i < rows.length; i++) {
                     var row = rows[i];
                     if (row.insurance_type == this.insurance_type) {
                     	var tabTotalPrice = (row.mode_of_payment == 'MNT'?((row.premium_amount_by_cash*12)):(row.mode_of_payment == 'ANL' || row.mode_of_payment == 'LPS'?(row.premium_amount_by_cash):0));
                        if (this.fieldTotalPrice[row.id] == undefined) {
                           this.fieldTotalPrice[row.id] = [];
                        }
                        this.fieldTotalPrice[row.id] = tabTotalPrice;
                        this.tabTotalPrice.push(tabTotalPrice);
                        if (row.managed_by == 1) {
                           row.managed_by = true;
                        } else {
                           row.managed_by = false;
                        }
                        this.tabsTableDatas.push(row);
                     }                       
                  }                            
               }
            }).catch(function (error) {
               if (error.response.data.detail) {
                  $this.responseHandle('warning', error.response.data.detail);
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
      this.definedStrings = definedStrings
      this.getInsuranceData();     
   }
}
</script>