<template>
<div class="padding-top">
    <div class="card">
        <div class="card-header">
        User List <router-link class="btn btn-primary float-right btn-sm px-2" :to="{name: 'agent.ecom.user.create'}"><i class="fa fa-plus"></i></router-link>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Temporary Password</th>
                    </tr>
                    </thead>
                    <tbody>
                        <user-list-item :agent="agent" v-for="(user, index) in users" :key="index" :user="user" ></user-list-item>
                    </tbody>
                </table>
            </div>
            <nav>
                    <ul class="pagination table-responsive padding-top m-auto" v-if="links.length > 3">
                    <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
                    <a class="page-link" v-on:click="getUsers(page.url)" tabindex="-1">
                        <span class="d-flex" v-if="page.label == 'Next &raquo;'">
                            Next <i class="fa fa-arrow-right"></i>
                        </span>
                        <span class="d-flex" v-else-if="page.label == '&laquo; Previous'">
                            <i class="fa fa-arrow-left"></i> Previous
                        </span>
                        <span v-else>
                            {{ page.label }}
                        </span>
                        </a>
                    </li>
                    <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li> -->
                </ul>
            </nav>
        </div>
    </div>
</div>
</template>

<script>
export default {
props: ['agent'],
data() {
    return {
        users: [],
        links: [],
    }
},
created() {
    this.getUsers()
},
methods: {
    getUsers(dataUrl = null){
            axios.get(dataUrl ? dataUrl : window.location.origin+`/api/agent/${this.agent}/ecommerce/users/get`).then(res=>{
                if (res.status == 200) {
                    this.users = res.data.data
                    this.links = res.data.links
                }
            });
        },
},
}
</script>

<style>

</style>
