
<template>
  <div id="page-user-edit">
    <div id="user-edit-tab-info">
      <!-- Avatar Row -->
      <vx-card>
        <div slot="no-body" class="tabs-container px-6 pt-6">
            <div><h3 class="mb-4">Order Details</h3></div>
            
                 <div class="vx-row">
                    <div class="vx-col md:w-1/4 sm:w-1/3 w-full">
                        <div class="vx-col w-full mb-2 font-bold">Order Number :</div>
                    </div>  
                    <div class="vx-col md:w-3/4 sm:w-2/3 w-full mb-6">
                        <div class="vx-col w-full ">{{ order.order_number }}</div>
                    </div>  
                </div>  
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 sm:w-1/3 w-full ">
                        <div class="vx-col w-full mb-2 font-bold">Plan :</div>
                    </div>  
                    <div class="vx-col md:w-3/4 sm:w-2/3 w-full mb-6">
                        <div class="vx-col w-full ">{{ order.plan_name }}</div>
                    </div>  
                </div>  
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 sm:w-1/3 w-full">
                        <div class="vx-col w-full mb-2 font-bold">Total Amount :</div>
                    </div>  
                    <div class="vx-col md:w-3/4 sm:w-2/3 w-full mb-6">
                        <div class="vx-col w-full">{{ order.total_amount }}</div>
                    </div>  
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 sm:w-1/3 w-full">
                        <div class="vx-col w-full mb-2 font-bold">Contact Name :</div>
                    </div>  
                    <div class="vx-col md:w-3/4 sm:w-2/3 w-full mb-6">
                        <div class="vx-col w-full">{{ order.contact_name }}</div>
                    </div>  
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 sm:w-1/3 w-full">
                         <div class="vx-col w-full mb-2 font-bold">Contact Email :</div>
                    </div>  
                    <div class="vx-col md:w-3/4 sm:w-2/3 w-full mb-6">
                        <div class="vx-col w-full">{{ order.contact_email }}</div>
                    </div>  
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 sm:w-1/3 w-full">
                         <div class="vx-col w-full mb-2 font-bold">Contact Mobile :</div>
                    </div>  
                    <div class="vx-col md:w-3/4 sm:w-2/3 w-full mb-6">
                        <div class="vx-col w-full ">{{ order.contact_mobile }}</div>
                    </div>  
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 sm:w-1/3 w-full">
                         <div class="vx-col w-full mb-2 font-bold">Transaction Number :</div>
                    </div>  
                    <div class="vx-col md:w-3/4 sm:w-2/3 w-full mb-6">
                         <div class="vx-col w-full p trans_id">{{ order.transaction_id }}</div>
                    </div>  
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 sm:w-1/3 w-full">
                        <div class="vx-col w-full mb-2 font-bold">Order Status :</div>
                    </div>  
                    <div class="vx-col md:w-3/4 sm:w-2/3 w-full mb-6">
                         <div class="vx-col w-full ">{{ order.order_status ? 'Done' : 'Not-Done' }}</div>
                    </div>  
                </div>
                <div class="vx-row">
                    <div class="vx-col md:w-1/4 sm:w-1/3 w-full">
                        <div class="vx-col w-full mb-2 font-bold">Order Date :</div>
                    </div>  
                    <div class="vx-col md:w-3/4 sm:w-2/3 w-full mb-6">
                         <div class="vx-col w-full">{{ order.order_date | YYYYMMDD }}</div>
                    </div>  
                </div>
       
        </div>

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
            order: {},
            orderId : ''
        }
    },
    methods: {
        getOrderData: function (id = null){
            let orderId = id ? id : this.orderId;
            var $this = this;
            if(orderId){
                axios.get(siteIndexURL+'/v1/orders/'+orderId).then((result)=>{
                    if (result.data.status == true) {
                        $this.order = result.data.response.order;
                    }
                }).catch(function (error) {
                    if (error.response.data.detail) {
                        $this.responseHandle('warning', error.response.data.detail);
                    } 
                });
            }
            
        },
    },
    beforeMount() { 
        let currentParams = this.$router.currentRoute.params;
        this.orderId = currentParams.orderId
        this.getOrderData(this.orderId);
    }
}
</script>
                        
                        
                        
                       
                    