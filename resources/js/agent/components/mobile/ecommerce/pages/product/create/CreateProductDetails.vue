<template>
    <div class="padding-top">
        <div class="steps-wizard clearfix mb-3">
            <div class="step done" data-step-num="1">
                <div class="step-icon"> 1 </div>
                <span class="step-title">Upload Photos</span>
            </div>
            <div class="step current" data-step-num="2">
                <div class="step-icon"> 2 </div>
                <span class="step-title">Information</span>
            </div>
            <div class="step" data-step-num="3">
                <div class="step-icon "> 3 </div>
                <span class="step-title">Category</span>
            </div>
            <div class="step" data-step-num="4">
                <div class="step-icon"> 4 </div>
                <span class="step-title">Owner</span>
            </div>
        </div>
        <hr class="divider my-3">
                        <div class="padding-around w3-white">
                            <div class="mb-3">
                                    <label class="h6" for="product_name">Product Name</label>
                                    <input class="form-control" :class="{'is-invalid': error.product_name}" type="text" v-model="product.product_name" placeholder="Name of product with a some indentical info">
                                <div class="alert alert-danger" v-for="(msg, index) in error.product_name" :key="index">
                                    {{ msg }}
                                </div>
                            </div>
                            <div class="mb-3">
                                    <label class="h6" for="excerpt">Short Description</label>
                                    <textarea class="form-control" :class="{'is-invalid': error.excerpt}" type="text" v-model="product.excerpt" rows="3" placeholder="Name of the owner"></textarea>
                                    
                                    <div class="alert alert-danger" v-for="(msg, index) in error.excerpt" :key="index">
                                    {{ msg }}
                                </div>
                            </div>
                            <div class="mb-3">
                                    <label class="h6" for="description">Full Description</label>
                                    <textarea class="form-control" :class="{'is-invalid': error.description}" type="text" v-model="product.description" rows="7" placeholder="Name of the owner"></textarea>
                                    
                                    <div class="alert alert-danger" v-for="(msg, index) in error.description" :key="index">
                                    {{ msg }}
                                </div>
                            </div>
                            <div class="mb-3">
                                    <label class="h6" for="what_in_box">What In the box</label>
                                    <textarea class="form-control" type="text" v-model="product.what_in_box" rows="2" placeholder="Name of the owner"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="h6" for="product_condition">
                                    Product Condition
                                </label>
                                <select class="form-control" :class="{'product_condition': error.product_condition}" v-model="product.product_condition" id="product_condition">
                                    <option value="">Select one</option>
                                    <option value="brand_new">Brand new</option>
                                    <option value="new">New</option>
                                    <option value="used">Used</option>
                                    <option value="reconditioned">Reconditioned</option>
                                    <option value="2nd_hand">2ndHand</option>
                                    <option value="custom">Custom</option>
                                </select>
                                <div class="alert alert-danger" v-for="(msg, index) in error.product_condition" :key="index">
                                    {{ msg }}
                                </div>
                            </div>
                            <div class="h6">
                                Behavior
                            </div>
                            <div class="mb-1">
                                <input class="" type="checkbox" v-model="product.septic" id="septic">
                                <label for="septic"> Septic (পচনশীল)</label>
                            </div>
                            <div class="mb-1">
                                <input class="" type="checkbox" v-model="product.liquid" id="liquid">
                                <label for="liquid"> Liquid</label>
                            </div>
                            <div class="mb-1">
                                <input class="" type="checkbox" v-model="product.inflammable" id="inflammable">
                                <label for="inflammable"> Inflammable (দাহ্য পদার্থ)</label>
                            </div>
                            <div class="mb-1">
                                <input class="" type="checkbox" v-model="product.pre_order" id="pre_order">
                                <label for="pre_order"> Pre Booking</label>
                            </div>
                            <div class="mb-1">
                                <input class="" type="checkbox" v-model="product.digital" id="digital">
                                <label for="digital"> Digital (downloadable)</label>
                            </div>
                            <div class="mb-3">
                                <input class="" type="checkbox" v-model="product.refundable" id="refundable">
                                <label for="refundable"> Refundable</label>
                            </div>
                            <div class="mb-3">
                                <label class="h6" for="warrenty_type">
                                    Warranty type
                                </label>
                                <select class="form-control" v-model="product.warrenty_type" id="warrenty_type">
                                    <option value="">No Warrenty</option>
                                    <option value="replacement_warrenty">Replacement Warrenty</option>
                                    <option value="service_warrenty">Service Warranty</option>
                                </select>
                            </div>
                            <div class="mb-3" v-if="product.warrenty_type">
                                <label class="h6" for="warrenty_period">
                                    Warranty type
                                </label>
                                <select class="form-control" v-model="product.warrenty_period" id="warrenty_period">
                                    <option value="">Warranty days</option>
                                    <option value="30">30 Days</option>
                                    <option value="183">183 Days</option>
                                    <option value="365">365 Days</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <div class="px-3">
                    <div class="padding-around">
                            <button class="btn btn-primary w-100" v-on:click="saveDetails()"><i class="fa fa-save"></i> Save & Next <i class="fa fa-arrow-right"></i></button>
                        </div>
                </div>
                <div class="px-1">
                    <div>
                        <hr class="divider my-3">
                        <bottom-back-bottom></bottom-back-bottom>
                    </div>
                </div>
                        </div>
    </div>
</template>
<style scoped>

</style>
<script>
export default {
    props: ['agent'],
    data() {
        return {
            product:{
                product_name : '',
                excerpt : '',
                description : '',
                what_in_box : '',
                product_condition : '',
                septic : '',
                liquid : '',
                inflammable : '',
                pre_order : '',
                digital : '',
                refundable : '',
                warrenty_type : '',
                warrenty_period : '',
            },
            error:{

            }
        }
    },
    created() {
        axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/create`).then(res=>{
            if (res.data.feature_img) {
                this.product.product_name   = res.data.name.en ?? null
                this.product.excerpt        = res.data.excerpt.en ?? null
                this.product.description    = res.data.description.en ?? null
                this.product.what_in_box    = res.data.what_in_box.en ?? null
                this.product.product_condition = res.data.product_condition ?? null
                this.product.septic     = res.data.septic ?? false
                this.product.liquid     = res.data.liquid ?? false
                this.product.inflammable = res.data.inflammable ?? false
                this.product.pre_order  = res.data.pre_order ?? false
                this.product.digital    = res.data.digital ?? false
                this.product.refundable = res.data.refundable ?? false
                this.product.warrenty_type = res.data.warrenty_type ?? null
                this.product.warrenty_period = res.data.warrenty_period ?? null
            }else{
                this.$router.push({ name: 'agent.ecommerce.product.create'})
            }
        })
    },
    methods:{
        saveDetails(){
            axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/product-info/save`, this.product)
            .then(res=>{
                if (res.status == 200) {
                    this.$router.push({ name: 'agent.ecom.product.create.category'})
                }else{
                    console.log(res.data)
                    this.error = res.data
                }
            })
            .catch(error=>{
                console.log(error)
            })
        }
    },
}
</script>