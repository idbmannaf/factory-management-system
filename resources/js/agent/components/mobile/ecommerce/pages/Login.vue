<template>
  <div>
<div class="bg-primary padding-x padding-bottom">
    <h3 class="title-page text-white text-center">Sign in</h3>
</div>

<section class="padding-around text-center">
    <a class="btn btn-success" href="/login">Login</a>
</section>
  </div>
</template>

<script>
export default {
data() {
    return {
        token: null,
    }
},
created() {
    this.token = document.querySelector('meta[name=csrf-token]').content;
},
}
</script>

<style>

</style>