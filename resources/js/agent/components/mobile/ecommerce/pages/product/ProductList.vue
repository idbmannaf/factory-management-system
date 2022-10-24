<template>
    <div class="padding-top-">
        <div class="card">
            <div class="card-header">
                <div class="h3">
                    Products
                    <!-- <router-link class="btn btn-primary btn-sm h6 float-right" :to="{name: 'agent.ecommerce.product.create'}">
                        <i class="fa fa-plus"></i> new
                    </router-link> -->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="white-space: nowrap">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Source</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                               <ecommerce-product-list-item v-for="(product, index) in products" :key="index" :product="product"
                               :agent="agent"></ecommerce-product-list-item>
                        </tbody>
                    </table>
                    <div>
                        <nav aria-label="...">
  <ul class="pagination table-responsive" v-if="links.length > 3">
    <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
      <a class="page-link" v-on:click="getPageData(page.url)" tabindex="-1">
            <span v-if="page.label == 'Next &raquo;'">
                Next <i class="fa fa-arrow-right"></i>
            </span>
            <span v-else-if="page.label == '&laquo; Previous'">
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
        </div>
    </div>
</template>
<script>
    import { mapState, mapActions } from 'vuex'
export default {
    props: ['agent'],
    computed: mapState({
        // products: state => state.products.all.data,
        // links: state => state.products.all.links,
    }),
    data() {
        return {
            products: [],
            links: [],
        }
    },
    created() {
    //    alert("DD");
        // this.$store.dispatch('products/getAllProducts')
        axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/product`).then(res =>{
            this.products = res.data.data
            this.links = res.data.links
        })
    },
        // methods: mapActions(
        // ),
    methods: {
        getPageData(url){
            axios.get(url).then(res => {
                this.products = res.data.data;
                this.links = res.data.links;
                })
        }
    },
}
</script>
