<template>
<div class="padding-top">
<div class="card">
        <div class="card-header h5">
        Shop List <router-link class="btn btn-primary float-right btn-sm px-2" :to="{name: 'agent.ecom.source.create'}"><i class="fa fa-plus"></i></router-link>
        </div>
        <div class="card-body">
            <div class="padding-bottom">
                <input type="text" class="form-control" placeholder="search by mobile or shop name or owner's name" v-model="search" @keyup="searchShop">
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Shop Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Owner</th>
                        <th>Type</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                        <source-list-item :agent="agent" v-for="(source, index) in sources" :key="index" :source="source"></source-list-item>
                    </tbody>
                </table>
            </div>

            <nav>
                    <ul class="pagination table-responsive padding-top m-auto" v-if="links.length > 3">
                    <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
                    <a class="page-link" v-on:click="getSources(page.url)" tabindex="-1">
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
            sources: [],
            links: [],
            search: null,
        }
    },
    created() {
        this.getSources()
    },
    methods: {
        getSources(dataUrl = null){
            this.sources = []
            axios.get(dataUrl ? dataUrl : window.location.origin+`/api/agent/${this.agent}/ecommerce/sources/get`).then(res=>{
                if (res.status == 200) {
                    this.sources = res.data.data
                    this.links = res.data.links
                }
            });
        },
        searchShop(){
            if (!this.search) {
                this.getSources()
            }else{
                axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/shop/search?query=${this.search}`).then(res=>{
                    if (res.status == 200) {
                        this.sources = res.data.data
                        this.links = res.data.links
                    }
                });
            }
        },
    },

}
</script>

<style>

</style>
