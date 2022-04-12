<!-- =========================================================================================
  File Name: UserManage.vue
  Description: User Edit Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-user-edit" class="tabs_icon_out">
   <form-wizard
      ref="checkoutWizard"
      color="rgba(var(--vs-primary), 1)"
      :title="null"
      :subtitle="null"
      :hide-buttons="true">
      <!-- <div v-if="tenant_id=='fleet_admin'">
        <tab-content title="Admin Basic Profile" icon="feather icon-user" class="mb-5 ">
         <AdminBasicInfo></AdminBasicInfo>
      </tab-content>
      </div> -->
      <tab-content title="Basic Profile" icon="feather icon-user" class="mb-5 ">
         <user-tab-basic-profile></user-tab-basic-profile>
      </tab-content>
      <tab-content title="Insurances" icon="feather icon-umbrella" class="mb-5 ">
         <user-tab-insurances></user-tab-insurances>
      </tab-content>
      <tab-content title="Investments" icon="feather icon-bar-chart" class="mb-5">
         <user-tab-investments></user-tab-investments>
      </tab-content>
      <tab-content title="CPF" icon="fas fa-funnel-dollar" class="mb-5">
         <user-tab-cpf></user-tab-cpf>
      </tab-content>
      <tab-content title="Mortgage" icon="fas fa-dollar-sign" class="mb-5">
         <user-tab-mortgages></user-tab-mortgages>
      </tab-content>
      <tab-content title="Documents" icon="feather icon-file-text" class="mb-5">
         <user-tab-documents></user-tab-documents>
      </tab-content>
      <tab-content title="Broadcast" icon="fas fa-broadcast-tower" class="mb-5">
         <user-tab-broadcast></user-tab-broadcast>
      </tab-content>
      <tab-content title="Expenditure" icon="fas fa-money-bill-wave" class="mb-5">
         <user-tab-cash-flow></user-tab-cash-flow>
      </tab-content>
      <tab-content title="SRS" icon="fas fa-money-bill" class="mb-5">
         <user-tab-srs></user-tab-srs>
      </tab-content>
      <tab-content title="Notes" icon="fas fa-file-alt" class="mb-5">
         <user-tab-notes></user-tab-notes>
      </tab-content>
      <tab-content title="CashFlow" icon="fas fa-wallet" class="mb-5">
         <user-tab-cash-flow-overview></user-tab-cash-flow-overview>
      </tab-content>
   </form-wizard>
  </div>
</template>

<script>
import { FormWizard, TabContent } from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

import UserTabBroadcast from './user-tabs/UserTabBroadcast.vue'
import UserTabBasicProfile from './user-tabs/user-tab-basic-profile/UserTabBasicProfile.vue'
import UserTabCashFlow from './user-tabs/user-tab-cachflow/UserTabCashFlow.vue'
import UserTabCPF from './user-tabs/user-tab-cpf/UserTabCPF.vue'
import UserTabDocuments from './user-tabs/user-tab-document/UserTabDocuments.vue'
import UserTabInsurances from './user-tabs/user-tab-insurances/UserTabInsurances.vue'
import UserTabInvestments from './user-tabs/user-tab-investment/UserTabInvestments.vue'
import UserTabMortgages from './user-tabs/user-tab-mortgage/UserTabMortgages.vue'
import UserTabSRS from './user-tabs/user-tab-SRS/UserTabSRS.vue'
import UserTabNotes from './user-tabs/user-tab-notes/UserTabNotes.vue'
import UserTabCashFlowOverView from './user-tabs/user-tab-cachflow-overview/UserTabCashFlowOverView.vue'
// import UserAdminTabBasicProfile from './user-settings/AdminBasicInfo.vue'

export default {
  name: 'user-create',
  components: {
    'form-wizard': FormWizard,
    'tab-content': TabContent,
    'user-tab-broadcast': UserTabBroadcast,
    'user-tab-basic-profile': UserTabBasicProfile,
    'user-tab-cash-flow': UserTabCashFlow,
    'user-tab-cpf': UserTabCPF,
    'user-tab-documents': UserTabDocuments,
    'user-tab-insurances': UserTabInsurances,
    'user-tab-investments': UserTabInvestments,
    'user-tab-mortgages': UserTabMortgages,
    'user-tab-srs': UserTabSRS,
    'user-tab-notes': UserTabNotes,
    'user-tab-cash-flow-overview': UserTabCashFlowOverView,
    // 'AdminBasicInfo': UserAdminTabBasicProfile

  },
  data () {
    return {
      user_data: null,
      user_not_found: false,
      activeTab: 0,
      broadcast: [],
      cashFlow:[],
      cpf: [],
      documents: [],
      insurances: [],
      mortgage: [],
    }
  },
  watch: {
  },
  methods: {
    fetch_user_data () {
      this.user_not_found = true
    }
  },
  mounted(){
   var wizard = this.$refs.checkoutWizard
   wizard.activateAll()
  },
  created () {
  }
  
}

</script>
