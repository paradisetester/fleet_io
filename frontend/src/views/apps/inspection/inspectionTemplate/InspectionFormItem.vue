<template>
   <div class="vx-row">
     <vx-card>
     	<vs-tabs v-model="activeTab" class="tab-action-btn-fill-conatiner">
     	  	<vs-tab :label="'Inspection Items ('+ itemsCount+')'" icon-pack="feather" icon="icon-user">
		        <vs-dropdown vs-custom-content vs-trigger-click>
		           <a class="flex items-center btn" href.prevent>
		              <vs-button color="primary" type="filled">
		                 <span>Add Inspection Item</span>
		                 <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4 ml-1" />
		              </vs-button>
		           </a>
		           <vs-dropdown-menu class="dropdown-login">
		              <h3 class="mb-0">Item List</h3>
		              <ul>
		                 <li @click.prevent="createItem('passfail')"><a class="lists-item" data-id="1"> <i class="fa fa-clock"></i> </a> Pass / Fail</li>
		                 <li @click.prevent="createItem('meter')"><a class="lists-item" data-id="2"> <i class="fa fa-clock"></i> </a> Meter Entry</li>
		                 <li @click.prevent="createItem('signature')"><a class="lists-item" data-id="3"> <i class="fa fa-clock"></i> </a> Signature  </li>
		                 <li @click.prevent="createItem('freeText')"><a class="lists-item" data-id="4"> <i class="fa fa-clock"></i> </a> Free Text  </li>
		                 <li @click.prevent="createItem('dropdown')"><a class="lists-item" data-id="5"> <i class="fa fa-clock"></i> </a> Dropdown   </li>
		                 <li @click.prevent="createItem('photo')"><a class="lists-item" data-id="6"> <i class="fa fa-clock"></i> </a> Photo      </li>
		                 <li @click.prevent="createItem('number')"><a class="lists-item" data-id="7"> <i class="fa fa-clock"></i> </a> Number     </li>
		                 <li @click.prevent="createItem('datetime')"><a class="lists-item" data-id="8"> <i class="fa fa-clock"></i> </a> Date Time  </li>
		              </ul>
		           </vs-dropdown-menu>
		        </vs-dropdown>
		        <vs-collapse  :type="type" accordion>
		           <div v-for="(item, index) in items" :key="index">
		              <vs-collapse-item class="vs-collapse-item-row" data-id="passfail" v-if="item.itemID == 'passfail'">
		                 <div slot="header">
		                    <div class="vx-row headerSlot">
		                       <div class="vx-col sm:w-1/3 w-full">
		                          <vs-input class="w-full" placeholder="Enter Label" v-model="item.itemLabel"></vs-input>
		                       </div>
		                       <div class="vx-col sm:w-1/3 w-full">
		                          <small style="font-size: 12px;">{{item.itemName}}</small>
		                       </div>
		                    </div>
		                 </div>
		                 <div class="buttonControl">
		                    <vs-button class="w-full vs-button-danger ml-auto mt-6 sm:w-1/1" v-on:click="removeItem(index)"><i class="fas fa-trash-alt"></i></vs-button>
		                 </div>
		                 <div class="mt-5">
		                    <vs-checkbox v-model="item.itemRequired">Required?</vs-checkbox>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Short Description</label>
		                    <vs-input class="w-full mb-base" v-model="item.itemShortDescription"></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Instructions</label>
		                    <vs-textarea v-model="item.itemInstructions" />
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Pass Label</label>
		                    <vs-input class="w-full mb-base" label-placeholder="Label" v-model="item.itemPassLabel"></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Fail Label</label>
		                    <vs-input class="w-full mb-base" label-placeholder="Label" v-model="item.itemFailLabel"></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">N/A Option</label>
		                    <vs-checkbox v-model="item.itemEnableNA">Required?</vs-checkbox>
		                    <vs-input :label="'N/A Label'" v-model="item.itemEnableNALabel" v-if="item.itemEnableNA == true"></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Remarks</label>
		                    <vs-checkbox v-model="item.itemRequiredPhotoCommentForPass">Require photo or comment for "Pass"</vs-checkbox>
		                    <vs-checkbox v-model="item.itemRequiredPhotoCommentForFail">Require photo or comment for "Fail"</vs-checkbox>
		                 </div>
		              </vs-collapse-item>
		              <vs-collapse-item class="vs-collapse-item-row"  data-id="meter" v-if="item.itemID == 'meterentery'">
		                 <div slot="header">
		                    <div class="vx-row">
		                       <div class="vx-col sm:w-1/3 w-full">
		                          <vs-input class="w-full" placeholder="Enter Label" v-model="item.itemLabel"></vs-input>
		                       </div>
		                       <div class="vx-col sm:w-1/3 w-full"> <small style="font-size: 12px;">{{item.itemName}}</small>
		                       </div>
		                    </div>
		                 </div>
		                 <div class="buttonControl">
		                    <vs-button class="w-full vs-button-danger ml-auto mt-6 sm:w-1/1"  v-on:click="removeItem(index)"><i class="fas fa-trash-alt"></i></vs-button>
		                 </div>
		                 <div class="mt-5">
		                    <vs-checkbox v-model="item.itemRequired">Required?</vs-checkbox>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Description</label>
		                    <vs-input class="w-full mb-base" label-placeholder="Label" v-model="item.itemDescription"></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <vs-checkbox v-model="item.itemRequiredSecondaryMeter">Require Secondary Meter?</vs-checkbox>
		                    <vs-checkbox v-model="item.itemRequiredPhotoVerification">Require Photo Verification</vs-checkbox>
		                 </div>
		              </vs-collapse-item>
		              <vs-collapse-item class="vs-collapse-item-row" data-id="signature" v-if="item.itemID == 'signature'">
		                 <div slot="header">
		                    <div class="vx-row">
		                       <div class="vx-col sm:w-1/3 w-full">
		                          <vs-input class="w-full" placeholder="Enter Label" v-model="item.itemLabel"></vs-input>
		                       </div>
		                       <div class="vx-col sm:w-1/3 w-full"> <small style="font-size: 12px;">{{item.itemName}}</small>
		                       </div>
		                    </div>
		                 </div>
		                 <div class="buttonControl">
		                    <vs-button class="w-full vs-button-danger ml-auto mt-6 sm:w-1/1"  v-on:click="removeItem(index)"><i class="fas fa-trash-alt"></i></vs-button>
		                 </div>
		                 <div class="mt-5">
		                    <vs-checkbox v-model="item.itemRequired">Required?</vs-checkbox>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Description</label>
		                    <vs-textarea v-model="item.itemDescription" />
		                 </div>
		              </vs-collapse-item>
		              <vs-collapse-item class="vs-collapse-item-row" data-id="dropdown" v-if="item.itemID == 'dropdown'">
		                 <div slot="header">
		                    <div class="vx-row">
		                       <div class="vx-col sm:w-1/3 w-full">
		                          <vs-input class="w-full" placeholder="Enter Label" v-model="item.itemLabel"></vs-input>
		                       </div>
		                       <div class="vx-col sm:w-1/3 w-full"> <small style="font-size: 12px;">{{item.itemName}}</small>
		                       </div>
		                    </div>
		                 </div>
		                 <div class="buttonControl">
		                    <vs-button class="w-full vs-button-danger ml-auto mt-6 sm:w-1/1" v-on:click="removeItem(index)"><i class="fas fa-trash-alt"></i></vs-button>
		                 </div>
		                 <div class="mt-5">
		                    <vs-checkbox v-model="item.itemRequired">Required?</vs-checkbox>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Short Description</label>
		                    <vs-input class="w-full mb-base" v-model="item.itemShortDescription" ></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Instructions</label>
		                    <vs-textarea v-model="item.itemInstructions" />
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Choices</label>
		                    <vs-textarea v-model="item.itemChoices" />
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Remarks</label>							
		                    <vs-checkbox v-model="item.itemRequiredPhotoCommentForPass">Require photo or comment for "Pass"</vs-checkbox>
		                    <vs-checkbox v-model="item.itemRequiredPhotoCommentForFail">Require photo or comment for "Fail"</vs-checkbox>
		                 </div>
		              </vs-collapse-item>
		              <vs-collapse-item class="vs-collapse-item-row" data-id="photo" v-if="item.itemID == 'photo'">
		                 <div slot="header">
		                    <div class="vx-row">
		                       <div class="vx-col sm:w-1/3 w-full">
		                          <vs-input class="w-full" placeholder="Enter Label" v-model="item.itemLabel"></vs-input>
		                       </div>
		                       <div class="vx-col sm:w-1/3 w-full"> <small style="font-size: 12px;">{{item.itemName}}</small>
		                       </div>
		                    </div>
		                 </div>
		                 <div class="buttonControl">
		                    <vs-button class="w-full vs-button-danger ml-auto mt-6 sm:w-1/1" v-on:click="removeItem(index)"><i class="fas fa-trash-alt"></i></vs-button>
		                 </div>
		                 <div class="mt-5">
		                    <vs-checkbox v-model="item.itemRequired">Required?</vs-checkbox>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Short Description</label>
		                    <vs-input class="w-full mb-base" label-placeholder="Label" v-model="item.itemShortDescription"></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Instructions</label>
		                    <vs-textarea v-model="item.itemInstructions" />
		                 </div>
		              </vs-collapse-item>
		              <vs-collapse-item class="vs-collapse-item-row" data-id="freeText" v-if="item.itemID == 'freeText'">
		                 <div slot="header">
		                    <div class="vx-row">
		                       <div class="vx-col sm:w-1/3 w-full">
		                          <vs-input class="w-full" placeholder="Enter Label" v-model="item.itemLabel"></vs-input>
		                       </div>
		                       <div class="vx-col sm:w-1/3 w-full"> <small style="font-size: 12px;">{{item.itemName}}</small>
		                       </div>
		                    </div>
		                 </div>
		                 <div class="buttonControl">
		                    <vs-button class="w-full vs-button-danger ml-auto mt-6 sm:w-1/1" v-on:click="removeItem(index)"><i class="fas fa-trash-alt"></i></vs-button>
		                 </div>
		                 <div class="mt-5">
		                    <vs-checkbox v-model="item.itemRequired">Required?</vs-checkbox>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Short Description</label>
		                    <vs-input class="w-full mb-base" label-placeholder="Label" v-model="item.itemShortDescription"></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Instructions</label>
		                    <vs-textarea v-model="item.itemInstructions" />
		                 </div>
		              </vs-collapse-item>
		              <vs-collapse-item class="vs-collapse-item-row" data-id="number" v-if="item.itemID == 'number'">
		                 <div slot="header">
		                    <div class="vx-row">
		                       <div class="vx-col sm:w-1/3 w-full">
		                          <vs-input class="w-full" placeholder="Enter Label" v-model="item.itemLabel"></vs-input>
		                       </div>
		                       <div class="vx-col sm:w-1/3 w-full"> <small style="font-size: 12px;">{{item.itemName}}</small>
		                       </div>
		                    </div>
		                 </div>
		                 <div class="buttonControl">
		                    <vs-button class="w-full vs-button-danger ml-auto mt-6 sm:w-1/1" v-on:click="removeItem(index)"><i class="fas fa-trash-alt"></i></vs-button>
		                 </div>
		                 <div class="mt-5">
		                    <vs-checkbox v-model="item.itemRequired">Required?</vs-checkbox>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Short Description</label>
		                    <vs-input class="w-full mb-base" label-placeholder="Label" v-model="item.itemShortDescription"></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Instructions</label>
		                    <vs-textarea v-model="item.itemInstructions" />
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Passing Range</label>
		                    <vs-input class="w-full mb-base" label-placeholder="No Min" v-model="item.itemPassingRangeMin"></vs-input>
		                    <label class="text-sm">to</label>
		                    <vs-input class="w-full mb-base" label-placeholder="No Max" v-model="item.itemPassingRangeMax"></vs-input>
		                 </div>
		              </vs-collapse-item>
		              <vs-collapse-item class="vs-collapse-item-row" data-id="datetime" v-if="item.itemID == 'datetime'">
		                 <div slot="header">
		                    <div class="vx-row">
		                       <div class="vx-col sm:w-1/3 w-full">
		                          <vs-input class="w-full" placeholder="Enter Label" v-model="item.itemLabel"></vs-input>
		                       </div>
		                       <div class="vx-col sm:w-1/3 w-full"> <small style="font-size: 12px;">{{item.itemName}}</small>	
		                       </div>
		                    </div>
		                 </div>
		                 <div class="buttonControl">
		                    <vs-button class="w-full vs-button-danger ml-auto mt-6 sm:w-1/1" v-on:click="removeItem(index)"><i class="fas fa-trash-alt"></i></vs-button>
		                 </div>
		                 <div class="mt-5">
		                    <vs-checkbox v-model="item.itemRequired">Required?</vs-checkbox>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Short Description</label>
		                    <vs-input class="w-full mb-base" label-placeholder="Label" v-model="item.itemShortDescription"></vs-input>
		                 </div>
		                 <div class="mt-5">
		                    <label class="text-sm">Instructions</label>
		                    <vs-textarea v-model="item.itemInstructions" />
		                 </div>
		                 <div class="mt-5">
		                    <vs-radio v-model="item.itemDateAndTimeType" vs-value="Date">Date</vs-radio>
		                    <vs-radio v-model="item.itemDateAndTimeType" vs-value="Dateandtime">Date and time</vs-radio>
		                 </div>
		              </vs-collapse-item>
		           </div>
		        </vs-collapse>
		        <div class="flex flex-wrap items-center justify-end">
		           <vs-button class="ml-auto mt-2" @click.prevent="saveForm">Save Changes</vs-button>
		           <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
		        </div>
    	   	</vs-tab>
    	   	<vs-tab label="Vehicles" icon-pack="feather" icon="icon-info">
    	   		<div class=" flex-wrap items-center">
    	   		   <vs-button class="ml-auto mt-2" @click="addAllVehicles">Add All Vehicles</vs-button>
    	   		   <vs-button class="ml-4 mt-2" type="border" color="warning" @click="addSpecificVehicles = true">Add Specific Vehicles</vs-button>
    	   		   <div class="vx-col sm:w-1/1 w-full" v-if="addSpecificVehicles == true">
    	   		      <div class="vx-row box_outter">
    	   		         <vs-select
    	   		            placeholder="Search and select"
    	   		            v-validate="'required'"
    	   		            class=" "
    	   		            style="width: 100%;"
    	   		            label="Select Specific Vehicle"
    	   		            v-model="specificVehicleID"
    	   		            @change="specifiVehicleChangeEvent"
    	   		            name="specificVehicleID"
    	   		            >
    	   		            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in specificVehicleOptions" />
    	   		         </vs-select>
    	   		      </div>
    	   		   </div>
    	   		   <div class="vx-col sm:w-1/1 w-full">
    	   		      <div class="vx-row box_outter">
    	   		         <div class="vs-component vs-con-table stripe vs-table-primary clt_manage">
    	   		            <div class="con-tablex vs-table--content">
    	   		               <div class="vs-con-tbody vs-table--tbody ">
    	   		                  <table class="vs-table vs-table--tbody-table">
    	   		                     <thead class="vs-table--thead">
    	   		                        <tr>
    	   		                           <th><div class="vs-table-text">Vehicle Name</div></th>
    	   		                        </tr>
    	   		                     </thead>
    	   		                     <tbody>
    	   		                        <tr class="tr-values vs-table--tr tr-table-state-null" v-for="(listedVehicleID, keyIndex) in listedVehicleIDS" :key="keyIndex">
    	   		                           <td class="td vs-table--td">{{listedVehicleID.text}}</td>
    	   		                        </tr>
    	   		                     </tbody>
    	   		                  </table>
    	   		               </div>
    	   		            </div>
    	   		         </div>
    	   		      </div>
    	   		  </div>
    	   		</div>
    	   	</vs-tab>
    	</vs-tabs>
     </vx-card>
   </div>
