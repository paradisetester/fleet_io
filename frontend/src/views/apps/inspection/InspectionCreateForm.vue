<template>
   <vx-card no-shadow>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Inspection Details</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <vs-input class="w-full mb-base" label-placeholder="Vehicle Name" v-model="inspection.vehicle_name"></vs-input>
         </vs-col>
      </vs-row>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Odometer Reading</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <vs-input class="w-full mb-base" label-placeholder="Odometer" v-model="inspection.odometer"></vs-input>
            <div class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemark = !addRemark">+ Add Remark</a>
               <ul class="dropdown-menu" v-show="addRemark">
                  <li> <a v-on:click="addComment = !addComment" >Add Comment</a></li>
                  <li> <a v-on:click="addPhoto = !addPhoto" >Add Photo</a></li>
               </ul>
            </div>
            <div class="mt-5" v-show="addComment">
               <label class="text-sm">Comment</label>
               <vs-textarea v-model="inspection.comment" />
            </div>
            <div class="mt-5" v-show="addPhoto">
               <div class="flex flex-wrap items-center mb-base">
                  <label class="text-sm">Photo</label>
                  <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <h2 class="mt-8">Item Checklist</h2>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Interior Cleanliness</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <label class="text-sm">Photo</label>
               <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Engine</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.engine" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.engine" vs-value="Fail">Fail</vs-radio>
            </div>
            <div class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkEngine = !addRemarkEngine">+ Add Remark</a>
               <ul class="dropdown-menu" v-show="addRemarkEngine">
                  <li> <a v-on:click="addCommentEngine = !addCommentEngine" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoEngine = !addPhotoEngine" >Add Photo</a></li>
               </ul>
            </div>
            <div class="mt-5" v-show="addCommentEngine">
               <label class="text-sm">Comment</label>
               <vs-textarea v-model="inspection.comment" />
            </div>
            <div class="mt-5" v-show="addPhotoEngine">
               <div class="flex flex-wrap items-center mb-base">
                  <label class="text-sm">Photo</label>
                  <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Oil life left</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <vs-input class="w-full mb-base" label-placeholder="Oil life left" v-model="inspection.oil_life_left"></vs-input>
            <div class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkOil = !addRemarkOil">+ Add Remark</a>
               <ul class="dropdown-menu" v-show="addRemarkOil">
                  <li> <a v-on:click="addCommentOil = !addCommentOil" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoOil = !addPhotoOil" >Add Photo</a></li>
               </ul>
            </div>
            <div class="mt-5" v-show="addCommentOil">
               <label class="text-sm">Comment</label>
               <vs-textarea v-model="inspection.comment" />
            </div>
            <div class="mt-5" v-show="addPhotoOil">
               <div class="flex flex-wrap items-center mb-base">
                  <label class="text-sm">Photo</label>
                  <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Fuel level</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <vs-input class="w-full mb-base" label-placeholder="Fuel level" v-model="fuel_level"></vs-input>
            <div class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkFuel = !addRemarkFuel">+ Add Remark</a>
               <ul class="dropdown-menu" v-show="addRemarkFuel">
                  <li> <a v-on:click="addCommentOil = !addCommenFuel" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoOil = !addPhotoFuel" >Add Photo</a></li>
               </ul>
            </div>
            <div class="mt-5" v-show="addCommentFuel">
               <label class="text-sm">Comment</label>
               <vs-textarea v-model="inspection.comment" />
            </div>
            <div class="mt-5" v-show="addPhotoFuel">
               <div class="flex flex-wrap items-center mb-base">
                  <label class="text-sm">Photo</label>
                  <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Transmission</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.transmission" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.transmission" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkTransmission = !addRemarkTransmission">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkTransmission">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentTransmission = !addCommentTransmission" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoTransmission = !addPhotoTransmission" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentTransmission">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoTransmission">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Clutch</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.clutch" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.clutch" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkClutch = !addRemarkClutch">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkClutch">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentClutch = !addCommentClutch" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoClutch = !addPhotoClutch" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentClutch">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoClutch">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Steering Mechanism</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.steering" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.steering" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkSteering = !addRemarkSteering">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkSteering">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentSteering = !addCommentSteering" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoSteering = !addPhotoSteering" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentSteering">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoSteering">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Horn</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.horn" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.horn" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkHorn = !addRemarkHorn">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkHorn">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentHorn = !addCommentHorn" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoHorn = !addPhotoHorn" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentHorn">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoHorn">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Windshield and Wipers/Washers</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.windshield" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.windshield" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkWindshield = !addRemarkWindshield">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkWindshield">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentWindshield = !addCommentWindshield" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoWindshield = !addPhotoWindshield" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentWindshield">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoWindshield">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Rear Vision Mirrors</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.mirrors" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.mirrors" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkMirrors = !addRemarkMirrors">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkMirrors">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentMirrors = !addCommentMirrors" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoMirrors = !addPhotoMirrors" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentMirrors">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoMirrors">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Lighting Devices and Reflectors</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.lighting" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.lighting" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkLighting = !addRemarkLighting">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkLighting">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentLighting = !addCommentLighting" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoLighting = !addPhotoLighting" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentLighting">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoLighting">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Parking Brake</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.brake" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.brake" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkBrake = !addRemarkBrake">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkBrake">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentBrake = !addCommentBrake" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoBrake = !addPhotoBrake" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentBrake">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoBrake">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Service Services</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.service" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.service" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkService = !addRemarkService">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkService">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentService = !addCommentService" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoService = !addPhotoService" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentService">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoService">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Air Lines/Light Lines</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.lines" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.lines" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkLines = !addRemarkLines">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkLines">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentLines = !addCommentLines" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoLines = !addPhotoLines" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentLines">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoLines">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Coupling Devices</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.coupling" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.coupling" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkCoupling = !addRemarkCoupling">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkCoupling">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentCoupling = !addCommentCoupling" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoCoupling = !addPhotoCoupling" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentCoupling">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoCoupling">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Tires</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.tires" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.tires" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkTires = !addRemarkTires">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkTires">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentTires = !addCommentTires" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoTires = !addPhotoTires" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentTires">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoTires">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Wheels and Rims</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.wheels" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.wheels" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkWheels = !addRemarkWheels">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkWheels">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentWheels = !addCommentWheels" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoWheels = !addPhotoWheels" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentWheels">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoWheels">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row >
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Emergency Equipment</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-radio v-model="inspection.equipment" vs-value="Pass">Pass</vs-radio>
               <vs-radio v-model="inspection.equipment" vs-value="Fail">Fail</vs-radio>
            </div>
            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" v-on:click="addRemarkEquipment = !addRemarkEquipment">+ Add Remark</a>
            <div class="dropdown"  v-show="addRemarkEquipment">
               <ul class="dropdown-menu">
                  <li> <a v-on:click="addCommentEquipment = !addCommentEquipment" >Add Comment</a></li>
                  <li> <a v-on:click="addPhotoEquipment = !addPhotoEquipment" >Add Photo</a></li>
               </ul>
               <div class="mt-5" v-show="addCommentEquipment">
                  <label class="text-sm">Comment</label>
                  <vs-textarea v-model="inspection.comment" />
               </div>
               <div class="mt-5" v-show="addPhotoEquipment">
                  <div class="flex flex-wrap items-center mb-base">
                     <label class="text-sm">Photo</label>
                     <vs-upload multiple text="Pick file or Drop file here" action="https://jsonplaceholder.typicode.com/posts/" @on-success="successUpload" />
                  </div>
               </div>
            </div>
         </vs-col>
      </vs-row>
      <h2 class="mt-8">Sign-Off</h2>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Vehicle condition OK</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <label class="text-sm">This must be checked if there are no defects.</label>
               <v-select v-model="inspection.status" :options="statusOptions"  />
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2"><label class="text-sm">Reviewing Driver's Signature</label></vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2">
            <div class="flex flex-wrap items-center mb-base">
               <vs-input class="w-full mt-5" label-placeholder="Type your name to sign" v-model="inspection.signature" />
            </div>
         </vs-col>
      </vs-row>
      <vs-divider/>
      <vs-row>
         <!-- Save & Reset Button -->
         <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2">Save Changes</vs-button>
            <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
         </div>
      </vs-row>
   </vx-card>
