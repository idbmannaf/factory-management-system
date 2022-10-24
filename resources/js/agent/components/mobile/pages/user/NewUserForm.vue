<template>
  <div class="padding-around">
      <div class="h5">Add New User</div>
      <div class="form-group">
          <label for="name">Full Name*</label>
          <input type="text" v-model="userInfo.name" class="form-control" :class="{'is-invalid' : error.name}">
          <div class="alert alert-danger" v-for="(msg, index) in error.name" :key="index">
                {{ msg }}
            </div>
      </div>
      <div class="form-group">
          <label for="">Mobile*</label>
          <input type="text" v-model="userInfo.mobile" class="form-control" :class="{'is-invalid' : error.mobile}">
          <div class="alert alert-danger" v-for="(msg, index) in error.mobile" :key="index">
                {{ msg }}
            </div>
      </div>
      <div class="form-group">
          <label for="">Email (optional)</label>
          <input type="email" v-model="userInfo.email" class="form-control" :class="{'is-invalid': error.email}">
          <div class="alert alert-danger" v-for="(msg, index) in error.email" :key="index">
                {{ msg }}
            </div>
      </div>
      <div class="my-2 text-center">
          <button class="btn btn-primary btn-sm" :disabled="!userInfo.name || !userInfo.mobile" @click="saveUser()"><i class="fa fa-user-plus"></i> Add User</button>
      </div>
  </div>
</template>

<script>
import eventBus from './../../../../event-bus'
export default {
    props: ['agent'],
    data() {
        return {
            userInfo: {},
            error: {},
        }
    },
    created() {
    },
    methods: {
        saveUser(){
            this.error = {}
            axios.post(window.location.origin+`/api/agent/${this.agent}/user/save`, this.userInfo).then(res => {
                if (res.status == 200) {
                    this.$swal({
                        title: 'Success!',
                        text: 'User is added with a temporary password.',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    eventBus.$emit('newUserAdded', res.data)
                }else{
                    this.error = res.data
                }
            })
        }
    },
}
</script>

<style>

</style>