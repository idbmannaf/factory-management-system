<template>
    <div class="padding-top">
        <div class="steps-wizard clearfix mb-3">
            <div class="step current" data-step-num="1">
                <div class="step-icon">1</div>
                <span class="step-title">Upload Photos</span>
            </div>
            <div class="step" data-step-num="2">
                <div class="step-icon">2</div>
                <span class="step-title">Product Information</span>
            </div>
            <div class="step" data-step-num="3">
                <div class="step-icon">3</div>
                <span class="step-title">Product Category</span>
            </div>
            <div class="step" data-step-num="4">
                <div class="step-icon">4</div>
                <span class="step-title">Product Owner</span>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="h4">
                    Create New Product
                </div>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col text-center">
                        <a
                            id="btn-profilepic"
                            class="btn-profilepic"
                            title="Change Feature Image"
                        >
                            <img
                                align="center"
                                class="fb-image-profile w3-animate-zoom img-thumbnail w-100 mb-3"
                                style="max-width: 250px;"
                                v-if="fiUrl"
                                :src="fiUrl"
                                alt="Profile image"
                            />
                        </a>
                        <cropper
                            class="cropper"
                            :src="cropperUrl"
                            :stencil-props="{
                                aspectRatio: 1 / 1
                            }"
                            @change="change"
                        />
                    </div>
                    <!-- <div>
                        <i class="fa fa-camera w3-text-white w3-hover-shadow w3-hover-deep-orange w3-round w3-card-4 w3-blue fa-stack-1x "></i>
                    </div> -->
                </div>

                    <div class="text-center" v-if="is_selected_FI">
                        <button class="btn btn-danger btn-sm img-btn" v-on:click="resetFeatuedImage()"><i class="fa fa-times fa-2x"></i></button>
                        <button class="btn btn-primary btn-sm img-btn" v-on:click="saveFeaturedImage()"><i class="fa fa-check fa-2x"></i></button>
                    </div>
                <hr class="divider my-3" />
                <div class="px-3">
                    <div class="custom-file">
                        <input
                            type="file"
                            class="custom-file-input"
                            id="file_pasport"
                            accept=""
                            lang="en"
                            v-on:change="onFileChange"
                        />
                        <label class="custom-file-label" for="file_pasport"
                            >Featured Image</label
                        >
                    </div>
                </div>
                <!-- <hr class="divider my-3" />
                <div class="px-3">
                    <div class="row">
                        <div
                            class="col-xs-6"
                            v-for="(image, index) in moreImages"
                            :key="index"
                        >
                            <img
                                class="w-100 img-thumbnail"
                                :src="image"
                                alt=""
                            />
                        </div>
                    </div>
                    <div class="text-center padding-around" v-if="is_selected_MI">
                        <button class="btn btn-danger btn-sm" v-on:click="clearMoreImages()"><i class="fa fa-trash"></i>Clear</button>
                    </div>
                    <div class="custom-file">
                        <input
                            type="file"
                            class="custom-file-input"
                            id="file_pasport"
                            accept=""
                            lang="en"
                            v-on:change="showMoreImages"
                            multiple
                        />
                        <label class="custom-file-label" for="file_pasport"
                            >More Images</label
                        >
                    </div> -->
                </div>
                <hr class="divider my-3" />
                <div class="px-1">
                    <div>
                        <div class="padding-around">
                            <button
                                class="btn btn-primary w-100"
                                v-on:click="nextStep()"
                            >
                                Next <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                        <hr class="divider my-3" />
                        <bottom-back-bottom></bottom-back-bottom>
                    </div>
                </div>
            </div>
        </div>
</template>
<style scoped>
.img-btn{
    width: 100px;
}
.cropper {
    height: auto;
    background: #ddd;
    margin: 20px;
}
</style>
<script>
import { Cropper } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";
export default {
    props: ['agent'],
    components: {
        Cropper
    },
    data() {
        return {
            dummyUrl: "/../../../../../img/pfi.png",
            fiUrl: '',
            cropperUrl: "",
            featured_image: "",
            is_selected_FI: false,
            is_selected_MI: false,
            more_images: [],
            cropCoordinates: [],
            moreImages: []
        };
    },
    created() {
        axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/create`).then(res=>{
            if (res.data.feature_img) {
                this.fiUrl = res.data.feature_img
            }else{
                this.fiUrl = this.dummyUrl
            }
        })

    },
    methods: {
        onFileChange(e) {
            const file = e.target.files[0];
            this.image = file;
            this.fiUrl = "";
            this.cropperUrl = URL.createObjectURL(file);
            this.featured_image = e.target.files[0];
            if (this.featured_image) {
                this.is_selected_FI = true
            }else{
                this.is_selected_FI = false
            }
        },
        showMoreImages(e) {
            const files = e.target.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                this.more_images.push(file);
                this.moreImages.push(URL.createObjectURL(file));
            }
            this.is_selected_MI = true
        },
        change({ coordinates, canvas }) {
            this.cropCoordinates = coordinates;
        },
        resetFeatuedImage(){
            this.featured_image = null
            this.is_selected_FI = null
            this.fiUrl = this.dummyUrl
            this.cropperUrl = null
        },
        clearMoreImages(){
            this.more_images = null
            this.moreImages = null
            this.is_selected_MI = false
        },
        saveFeaturedImage(){

            let formData = new FormData();
            formData.append('image', this.featured_image)
            formData.append("cropHeight", this.cropCoordinates.height);
            formData.append("cropWidth", this.cropCoordinates.width);
            formData.append("cropTop", this.cropCoordinates.top);
            formData.append("cropLeft", this.cropCoordinates.left);
            axios.post(
                    window.location.origin+`/api/agent/${this.agent}/ecommerce/product/feature-image/upload`,
                        formData,
                    {
                        headers: {
                            "Content-Type": `multipart/form-data; boundary=${formData._boundary}`
                        }
                    }
                )
                .then(res => {
                    if (res.data.hasError) {
                        alert(res.data.errorMessage);
                    }
                    if (res.data.success) {
                        this.fiUrl = res.data.image
                        this.cropperUrl = ''
                        this.is_selected_FI = false
                    }
                })
                .catch(response => {
                    console.log(response);
                });
        },
        nextStep() {
            // let formData = new FormData();
            //     formData.append('images',this.more_images)
            // // this.more_images.forEach(element => {
            // //     formData.append('moreImages', element)
            // // });
            // axios.post(
            //         window.location.origin+`/api/agent/${this.agent}/ecommerce/product/more-images/upload`,
            //             formData,
            //         {
            //             headers: {
            //                 "Content-Type": `multipart/form-data; boundary=${formData._boundary}`
            //             }
            //         }
            //     )
            //     .then(res => {
            //         if (res.data.hasError) {
            //             alert(res.data.errorMessage);
            //         }
            //         if (res.data.success) {
            //             this.$router.push({ name: 'agent.ecom.product.create.details'})
            //         }
            //     })
            //     .catch(response => {
            //         console.log(response);
            //     });
            this.$router.push({ name: 'agent.ecom.product.create.details'})
        }
    }
};
</script>
