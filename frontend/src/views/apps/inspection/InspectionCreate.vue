<template>
  <div>
    <vx-card no-shadow>
      <vs-row>
        <h2 vs-w="12" class="text-lg">Inspection Details</h2>
        <br>
        <vs-col vs-w="12" class="p-4 sm:p-2">
          <label class="text-lg">Vehicles <b>*</b></label><br>
          <select v-model="vehicle_id" v-validate="'required'" name="vehicle_id" class="w-full form-control">
            <option v-for="(vehicleOption, index) in vehicles" :key="index" :value="vehicleOption.vehicle_id">{{vehicleOption.name}}</option>
          </select>
        </vs-col>
      </vs-row>
    </vx-card>
    <br>
    <vx-card no-shadow>
      <vs-row>
        <h2 class="text-lg">Inspection Items</h2>
      </vs-row>
      <vs-divider/>
      <div v-for="(item, index) in items" :key="index">
        <div class="vx-row" v-if="item.itemID == 'passfail'">
          <div class="vx-col sm:w-1/3 w-full" >
            <div class="vx-row box_outter">
              <h3 class=" w-full">{{item.itemLabel}}</h3>
              <h5 class=" w-full">{{item.itemShortDescription}}</h5>
              <a class=" w-full" v-on:click="viewInstructions(item.itemInstructions)">View Instructions</a>
            </div>
          </div>
          <div class="vx-col sm:w-2/3 w-full" >
            <div class="vx-row box_outter">
              <div class="flex flex-wrap items-center mb-base">
                 <vs-radio :vs-value="item.itemPassLabel" v-model="item.itemPassFailLabel">{{item.itemPassLabel}}</vs-radio>
                 <vs-radio :vs-value="item.itemFailLabel" v-model="item.itemPassFailLabel">{{item.itemFailLabel}}</vs-radio>
                 <vs-radio :vs-value="item.itemEnableNALabel" v-model="item.itemPassFailLabel" v-if="item.itemEnableNA == true">{{item.itemEnableNALabel}}</vs-radio>
              </div>
              <div class="vx-col sm:w-1/1 w-full">
                 <a class="dropdown-toggle" v-on:click="item.addRemark = true" data-toggle="dropdown" aria-expanded="false">+ Add Remark</a>
                 <ul class="dropdown-menu" v-if="item.addRemark == true">
                    <li> <a v-on:click="item.addComment = true">Add Comment</a></li>
                    <li> <a v-on:click="item.addPhoto = true">Add Photo</a></li>
                 </ul>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addComment == true">
                 <label class="text-sm">Comment</label>
                 <vs-textarea v-model="item.itemRemarkComment"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addPhoto == true">
                 <div class="flex flex-wrap items-center mb-base">
                    <label class="text-sm">Photo</label>
                   <img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
					<input type="hidden" v-model="item.itemRemarkPhoto"/>
                    <vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload" @on-delete="successDelete($event,index)" :data="{'index':index}" />
					
					<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
               <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
               <vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
            </div>
                 </div>
              </div>
            </div>
          </div>
          <vs-divider/>
        </div>
        <div class="vx-row" v-if="item.itemID == 'meterentery'">
          <div class="vx-col sm:w-1/3 w-full" >
            <div class="vx-row box_outter">
              <h3 class=" w-full">{{item.itemLabel}}</h3>
              <h5 class=" w-full">{{item.itemDescription}}</h5>
            </div>
          </div>
          <div class="vx-col sm:w-2/3 w-full" >
            <div class="vx-row box_outter">
              <div class="flex flex-wrap items-center mb-base">
                <vs-input v-model="item.itemMeterOdoMeter" class="w-full mb-base" label-placeholder="Odometer"></vs-input>
                 <div class="flex flex-wrap items-center mb-base">
                    <label class="text-sm">Meter Entry Photo Verification </label>
                   <img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
						<input type="hidden" v-model="item.itemRemarkPhoto"/>
						<vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload"  @on-delete="successDelete($event,index)" :data="{'index':index}" />

						<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
						<input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
						<vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
						</div>
                 </div>
              </div>
              <div class="vx-col sm:w-1/1 w-full">
                 <a class="dropdown-toggle" v-on:click="item.addRemark = true" data-toggle="dropdown" aria-expanded="false">+ Add Remark</a>
                 <ul class="dropdown-menu" v-if="item.addRemark == true">
                    <li> <a v-on:click="item.addComment = true">Add Comment</a></li>
                    <li> <a v-on:click="item.addPhoto = true">Add Photo</a></li>
                 </ul>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addComment == true">
                 <label class="text-sm">Comment</label>
                 <vs-textarea v-model="item.itemRemarkComment"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addPhoto == true">
                 <div class="flex flex-wrap items-center mb-base">
                    <label class="text-sm">Photo</label>
						<img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
						<input type="hidden" v-model="item.itemRemarkPhoto"/>
						<vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload"  @on-delete="successDelete($event,index)" :data="{'index':index}" />

						<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
						<input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
						<vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
						</div>
                 </div>
              </div>
            </div>
          </div>
          <vs-divider/>
        </div>
        <div class="vx-row" v-if="item.itemID == 'signature'">
          <div class="vx-col sm:w-1/3 w-full" >
            <div class="vx-row box_outter">
              <h3 class=" w-full">{{item.itemLabel}}</h3>
              <h5 class=" w-full">{{item.itemDescription}}</h5>
            </div>
          </div>
          <div class="vx-col sm:w-2/3 w-full" >
            <div class="vx-row box_outter">
              <div class="flex flex-wrap items-center mb-base">
                <label class="text-sm">Signature</label>
                <vs-textarea v-model="item.itemSignature"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full">
                 <a class="dropdown-toggle" v-on:click="item.addRemark = true" data-toggle="dropdown" aria-expanded="false">+ Add Remark</a>
                 <ul class="dropdown-menu" v-if="item.addRemark == true">
                    <li> <a v-on:click="item.addComment = true">Add Comment</a></li>
                    <li> <a v-on:click="item.addPhoto = true">Add Photo</a></li>
                 </ul>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addComment == true">
                 <label class="text-sm">Comment</label>
                 <vs-textarea v-model="item.itemRemarkComment"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addPhoto == true">
                 <div class="flex flex-wrap items-center mb-base">
                    <label class="text-sm">Photo</label>
						<img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
						<input type="hidden" v-model="item.itemRemarkPhoto"/>
						<vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload"  @on-delete="successDelete($event,index)" :data="{'index':index}" />

						<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
						<input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
						<vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
						</div>
                 </div>
              </div>
            </div>
          </div>
          <vs-divider/>
        </div>
        <div class="vx-row" v-if="item.itemID == 'freeText'">
          <div class="vx-col sm:w-1/3 w-full" >
            <div class="vx-row box_outter">
              <h3 class=" w-full">{{item.itemLabel}}</h3>
              <h5 class=" w-full">{{item.itemShortDescription}}</h5>
              <a class=" w-full" v-on:click="viewInstructions(item.itemInstructions)">View Instructions</a>
            </div>
          </div>
          <div class="vx-col sm:w-2/3 w-full" >
            <div class="vx-row box_outter">
              <div class="flex flex-wrap items-center mb-base">
                <vs-textarea v-model="item.itemFreeText"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full">
                 <a class="dropdown-toggle" v-on:click="item.addRemark = true" data-toggle="dropdown" aria-expanded="false">+ Add Remark</a>
                 <ul class="dropdown-menu" v-if="item.addRemark == true">
                    <li> <a v-on:click="item.addComment = true">Add Comment</a></li>
                    <li> <a v-on:click="item.addPhoto = true">Add Photo</a></li>
                 </ul>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addComment == true">
                 <label class="text-sm">Comment</label>
                 <vs-textarea v-model="item.itemRemarkComment"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addPhoto == true">
                 <div class="flex flex-wrap items-center mb-base">
                    <label class="text-sm">Photo</label>
					<img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
					<input type="hidden" v-model="item.itemRemarkPhoto"/>
					<vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload"  @on-delete="successDelete($event,index)" :data="{'index':index}" />

					<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
					<input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
					<vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
					</div>
                 </div>
              </div>
            </div>
          </div>
          <vs-divider/>
        </div>
        <div class="vx-row" v-if="item.itemID == 'dropdown'">
          <div class="vx-col sm:w-1/3 w-full" >
            <div class="vx-row box_outter">
              <h3 class=" w-full">{{item.itemLabel}}</h3>
              <h5 class=" w-full">{{item.itemShortDescription}}</h5>
              <a class=" w-full" v-on:click="viewInstructions(item.itemInstructions)">View Instructions</a>
            </div>
          </div>
          <div class="vx-col sm:w-2/3 w-full" >
            <div class="vx-row box_outter">
              <div class="flex flex-wrap items-center mb-base">
                <select v-model="item.itemDropdown">
                  <option>select</option>
                  <option>select</option>
                  <option>select</option>
                  <option>select</option>
                </select>
              </div>
              <div class="vx-col sm:w-1/1 w-full">
                 <a class="dropdown-toggle" v-on:click="item.addRemark = true" data-toggle="dropdown" aria-expanded="false">+ Add Remark</a>
                 <ul class="dropdown-menu" v-if="item.addRemark == true">
                    <li> <a v-on:click="item.addComment = true">Add Comment</a></li>
                    <li> <a v-on:click="item.addPhoto = true">Add Photo</a></li>
                 </ul>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addComment == true">
                 <label class="text-sm">Comment</label>
                 <vs-textarea v-model="item.itemRemarkComment"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addPhoto == true">
                 <div class="flex flex-wrap items-center mb-base">
                    <label class="text-sm">Photo</label>
					<img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
					<input type="hidden" v-model="item.itemRemarkPhoto"/>
					<vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload"  @on-delete="successDelete($event,index)" :data="{'index':index}" />

					<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
					<input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
					<vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
					</div>
                 </div>
              </div>
            </div>
          </div>
          <vs-divider/>
        </div>
        <div class="vx-row" v-if="item.itemID == 'photo'">
          <div class="vx-col sm:w-1/3 w-full" >
            <div class="vx-row box_outter">
              <h3 class=" w-full">{{item.itemLabel}}</h3>
              <h5 class=" w-full">{{item.itemShortDescription}}</h5>
              <a class=" w-full" v-on:click="viewInstructions(item.itemInstructions)">View Instructions</a>
            </div>
          </div>
          <div class="vx-col sm:w-2/3 w-full" >
            <div class="vx-row box_outter">
              <div class="flex flex-wrap items-center mb-base">
					<img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
					<input type="hidden" v-model="item.itemRemarkPhoto"/>
					<vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload"  @on-delete="successDelete($event,index)" :data="{'index':index}" />

					<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
					<input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
					<vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
					</div>
              </div>
              <div class="vx-col sm:w-1/1 w-full">
                 <a class="dropdown-toggle" v-on:click="item.addRemark = true" data-toggle="dropdown" aria-expanded="false">+ Add Remark</a>
                 <ul class="dropdown-menu" v-if="item.addRemark == true">
                    <li> <a v-on:click="item.addComment = true">Add Comment</a></li>
                    <li> <a v-on:click="item.addPhoto = true">Add Photo</a></li>
                 </ul>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addComment == true">
                 <label class="text-sm">Comment</label>
                 <vs-textarea v-model="item.itemRemarkComment"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addPhoto == true">
                 <div class="flex flex-wrap items-center mb-base">
                    <label class="text-sm">Photo</label>
					<img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
					<input type="hidden" v-model="item.itemRemarkPhoto"/>
					<vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload"  @on-delete="successDelete($event,index)" :data="{'index':index}" />

					<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
					<input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
					<vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
					</div>
                 </div>
              </div>
            </div>
          </div>
          <vs-divider/>
        </div>
        <div class="vx-row" v-if="item.itemID == 'number'">
          <div class="vx-col sm:w-1/3 w-full" >
            <div class="vx-row box_outter">
              <h3 class=" w-full">{{item.itemLabel}}</h3>
              <h5 class=" w-full">{{item.itemShortDescription}}</h5>
              <a class=" w-full" v-on:click="viewInstructions(item.itemInstructions)">View Instructions</a>
            </div>
          </div>
          <div class="vx-col sm:w-2/3 w-full" >
            <div class="vx-row box_outter">
              <div class="flex flex-wrap items-center mb-base">
                <vs-input class="w-full" type="number" v-model="item.itemNumber"></vs-input>
              </div>
              <div class="vx-col sm:w-1/1 w-full">
                 <a class="dropdown-toggle" v-on:click="item.addRemark = true" data-toggle="dropdown" aria-expanded="false">+ Add Remark</a>
                 <ul class="dropdown-menu" v-if="item.addRemark == true">
                    <li> <a v-on:click="item.addComment = true">Add Comment</a></li>
                    <li> <a v-on:click="item.addPhoto = true">Add Photo</a></li>
                 </ul>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addComment == true">
                 <label class="text-sm">Comment</label>
                 <vs-textarea v-model="item.itemRemarkComment"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addPhoto == true">
                 <div class="flex flex-wrap items-center mb-base">
                    <label class="text-sm">Photo</label>
					<img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
					<input type="hidden" v-model="item.itemRemarkPhoto"/>
					<vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload"  @on-delete="successDelete($event,index)" :data="{'index':index}" />

					<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
					<input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
					<vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
					</div>
                 </div>
              </div>
            </div>
          </div>
          <vs-divider/>
        </div>
        <div class="vx-row" v-if="item.itemID == 'datetime'">
          <div class="vx-col sm:w-1/3 w-full" >
            <div class="vx-row box_outter">
              <h3 class=" w-full">{{item.itemLabel}}</h3>
              <h5 class=" w-full">{{item.itemShortDescription}}</h5>
              <a class=" w-full" v-on:click="viewInstructions(item.itemInstructions)">View Instructions</a>
            </div>
          </div>
          <div class="vx-col sm:w-2/3 w-full" >
            <div class="vx-row box_outter">
              <div class="flex flex-wrap items-center mb-base">
                <div class="vx-row">
                  <div class="vx-col sm:w-1/2 w-full" >
                    <datepicker                          
                       class="selectExample w-full"
                       :format="'yyyy-MM-dd'"
                       placeholder="Date"
                       icon-pack="feather" icon="icon-edit-2" icon-before
                       v-validate="'required'"
                        v-model="item.itemDate"
                        v-if="item.itemDateAndTimeType == 'Dateandtime' || item.itemDateAndTimeType == 'Date'"
                      data-vv-as="Date"></datepicker>
                  </div>
                  <div class="vx-col sm:w-1/2 w-full" >
                    <flat-pickr v-if="item.itemDateAndTimeType == 'Dateandtime'" :config="configdateTimePicker" class="form-control" v-model="item.itemTime" placeholder="Time" />
                  </div>
                </div>
              </div>
              <div class="vx-col sm:w-1/1 w-full">
                 <a class="dropdown-toggle" v-on:click="item.addRemark = true" data-toggle="dropdown" aria-expanded="false">+ Add Remark</a>
                 <ul class="dropdown-menu" v-if="item.addRemark == true">
                    <li> <a v-on:click="item.addComment = true">Add Comment</a></li>
                    <li> <a v-on:click="item.addPhoto = true">Add Photo</a></li>
                 </ul>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addComment == true">
                 <label class="text-sm">Comment</label>
                 <vs-textarea v-model="item.itemRemarkComment"/>
              </div>
              <div class="vx-col sm:w-1/1 w-full" v-if="item.addPhoto == true">
                 <div class="flex flex-wrap items-center mb-base">
                    <label class="text-sm">Photo</label>
					<img :src="imagepath+'/'+item.itemRemarkPhoto" width="200px" v-if="item.itemRemarkPhoto"/>
					<input type="hidden" v-model="item.itemRemarkPhoto"/>
					<vs-upload ref="item.file" text="Pick file or Drop file here" :action="uploadFile" fileName='photos' automatic  @on-success="successUpload"  @on-delete="successDelete($event,index)" :data="{'index':index}" />

					<div class="upload-img mt-5" v-if="item.itemRemarkPhoto">
					<input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
					<vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
					</div>
                 </div>
              </div>
            </div>
          </div>
          <vs-divider/>
        </div>        
      </div>
      <vs-row>
         <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click="saveForm">Save</vs-button>
         </div>
      </vs-row>
    </vx-card>
    <vs-popup class="holamundo" :title="'Instructions'" :active.sync="popupActive">
      <div class="vx-row">
        <div class="vx-col sm:w-1/3 w-full" >
          <div class="vx-row box_outter">
            {{instructions}}
          </div>
        </div>
      </div>
    </vs-popup>
  </div>