</template>
<script>
import axios from 'axios';
import {siteIndexURL} from '../../../../axios'

export default {		
	data: () => (
	{	
		type: 'margin',
		value1: '',
		value2: '',
		activeTab:0,
		addSpecificVehicles:false,
		specificVehicleID:'',
		specificVehicleOptions:[
			
		],
		listedVehicleIDS:[],
		items: [		
		],
		template_id:''
	}),
	computed: {
		itemsCount()
		{
			return this.items.length;
		}
	},
	methods: {
		addAllVehicles(){
			this.addSpecificVehicles = false
			this.listedVehicleIDS = this.specificVehicleOptions;
		},
		specifiVehicleChangeEvent: function()
		{
			if (this.specificVehicleOptions.length > 0) {
				var specificVehicle;
				for (var i = 0; i < this.specificVehicleOptions.length; i++) {
					specificVehicle = this.specificVehicleOptions[i];
					if (specificVehicle.value == this.specificVehicleID) {
						this.listedVehicleIDS.push(specificVehicle);
					}					
				}
			}
		},
		removeItem: function(index)
		{
			if (index > -1) {
			  this.items.splice(index, 1);
			}
		},
		createItem: function(type)
		{
			var typeDateTime = {
				itemName: 'Date Time',
				itemID: 'datetime',
				itemLabel: '',
				itemRequired: false,
				itemShortDescription: '',
				itemInstructions: '',
				itemDateAndTimeType:''
			};
			var typeNumber = {
				itemName: 'Number',
				itemID: 'number',
				itemLabel: '',
				itemRequired: false,
				itemShortDescription: '',
				itemInstructions: '',
				itemPassingRangeMin:'',
				itemPassingRangeMax:''
			};
			var typePhoto = {
				itemName: 'Photo',
				itemID: 'photo',
				itemLabel: '',
				itemRequired: false,
				itemDescription: '',
				itemInstructions: ''
			};
			var typeDropDown = {
				itemName: 'Dropdown',
				itemID: 'dropdown',
				itemLabel: '',
				itemRequired: false,
				itemShortDescription: '',
				itemInstructions: '',
				itemChoices: '',
				itemRequiredPhotoCommentForPass: false,
				itemRequiredPhotoCommentForFail: false
			};
			var typeSignature = {
				itemName: 'Signature',
				itemID: 'signature',
				itemLabel: '',
				itemRequired: false,
				itemDescription: ''
			};
			var typeMeterEntry = {
				itemName: 'Meter Entry',
				itemID: 'meterentery',
				itemLabel: '',
				itemRequired: false,
				itemDescription: '',
				itemRequiredSecondaryMeter: false,
				itemRequiredPhotoVerification: false
			};
			var typePassFail = {
				itemName: 'Pass/Fail',
				itemID: 'passfail',
				itemLabel: '',
				itemRequired: false,
				itemShortDescription: '',
				itemInstructions: '',
				itemPassLabel: '',
				itemFailLabel: '',
				itemEnableNA: false,
				itemEnableNALabel:'',
				itemRequiredPhotoCommentForPass: false,
				itemRequiredPhotoCommentForFail: false
			};
			var typeFreeText = {
				itemName: 'Free Text',
				itemID: 'freeText',
				itemLabel: '',
				itemRequired: false,
				itemShortDescription: '',
				itemInstructions: ''
			};
			if (type == 'passfail') {
				this.items.push(typePassFail);
			} else if (type == 'meter') {
				this.items.push(typeMeterEntry);
			} else if (type == 'signature') {
				this.items.push(typeSignature);
			} else if (type == 'freeText') {
				this.items.push(typeFreeText);
			} else if (type == 'dropdown') {
				this.items.push(typeDropDown);
			} else if (type == 'photo') {
				this.items.push(typePhoto);
			} else if (type == 'number') {
				this.items.push(typeNumber);
			} else if (type == 'datetime') {
				this.items.push(typeDateTime);
			}
		},
		getInspectiontemplates: function ()
		{
		  var $this = this;
		  axios.get(siteIndexURL+'/v1/inspectiontemplatesitem/'+this.template_id)
		  .then((result)=>{		   
		     if (result.data.status == true) {  					
				this.items =  JSON.parse(result.data.response.inspectionItems.fields);
		    }		  
		  }).catch(function (error) {
		    if (error.response) {9729273935
		      	if (error.response.data.detail) {
		      	  	$this.responseHandle('warning', error.response.data.detail);
		      	} 
		      	if (error.response.data.message) {
		      		if (error.response.data.message == 'Unauthenticated.') {
		      			$this.responseHandle('warning', 'Your Session is expiry, Please login again to continue');
		      			$this.$router.push('/auth/login')
		      		} else {
		      			$this.responseHandle('warning', error.response.data.message);
		      		}		      	  	
		      	} 
		    }
		  });
		},
		saveForm: function()
		{
			this.$validator.validateAll().then(result => {
			    if (result) {
			        const fields = JSON.stringify(this.items)
			        var $this = this;
			        const formData = new FormData();
			        formData.append("fields", fields);         
			        formData.append("inspection_template_id", $this.template_id);
			        axios.post(siteIndexURL+"/v1/inspectiontemplatesitem", formData)
			        .then( result => {
			            if (result.data.status == true) {		
			              	this.responseHandle('success', result.data.message);
			              	$this.$router.push('/inspection/forms')
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
		        } else {
		          this.responseHandle('warning', 'Please solve errors');
		        }
			})
		},
		getVehicles(){
			var $this = this;
			  axios.get(siteIndexURL+'/v1/vehicledetails/')
			  .then((result)=>{		   
			     if (result.data.status == true) {  					
					var vehicles = result.data.response.vehicleDetails;
					if (vehicles.length > 0) {
						var specificOption;
						for (var i = 0; i < vehicles.length; i++) {
							specificOption = {
								value: vehicles[i].vehicle_id,
								text: vehicles[i].name
							}
							this.specificVehicleOptions.push(specificOption);
						}
					}
			    }		  
			  }).catch(function (error) {
			    if (error.response) {
			      	if (error.response.data.detail) {
			      	  	$this.responseHandle('warning', error.response.data.detail);
			      	} 
			      	if (error.response.data.message) {
			      		if (error.response.data.message == 'Unauthenticated.') {
			      			$this.responseHandle('warning', 'Your Session is expiry, Please login again to continue');
			      			$this.$router.push('/auth/login')
			      		} else {
			      			$this.responseHandle('warning', error.response.data.message);
			      		}		      	  	
			      	} 
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
	beforeMount(){
	    let currentRoute = this.$router.currentRoute.params;
	    this.template_id = currentRoute.ID ;
	    this.getVehicles()
	    if(this.template_id){
	    	this.getInspectiontemplates();
	    }
	},
	beforeDestroy() {
if (this.$refs.vsCollapseItem) {
    for (let collapseItem of this.$refs.vsCollapseItem){
    window.removeEventListener('resize', collapseItem);
   }
   }
  },
}
</script>
<style type="text/css">
	.dropdown-login li {
		cursor: pointer;
	}
	.vs-collapse-item-row{
		position: relative;
	}
	.buttonControl {
		display: block !important;
	}
</style>