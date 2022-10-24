<template>
    <div>
        <section>
			<div>
				<div class="row padding-top">
                    <div class="col icon text-center">
                            <img
                                align="center"
                                class="fb-image-profile w3-animate-zoom img-thumbnail mb-3"
                                style="max-width: 70%;"
                                v-if="fiUrl"
                                :src="fiUrl"
                                alt="Profile image"
                            />
					</div>
				</div>	
			</div>
<h6 class="title-sm padding-x">Personal</h6>
<nav class="nav-list">
	<a class="btn-list" href="#">
		<i class="icon-action fa fa-pen"></i>
		<span class="text">Name</span>
		<small class="title">{{ user.name }}</small>
	</a>
	<a class="btn-list" href="#">
		<i class="icon-action fa fa-pen"></i>
		<span class="text">Phone</span>
		<small class="title">{{ user.mobile }}</small>
	</a>
	<a class="btn-list" href="#"> 
		<i class="icon-action fa fa-pen"></i>
		<span class="text">Email</span>
		<small class="title">{{ user.email }}</small>
	</a>
</nav>
</section> 

<hr class="divider"> 

<!-- <section>
<h6 class="title-sm padding-x">Application</h6>
<nav class="nav-list">
	<a class="btn-list" href="#">
		<i class="icon-action fa fa-pen"></i>
		<span class="text">Notifications</span>
		<small class="title">Deals and offer information</small>
	</a>
	<a class="btn-list" href="#">
		<i class="icon-action fa fa-pen"></i>
		<span class="text">Settings</span>
		<small class="title">Account control, app style</small>
	</a>
	<div class="btn-list" href="#">
		<div class="float-right custom-control custom-switch">
			<input type="checkbox" class="custom-control-input" id="select_darkmode">
			<label class="custom-control-label" for="select_darkmode"></label>
		</div>
		<span class="text">Dark mode</span>
	</div>
</nav>
</section> -->
<p class="text-center my-4">
    <a href=""  onclick="event.preventDefault();history.back()" class="btn btn-light"> <i class="icon fa fa-arrow-left"></i>  <span class="text">Back</span> </a>
</p>
    </div>
</template>
<script>
export default {
	data() {
        return {
            user: {},
            image: null,
            fiUrl: null,
            errors: [],
        }
    },
    created() {
        axios.get(window.location.origin+`/api/check-login`).then(res=>{
            if (res.data.login) {
                this.user           = res.data.user
                this.fiUrl          = this.user.img_name ?? ' '
            }
        });
    },
}
</script>