</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import definedStrings from '../../../definedStrings'

export default {
  components: {
    flatPickr,
    vSelect
  },
  data () {
    return {
	    definedStrings:{},
		inspection : {
			'vehicle_name':'',
			'odometer':'',
			'comment':'',
			'engine':'',
			'oil_life_left':'',
			'transmission':'',
			'clutch':'',
			'steering':'',
			'horn':'',
			'windshield':'',
			'mirrors':'',
			'lighting':'',
			'brake':'',
			'service':'',
			'lines':'',
			'coupling':'',
			'tires':'',
			'wheels':'',
			'equipment':'',
			'status':'',
			'signature':'',
		},
	
		addRemark : false,
		addComment : false,
		addPhoto : false,
		
		addRemarkEngine : false,
		addCommentEngine : false,
		addPhotoEngine : false,
		
		addRemarkOil : false,
		addCommentOil : false,
		addPhotoOil : false,
		
		addRemarkFuel : false,
		addCommentFuel : false,
		addPhotoFuel : false,
		
		addRemarkTransmission : false,
		addCommentTransmission : false,
		addPhotoTransmission : false,
		
		addRemarkHorn : false,
		addCommentHorn : false,
		addPhotoHorn : false,
		
		addRemarkMirrors : false,
		addCommentMirrors : false,
		addPhotoMirrors : false,
		
		addRemarkLighting : false,
		addCommentLighting : false,
		addPhotoLighting : false,
				
		addRemarkBrake : false,
		addCommentBrake : false,
		addPhotoBrake : false,
				
		addRemarkService : false,
		addCommentService : false,
		addPhotoService : false,
				
		addRemarkLines : false,
		addCommentLines : false,
		addPhotoLines : false,
				
		addRemarkCoupling : false,
		addCommentCoupling : false,
		addPhotoCoupling : false,
				
		addRemarkTires : false,
		addCommentTires : false,
		addPhotoTires : false,
				
		addRemarkWheels : false,
		addCommentWheels : false,
		addPhotoWheels : false,
				
		addRemarkEquipment : false,
		addCommentEquipment : false,
		addPhotoEquipment : false,
		statusOptions: [
			{ 
				label: 'Active',  
				value: 'active'  
			},
			{ 
				label: 'Sold',  
				value: 'sold'  
			},
			{ 
				label: 'In Active',  
				value: 'inactive'  
			},
		],     
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  beforeMount() {
     this.definedStrings = definedStrings
  },
   methods: {
    successUpload () {
      this.$vs.notify({ color: 'success', title: 'Upload Success', text: 'Lorem ipsum dolor sit amet, consectetur' })
    }
  }
  
}
</script>
