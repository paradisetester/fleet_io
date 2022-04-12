<template>
  <div>
    <div class="top-header">
    	<div class="container">
    		<div class="top-outr">
    			<div class="top-text"> 
    				<h4>{{Theme.header}}</h4>
    			</div>
    			<div class="top-detail">
    				<a href=""><span>{{Theme.phoneno}}</span></a>
                    <a v-if="!profile.name" v-on:click="redirectPage('/auth/login')"><span>Login</span></a>   
                    <a v-if="profile.name" v-on:click="redirectPage('/home')"><img src="/img/user.png"> <span>{{profile.name}}</span></a>
                    <a v-if="profile.name" v-on:click="logoutSession"> <span>Logout</span></a>  		
    			</div>
    		</div>
    	</div>
    </div>
    <div class="main-header">
    	<div class="container">
    		<div class="nav-otr">
	    		<div class="logo-sec">
	    			<a v-on:click="redirectPage('/')">
					<img :src="pageImage" alt="img" v-if="pageImage">
					<img src="/img/logo.png" alt="img" v-else="">
					</a>
	    		</div>
	    		<div class="navbar">
	    			<span v-on:click="showMenu" class="togle-btn sm:inline-flex xl:hidden cursor-pointer p-2 feather-icon select-none relative"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu "><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></span>
	    			<ul class="menus" :class="{'open-mobile':showMobileMenu == true}">
		    			<li v-for="menu in menusList" :key="menu.link_id"><a v-on:click="redirectPage('/front/'+menu.link_url)">{{menu.link_name}}</a></li>
		    			<li class="get-btn"><a  v-on:click="redirectPage('/front/plans')">Get a demo</a></li>
		    		</ul>
	    		</div>
	    		
	    	</div>
    	</div>
    </div>    
  </div>
</template>


