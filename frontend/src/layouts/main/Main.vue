<template>
  <div class="layout--main" :class="[layoutTypeClass, navbarClasses, footerClasses, {'no-scroll': isAppPage}]">
<div class="expire-alert con-vs-alert con-vs-alert-primary con-icon" v-if="notificationMsg">{{notificationMsg}}</div>
    <v-nav-menu
      :navMenuItems = "navMenuItems"
      title         = ""
      parent        = ".layout--main" />

    <div id="content-area" :class="[contentAreaClass, {'show-overlay': bodyOverlay}]">
      <div id="content-overlay" />

    <!-- Navbar -->
    <template v-if="mainLayoutType === 'horizontal' && windowWidth >= 1200">
      <the-navbar-horizontal
        :navbarType= "navbarType"
        :class="[
          {'text-white' : isNavbarDark  && !isThemeDark},
          {'text-base'  : !isNavbarDark && isThemeDark}
        ]" />

      <div style="height: 62px" v-if="navbarType === 'static'"></div>

      <h-nav-menu
        :class="[
          {'text-white' : isNavbarDark  && !isThemeDark},
          {'text-base'  : !isNavbarDark && isThemeDark}
        ]"
        :navMenuItems="navMenuItems" />
    </template>
    <template v-else>
      <the-navbar-vertical
        :navbarColor="navbarColor"
        :class="[
          {'text-white' : isNavbarDark  && !isThemeDark},
          {'text-base'  : !isNavbarDark && isThemeDark}
        ]" />
    </template>
    
    <!-- /Navbar -->

      <div class="content-wrapper">

        <div class="router-view">
          <div class="router-content">

            <transition :name="routerTransition">

              <div v-if="$route.meta.breadcrumb || $route.meta.pageTitle" class="router-header flex flex-wrap items-center mb-6">
                <div
                  class="content-area__heading"
                  :class="{'pr-4 border-0 md:border-r border-solid border-grey-light' : $route.meta.breadcrumb}">
                  <h2 class="mb-1">{{ routeTitle }}</h2>
                </div>

                <!-- BREADCRUMB -->
                <vx-breadcrumb class="ml-4 md:block hidden" v-if="$route.meta.breadcrumb" :route="$route" :isRTL="$vs.rtl" />

                <!-- DROPDOWN -->
               

              </div>
            </transition>

            <div class="content-area__content">

              <back-to-top bottom="5%" :right="$vs.rtl ? 'calc(100% - 2.2rem - 38px)' : '30px'" visibleoffset="500" v-if="!hideScrollToTop">
                <vs-button icon-pack="feather" icon="icon-arrow-up" class="shadow-lg btn-back-to-top" />
              </back-to-top>

              <transition :name="routerTransition" mode="out-in">
                <router-view @changeRouteTitle="changeRouteTitle" @setAppClasses="(classesStr) => $emit('setAppClasses', classesStr)" />
              </transition>
            </div>
          </div>
        </div>
      </div>
      <the-footer />
    </div>
  </div>
</template>