</template>
<script>
import flatPickr from 'vue-flatpickr-component'
import Datepicker from 'vuejs-datepicker';
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import axios from 'axios';
import {siteIndexURL} from '../../../axios'
export default {
  components: {
    flatPickr,
    vSelect,
    'datepicker': Datepicker
  },
  data () {
    return {		
      configdateTimePicker: {
        enableTime: true,
        enableSeconds: true,
        noCalendar: true
      },
		instructions:'',
		popupActive:false,
		vehicles:[], 
		items:[],
		item:{},
		vehicle_id:'',
		id:0,
		imagepath:siteIndexURL.replace('api', ''),	  
		uploadFile: siteIndexURL+'/v1/vehicleInspection/uploadFile'
    }
  },
  computed: {

  },
  beforeMount() {
    let currentRoute = this.$router.currentRoute.params;
    this.id = currentRoute.ID
    this.getVehicles();
    this.getInspectionTemplate();
  },
  methods: {
    viewInstructions(content = '')
    {
      this.instructions = content;
      this.popupActive = true;
    },
    getVehicles(){   	
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehicledetails')
      .then((result)=>{
        if (result.data.status == true) {
          this.vehicles = result.data.response.vehicleDetails;
        }
      }).catch(function (error) {
        if (error.response) {
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
    },
    saveForm: function()
    {
      const fields = JSON.stringify(this.items)
      var $this = this;
      const formData = new FormData();
      formData.append("fields", fields);  
      formData.append("vehicle_id", this.vehicle_id);  
      formData.append("inspection_template_id", this.id);            
      axios.post(siteIndexURL+"/v1/vehicleInspection", formData)
      .then( result => {
          if (result.data.status == true) {   
              this.responseHandle('success', result.data.message);
              $this.$router.push('/inspection')
          }
      }).catch(function(error){
        if (error.response.data.message) {
          if (error.response.data.message == 'Unauthenticated.') {
            $this.responseHandle('warning', 'Your Session is expiry, Please login again to continue');
            $this.$router.push('/auth/login')
          } else {
            $this.responseHandle('warning', error.response.data.message);
          }               
        } 
      });
    },
    successUpload: function($event)
    {
		var response = JSON.parse($event.currentTarget.response)
		var index = response.index
		this.items[index].itemRemarkPhoto = response.image     
		this.responseHandle('success', 'File uploaded successfully');
    },
	successDelete: function($event,index)
    {	
		var filepath= this.items[index].itemRemarkPhoto
		var $this = this;
		var data = {'image':filepath,'deletes':'delete'};
		axios.post(this.uploadFile, data)
		.then((result)=>{
			if(result.data.status == true){
			this.items[index].itemRemarkPhoto ='';
			this.responseHandle('success', 'File Deleted successfully');
			}
			
	  }).catch(function (error) {
        if (error.response) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });  
		
    },
	updateCurrImg (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.pageFile = input.target.files[0]
          this.itemRemarkPhoto = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
   	getInspectionTemplate: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/inspectiontemplatesitem/'+this.id)
      .then((result)=>{
        if (result.data.status == true) {
          var fields = JSON.parse(result.data.response.inspectionItems.fields);
          fields.forEach((data) => {
            if (data.itemID == 'passfail') {
              data.itemPassFailLabel = ''; 
            } else if (data.itemID == 'meterentery') {
              data.itemMeterOdoMeter = '';
              data.itemMeterPhoto = '';
              data.itemMeterFile = '';  
            } else if (data.itemID == 'signature') {
              data.itemSignature = '';  
            } else if (data.itemID == 'number') {
              data.itemNumber = '';  
            } else if (data.itemID == 'freeText') {
              data.itemFreeText = '';  
            } else if (data.itemID == 'dropdown') {
              data.itemDropdown = '';  
            } else if (data.itemID == 'photo') {
              data.itemPhoto = '';
              data.itemFile = '';  
            } else if (data.itemID == 'datetime') {
              data.itemDate = '';
              data.itemTime = '';  
            }            
            data.addRemark = false;
            data.addComment = false;
            data.addPhoto = false;
            data.itemRemarkComment = '';
            data.itemRemarkPhoto = '';
            data.itemRemarkFile = '';
            this.items.push(data);
          });
        }
      }).catch(function (error) {
        if (error.response) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
  }
}
</script>
