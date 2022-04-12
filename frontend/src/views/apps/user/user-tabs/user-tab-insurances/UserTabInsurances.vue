<template>
   <div>
      <user-tab-insurances-renewables></user-tab-insurances-renewables>
      <user-tab-insurances-other-plans></user-tab-insurances-other-plans>
   </div>
</template>
<script type="text/javascript">
import UserTabInsurancesOtherPlans from './UserTabInsurancesOtherPlans'
import UserTabInsurancesRenewables from './UserTabInsurancesRenewables'
export default {
	name: 'user-tab-insurances',
	components: {
      'user-tab-insurances-renewables': UserTabInsurancesRenewables,
      'user-tab-insurances-other-plans': UserTabInsurancesOtherPlans
	},
	data() {
		return {
		}
	},
	watch: {

	},
	methods: {
		
	},
	created() {
      
	},
   beforeMount() { 
        
   }
}
</script>