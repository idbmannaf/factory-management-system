<template>
  <div class="padding-top">
    <div class="card">
        <div class="card-header">
            Create new User
        </div>
        <div class="card-body">
        <select-user :agent="agent" :newUser="true"></select-user>
        </div>
    </div>
  </div>
</template>

<script>
import eventBus from './../../../../../event-bus'
export default {
    props: ['agent'],
    data() {
        return {

        }
    },
    mounted() {
        eventBus.$emit('newUserAdded')
    },

}
</script>

<style>

</style>
