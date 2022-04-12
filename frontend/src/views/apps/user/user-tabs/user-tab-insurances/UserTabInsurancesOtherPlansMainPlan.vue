<template>
   <div class="vx-row box_outter">
      <vx-card>
         <div class="mt-5 user_no_mg">
            <vs-collapse accordion>
               <vs-collapse-item> 
                  <div class="tab_outter" slot="header">
                     <span class="user_hd">Life Plan(Main Plan)</span><span class="user_premium">Total Premium Amount : {{sumArray(tabTotalPrice) | PRICEFORMAT}}</span>
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
      <vs-popup fullscreen class="holamundo" :title="'Life Plan(Main Plan)'" :active.sync="popupActive">
         <form v-on:submit.prevent>
            <h4>Policy Details</h4>
            <div class="vx-row">
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                        data-vv-as="Insured name"
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
                        data-vv-as="Premium  Amount By Cash"
                        v-model="activeyKeyFormData.premium_amount_by_cash"
                        name="premium_amount_by_cash"
                        label="Premium  Amount By Cash"
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
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Total tenure"
                        v-model="activeyKeyFormData.total_tenure"
                        name="total_tenure"
                        label="Total tenure"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('total_tenure')">{{ errors.first('total_tenure') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-clock" icon-before icon-no-border
                        data-vv-as="Date of Maturity"
                        v-model="date_of_maturity"
                        readonly
                        name="date_of_maturity"
                        label="Date of Maturity"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('date_of_maturity')">{{ errors.first('date_of_maturity') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Tenure remaining"
                        readonly
                        v-model="tenure_remaining"
                        name="tenure_remaining"
                        label="Tenure remaining"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('tenure_remaining')">{{ errors.first('tenure_remaining') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-sliders" icon-before icon-no-border
                        data-vv-as="Premium Term"
                        v-model="activeyKeyFormData.premium_term"
                        :readonly="activeyKeyFormData.mode_of_payment == 'LPS' ? true : false"
                        name="premium_term"
                        label="Premium Term"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('premium_term')">{{ errors.first('premium_term') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Premium Paid Till Date(as per Anniversary date)"
                        v-model="premium_paid_till_date"
                        readonly
                        name="premium_paid_till_date"
                        label="Premium paid till date"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('premium_paid_till_date')">{{ errors.first('premium_paid_till_date') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-clock" icon-before icon-no-border
                        data-vv-as="Premium End Date"
                        v-model="premium_end_date"
                        readonly
                        name="premium_end_date"
                        label="Premium End Date"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('premium_end_date')">{{ errors.first('premium_end_date') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Committed amount"
                        v-model="committed_amount"
                        readonly
                        name="committed_amount"
                        label="Committed amount"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('committed_amount')">{{ errors.first('committed_amount') }}</span>
                  </div>
               </div>
            </div>
               <h4>Bonus & Cash Value Details</h4>
            <div class="vx-row">
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter margin_tp_10">
                     <label>Date of First Payout Start/Drawdown Age </label>
                        <datepicker                          
                           class="selectExample w-full"
                           :format="'yyyy-MM-dd'"
                           name="date_when_first_payout_start"
                           :typeable="true"
                           placeholder="Date When First Payout Start/Drawdown Age"
                           icon-pack="feather" icon="icon-edit-2" icon-before
                           v-model="activeyKeyFormData.date_when_first_payout_start"
                           data-vv-as="Date When First Payout Start/Drawdown Age"></datepicker>
                     <span class="text-danger text-sm" v-show="errors.has('date_when_first_payout_start')">{{ errors.first('date_when_first_payout_start') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-select
                        placeholder="Search and select"
                        v-validate="'required'"
                        class=" "
                        style="width: 100%;"
                        label="Cash Bonus Option"
                        name="cash_bonus_option"
                        vs-multiple
                        autocomplete
                        v-model="activeyKeyFormData.cash_bonus_option"
                        >
                        <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in definedStrings.insurance.cash_bonus_optionOptions" />
                     </vs-select>
                     <span class="text-danger text-sm" v-show="errors.has('cash_bonus_option')">{{ errors.first('cash_bonus_option') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Cash Bonus Amount"
                        v-model="activeyKeyFormData.cash_bonus_amount"
                        name="cash_bonus_amount"
                        label="Cash Bonus Amount"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('cash_bonus_amount')">{{ errors.first('cash_bonus_amount') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-sliders" icon-before icon-no-border
                        data-vv-as="Minimum Commitment Period"
                        v-model="activeyKeyFormData.minimum_commitment_period"
                        name="minimum_commitment_period"
                        label="Minimum Commitment Period"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('minimum_commitment_period')">{{ errors.first('minimum_commitment_period') }}</span>
                  </div>
               </div>
              <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Nett Cash Value Including Accumulated Cash Bonus If Any"
                        v-model="activeyKeyFormData.net_cash_value_include_cash_bonus"
                        name="net_cash_value_include_cash_bonus"
                        label="Nett Cash Value Including Accumulated Cash Bonus If Any($)"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('net_cash_value_include_cash_bonus')">{{ errors.first('net_cash_value_include_cash_bonus') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        icon-pack="feather" icon="icon-sliders" icon-before icon-no-border
                        data-vv-as="Expected Yield To maturity if Wholelife specify (%)"
                        v-model="activeyKeyFormData.expected_yield_to_maturity_if_whole_specify"
                        name="expected_yield_to_maturity_if_whole_specify"
                        label="Expected Yield To maturity if Wholelife specify (%)"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('expected_yield_to_maturity_if_whole_specify')">{{ errors.first('expected_yield_to_maturity_if_whole_specify') }}</span>
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
                        v-model="activeyKeyFormData.accident_death"
                        name="accident_death"
                        label="Accidental death"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('accident_death')">{{ errors.first('accident_death') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Death"
                        v-model="activeyKeyFormData.death"
                        name="death"
                        label="Death"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('death')">{{ errors.first('death') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="TPD($)"
                        v-model="activeyKeyFormData.tpd"
                        name="tpd"
                        label="TPD($)"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('tpd')">{{ errors.first('tpd') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Early Critical Illness($)"
                        v-model="activeyKeyFormData.early_critical_illness"
                        name="early_critical_illness"
                        label="Early Critical Illness($)"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('early_critical_illness')">{{ errors.first('early_critical_illness') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Major Critical Illness($)"
                        v-model="activeyKeyFormData.major_critical_illness"
                        name="major_critical_illness"
                        label="Major Critical Illness($)"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('major_critical_illness')">{{ errors.first('major_critical_illness') }}</span>
                  </div>
               </div>
               <div class="vx-col sm:w-1/3 w-full" >
                  <div class="vx-row box_outter">
                     <vs-input
                        v-validate="'required'"
                        icon-pack="feather" icon="icon-dollar-sign" icon-before icon-no-border
                        data-vv-as="Terminal Illness($)"
                        v-model="activeyKeyFormData.terminal_illness"
                        name="terminal_illness"
                        label="Terminal Illness($)"
                        class="w-full mt-5"/>
                     <span class="text-danger text-sm" v-show="errors.has('terminal_illness')">{{ errors.first('terminal_illness') }}</span>
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
         activeyKeyFormData: { },
         tabsTableDatas: [],
         tabTotalPrice: [],
         fieldTotalPrice:[],
         insurance_type: 3
      }
   },
   computed: {
      total_premium_if_throughout_tenure: function(){
         if (this.activeyKeyFormData.mode_of_payment == 'LPS') {
            return this.getTotalPremiumAmountByMode();
         }
         return (this.getTotalPremiumAmount()*this.activeyKeyFormData.total_tenure);
      },
      premium_paid_till_date: function(){
         if (!this.activeyKeyFormData.date_in_force) {
            return 0;
         }
         if (this.activeyKeyFormData.mode_of_payment == 'LPS') {
            return this.getTotalPremiumAmountByMode();
         }
         var paidMonth;
         if (this.activeyKeyFormData.mode_of_payment == 'MNT') {  
            paidMonth = this.monthDiff(new Date(), new Date(this.activeyKeyFormData.date_in_force));
         } else {
            if (!this.activeyKeyFormData.premium_term) {
               return 0;
            }
            paidMonth = this.activeyKeyFormData.premium_term - this.getRemainingTenure(this.activeyKeyFormData.premium_term, 'yearly');
         }
         
         paidMonth = parseInt(paidMonth)
         return this.getTotalPremiumAmountByMode()*paidMonth;
      },
      tenure_remaining: function(){
         if (!this.activeyKeyFormData.total_tenure) {
            return 0;
         }
         return this.getRemainingTenure(this.activeyKeyFormData.total_tenure, 'yearly');
      },
      premium_end_date: function(){
         if (this.activeyKeyFormData.mode_of_payment == 'LPS') {
            this.activeyKeyFormData.premium_term = 0;
            return 'N/A';
         }
         if (!this.activeyKeyFormData.date_in_force || !this.activeyKeyFormData.premium_term) {
            return;
         }
         return this.formatDate2(this.addMonths(new Date(this.activeyKeyFormData.date_in_force), this.activeyKeyFormData.premium_term, 'yearly'))
      },
      date_of_maturity: function(){
         if (!this.activeyKeyFormData.date_in_force || !this.activeyKeyFormData.total_tenure) {
            return;
         }
         return this.formatDate2(this.addMonths(new Date(this.activeyKeyFormData.date_in_force), this.activeyKeyFormData.total_tenure, 'yearly'))
      },
      committed_amount: function(){
         if (this.activeyKeyFormData.mode_of_payment == 'LPS') {
            return this.getTotalPremiumAmount()
         }
         if (!this.activeyKeyFormData.premium_term) {
            return 0;   
         }
         return this.getTotalPremiumAmount()*parseFloat(this.activeyKeyFormData.premium_term)
      }
   },
   methods: {
      resetForm: function()
      {
         var formField = {
            insured_name:'',
            policy_holder:'',
            product_name:'',
            insurer:'',
            policy_number:'',
            mode_of_payment:'',
            premium_amount_by_cash:'',
            date_in_force:'',
            date_of_maturity:'',
            premium_term:0,
            total_tenure:0,
            tenure_remaining:0,
            premium_end_date:'',
            accident_death:'',
            death:'',
            date_when_first_payout_start:'',
            cash_bonus_option:'',
            cash_bonus_amount:'',
            committed_amount:'',
            premium_paid_till_date:0,
            net_cash_value_include_cash_bonus:'',
            expected_yield_to_maturity_if_whole_specify:'',
            minimum_commitment_period:'',
            tpd:'',
            early_critical_illness:'',
            major_critical_illness:'',
            terminal_illness:'',
            remarks:'',
            managed_by:false
         }
         this.activeyKeyFormData = formField
      },
      getTotalPremiumAmountByMode: function()
      {
         if (this.activeyKeyFormData.mode_of_payment == 'MNT') {
            return this.getTotalPremiumAmount() / 12;
         } else{
            return this.getTotalPremiumAmount()
         }
      },
      getTotalPremiumAmount: function()
      {
         return (this.activeyKeyFormData.mode_of_payment == 'MNT'?(this.activeyKeyFormData.premium_amount_by_cash*12):(this.activeyKeyFormData.mode_of_payment == 'ANL' || this.activeyKeyFormData.mode_of_payment == 'LPS'?this.activeyKeyFormData.premium_amount_by_cash:0));
      },
      getRemainingTenure: function(premium_term = 0, forWhat = ''){
         if (!this.activeyKeyFormData.date_in_force) {
            return 0;
         }
         var newDate = this.addMonths(new Date(this.activeyKeyFormData.date_in_force), premium_term, forWhat);
         var month = "" + (newDate.getMonth() + 1);
         var day = "" + newDate.getDate();
         var year = newDate.getFullYear();
         if (month.length < 2) month = "0" + month;
         if (day.length < 2) day = "0" + day;
         var newGetDate = [year, month].join(", ");
         var lastDate = [year, month, day].join("");
         var date_in_force = new Date(this.activeyKeyFormData.date_in_force);
         var nmonth = "" + (date_in_force.getMonth() + 1);
         var nday = "" + date_in_force.getDate();
         var nyear = date_in_force.getFullYear();
         if (nmonth.length < 2) nmonth = "0" + nmonth;
         if (nday.length < 2) nday = "0" + nday;
         var newNGetDate = [nyear, nmonth].join(", ");
         var todayDate = new Date();
         var tmonth = "" + (todayDate.getMonth() + 1);
         var tday = "" + todayDate.getDate();
         var tyear = todayDate.getFullYear();
         if (tmonth.length < 2) tmonth = "0" + tmonth;
         if (tday.length < 2) tday = "0" + tday;
         var currentDate = [tyear, tmonth, tday].join("");

         if (lastDate < currentDate) {
            return 0
         }
         newNGetDate = [tyear, tmonth, tday].join(", ");
         if (this.activeyKeyFormData.mode_of_payment == 'ANL' || this.activeyKeyFormData.mode_of_payment == 'LPS' || forWhat == 'yearly') {
            var stringYear = premium_term - (tyear - nyear);
            stringYear = stringYear.toString();
            stringYear = stringYear.replace('-', '');
            if (this.checkSelectdDate(forWhat) == true) {
               stringYear = stringYear - 1;
            }
            return stringYear;
         }
         return this.monthDiff(new Date(newNGetDate), new Date(newGetDate), 'minus');
      },
      monthDiff: function(dateFrom, dateTo, action = 'plus') {
         var getMonths = dateTo.getMonth() - dateFrom.getMonth() + (12 * (dateTo.getFullYear() - dateFrom.getFullYear()));
         
         var stringMOnth = getMonths.toString();
         stringMOnth = stringMOnth.replace('-', '');

         var nmonth = "" + (dateTo.getMonth() + 1);
         var nday = "" + dateTo.getDate();
         var nyear = dateTo.getFullYear();
         if (nmonth.length < 2) nmonth = "0" + nmonth;
         if (nday.length < 2) nday = "0" + nday;
         var fromGetDate = [nyear, nmonth, nday].join("");
         var fmonth = "" + (dateFrom.getMonth() + 1);
         var fday = "" + dateFrom.getDate();
         var fyear = dateFrom.getFullYear();
         if (fmonth.length < 2) fmonth = "0" + fmonth;
         if (fday.length < 2) fday = "0" + fday;
         var currentDate = [fyear, fmonth, fday].join(""); 
         if (fromGetDate > currentDate) {
            return 0;
         }
         if (fyear == nyear && fmonth == nmonth) {
            if (nday < fday) {
               return 1;
            } else {
               return 0
            }
         }
         if (this.checkSelectdDate('monthly') == true) {
            stringMOnth = parseInt(stringMOnth) + 1;            
         }
         return stringMOnth
      },
      checkSelectdDate: function(forWhat)
      {
         var todayDate = new Date();
         var nmonth = "" + (todayDate.getMonth() + 1);
         var nday = "" + todayDate.getDate();
         var nyear = todayDate.getFullYear();
         if (nmonth.length < 2) nmonth = "0" + nmonth;
         if (nday.length < 2) nday = "0" + nday;
         var currentDate = [nyear, nmonth, nday].join("");

         var forceDate = new Date(this.activeyKeyFormData.date_in_force);
         var fmonth = "" + (forceDate.getMonth() + 1);
         var fday = "" + forceDate.getDate();
         var fyear = forceDate.getFullYear();
         if (fmonth.length < 2) fmonth = "0" + fmonth;
         if (fday.length < 2) fday = "0" + fday;
         var fromGetDate = [fyear, fmonth, fday].join("");  
         if (this.activeyKeyFormData.mode_of_payment == 'ANL' || this.activeyKeyFormData.mode_of_payment == 'LPS' || forWhat == 'yearly') {
            if (forceDate < todayDate && fmonth <= nmonth && fday <= nday) {
               return true;
            }
         } else {
            if (forceDate < todayDate && fday <= nday) {
               return true;
            }
         }
         return false;
      },
      addMonths: function(date, months, forWhat) {
          var d = date.getDate();
          if (this.activeyKeyFormData.mode_of_payment == 'ANL' || this.activeyKeyFormData.mode_of_payment == 'LPS' || forWhat == 'yearly') {
            months = parseInt(months);
            date.setFullYear(date.getFullYear() + (months));
            return date
          } else {
            date.setMonth(date.getMonth() + +(months-1));
            if (date.getDate() != d) {
              date.setDate(0);
            }
            return date;
          }
      },
      openModalPopup: function () {
         this.resetForm()
         this.popupActive = true;
      },
      openEditModalPopup: function (row) {
         this.activeyKeyFormData = row;
         this.popupActive = true;
      },
      saveForm: function () {
         this.$validator.validateAll().then(result => {
            if (result) {
               
               if (this.activeyKeyFormData.date_in_force != undefined && this.activeyKeyFormData.date_in_force != '') {
                  this.activeyKeyFormData.date_in_force = this.formatDate2(this.activeyKeyFormData.date_in_force);
               }
               this.activeyKeyFormData.tenure_remaining = this.tenure_remaining
               this.activeyKeyFormData.premium_paid_till_date = this.premium_paid_till_date
               this.activeyKeyFormData.premium_end_date = this.premium_end_date
               this.activeyKeyFormData.committed_amount = this.committed_amount
               if (this.activeyKeyFormData.premium_end_date != undefined && this.activeyKeyFormData.premium_end_date != '') {
                  this.activeyKeyFormData.premium_end_date = this.formatDate2(this.activeyKeyFormData.premium_end_date);
               }
               this.activeyKeyFormData.date_of_maturity = this.date_of_maturity
               if (this.activeyKeyFormData.date_of_maturity!= undefined && this.activeyKeyFormData.date_of_maturity != '') {
                  this.activeyKeyFormData.date_of_maturity = this.formatDate2(this.activeyKeyFormData.date_of_maturity);
               }
               if (this.activeyKeyFormData.date_when_first_payout_start != undefined && this.activeyKeyFormData.date_when_first_payout_start != '') {
                  this.activeyKeyFormData.date_when_first_payout_start = this.formatDate2(this.activeyKeyFormData.date_when_first_payout_start);
               }
               if (this.activeyKeyFormData.mode_of_payment == 'LPS') {
                  this.activeyKeyFormData.premium_end_date = '';
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
                  var url = '/v1/create_insurance_other_plans/'+this.insurance_type+'/';
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
                  
                  axios.put(siteIndexURL+'/v1/insurance_other_plans/edit/'+this.insurance_type+'/'+edit_id+'/', dataString)
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
         axios.delete(siteIndexURL+'/v1/insurance_other_plans/delete/'+id+'/')
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

         axios.get(siteIndexURL+'/v1/'+client_id+'/insurance_other_plans/')
            .then((result) => {
               if (result.data.success == true) {
                  this.tabsTableDatas = [];
                  var rows = result.data.data;
                  this.tabTotalPrice = [];
                  for (var i = 0; i < rows.length; i++) {
                     var row = rows[i];
                     if (row.insurance_type == this.insurance_type) {
                        var tabTotalPrice = (row.mode_of_payment == 'MNT'?(row.premium_amount_by_cash*12):(row.mode_of_payment == 'ANL' || row.mode_of_payment == 'LPS'?parseFloat(row.premium_amount_by_cash):0));
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