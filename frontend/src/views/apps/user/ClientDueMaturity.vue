<!-- =========================================================================================
  File Name: UserList.vue
  Description: User List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->
<template>
  <div id="data-list-list-view" class="data-list-container">
    <vx-card>
      <div slot="no-body" class="tabs-container px-6 pt-6">

        <vs-tabs v-model="activeTab" class="tab-action-btn-fill-conatiner">
          <vs-tab label="Insurance Dues" icon-pack="feather" icon="icon-user">
            <div class="tab-text">
              <insurance-due-maturity class="mt-4"/>
            </div>
          </vs-tab>
          <vs-tab label="Investment Dues" icon-pack="feather" icon="icon-edit">
            <div class="tab-text">
              <investment-due-maturity class="mt-4"/>
            </div>
          </vs-tab>
        </vs-tabs>

      </div>
    </vx-card>
  </div>
</template>

<script>
import InsuranceDueMaturity from './InsuranceDueMaturity'
import InvestmentDueMaturity from './InvestmentDueMaturity'

export default {
  components: {
    'insurance-due-maturity': InsuranceDueMaturity,
    'investment-due-maturity': InvestmentDueMaturity
  },
  data () {
    return {
      activeTab:0
    }
  },
  computed: {
    
  },
  methods: {
    
  },
  mounted () {
  },
  beforeMount() { 
  }
}

</script>

<style lang="scss">
#page-user-list {
  .user-list-filters {
    .vs__actions {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-58%);
    }
  }
}

</style>
<style>
.vs-con-table .vs-con-tbody {
    background: #f8f8f8;
    border: 2px solid #efefef;
}
.vs-con-table .tr-values:nth-child(odd) {
    background: transparent!important;
}
.vs-con-table .tr-values:nth-child(even) {
    background: #fff!important;
}
</style>
