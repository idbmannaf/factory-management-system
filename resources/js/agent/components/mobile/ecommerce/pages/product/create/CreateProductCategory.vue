<template>
    <div class="padding-top">
        <div class="steps-wizard clearfix mb-3">
            <div class="step done" data-step-num="1">
                <div class="step-icon"> 1 </div>
                <span class="step-title">Upload Photos</span>
            </div>
            <div class="step done" data-step-num="2">
                <div class="step-icon"> 2 </div>
                <span class="step-title">Information</span>
            </div>
            <div class="step current" data-step-num="3">
                <div class="step-icon current"> 3 </div>
                <span class="step-title">Category</span>
            </div>
            <div class="step" data-step-num="4">
                <div class="step-icon"> 4 </div>
                <span class="step-title">Owner</span>
            </div>
        </div>
        <div class="padding-around" v-if="savedCategories.length > 0">
            <div class="h6">Saved Category</div>
            <div class="padding-around" v-for="(cat, index) in savedCategories" :key="index">
                <span class="border rounded selected-category w3-aqua">{{cat.category_string}}</span>
            <button @click="deleteSelectedCategory(cat.id, index)" class="btn btn-sm btn-danger float-right"><i class="fa fa-trash"></i></button>
            </div>
        </div>
        <div class="padding-around" v-if="selectedCategory">
            <div class="h6">Selected Category</div>
            <div class="padding-around">
                <span class="border rounded selected-category w3-aqua">{{selectedCategory}}</span>
            <button @click="clearSelectedCategory()" class="btn btn-sm btn-danger float-right"><i class="fa fa-trash"></i></button>
            </div>
        </div>
        <div v-if="loading">
            <marquee width="60%" behavior="" direction="left">loading...</marquee>
        </div>
        <div class="padding-around" v-if="categoryListShow">
            <label for=""><span v-if="selectTitle">{{selectTitle}}</span></label>
            <select class="form-control select2" v-model="category" @change="selectCategory()">
                <option value="" selected disabled>Select one</option>
                <option v-for="(cat, index) in categoryListShow" :key="index" :value="cat"> {{ cat.name.en }}</option>
            </select>
        </div>
        <div>
            <div class="px-3">
                <div>
                    <div class="h6">
                        Listing type
                    </div>
                    <div class="form-group px-3">
                        <input type="checkbox" v-model="b2c" disabled >
                        <label>B2C</label>
                    </div>
                    <div class="form-group px-3">
                        <input type="checkbox" v-model="b2b">
                        <label>B2B (Bulk Qty. Order Only)</label>
                    </div>
                </div>
                <div>
                    <div v-if="b2c" class="p-1 rounded w3-white">
                        <div class="form-group">
                            <label for="">Minimum order Qty*</label>
                            <div class="input-group">
                            <input class="form-control" type="number" step="1" min="1" v-model="moq" placeholder="ex. 100">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Unit(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Purchase Price*</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#2547;</span>
                                </div>
                            <input class="form-control" type="number" step="0.01" min=".00" v-model="purchase_price" placeholder="ex. 400">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Sale price*</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#2547;</span>
                                </div>
                            <input class="form-control" type="number" step="0.01" min=".00" v-model="sale_price" placeholder="ex. 500">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Compare price (deleted price) </label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">&#2547;</span>
                            </div>
                            <input class="form-control" type="number" step="0.01" v-model="compare_price" placeholder="ex. 600">
                            </div>
                        </div>
                    </div>
                <hr class="divider- my-1">
                    <div v-if="b2b" class="p-1 rounded w3-white">
                        <div class="h5">
                            For Bulk deals
                        </div>
                        <div v-if="b2bPrices.length || savedPrices.length">
                            <table class="table table-bordered text-center">
                                <tr>
                                    <th>Min. Qty</th>
                                    <th>Purchase Price (&#2547;)</th>
                                    <th>Sale Price (&#2547;)</th>
                                </tr>
                                <tr v-for="(pr, index) in savedPrices" :key="index">
                                    <td>{{ pr.min_unit }}</td>
                                    <td>{{ pr.purchase_price }}</td>
                                    <td>{{ pr.sale_price }}</td>
                                </tr>
                                <tr v-for="(p, index) in b2bPrices" :key="index">
                                    <td>{{ p.unit }}</td>
                                    <td>{{ p.purchase_price }}</td>
                                    <td>{{ p.sale_price }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="">Minimum Units</label>
                            <div class="input-group">
                            <input class="form-control" type="number" step="1" min="1" v-model="minUnit" placeholder="ex. 100">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Unit(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Purchase Price <span v-if="minUnit > 0"> for {{ minUnit }} units</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#2547;</span>
                                </div>
                            <input class="form-control" type="number" step="0.01" min=".00" v-model="unitPurchasePrice" placeholder="ex. 60.50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Sale Price <span v-if="minUnit > 0"> for {{ minUnit }} units</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#2547;</span>
                                </div>
                            <input class="form-control" type="number" step="0.01" min=".00" v-model="unitSalePrice" placeholder="ex. 62.00">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn  btn-warning btn-sm" :disabled="!minUnit || !unitPurchasePrice || !unitSalePrice" @click="addAnotherPriceCondition()"> <i class="fa fa-plus" ></i> another price condition</button>
                        </div>
                    </div>
                </div>    
            </div>
                <hr class="divider my-3">
                <div class="px-1">
                    <div>
                        <div class="padding-around">
                            <button @click="nextStep()" class="btn btn-primary w-100" :disabled="!savedCategories && !selectedCategory || !moq || !purchase_price || !sale_price"><i class="fa fa-save"></i> Save & Next <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                        <hr class="divider my-3">
                        <bottom-back-bottom></bottom-back-bottom>
                    </div>
                </div>
        </div>
    </div>
</template>
<style scoped>
.selected-category{
    padding: 5px;
}
</style>

<script>
export default {
    props: ['agent'],
    data() {
        return {
            savedPrices: [],
            categoryList: null,
            categoryListShow: null,
            category: null,
            selectedCategoryId: null,
            selectedCategory: null,
            selectTitle : 'Product Category',
            loading: true,
            savedCategories: [],
            b2c: true,
            b2b: true,
            moq: null,
            purchase_price: null,
            sale_price: null,
            compare_price: null,
            b2bPrices: [], 
            minUnit: null,
            unitPurchasePrice: null,
            unitSalePrice: null,
        }
    },
    created() {
        axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/create`).then(res=>{
            if (res.data.name) {
                this.savedPrices = res.data.prices ?? []
                this.savedCategories = res.data.category_relations ?? []
                this.b2b= res.data.b_to_b ?? true
                this.moq= res.data.min_order_quantity ?? null
                this.purchase_price= res.data.purchase_price ?? null
                this.sale_price= res.data.sale_price ?? null
                this.compare_price= res.data.compare_price ?? null
            }else{
                this.$router.push({ name: 'agent.ecom.product.create.details'})
            }
        });
        axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/categories/get`).then(res =>{
            this.categoryList = res.data.categories
            this.categoryListShow = this.categoryList
            this.loading = false
        });
    },
    methods: {
        selectCategory(){
            if (this.category) {
                this.selectedCategoryId = this.category.id
                if (this.selectedCategory == null) {
                    this.selectedCategory = this.category.name.en
                }else{
                    this.selectedCategory = this.selectedCategory+' > '+this.category.name.en
                }
                if (this.category.children.length > 0) {
                    this.categoryListShow = this.category.children
                    this.selectTitle = this.category.name.en+' sub-category'
                }else{
                    this.categoryListShow = null
                }
            }
        },
        clearSelectedCategory(){
            this.selectedCategory = null
            this.category = null
            this.categoryListShow = this.categoryList
            this.selectTitle = 'Product Category'
        },
        deleteSelectedCategory(catRelId, index){
            axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/category/remove`,{'catRelId': catRelId}).then(res=>{
                if (res.status == 200) {
                    this.savedCategories.splice(index, 1);
                    if(this.savedCategories.length == 0){
                        this.savedCategories = null
                    }
                }
            })
        },
        nextStep(){
            if (!this.selectedCategory && !this.savedCategories) {
                alert('Please select a Category')
            }else{
                    axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/category/save`,{
                        'category' : this.selectedCategoryId,
                        'categoy_string': this.selectedCategory,
                        'moq': this.moq,
                        'b2c': this.b2c,
                        'b2b': this.b2b,
                        purchase_price: this.purchase_price,
                        sale_price: this.sale_price,
                        compare_price: this.compare_price,
                        priceList: this.b2bPrices, 
                        minUnit: this.minUnit,
                        unitPurchasePrice: this.unitPurchasePrice,
                        unitSalePrice: this.unitSalePrice,
                    }).then(res =>{
                        if (res.status == 200) {
                            this.$router.push({name: 'agent.ecom.product.create.owner'})
                        }else{
                            console.log('Error')
                        }
                    })
            }
        },
        addAnotherPriceCondition(){
            this.b2bPrices.push({
                'unit' : this.minUnit,
                'purchase_price' : this.unitPurchasePrice,
                'sale_price' : this.unitSalePrice,
            })
            this.minUnit = null
            this.unitPurchasePrice = null
            this.unitSalePrice = null
        },
    },
}
</script>