<template>
   <div class="vx-row">

                  <div class="vx-col w-full md:w-1/3 mb-base address-section">

                    <div class="active">
                        <div :class="'pricingTable2 '+ cartDatas.color">
                            <div class="pricingTable-header">
                                <h3 class="title">{{cartDatas.heading}}</h3>
                                <div class="price-value">${{cartDatas.price}} per month</div> 
                            </div>
                            
                            <p v-html="cartDatas.features"></p>
                            <a @click="addToCart(plan,'paid')" class="pricingTable-signup">Subscribe Now</a>
                        </div>
                    </div>

                  </div>
                  <div class="vx-col w-full md:w-2/3 mb-base cart-section">
                <vx-card title="Checkout">
                    <form v-on:submit.prevent>
                    <div class="panel panel-info" v-if="cartDatas.price > 0">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                        <div class="panel-body">
                           <div class="form-group mt-5">
                              <strong>Card Number:</strong>
                              <input v-cardformat:formatCardNumber type="text" class="form-control" name="card_number" v-model="checkoutData.card_number" value="" placeholder="Enter Card Number" />
                           </div>
                           <div class="form-group ">
                              <div class="vx-row">
                                 <div class="vx-col w-full md:w-1/2 mt-5">
                                    <div class="col-md-12"><strong>Exp Year:</strong></div>
                                    <input type="text" class="form-control" name="exp_year" v-model="checkoutData.exp_year" placeholder="Enter Year" /> 
                                 </div>
                                 <div class="vx-col w-full md:w-1/2 margin-bt mt-5">
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
                                 <vs-checkbox class="input-checkbox renew_chk" id="card_payment" @change="checkprivacy($event)" v-model="checkoutData.term_and_condition" type="checkbox"><span>I’ve read and accept the terms & conditions</span></vs-checkbox>
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
    import {siteIndexURL, siteFrontIndexURL} from '@/axios'
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
                cartDatas : {}
            }
        },
        methods: {
            placeOrder() {
              if(this.checkoutData.term_and_condition)
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
                        this.$session.set('profile', result.data.response.user); 
                        $this.responseHandle('success', result.data.message);
                        window.location.href=siteFrontIndexURL+"home"
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
                this.submitted= true;
                this.responseHandle('warning', 'Please Accept The Terms & Conditions');
              }
                
            },
            checkprivacy(name)
            {
              if(name.isTrusted)
              {
                this.submitted= false;
              }
              else{
                this.submitted= true;
              }

            }
            ,
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
            getCartDetails(id){
                let $this = this;
                axios.get(siteIndexURL+'/v1/plans/'+id).then((result)=>{
                    if(result.data.status == true){
                        $this.cartDatas = result.data.response.plan
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
            this.cartDatas = this.$session.get('cart');
            if (!this.cartDatas) {
                var plan_id = this.userdata.company.plan_id
                this.getCartDetails(plan_id);
            }

        }
    }
</script>

