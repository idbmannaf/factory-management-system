<template>
    <div>
        <div class="bg-primary padding-x padding-bottom">
            <h3 class="title-page text-white">All Category</h3>
        </div>

        <section class="scroll-horizontal padding-around">
                <div class="item-sm">
                    <a href="#">
                        <div class="img-wrap">
                            <img class="rounded-circle img-sm" src="mobile/images/avatars/1.jpg" alt="">
                        </div>
                        <div class="text-wrap pt-2 text-center">
                            <p class="text-truncate">Men</p>
                        </div>
                    </a>
                </div>
                <div class="item-sm">
                    <a href="#">
                        <div class="img-wrap">
                            <img class="rounded-circle img-sm" src="mobile/images/avatars/2.jpg" alt="">
                        </div>
                        <div class="text-wrap pt-2 text-center">
                            <p class="text-truncate">Woman</p>
                        </div>
                    </a>
                </div>
                <div class="item-sm">
                    <a href="#">
                        <div class="img-wrap">
                            <img class="rounded-circle img-sm" src="mobile/images/avatars/3.jpg" alt="">
                        </div>
                        <div class="text-wrap pt-2 text-center">
                            <p class="text-truncate">Ladies</p>
                        </div>
                    </a>
                </div>
                <div class="item-sm">
                    <a href="#">
                        <div class="img-wrap">
                            <img class="rounded-circle img-sm" src="mobile/images/avatars/4.jpg" alt="">
                        </div>
                        <div class="text-wrap pt-2 text-center">
                            <p class="text-truncate">Baby</p>
                        </div>
                    </a>
                </div>

        </section> 


        <hr class="divider mb-3">


        <ul class="nav-menu">
            <li class="nav-item" v-for="(cat, index) in categories" :key="index">
                <router-link class="icontext" :to="{name: 'ecom.subcategories', params:{'category': cat.id}}">
                    <span class="icon icon-sm bg-primary rounded"> <img src="mobile/images/icons/category-white/cpu.svg" alt=""> 
                    </span>
                    <div class="text"> <h6 class="title">{{ cat.name.en }}</h6> <span class="text-muted">234 items</span></div>
                </router-link>
            </li>
            <!-- <li class="nav-item">
                <a href="" class="icontext">
                    <span class="icon icon-sm bg-primary rounded"> <img src="mobile/images/icons/category-white/homeitem.svg" alt="">  </span>
                    <div class="text"> <h6 class="title">Equipments</h6> <span class="text-muted">354 items</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="icontext">
                    <span class="icon icon-sm bg-primary rounded"> <img src="mobile/images/icons/category-white/book.svg" alt="">  </span>
                    <div class="text"> <h6 class="title">Books</h6> <span class="text-muted">48 items</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="icontext">
                    <span class="icon icon-sm bg-primary rounded"> <img src="mobile/images/icons/category-white/ball.svg" alt="">  </span>
                    <div class="text"> <h6 class="title">Sports</h6> <span class="text-muted">97 items</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="icontext">
                    <span class="icon icon-sm bg-primary rounded"> <img src="mobile/images/icons/category-white/cpu.svg" alt=""> </span>
                    <div class="text"> <h6 class="title">Electronics</h6> <span class="text-muted">234 items</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="icontext">
                    <span class="icon icon-sm bg-primary rounded"> <img src="mobile/images/icons/category-white/homeitem.svg" alt="">  </span>
                    <div class="text"> <h6 class="title">Home items</h6> <span class="text-muted">354 items</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="icontext">
                    <span class="icon icon-sm bg-primary rounded"> <img src="mobile/images/icons/category-white/book.svg" alt="">  </span>
                    <div class="text"> <h6 class="title">Books and magazines</h6> <span class="text-muted">48 items</span></div>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="icontext">
                    <span class="icon icon-sm bg-primary rounded"> <img src="mobile/images/icons/category-white/ball.svg" alt="">  </span>
                    <div class="text"> <h6 class="title">Sport and outdoor</h6> <span class="text-muted">97 items</span></div>
                </a>
            </li> -->
        </ul>
        <bottom-back-button></bottom-back-button>
    </div>
</template>
<script>
export default {
    data() {
        return {
            categories: [],
            next_page_url : null,
            current_page : 0,
            last_page : 1,
        }
    },
    mounted() {
        this.getMoreCategories()
    },
    created() {
        this.getCategories()
    },
    methods: {
        getCategories(dataUrl = null){
            if (this.current_page < this.last_page) {
                axios.get(dataUrl ? dataUrl : window.location.origin+'/api/categories/get').then(res=>{
                    res.data.data.forEach(i=>{
                        this.categories.push(i)
                    })
                    this.current_page = res.data.current_page
                    this.last_page = res.data.last_page
                    this.next_page_url = res.data.next_page_url
                })
            }
        },
        getMoreCategories(){
            window.onscroll = () => {
            let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
            if (bottomOfWindow) {
                this.getCategories(this.next_page_url);
            }
            };
        }
    },
}
</script>