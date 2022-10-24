<template>
  <div>
    <div class="bg-primary text-center padding-x padding-bottom">
        <nav aria-label="breadcrumb" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link class="text-dark" @click.native="$router.go()" :to="{name: 'ecommerce.categories'}">Categories</router-link></li>
            <li class="breadcrumb-item" v-for="(parent, index) in categoryData.parents" :key="index" :class="{ 'active' : (categoryData.parents.length-1) == index }"><router-link @click.native="$router.go()" :to="{name: 'ecom.subcategories', params:{'category': parent.id}}">{{ parent.name.en }}</router-link></li>
        </ol>
        </nav>
        <h3 class="title-page text-white" v-if="categoryData.name">
            {{ categoryData.name.en }}
        </h3>
        <p class="text-white-50">321 products</p>
    </div>
    <section class="padding-around">
        <ul class="row px-1" v-if="categoryData.children.length > 0">
            <li class="col-4 p-1" v-for="(subcat, index) in categoryData.children" :key="index">
                <router-link class="btn-icontop-lg p-1" @click.native="$router.go()" :to="{name: 'ecom.subcategories', params:{'category': subcat.id}}">
                    <span class="icon"> <img src="images/icons/category-blue/cpu.svg" alt=""> </span>
                    <span class="text text-truncate"> {{ subcat.name.en }} </span>
                </router-link>
            </li>
        </ul>

        </section>
        <section class="padding-x" id="productItems">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-4" v-for="(product, index) in products" :key="index">
                    <product-item :key="product.id" :product="product"></product-item>
                </div>
            </div> <!-- row end -->
            <!-- <ul class="pagination table-responsive padding-top" v-if="links.length > 3">
                <li class="page-item" v-for="(page, index) in links" :key="index" :class="{disabled: !page.url, active: page.active}">
                <a class="page-link" v-on:click="getProducts(page.url)" tabindex="-1">
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
            </ul> -->
        </section> <!-- section body .// -->
  </div>
</template>
<script>
export default {
    props: ['category', 'slug'],
    data() {
        return {
            categoryData:{
                'parents': [],
                'children': [],
            },
            parents: [],
            links: [],
            next_page_url : null,
            current_page : 0,
            last_page : 1,
            breadcrumbs : null,
            products: [],
        }
    },
    created() {
        this.getSubCategories()
        this.getProducts()
        this.breadcrumbs = this.slug ?? null
    },
    mounted() {
        this.getMoreProducts()
    },
    methods: {
        getSubCategories(){
            axios.get(window.location.origin+`/api/category/${this.category}`).then(res=>{
                this.categoryData = res.data

            })
        },
        getProducts(dataUrl = null){
            if (this.current_page < this.last_page) {
                axios.get(dataUrl ? dataUrl : window.location.origin+'/api/products').then(res => {
                    res.data.data.forEach(i =>{
                        this.products.push(i)
                    })
                    this.links = res.data.links
                    this.current_page = res.data.current_page
                    this.last_page = res.data.last_page
                    this.next_page_url = res.data.next_page_url
                })
            }
        },
        getMoreProducts(){
            window.onscroll = () => {
            let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
            if (bottomOfWindow) {
                this.getProducts(this.next_page_url);
            }
            };
        }
    },
}
</script>

<style>

</style>