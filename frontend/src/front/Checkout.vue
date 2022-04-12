<template>
   <div>
      <section class="banner-head-section">
         <div class="container">
            <div class="page-title-sec">
               <h1>Checkout</h1>
            </div>
         </div>
      </section>
      <section class="padding-all">
         <div class="container">
            <form v-on:submit.prevent>
                <div class="row cart-body">
				<div class="col-md-12 short_description-section">
				  <h4>{{ page.short_description }}</h4>
				  </div>
                  <div class="col-md-6 address-section">
                     <img src="@/assets/images/pages/register.jpg" alt="register" class="mx-auto">
                  </div>
                  <div class="col-md-6 cart-section">
                     <!--REVIEW ORDER-->
                     <div class="panel panel-info">
                        <div class="panel-heading">
                           Review Order 
                           <div class="pull-right"><small><a class="afix-1" v-on:click="redirectPage('/plans')">Edit Cart</a></small></div>
                        </div>
                        <div class="panel-body right-siderbar">
                           <div class="form-group vx-row">
                              <div class="vx-col w-2/3 md:w-2/3 ">
                                <strong>{{cartDatas.heading}}</strong>
                              </div>
                              <div class="vx-col w-1/3 sm:w-1/3 text-right">
                                 <h6><span>$</span>{{cartDatas.price}}</h6>
                              </div>
                           </div>
                           <div class="form-group vx-row">
                            <div class="vx-col w-2/3 md:w-2/3">
                              <strong>Order Total</strong>
                            </div>
                            <div class="vx-col w-1/3 sm:w-1/3 text-right">
                               <h6><span>$</span>{{cartDatas.price}}</h6>
                            </div>  
                           </div>
                        </div>
                     </div>
                     <div class="panel panel-info" v-if="cartDatas.price > 0">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                        <div class="panel-body">
                           <div class="">
                              <strong>Card Number:</strong>
                              <input v-cardformat:formatCardNumber type="text" class="form-control" name="card_number" v-model="checkoutData.card_number" value="" />
                           </div>
                           <div class="form-group">
                              <div class="vx-row">
                                 <div class="vx-col w-full md:w-1/2 mt-4">
                                    <div class="col-md-12"><strong>Exp Year:</strong></div>
                                    <input type="text" class="form-control" name="exp_year" v-model="checkoutData.exp_year" placeholder="2020" /> 
                                 </div>
                                 <div class="vx-col w-full md:w-1/2 mt-4">
                                    <div class="col-md-12"><strong>Exp Month:</strong></div>
                                    <select class="form-control" name="exp_month" v-model="checkoutData.exp_month">
                                       <option value="">Month</option>
                                       <option value="01">01</option>
                                       <option value="02">02</option>
                                       <option value="03">03</option>
                                       <option value="04">04</option>
                                       <option value="05">05</option>
                                       <option value="06">06</option>
                                       <option value="07">07</option>
                                       <option value="08">08</option>
                                       <option value="09">09</option>
                                       <option value="10">10</option>
                                       <option value="11">11</option>
                                       <option value="12">12</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                               <strong>Card CVV:</strong>
                               <input type="text" class="form-control" v-cardformat:formatCardCVC name="cvv" v-model="checkoutData.cvv" placeholder="123" />
                           </div>
                        </div>
                     </div>
                     <div class="panel panel-info">
                        <div class="panel-body">
                            <div class="form-group">
                              <div class="col-xs-12">
                       <input class="input-checkbox " id="card_payment" v-model="term_and_condition" type="checkbox"><span>I’ve read and accept the terms & conditions</span>
                                 <div class="pull-left">  <button type="button" class="check_button_end pricingTable-signup"  @click.prevent="placeOrder" :disabled="submitted" name="Proceed to Checkout">Proceed to Pay</button></div>
								 <p v-if="message">{{message}}</p>
                              </div>
                            </div>
                        </div>
                     </div>
                  </div>
                </div>
            </form>            
         </div>
      </section>
   </div>
</template>

<script>
    import axios from 'axios';
    import {siteIndexURL} from '../axios'
    export default {

        data: () => ({
      				isUserLogin:false,
      				userdata:{},
      				submitted: false,
      				message:'',
      				checkoutData: {
            				card_number:'',
            				exp_year: '',
            				exp_month:'',
            				cvv:'',
                     term_and_condition:false,
                  },
              term_and_condition:false,
        }),

    props:[
        'page'
    ],
      
        methods: {
         placeOrder() {
          if(this.term_and_condition)
          {
                this.submitted= true;
                this.message='please wait for processing...';
                var $this = this;
                this.checkoutData.amount = this.cartDatas.price;
                this.checkoutData.plan_id = this.cartDatas.id;
                this.checkoutData.tenant_email = this.userdata.email;
                axios.post(siteIndexURL+'/v1/subscribe/plan', this.checkoutData)
                .then((result)=>{
                   this.submitted=false;
                   this.message='';     
                  if (result.data.status == true) {
                     this.$session.start();
                     this.$session.set('access', result.data.response.access_tokens);
                     this.$session.set('refresh', result.data.response.refresh_token);
                     this.$session.set('profile', result.data.response.user);
                     this.$session.set('tenant_id', result.data.response.tenant_id);
                     this.$session.set('cart', '');
                     this.$session.set('free_trial', '');
                     $this.responseHandle('success', result.data.message);
                     window.location.href="/home";
                  }
                }).catch(function (error) {
                   $this.submitted = false
                  if (error.response.data.detail) {                     
                    $this.responseHandle('warning', error.response.data.detail);
                  } 
                  if (error.response.data.message) {                    
                    $this.responseHandle('warning', error.response.data.message);
                  } 
                });
          }
          else{
              this.submitted = false;
            this.responseHandle('warning', 'Please Accept The Terms & Conditions');

          }
				
            },
            redirectPage($page = '/'){
              this.$router.push($page).catch(() => {})
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
          this.userdata = this.$session.get('userdata');
		
          this.cartDatas = this.$session.get('cart');
          if (!this.cartDatas) {
              this.$router.push('/front/plans')
          }
        }
    }
</script>

