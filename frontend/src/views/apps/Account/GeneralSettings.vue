<template>
  <vx-card>
    <div slot="no-body" class="tabs-container p-4 py-6">
      <h3 class="mb-4">{{ profile.plan.name}} Plan</h3>  
      <div class="mt-8">
        <vs-col vs-w="8" class="cm_pd"><h6 class="mb-4">Fleetio Manage - {{ profile.plan.name}}</h6></vs-col>
        <vs-col vs-w="4" class="cm_pd subs_btn"><vs-button color="primary" type="border" size="small" icon-pack="feather" icon="icon-edit"  @click.prevent="purchasePlan">Subscribe</vs-button></vs-col>
        <vs-col vs-w="8" class="cm_pd">Vehicles : 0 of 0 </vs-col>
        <vs-col vs-w="4" class="cm_pd">Status : {{ profile.company.free_plan ? 'Trial Plan' : 'Trial Ended' }}</vs-col>
        <vs-col vs-w="8" class="cm_pd">Plan : {{profile.company.free_plan ? 'Free' : 'Paid'}} </vs-col>
        <vs-col vs-w="4" class="cm_pd">Plan Expired On : {{ profile.company.valid_till | YYYYMMDD }}</vs-col>
      </div>
      <div class="clearfix mb-4"></div>
      <hr>
      <div class="mt-8">
        <vs-col vs-w="8" class="cm_pd"><h6 class="mb-4">{{profile.company.name}}</h6></vs-col>
        <vs-col vs-w="4" class="cm_pd subs_btn pull-right">
          <vs-button color="primary" type="border" size="small" icon-pack="feather" icon="icon-edit"  @click.prevent="editProfile">Edit</vs-button>
        </vs-col>	
        <vs-col vs-w="8" class="cm_pd">Email : {{profile.email}}</vs-col>
        <vs-col vs-w="4" class="cm_pd">Contact : {{profile.name}}</vs-col>
      </div>
      <div class="clearfix"></div>
    </div>
  </vx-card>
</template>

<script>
export default {
  data() {
    return {
      profile: {
        name:'',
        email:''
      },
	
    }
  },
  computed: {
    activeUserInfo() {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    purchasePlan () {
      this.$router.push('/plan/upgrade').catch(() => {})
    },
   checkout () {
      this.$refs.checkoutRef.redirectToCheckout();
    },
    editProfile() {
      this.$router.push('/auth-edit-profile').catch(() => {})
    }
  },
  mounted() {
    this.$session.start()   
    this.profile = this.$session.get('profile');
    if (this.$session.get('access') == undefined || !this.$session.get('access')) {
      this.$router.push('/').catch(() => {})
    }
  }
}
</script>
<style lang="scss">
  .vx-card .vx-card__collapsible-content.vs-con-loading__container {
    overflow: auto !important;
  }
</style>