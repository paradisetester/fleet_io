<template>
   <div id="page-user-edit">
      <h4>Other Plans</h4>
      <user-tab-insurances-other-plans-term></user-tab-insurances-other-plans-term>
      <user-tab-insurances-other-plans-endowment></user-tab-insurances-other-plans-endowment>
      <user-tab-insurances-other-plans-main-plan></user-tab-insurances-other-plans-main-plan>
      <user-tab-insurances-other-plans-rider-plan></user-tab-insurances-other-plans-rider-plan>
      <user-tab-insurances-other-plans-annuity></user-tab-insurances-other-plans-annuity>
      <user-tab-insurances-other-plans-ilp></user-tab-insurances-other-plans-ilp>
   </div>
</template>
<script type="text/javascript">
import UserTabInsurancesOtherPlansTerm from './UserTabInsurancesOtherPlansTerm'
import UserTabInsurancesOtherPlansEndowment from './UserTabInsurancesOtherPlansEndowment'
import UserTabInsurancesOtherPlansMainPlan from './UserTabInsurancesOtherPlansMainPlan'
import UserTabInsurancesOtherPlansRiderPlan from './UserTabInsurancesOtherPlansRiderPlan'
import UserTabInsurancesOtherPlansAnnuity from './UserTabInsurancesOtherPlansAnnuity'
import UserTabInsurancesOtherPlansILP from './UserTabInsurancesOtherPlansILP'
export default {
	name: 'user-tab-insurances-other-plans',
	components: {
      'user-tab-insurances-other-plans-term': UserTabInsurancesOtherPlansTerm,
      'user-tab-insurances-other-plans-endowment': UserTabInsurancesOtherPlansEndowment,
      'user-tab-insurances-other-plans-main-plan': UserTabInsurancesOtherPlansMainPlan,
      'user-tab-insurances-other-plans-rider-plan': UserTabInsurancesOtherPlansRiderPlan,
      'user-tab-insurances-other-plans-annuity': UserTabInsurancesOtherPlansAnnuity,
      'user-tab-insurances-other-plans-ilp': UserTabInsurancesOtherPlansILP
	},
	data() {
		return {
		}
	},
	methods: {},
	created() {},
   beforeMount() {}
}
</script>