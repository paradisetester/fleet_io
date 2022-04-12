<!-- =========================================================================================
  File Name: Profile.vue
  Description: Profile Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div id="profile-page">
        <!-- COL AREA -->
        <div class="vx-row">
            <!-- COL 1 -->
            <div class="vx-col w-full lg:w-1/4">
                <!-- ABOUT CARD -->
                <vx-card title="About" class="mt-base">
                    <!-- ACTION SLOT -->
                    <template slot="actions">
                        
                         <span class="float-right" v-if="userdata.admin">
                            <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">
                              <a class="a-icon" href.prevent>
                               <feather-icon icon="MoreHorizontalIcon"></feather-icon>
                                <vs-icon class="" icon="expand_more"></vs-icon>
                              </a>
                              <vs-dropdown-menu>
                                <vs-dropdown-item @click="editProfile">
                                  Edit
                                </vs-dropdown-item>                               
                              </vs-dropdown-menu>
                            </vs-dropdown>
                          </span>

                    </template>
                    <div class="content-center pp_img">
                        <vs-avatar class="user-profile-img" size="85px" />
                    </div>
                    <!-- OTEHR DATA -->
                    <div class="mt-5">
                        <h6>Joined:</h6>
                        <p>{{userdata.company.valid_from | YYYYMMDD}}</p>
                    </div>
                    <div class="mt-5">
                        <h6>Name:</h6>
                        <p>{{userdata.basic.name}}</p>
                    </div>
                    <div class="mt-5">
                        <h6>Email:</h6>
                        <p>{{userdata.basic.email}}</p>
                    </div>
                    <div class="mt-5">
                        <h6>Mobile:</h6>
                        <p>{{userdata.company.mobile}}</p>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-full lg:w-3/4">
                <vx-card class="mt-base">
                  <span class="float-right" v-if="userdata.admin">
                    <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">
                      <a class="a-icon" href.prevent>
                        Plan Subscription
                        <vs-icon class="" icon="expand_more"></vs-icon>
                      </a>
                      <vs-dropdown-menu>
                        <vs-dropdown-item @click.stop="subscribe('renew')">
                          Renew
                        </vs-dropdown-item>
                        <vs-dropdown-item @click.stop="subscribe('upgrade')">
                          Upgrade
                        </vs-dropdown-item>
                      </vs-dropdown-menu>
                    </vs-dropdown>
                  </span>
                  <div class="flex content-start flex-wrap bg-gray-200 clear-both">
                    <div class="w-full md:w-1/3 mb-2">
                      <div class="text-gray-700 text-left bg-gray-400 font-bold">Company Name :</div>
                    </div>
                    <div class="w-full md:w-2/3 mb-6">
                      <div class="text-gray-700 bg-gray-400 ">{{userdata.company.name}}</div>
                    </div>
                  </div>
                  <div class="flex content-start flex-wrap bg-gray-200">
                    <div class="w-full md:w-1/3 mb-2">
                      <div class="text-gray-700 text-left bg-gray-400 font-bold">Tagline :</div>
                    </div>
                    <div class="w-full md:w-2/3 mb-6">
                      <div class="text-gray-700 bg-gray-400 ">{{userdata.company.tagline}}</div>
                    </div>
                  </div>
                  <div class="flex content-start flex-wrap bg-gray-200">
                    <div class="w-full md:w-1/3 mb-2">
                      <div class="text-gray-700 text-left bg-gray-400  font-bold">Fleet Size :</div>
                    </div>
                    <div class="w-full md:w-2/3 mb-6">
                      <div class="text-gray-700 bg-gray-400 ">{{userdata.company.fleet_size}} assets</div>
                    </div>
                  </div>
                  <div class="flex content-start flex-wrap bg-gray-200">
                    <div class="w-full md:w-1/3 mb-2">
                      <div class="text-gray-700 text-left bg-gray-400 font-bold">Industry :</div>
                    </div>
                    <div class="w-full md:w-2/3 mb-6">
                      <div class="text-gray-700 bg-gray-400 ">{{userdata.company.industry}}</div>
                    </div>
                  </div>
                  <div class="flex content-start flex-wrap bg-gray-200">
                    <div class="w-full md:w-1/3 mb-2">
                      <div class="text-gray-700 text-left bg-gray-400 font-bold">Timezone :</div>
                    </div>
                    <div class="w-full md:w-2/3 mb-6">
                      <div class="text-gray-700 bg-gray-400 ">{{userdata.company.time_zone}}</div>
                    </div>
                  </div>
                  <div class="flex content-start flex-wrap bg-gray-200">
                    <div class="w-full md:w-1/3 mb-2">
                      <div class="text-gray-700 text-left bg-gray-400 font-bold">Currency :</div>
                    </div>
                    <div class="w-full md:w-2/3 mb-6">
                      <div class="text-gray-700 bg-gray-400 ">{{userdata.company.currency}}</div>
                    </div>
                  </div>
                  <div class="flex content-start flex-wrap bg-gray-200">
                    <div class="w-full md:w-1/3 mb-2">
                      <div class="text-gray-700 text-left bg-gray-400  font-bold">Plan :</div>
                    </div>
                    <div class="w-full md:w-2/3 mb-6">
                      <div class="text-gray-700 bg-gray-400 ">{{userdata.plan.name}}</div>
                    </div>
                  </div>
                  <div class="flex content-start flex-wrap bg-gray-200">
                    <div class="w-full md:w-1/3 mb-2">
                      <div class="text-gray-700 text-left bg-gray-400 font-bold">Plan Expire On:</div>
                    </div>
                    <div class="w-full md:w-2/3 mb-6">
                      <div class="text-gray-700 bg-gray-400 ">{{userdata.company.valid_till | YYYYMMDD}}</div>
                    </div>
                  </div>
                </vx-card>
            </div>
        </div>
    </div>
    
</template>

<script>

export default {
  data () {
    return {
      wasSidebarOpen: null,
      userdata : {name:''}
    }
  },
  methods: {
    subscribe (type){     
      if(type == 'renew'){
            this.$router.push(`/plan/renew`).catch(() => {});
      }else{
          this.$router.push(`/plan/upgrade`).catch(() => {});
      }
    },
    editProfile(){
       this.$router.push(`/auth-edit-profile`).catch(() => {});
    }
  },
  mounted () {
    this.wasSidebarOpen = this.$store.state.reduceButton
    this.$store.commit('TOGGLE_REDUCE_BUTTON', false)
  },
  beforeMount() {
    this.$session.start();
    this.userdata = this.$session.get('profile');

  },
  beforeDestroy () {
    if (!this.wasSidebarOpen) this.$store.commit('TOGGLE_REDUCE_BUTTON', false)
  }
}

</script>


<style lang="scss">
@import "@/assets/scss/vuexy/pages/profile.scss";
</style>
