<template>
    <div :style="{'direction': $vs.rtl ? 'rtl' : 'ltr'}">
      <div class="demo-alignment">
        <vs-button color="success" @click="manageRecord" type="filled" icon-pack="feather" icon="icon-info"></vs-button>
        <vs-button color="warning" @click="confirmDeleteRecord" type="filled"  icon-pack="feather" icon="icon-trash-2"></vs-button>
      </div>
    </div>
</template>

<script>
import axios from 'axios';
import {API, siteIndexURL} from '../../../../axios'
export default {
  name: 'CellRendererActions',
  methods: {
    editRecord () {
      const id = this.params.data.id
      this.$router.push(`/client/edit/${id}`).catch(() => {})
    },
    manageRecord () {
      const id = this.params.data.id
      this.$router.push(`/client/manage/${id}`).catch(() => {})
    },
    confirmDeleteRecord () {
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: 'Confirm Delete',
        text: `You are about to delete "${this.params.data.name}"`,
        accept: this.deleteRecord,
        acceptText: 'Delete'
      })
    },
    deleteRecord () {
      const id = this.params.data.id
      var $this = this;
      axios.delete(siteIndexURL+'/v1/profile/profile/delete/'+id+'/')
      .then((result)=>{
        $this.responseHandle('success', result.data.message);
        $this.$router.go(`/clients`).catch(() => {})
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
        if (error.response.data.message) {
          $this.responseHandle('warning', error.response.data.message);
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
  }
}
</script>
