<template>
   	<div id="page-user-edit">
   		<h4>Renewables</h4>
      	<user-tab-insurances-renewables-personal-accident></user-tab-insurances-renewables-personal-accident>
      	<user-tab-insurances-renewables-health-insurance-medishield></user-tab-insurances-renewables-health-insurance-medishield>
      	<user-tab-insurances-renewables-health-insurance-pi-rider></user-tab-insurances-renewables-health-insurance-pi-rider>
      	<user-tab-insurances-renewables-health-insurance-deduct-able></user-tab-insurances-renewables-health-insurance-deduct-able>
      	<user-tab-insurances-renewables-income-disability></user-tab-insurances-renewables-income-disability>
   	</div>
</template>
<script type="text/javascript">
import UserTabInsurancesRenewablesPersonalAccident from './UserTabInsurancesRenewablesPersonalAccident'
import UserTabInsurancesRenewablesHealthInsuranceMedishield from './UserTabInsurancesRenewablesHealthInsuranceMedishield'
import UserTabInsurancesRenewablesHealthInsurancePiRider from './UserTabInsurancesRenewablesHealthInsurancePiRider'
import UserTabInsurancesRenewablesHealthInsuranceDeductAble from './UserTabInsurancesRenewablesHealthInsuranceDeductAble'
import UserTabInsurancesRenewablesIncomeDisability from './UserTabInsurancesRenewablesIncomeDisability'
export default {
	name: 'user-tab-insurances-renewables',
	components: {
		'user-tab-insurances-renewables-personal-accident': UserTabInsurancesRenewablesPersonalAccident,
		'user-tab-insurances-renewables-health-insurance-medishield': UserTabInsurancesRenewablesHealthInsuranceMedishield,
		'user-tab-insurances-renewables-health-insurance-pi-rider': UserTabInsurancesRenewablesHealthInsurancePiRider,
		'user-tab-insurances-renewables-health-insurance-deduct-able': UserTabInsurancesRenewablesHealthInsuranceDeductAble,
		'user-tab-insurances-renewables-income-disability': UserTabInsurancesRenewablesIncomeDisability
	},
	data() {
		return {
		}
	},
	methods: {},
	created() {	},
   	beforeMount() { }
}
</script>