<script>
import BackToTop           from 'vue-backtotop'
import HNavMenu            from "@/layouts/components/horizontal-nav-menu/HorizontalNavMenu.vue"
// import navMenuItems        from "@/layouts/components/vertical-nav-menu/navMenuItems.js"
import TheNavbarHorizontal from '@/layouts/components/navbar/TheNavbarHorizontal.vue'
import TheNavbarVertical   from '@/layouts/components/navbar/TheNavbarVertical.vue'
import TheFooter           from '@/layouts/components/TheFooter.vue'
import themeConfig         from '@/../themeConfig.js'
import VNavMenu            from '@/layouts/components/vertical-nav-menu/VerticalNavMenu.vue'
import { siteIndexURL,siteFrontIndexURL} from '../../axios'
import axios from 'axios';
import VueEasySession from 'vue-easysession'
export default {
  components: {
    BackToTop,
    HNavMenu,
    TheFooter,
    TheNavbarHorizontal,
    TheNavbarVertical,
    VNavMenu,
    
  },
  data() {
    return {
      footerType        : themeConfig.footerType  || 'static',
      hideScrollToTop   : themeConfig.hideScrollToTop,
      isNavbarDark      : false,
      navbarColor       : themeConfig.navbarColor || '#fff',
      navbarType        : themeConfig.navbarType  || 'floating',
      navMenuItems      : [],
      routerTransition  : themeConfig.routerTransition || 'none',
      routeTitle        : this.$route.meta.pageTitle,
      disableThemeTour  : themeConfig.disableThemeTour,     
      notificationMsg : '',
      accessCheck : true,
      tenant_id:'',
    }
  },
  watch: {
    "$route"() {
        this.checkExpire();
      this.routeTitle = this.$route.meta.pageTitle
    },
    isThemeDark(val) {
      const color = this.navbarColor == "#fff" && val ? "#10163a" : "#fff"
      this.updateNavbarColor(color)
    },
    "$store.state.mainLayoutType"(val) {
      this.setNavMenuVisibility(val)
    }
  },
  computed: {
    bodyOverlay() { return this.$store.state.bodyOverlay },
    contentAreaClass() {
      if(this.mainLayoutType === "vertical") {
        if      (this.verticalNavMenuWidth == "default") return "content-area-reduced"
        else if (this.verticalNavMenuWidth == "reduced") return "content-area-lg"
        else return "content-area-full"
      }
      // else if(this.mainLayoutType === "boxed") return "content-area-reduced"
      else return "content-area-full"
    },
    footerClasses() {
      return {
        'footer-hidden': this.footerType == 'hidden',
        'footer-sticky': this.footerType == 'sticky',
        'footer-static': this.footerType == 'static',
      }
    },
    isAppPage() {
      return this.$route.meta.no_scroll
    },
    isThemeDark()     { return this.$store.state.theme == 'dark' },
    layoutTypeClass() { return `main-${this.mainLayoutType}` },
    mainLayoutType()  { return this.$store.state.mainLayoutType  },
    navbarClasses()   {
      return {
        'navbar-hidden'   : this.navbarType == 'hidden',
        'navbar-sticky'   : this.navbarType == 'sticky',
        'navbar-static'   : this.navbarType == 'static',
        'navbar-floating' : this.navbarType == 'floating',
      }
    },
    verticalNavMenuWidth() { return this.$store.state.verticalNavMenuWidth },
    windowWidth()          { return this.$store.state.windowWidth }
  },
  methods: {
    changeRouteTitle(title) {

      this.routeTitle = title
    },
    updateNavbarColor(val) {
      this.navbarColor = val
      if (val == "#fff") this.isNavbarDark = false
      else this.isNavbarDark = true
    },
    setNavMenuVisibility(layoutType) {
      if((layoutType === 'horizontal' && this.windowWidth >= 1200) || (layoutType === "vertical" && this.windowWidth < 1200)) {
        this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', false)
        this.$store.dispatch('updateVerticalNavMenuWidth', 'no-nav-menu')
      }
      else {
        this.$store.commit('TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE', true)
      }
    },
	
	getFeatures: function ()
    {

      var $this = this;
      axios.get(siteIndexURL+'/v1/permission')
      .then((result)=>{		
         if (result.data.status == true) {         
		   $this.navMenuItems = result.data.response;
        }
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    logoutSession(){
        this.$session.start()      
        this.$session.set('access', '');
        this.$session.set('refresh', '');
        this.$session.set('profile', '');
        this.$session.set('tenant_id', '');
        this.$session.set('cart', '');
        window.location.href = '/auth/login';
    },
checkExpire(){
      var $this = this;
      axios.post(siteIndexURL+'/v1/check_plan')
      .then((result)=>{ 
          var tenant_not_exist = result.data.response.tenant_not_exist;
          if(tenant_not_exist == true){
            $this.logoutSession();
          }else{
            var expire = result.data.response.expired;                 
            var currentUrl = window.location.pathname;     
              
            if(expire == true ){    
              this.accessCheck = false    

              if(currentUrl !='/plan/renew'){   
                 window.location.href=siteFrontIndexURL+"plan/renew"
               }
            }
            if(result.data.message){
              $this.notificationMsg = result.data.message;
            }
          }
      }).catch(function (error) {
       $this.responseHandle('warning', error.response.data.message);
      });
    }

  },
  created() {


this.checkExpire();
var session = VueEasySession.getInstance();
const color = this.navbarColor == "#fff" && this.isThemeDark ? "#10163a" : this.navbarColor
    this.updateNavbarColor(color)
    this.setNavMenuVisibility(this.$store.state.mainLayoutType)
    this.tenant_id = session.get('tenant_id');
setTimeout(function(){
    if(this.tenant_id =='fleet_admin'){      
        this.getFeatures();
    }else if(this.accessCheck==true ){
        this.getFeatures();
    }
}.bind(this),2000);
    
  }
}

</script>