<script>
import { siteIndexURL, siteURL} from '../axios'
import axios from 'axios';
export default {
  components: {
  },
  data() {
    return {
      showMobileMenu:false,
      menusList:[],
      Theme:'',
      pageImage:'',
      profile:{
        name:'',
      },
    }
  },
  watch: {

  },
  computed: {
    
  },
  methods: {
    redirectPage($page = '/'){
	this.showMobileMenu = false
      this.$router.push($page).catch(() => {})
    },
    logoutSession()
    {
        this.$session.start()      
        this.$session.set('access', '');
        this.$session.set('refresh', '');
        this.$session.set('profile', '');
        this.$session.set('tenant_id', '');
        this.$session.set('cart', '');
        window.location.href = '/auth/login';
    },
    getMenus: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/menus')
      .then((result)=>{
        if (result.data.status == true) {
          this.menusList = result.data.response.menus;
        }
      }).catch(function (error) {
        if (error.response !== undefined) {
          if (error.response.data.message) {
            $this.responseHandle('warning', error.response.data.message);
          } 
        }        
      });
    },
    showMenu(){
    	if(this.showMobileMenu == true){
    		this.showMobileMenu = false
    	} else {
    		this.showMobileMenu = true
    	}
    },
    getTheme: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/themesetting')
      .then((result)=>{
         if (result.data.status == true) {
          this.Theme = result.data.response.themesetting;
          this.pageImage = this.siteIndexUrl+'/'+this.Theme.photo
        }
      }).catch(function (error) {
        if (error.response !== undefined && error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    responseHandle: function(type = 'warning', message = '')
    {
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
    this.$session.start();
    if (this.$session.get('profile') != undefined) {
      this.profile = this.$session.get('profile');
	
		if(this.profile!=''){
		
		  this.$router.push('/home').catch(() => {})
		}else{
      this.$session.set('tenant_id', '');
    }	 
    }
    this.getMenus();
    this.getTheme();
    this.siteIndexUrl = siteURL;
  }
}

</script>
<style>
a {
    cursor: pointer;
}
[dir] #app{
	padding:0px;
}
.col-md-12.short_description-section {
    width: 100%;
    padding: 0px 0px 50px;
    text-align: center;
}
span.togle-btn {
    display: none !important;
}
.top-header {
    padding: 15px 0;
    background-color: #0973ba;
}
.top-header p {
    color: #fff;
    font-size: 16px;
}
.top-outr {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
}
.top-outr a {
    color: #fff;
    font-size: 16px;
    margin-left: 25px;
}
.top-detail img {
    vertical-align: middle;
    margin-right: 7px;
}
.main-header {
    background-color: #fff;
    padding: 20px 0;
}
.sticky-header {
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    right: 0;
}
.nav-otr {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}
.logo-sec {
    width: 17%;
}
.logo-sec img {
    width: 100%;
}
.navbar ul li {
    display: inline-block;
    margin-left: 22px;
}
.navbar ul li a {
    color: #000000;
    font-size: 16px;
}
.navbar ul li.get-btn a {
    padding: 10px 20px;
    color: #0973ba;
    text-transform: uppercase;
    border: 2px solid #0973ba;
    border-radius: 5px;
    font-size: 15px;
    font-weight: bold;
}
section img {
	width: 100%;
	vertical-align: bottom;
	transition: all .25s ease-in-out;
}
section.banner {
    padding: 90px 0;
    color: #ffffff;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}
.banner-outr {
    max-width: 750px;
}
.banner-outr h1 {
    font-size: 50px;
    color: #ffffff;
    font-family: "Montserrat", Helvetica, Arial, sans-serif;
    font-weight: 900;
    margin-bottom: 40px;
    text-shadow: 0 7px 10px #000000;
}
.banner-outr p {
    font-size: 20px;
    font-weight: 700;
    text-shadow: 0 7px 10px #000000;
    margin-bottom: 40px;
}
.bnnr-btns a {
    color: #fff;
    margin-right: 20px;
    padding: 10px 15px;
    background-color: #0973ba;
    border: 2px solid #0973ba;
    font-size: 18px;
    display: inline-block;
    border-radius: 5px;
    transition: all .3s ease-in-out;
}
.bnnr-btns a:hover {
    border-color: #ffffff;
    background-color: transparent;
}
.bnnr-btns a.scnd-btn {
    border-color: #ffffff;
    background-color: transparent;
}
.bnnr-btns a.scnd-btn:hover {
	border-color: #0973ba;
    background-color: #0973ba;
}
div{
	clear: both;
}
.footer {
	clear: both;
    padding: 80px 0;
    background-color: #f5f5f5;
}
.footer-outr {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
.footer-col {
    width: 24%;
}
.footer-col img {
    width: 60%;
    margin-bottom: 25px;
}
.footer-col p {
    font-size: 16px;
    color: #636f73;
}
.footer-col h3 {
    font-size: 25px;
    color: #0973ba;
    font-weight: bold;
    margin-bottom: 25px;
    font-family: "Montserrat", Helvetica, Arial, sans-serif;
}
.footer-col ul li {
    margin-bottom: 15px;
}
.footer-col ul li a {
    color: #000000;
    font-size: 16px;
    font-weight: 500;
}
.related-outr {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}
.footer-col .thumb-outr img {
    margin-bottom: 0;
    vertical-align: bottom;
    width: 100%;
}
.thumb-outr {
    width: 20%;
    margin-right: 15px;
}
.copyright {
    padding: 15px 0;
    background-color: #0973ba;
    color: #ffffff;
    font-size: 16px;
}
.copy-outr {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}
.footer-icon a {
    margin-left: 10px;
}
.footer-icon img {
    vertical-align: bottom;
}
section.padding-all {
    padding: 80px 0 0;
    background-color: #ffffff;
}
.padding-all .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-left: -15px;
    margin-right: -15px;
}
.padding-all .col-md-6 {
    width: 50%;
    padding-left: 15px;
    padding-right: 15px;
}
.col-md-4 {
    width: 31%;
    padding-left: 15px;
    padding-right: 15px;
}
.video-outr {
    position: relative;
    transition: all .25s ease-in-out;
}
a.play-button {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    width: 70px;
    margin: auto;
    transform: translateY(-50%);
}
.video-outr:hover .img-outr img {
    opacity: .75;
}
.right-side-text h2 {
    font-size: 36px;
    color: #0973ba;
    font-weight: 700;
    margin-bottom: 25px;
    font-family: "Montserrat", Helvetica, Arial, sans-serif;
}
.right-side-text p {
    font-size: 20px;
    color: #636f73;
}
.three-box {
    text-align: center;
}
.three-box h3 {
    font-size: 23px;
    font-weight: 700;
    color: #0973ba;
    margin-bottom: 15px;
    font-family: "Montserrat", Helvetica, Arial, sans-serif;
}
.three-box p {
    color: #636f73;
    font-size: 18px;
}
.fourth-sec .img-outr img {
    width: 75%;
}
.fourth-sec .img-outr {
    text-align: center;
}
.fourth-sec .row {
    align-items: center;
}
.learn-more img {
    width: auto;
    vertical-align: baseline;
}
.learn-more a {
    display: inline-block;
    margin: 30px 0 0;
    font-size: 18px;
    font-weight: 700;
}
p {
    line-height: 24px;
}
section.padding-all.last-sec {
    padding-bottom: 80px;
}
.testimonial-sec {
    text-align: center;
}
.testimonial-sec h1 {
    font-size: 40px;
    font-weight: 700;
    color: #0973ba;
    margin-bottom: 25px;
}
.testimonial-sec h6 {
    font-size: 18px;
    color: #000000;
    text-transform: uppercase;
}
.testimonial-sec h6 {
    margin-bottom: 20px;
}
p.lead {
    color: #636f73;
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 25px;
}
.fifth-sec .vueperslides {
    margin-top: 40px;
}
.fifth-sec .vueperslides button.vueperslides__arrow {
    color: #0973ba;
}
.fifth-sec button.vueperslides__bullet.vueperslides__bullet--active .default {
    background-color: #0973ba;
}
.fifth-sec .vueperslides__bullet .default {
    border: 1px solid #0973ba;
    box-shadow: 0 0 1px rgb(9 115 186), 0 0 3px rgb(9 115 186);
}
.start-btn a {
    display: inline-block;
    padding: 10px 30px;
    font-size: 18px;
    font-weight: 500;
    background-color: #0973ba;
    color: #ffffff;
    border-radius: 5px;
    border: 2px solid #0973ba;
    transition: all .3s ease-in-out;
}
.start-btn a:hover {
    background-color: transparent;
    color: #0973ba;
}
.jumbotron.text-center {
    display: flex;
    flex-wrap: wrap;
    height: 100%;
    align-items: center;
}
.thnk-sec {
    width: 100%;
}
.thnk-sec h1.display-3 {
    font-size: 35px;
    font-weight: 700;
    color: #2a93d5;
}
.thnk-sec p {
    font-size: 18px;
    max-width: 700px;
    margin: 20px auto;
}
.thnk-sec img {
    width: 70px;
    margin-bottom: 20px;
}
.thnk-sec hr {
    max-width: 700px;
    margin: auto;
}
/** about us page **/
section.banner-head-section {
    padding: 0;
    text-align: center;
    background-color: #0973ba;
    height: 120px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.page-title-sec h1 {
    font-size: 35px;
    color: #ffffff;
    font-weight: 700;
}
.meet-team-title h2 {
    text-align: center;
    font-size: 35px;
    font-weight: bold;
    margin-bottom: 40px;
    color: #0973ba;
}
.team-img-outr img {
    max-width: 150px;
    background-color: #0973ba;
    border-radius: 100%;
    margin-bottom: 15px;
}
.our-team-sec .footer-icon {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;
}
.team-max-outr {
    max-width: 900px;
    margin: auto;
}
section.padding-all.our-team-sec {
    background-color: #fbfbfb;
}
.team-max-outr h3 {
    font-size: 18px;
    color: #000;
    font-weight: 600;
}
.full-img .img-outr img {
    width: 100%;
}
.right-side-text {
    text-align: center;
    display: block;
    width: 100%;
}
.right-side-text .about-description p{ font-size: 16px; }
.right-side-text .about-description {
    margin-top: 30px;
    padding-bottom: 50px;
    font-size: 15px;
}
/****** plans page ******/
.pricingTable2{
  padding-bottom:30px;
  margin:0;
  background:#fff;
  text-align:center;
  border-radius:15px;
  overflow:hidden
}
.pricingTable2:hover{
  box-shadow:0 0 10px rgba(195,67,67,.3) inset,0 0 20px -5px rgba(0,0,0,.8)
}
.pricingTable2 .pricingTable-header{
  padding:20px 15px 45px;background:#66ce04;
  -webkit-clip-path:polygon(50% 100%,100% 60%,100% 0,0 0,0 60%);
  clip-path:polygon(50% 100%,100% 60%,100% 0,0 0,0 60%);
  position:relative;
}
.pricingTable2 .pricingTable-header:before{
  content:"";
  width:400px;
  height:400px;
  border-radius:50%;
  position:absolute;
  right:-50%;
  top:-130%;
  background:repeating-radial-gradient(rgba(255,255,255,.05),rgba(255,255,255,.2) 20%);
  transition:all .5s ease 0s
}
.pricingTable2:hover .pricingTable-header:before{
  right:50%;
}
.pricingTable2 .title{
  font-size:40px;
  color:#fff;
  margin:0;
}
.pricingTable2 .price-value{
  display:block;
  font-size:25px;
  color:#000;
  margin:0 0 20px;
  transition:all .3s ease 0s;
}
.pricingTable2 .pricing-content{
  padding: 10px;
  margin: 20px 25px;
  list-style:none;
}
.pricingTable2 .pricing-content li{
  font-size:18px;
  color:#909090;
  line-height:40px;
  letter-spacing:1px;
  text-transform:capitalize;
  border-bottom:2px solid rgba(0,0,0,.15);
  margin-bottom:10px;
  position:relative;
}
.pricingTable2 .pricing-content li:last-child{
  border-bottom:none;
}
.pricingTable2 .pricing-content li svg{
  color:#66ce04;
}
.pricingTable2 .pricingTable-signup{
  display:block;
  padding:18px 0;
  margin:0 25px;
  border-radius:10px;
  background:#66ce04;
  font-size:20px;
  color:#fff;
  letter-spacing:1px;
  text-transform:uppercase;
  overflow:hidden;
  position:relative;
  transition:all .3s ease 0s;
}
.pricingTable2 .pricingTable-signup:hover{
  letter-spacing:2px;
  box-shadow:0 0 10px rgba(0,0,0,.7),0 0 0 7px rgba(255,255,255,.5) inset
}
.pricingTable2 .pricingTable-signup:before{
  content:"";
  width:230px;
  height:230px;
  border-radius:50%;
  background:repeating-radial-gradient(rgba(255,255,255,.05),rgba(255,255,255,.2) 20%);
  position:absolute;
  top:-180%;
  right:-40%;
  transition:all .8s ease 0s;
}
.pricingTable2 .pricingTable-signup:hover:before{
  right:40%;
}
.pricingTable2.silver .pricingTable-header,.pricingTable2.silver .pricingTable-signup{
  background:#9ea4a7;
}
.pricingTable2.gold .pricingTable-header,.pricingTable2.gold .pricingTable-signup{
  background:#cec912;
}
.pricingTable2.silver .pricing-content li svg{
  color:#9ea4a7;
}
.pricingTable2.gold .pricing-content li svg{
  color:#cec912;
}


.pricingTable2.blue .pricingTable-header,.pricingTable2.blue .pricingTable-signup{
  background:#15b8f3;
}
.pricingTable2.blue .pricing-content li svg{
  color:#15b8f3;
}
.pricingTable2.pink .pricingTable-header,.pricingTable2.pink .pricingTable-signup{
  background:#f03c79;
}
.pricingTable2.pink .pricing-content li svg{
  color:#f03c79;
}
section.padding-all.pricing-plans {
    background: #f2f2f2;
    padding-bottom: 60px;
}
section.padding-all.full-img.dynamic-section{background: #def2ff;}
/**** checkout ****/
.panel-info {
    border-color: #bce8f1;
}
.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.panel {
    border-radius: 1px;
}
.panel-info {
    border-color: #999;
}
.panel-info>.panel-heading {
    color: #ffffff;
    background-color: #d9edf7;
    border-color: #bce8f1;
}
.panel-info > .panel-heading {
    background-image: linear-gradient(to bottom, #36aeff 0px, #0973ba 100%);
}
.panel-info > .panel-heading {
    color: #eee;
    border-color: #999;
}
.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
.panel-heading {
    border-top-left-radius: 1px;
    border-top-right-radius: 1px;
}
.panel-body {
    padding: 15px;
}
.form-group {
    margin-bottom: 15px;
}
.cards li {
    -webkit-transition: all .2s;
    -moz-transition: all .2s;
    -ms-transition: all .2s;
    -o-transition: all .2s;
    transition: all .2s;
    background-image: url(//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg);
    background-position: 0 0;
    float: left;
    height: 32px;
    margin-right: 8px;
    text-indent: -9999px;
    width: 51px;
}
.cards .mastercard {
    background-position: -51px 0;
}
.cards li:last-child {
    margin-right: 0;
}
.cards .amex {
    background-position: -102px 0;
}
.btn-primary {
    color: #fff;
    background-color: #428bca;
    border-color: #357ebd;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
.panel-body.right-siderbar .form-group {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    align-items: center;
}
.panel-body.right-siderbar .form-group .col-sm-3 {
    width: 25%;
}
.panel-body.right-siderbar .form-group .col-sm-6 {
    width: 50%;
    padding-right: 15px;
    padding-left: 15px;
}
.panel-body.right-siderbar .form-group .col-xs-12 {
    width: 100%;
}
.pull-right {
    float: right;
}
.pull-right a {
    color: #ffffff;
}

/*** Payment page ***/
.payment-outr {
    max-width: 700px;
    margin: auto;
}
.payment-sec.address-section {
    width: 100%;
    padding: 0 15px;
}
.contact {
    max-width: 900px;
    margin: auto;
}
.contact h1 {
    margin-bottom: 30px;
}
button.check_button_end.pricingTable-signup {
    background: #1e8fdb;
    padding: 15px;
    border-radius: 5px;
    border: none;
    color: #fff;
    font-size: 17px;
    margin: 27px 0 0 0;
}

.pricingTable2 .pricingTable-signup_free {
  padding: 13px 22px;
    margin: 0 3px;
    border-radius: 10px;
    background: #e6e6e6;
    -webkit-transition: all .3s ease 0s;
    color: #000;
	font-size:14px;
}

.pricingTable2 .pricingTable-signup_free:hover{
  letter-spacing:2px;
  box-shadow:0 0 10px rgba(0,0,0,.7),0 0 0 7px rgba(255,255,255,.5) inset
}
.pricingTable2 .pricingTable-signup_free:before{
  content:"";
  width:130px;
  height:130px;
  border-radius:50%;
  background:repeating-radial-gradient(rgba(255,255,255,.05),rgba(255,255,255,.2) 20%);
  position:absolute;
  top:-180%;
  right:-40%;
  transition:all .8s ease 0s;
}
.pricingTable2 .pricingTable-signup_free:hover:before{
  right:40%;
}
.pricingTable2 .pricing-content {
	max-height: 278px;
	overflow-y: auto;
	min-height: 278px;
}

.resumeupload input[type="file"] {
    position: absolute;
    left: 47px;
    top: 9px;
}

.resumeupload {
    position: relative;
}

.resumeupload button.vs-component.vs-button.vs-button-primary.vs-button-filled {
    position: relative;
    z-index: 10;
}

span.text-danger.text-sm {
    color: red !important;
}

/*******************************************/
/******************************************/


@media only screen and (max-width:990px){
  .pricingTable2{
    margin-bottom:30px
  }
}
@media (max-width:768px){
	.padding-all .col-md-6, .col-md-4 {
	    width: 100%;
	}
  .margin-bt {
      margin-bottom: 15px;
  }
	.second-sec .right-side-text {
	    margin-top: 30px;
	}
	section img {
	    width: auto;
	}
	section .video-outr img {
	    width: 100%;
	}
	.copy-outr p {
	    margin-bottom: 10px;
	    text-align: center;
	}
	.copy-outr, .top-outr {
	    justify-content: center;
	}
	.top-outr a:first-child {
	    margin-left: 0;
	}
  .col-md-6.address-section {
      order: 2;
  }
}
@media (max-width:767px){
    span.togle-btn {
	    display: block !important;
	}
	ul.menus {
	    display: none;
	    position: absolute;
	    left: 0;
	    width: 100%;
	    background-color: #ffffff;
	    border-top: 2px solid #0973ba;
	    top: 100%;
	    padding: 20px;
	}
	.menus.open-mobile{
		display:block;
	}
	.navbar ul li {
	    display: block;
	    margin-right: 0;
	}
	.navbar ul li a {
	    margin-bottom: 15px;
	    display: inline-block;
	}
	.navbar ul li.get-btn a {
	    margin-bottom: 0;
	}
	.logo-sec {
	    width: 50%;
	}
	section.banner {
	    padding: 55px 0;
	}
	.learn-more a {
	    font-size: 16px;
	}
	.top-header p {
	    font-size: 14px;
	    text-align: center;
	    margin-bottom: 8px;
	}
	.footer-col {
	    width: 100%;
	    margin-bottom: 30px;
	}
	.banner-outr h1, .right-side-text h2, .testimonial-sec h1, .meet-team-title h2 {
	    font-size: 28px;
	}
	.banner-outr p {
	    font-size: 16px;
	}
	section.padding-all {
	    padding: 50px 0 0;
	}
	.fourth-sec .img-outr img {
	    width: 100%;
	    margin-top: 30px;
	}
	section.padding-all.fifth-sec {
	    padding-top: 50px;
	}
	section.padding-all.last-sec, section.padding-all.pricing-plans {
		padding-bottom: 50px;
	}
	.footer {
	    clear: both;
	    padding: 50px 0 20px;
	    background-color: #f5f5f5;
	}
	.bnnr-btns a {
	    margin-right: 0;
	    width: 200px;
	    text-align: center;
	    margin-top: 12px;
	}
	.fifth-sec .vueperslides__arrow {
	    opacity: 1;
	}
	.fifth-sec .vueperslides__arrows--outside .vueperslides__arrow--prev {
	    left: 0;
	}
	.fifth-sec .vueperslides__arrows--outside .vueperslides__arrow--next {
	    right: 0;
	}
	.fifth-sec .vueperslides button.vueperslides__arrow {
	    color: #ffffff;
	}
}
@media only screen and (max-width:479px){
  .pricingTable2{
      margin: 0 0 30px;
  }
  .pricingTable2 .pricing-content li{
      font-size:15px;
  }
}

</style>