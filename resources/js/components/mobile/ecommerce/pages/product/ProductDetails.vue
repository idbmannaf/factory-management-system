<template>
    <div>
        <header class="app-header absolute-top back-button">
            <a href="" onclick="event.preventDefault();history.back()" class="btn btn-icon shadow rounded-circle m-0 pt-2 pl-2">
                <i class="fa fa-arrow-left fa-2x text-dark"></i>
            </a>
        </header>
        <section class="gallery-wrap"  v-if="product">
            <a :href="product.feature_img" data-fancybox="gallery" class="img-big-wrap"><img :src="product.feature_img"></a>
            <div class="thumbs-wrap scroll-horizontal">
                <a :href="product.feature_img" data-fancybox="gallery" class="item-thumb"> <img :src="product.feature_img"></a>
                <!-- <a href="images/items/item-detail.jpg" data-fancybox="gallery" class="item-thumb"> <img src="images/items/item.jpg"></a>
                <a href="images/items/item-detail.jpg" data-fancybox="gallery" class="item-thumb"> <img src="images/items/item.jpg"></a>
                <a href="images/items/item-detail.jpg" data-fancybox="gallery" class="item-thumb"> <img src="images/items/item.jpg"></a> -->
            </div>
        </section>

        <section class="padding-around" v-if="product">
            <h5 class="title-detail"> {{ product.name.en }}  </h5>	
            <div class="price-wrap mb-2">
                <span class="h6 price text-danger pr-2" v-if="product.compare_price > 0"><del>&#2547; {{product.compare_price}}</del></span> 
                <span class="h6 price text-success">&#2547; {{product.sale_price}}</span> 
            </div> <!-- price-wrap.// -->

            <div class="rating-wrap mb-2">
                <ul class="rating-stars">
                    <li style="width:80%" class="stars-active">
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </li>
                    <li>
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </li>
                </ul>
                <small class="label-rating text-muted">7/10</small>
            </div> <!-- rating-wrap.// -->
            
            <div class="d-flex w-100">
                <div v-if="!isCarted" class="flex-grow-1 mr-2"><a class="btn btn-primary btn-block" @click="addToCart()">Add to cart</a></div>
                <div v-else>
                    <!-- <div class="col">
                        <a href="#" v-on:click="deleteCart()" class="btn-xs btn btn-danger"> <i class="fa fa-trash"></i>   </a>
                    </div> -->
                    <div class="col">
                        <div class="input-group input-spinner float-right">
                            <div class="input-group-prepend">
                            <button class="btn btn-primary" v-on:click="decrementQuantity()" type="button" :disabled="quantity == 1"> <i class="fa fa-minus"></i> </button>
                            </div>
                            <input type="number" class="form-control" v-model="quantity" >
                            <div class="input-group-append">
                                <button class="btn btn-primary" v-on:click="incrementQuantity()" type="button"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div><a href="#" class="btn btn-light btn-icon"><i class="fa fa-heart"></i></a></div>
            </div>
            <article class="info-detail-wrap pt-1 mb-2">
                <p>
                    {{ product.excerpt.en }}
                    <a class="btn-link" @click="detailsView=!detailsView"> {{ detailsView ? 'Read less' : 'Read more' }}</a>
                </p>
            </article>
            <article class="info-detail-wrap pt-1 mb-2" v-if="detailsView">
                <h6 class="title-sm">Description</h6>
                {{ product.description.en }}
            </article>
            <article class="info-detail-wrap pt-1 mb-2">
                <h6 class="title-sm">Product Behavior</h6>
                <ul class="list-bullet">
                    <li>Septic (পচনশীল):  {{ product.septic ? 'Yes' : 'No'}}</li>
                    <li>Liquid : {{ product.liquid ? 'Yes' : 'No'}}</li>
                    <li>Inflammable (দাহ্য পদার্থ) : {{ product.inflammable ? 'Yes' : 'No'}}</li>
                    <li>Pre Booking : {{ product.pre_order ? 'Yes' : 'No'}}</li>
                    <li>Digital (downloadable) : {{ product.digital ? 'Yes' : 'No'}}</li>
                    <li>Refundable : {{ product.refundable ? 'Yes' : 'No'}}</li>
                    <li>Warranty : 
                        <span v-if="product.warrenty_type == 'no_warrenty'">
                            No
                        </span>
                        <span v-else>
                            Yes
                        </span>
                    </li>
                </ul>
                <h6 class="title-sm">Warranty</h6>
                <p v-if="product.warrenty_type == 'no_warrenty'">
                    No Warranty
                </p>
                <p v-else>
                    {{ product.warrenty_period }} days ({{ product.warrenty_type }})
                </p>
            </article>
            <article class="info-detail-wrap pt-1 mb-2">
                <h6 class="title-sm">What in the box</h6>
                {{ product.what_in_box.en }}
            </article>
            <figure class="icontext w-100">
                <div class="icon"><img :src="product.source.logo" class="img-sm rounded" alt=""></div>
                <figcaption class="text">
                    <p>{{ product.source.name.en }}</p> 
                    <!-- <span class="text-muted">234 items</span>  -->
                </figcaption>
                <span> <i class="fa fa-chevron-right text-muted"></i> </span>
            </figure>
        </section>
        <hr class="divider  mb-3">

        <h5 class="title-section">Similar items</h5>

        <section class="scroll-horizontal padding-x" v-if="relatedItems">
            <product-item  @click.native="$router.go()" v-for="(product, index) in relatedItems" :key="index" :product="product"></product-item>
        </section>
        <bottom-back-button></bottom-back-button>
    </div>
</template>
<style scoped>
.back-button{
    top: 65px;
}
</style>
<script>
export default {
    props: [
        'productId',
    ],
    data() {
        return {
            product: null,
            imgUrl: null,
            detailsView: false,
            relatedItems: null,
            isCarted: false,
            quantity: 1,
        }
    },
    created() {
        this.getProductDetails()
    },
    methods: {
        getProductDetails(){
            axios.get(window.location.origin+`/api/product/${this.productId}/details`).then(res => {
                this.product = res.data
                this.relatedItems = res.data.related_items
                this.quantity = res.data.min_order_quantity
                if (res.data.isCarted) {
                    this.isCarted = true
                    this.quantity = res.data.cart.quantity
                }
            });
        },
        addToCart(){
            axios.post(window.location.origin+`/api/cart/add/product/${this.product.id}`, {'quantity': this.quantity}).then(res=>{
                if (!this.isCarted) {
                    this.$swal({
                    title: 'Success!',
                    text: 'Product is added to cart',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
                }
                this.isCarted = true
            })
        },
        decrementQuantity(){
            this.quantity--;
            this.addToCart()
        },
        incrementQuantity(){
            this.quantity++;
            this.addToCart()
        },
    },
}
</script>