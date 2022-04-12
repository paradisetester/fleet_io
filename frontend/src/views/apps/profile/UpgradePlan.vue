<template>
   <div class="vx-row">

                  <div class="vx-col w-full md:w-1/3 mb-base address-section upgrade_box">

                    <div  v-for="(plan, i ) in cartDatas" :key="i" :class="{ active: i === activeItem}" >
                        <div :class="'pricingTable2 '+ plan.color" v-on:click="addToCart(plan,i)">
                            <div class="pricingTable-header">
                                <h3 class="title">{{plan.heading}}</h3>
                                <div class="price-value">${{plan.price}} per month</div>
                            </div>
                        
                            <a  href="javascript:void(0)"  v-on:click="addToCart(plan,i)" class="pricingTable-signup">Subscribe Now</a>
                        </div>
                    </div>

                  </div>
                  <div class="vx-col w-full md:w-2/3 mb-base cart-section">
 <vx-card title="Checkout">
     <form v-on:submit.prevent>
        <div class="panel panel-info">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                        <div class="panel-body">
                           <div class="form-group mt-5">
                              <strong>Card Number:</strong>
                              <input v-cardformat:formatCardNumber type="text" class="form-control" name="card_number" v-model="checkoutData.card_number" value="" placeholder="Enter Card Number" />
                           </div>
                           <div class="form-group mt-5">
                              <div class="vx-row">
                                 <div class="vx-col w-full md:w-1/2">
                                    <div class="col-md-12"><strong>Exp Year:</strong></div>
                                    <input type="text" class="form-control" name="exp_year" v-model="checkoutData.exp_year" placeholder="Enter Year" /> 
                                 </div>
                                 <div class="vx-col w-full md:w-1/2 margin-bt">
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
                           <div class="form-group mt-5">
                               <strong>Card CVV:</strong>
                               <input type="text" class="form-control" v-cardformat:formatCardCVC name="cvv" v-model="checkoutData.cvv" placeholder="Enter CVV" />
                           </div>
                        </div>
                     </div>


                       <div class="panel panel-info mt-5">
                        <div class="panel-body">
                            <div class="form-group">
                              <div class="col-xs-12">
                                 <vs-checkbox class="input-checkbox " id="card_payment" v-model="checkoutData.term_and_condition" type="checkbox"><span>I’ve read and accept the terms & conditions</span></vs-checkbox>
                                 <div class="pull-left mt-5"> 
                                  <vs-button color="success"   class="pricingTable-signup"  @click.prevent="placeOrder" :disabled="submitted" name="Proceed to Checkout">Proceed to Pay</vs-button>

                                </div>
                 <p v-if="message">{{message}}</p>
                              </div>
                            </div>
                        </div>
                     </div>
                     </form>  
                      </vx-card>
                  </div>

    </div>
</template>

<script>
    import axios from 'axios';
    import {siteIndexURL} from '@/axios'
    export default {
        data(){
            return {
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
                    renew_plan: true
                },
                cartDatas : {},
                activeItem: null,
                plan_price:'',
                plan_id:'',
            }
        },
        methods: {
            addToCart:function(plan,i)
            {

              this.activeItem = i;
              this.plan_price = plan.price;
              this.plan_id = plan.id;
             
             },

            placeOrder() {
               // this.submitted= true;
              this.message='please wait for processing...';
              var $this = this;
              this.checkoutData.amount = this.plan_price;
              this.checkoutData.plan_id = this.plan_id;
              this.checkoutData.tenant_email = this.userdata.email;
              
                axios.post(siteIndexURL+'/v1/subscribe/plan', this.checkoutData)
                .then((result)=>{
                    this.message='';
                   
                    if (result.data.status == true) {
                        this.$session.start();
                        this.$session.set('profile', result.data.response.user);          
                        $this.responseHandle('success', result.data.message);
                        this.$router.push('/home').catch(() => {})
                    }
                }).catch(function (error) {
                    if (error.response.data.detail) {
                        $this.responseHandle('warning', error.response.data.detail);
                    } 
                    if (error.response.data.message) {
                        $this.responseHandle('warning', error.response.data.message);
                    } 
                });
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
            },
            getPlanDetails(){
                let $this = this;
                axios.get(siteIndexURL+'/v1/plans').then((result)=>{
                   
                    if(result.data.response.plans){
                        $this.cartDatas = result.data.response.plans

                    }
                }).catch(function (error) {
                    if (error.response.data.detail) {
                        $this.responseHandle('warning', error.response.data.detail);
                    } 
                    if (error.response.data.message) {
                        $this.responseHandle('warning', error.response.data.message);
                    } 
                });
            }
        },
        beforeMount() {
            this.$session.start();
            this.userdata = this.$session.get('profile');           
            this.getPlanDetails();           
        }
    }
</script>

