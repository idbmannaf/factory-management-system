<template>
    <div class="padding-top-">
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
                                v-if="dummyUrl"
                                :src="dummyUrl"
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
                <hr class="divider my-3" />
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
                    </div>
                    <hr class="divider my-3" />
                </div>
                <div class="px-3">
                    <button class="btn btn-primary w-100">Save</button>
                </div>
                <hr class="divider my-3" />
                <div class="px-1">
                    <div class="h5 px-3">
                        Set Product Owner
                    </div>
                    <div>
                        <div class="input-group px-3 mb-3">
                            <select
                                id="addOwner"
                                class="form-control select2-container step2-select select2"
                                name="owner"
                            >
                                <option value="">a</option>
                                <option value="">b</option>
                            </select>
                            <div class="input-group-append">
                                <span
                                    class="input-group-text"
                                    id="basic-addon2"
                                    v-on:click="addNewUser = !addNewUser"
                                >
                                    <i class="fa fa-user-plus"></i>
                                </span>
                            </div>
                        </div>
                        <div v-if="addNewUser">
                            <hr class="divider my-3" />
                            <div class="mb-3">
                                <label class="h6" for="name">Full Name</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="name"
                                    placeholder="Name of the owner"
                                />
                            </div>
                            <div class="mb-3">
                                <label class="h6" for="name"
                                    >Mobile Number</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    name="mobile"
                                    placeholder="015......"
                                />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-sm w-100">
                                    Save user
                                </button>
                            </div>
                        </div>
                        <hr class="divider my-3" />
                        <div class="padding-around">
                            <div class="mb-3">
                                <label class="h6" for="product_name"
                                    >Product Name</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    v-model="product.product_name"
                                    placeholder="Name of product with a some indentical info"
                                />
                            </div>
                            <div class="mb-3">
                                <label class="h6" for="excerpt"
                                    >Short Description</label
                                >
                                <textarea
                                    class="form-control"
                                    type="text"
                                    v-model="product.excerpt"
                                    rows="3"
                                    placeholder="Name of the owner"
                                ></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="h6" for="what_in_box"
                                    >What In the box</label
                                >
                                <textarea
                                    class="form-control"
                                    type="text"
                                    v-model="product.what_in_box"
                                    rows="2"
                                    placeholder="Name of the owner"
                                ></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="h6" for="product_condition">
                                    Product Condition
                                </label>
                                <select
                                    class="form-control"
                                    v-model="product.product_condition"
                                    id="product_condition"
                                >
                                    <option value="brand_new">Brand new</option>
                                    <option value="new">New</option>
                                    <option value="used">Used</option>
                                    <option value="reconditioned"
                                        >Reconditioned</option
                                    >
                                    <option value="2nd_hand">2ndHand</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                            <div class="h6">
                                Behavior
                            </div>
                            <div class="mb-1">
                                <input
                                    class=""
                                    type="checkbox"
                                    v-model="product.septic"
                                    id="septic"
                                />
                                <label for="septic"> Septic (পচনশীল)</label>
                            </div>
                            <div class="mb-1">
                                <input
                                    class=""
                                    type="checkbox"
                                    v-model="product.liquid"
                                    id="liquid"
                                />
                                <label for="liquid"> Liquid</label>
                            </div>
                            <div class="mb-1">
                                <input
                                    class=""
                                    type="checkbox"
                                    v-model="product.inflammable"
                                    id="inflammable"
                                />
                                <label for="inflammable">
                                    Inflammable (দাহ্য পদার্থ)</label
                                >
                            </div>
                            <div class="mb-1">
                                <input
                                    class=""
                                    type="checkbox"
                                    v-model="product.pre_order"
                                    id="pre_order"
                                />
                                <label for="pre_order"> Pre Booking</label>
                            </div>
                            <div class="mb-1">
                                <input
                                    class=""
                                    type="checkbox"
                                    v-model="product.digital"
                                    id="digital"
                                />
                                <label for="digital">
                                    Digital (downloadable)</label
                                >
                            </div>
                            <div class="mb-3">
                                <input
                                    class=""
                                    type="checkbox"
                                    v-model="product.refundable"
                                    id="refundable"
                                />
                                <label for="refundable"> Refundable</label>
                            </div>
                            <div class="mb-3">
                                <label class="h6" for="warrenty_type">
                                    Warranty type
                                </label>
                                <select
                                    class="form-control"
                                    v-model="product.warrenty_type"
                                    id="warrenty_type"
                                >
                                    <option value="">No Warrenty</option>
                                    <option value="replacement_warrenty"
                                        >Replacement Warrenty</option
                                    >
                                    <option value="service_warrenty"
                                        >Service Warranty</option
                                    >
                                </select>
                            </div>
                            <div class="mb-3" v-if="product.warrenty_type">
                                <label class="h6" for="warrenty_period">
                                    Warranty type
                                </label>
                                <select
                                    class="form-control"
                                    v-model="product.warrenty_period"
                                    id="warrenty_period"
                                >
                                    <option value="">Warranty days</option>
                                    <option value="30">30 Days</option>
                                    <option value="183">183 Days</option>
                                    <option value="365">365 Days</option>
                                </select>
                            </div>
                        </div>
                        <hr class="divider my-3" />
                        <div class="padding-around">
                            <button class="btn btn-primary w-100">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                        <bottom-back-bottom></bottom-back-bottom>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
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
    components: {
        Cropper
    },
    data() {
        return {
            dummyUrl: "/../../../../../img/pfi.png",
            cropperUrl: "",
            addNewUser: false,
            moreImages: [],
            product: {
                product_name: "",
                excerpt: "",
                what_in_box: "",
                product_condition: "",
                septic: "",
                liquid: "",
                inflammable: "",
                pre_order: "",
                digital: "",
                refundable: "",
                warrenty_type: "",
                warrenty_period: "",
                featured_image: "",
                more_images: []
            }
        };
    },
    created() {
        $(document).ready(function() {
            $(".select2").select2({
                theme: "bootstrap4"
            });
        });
    },
    methods: {
        onFileChange(e) {
            const file = e.target.files[0];
            console.log(file);
            this.dummyUrl = "";
            this.cropperUrl = URL.createObjectURL(file);
            this.product.featured_image = e.target.files[0];
        },
        showMoreImages(e) {
            const files = e.target.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                this.product.more_images.push(file);
                this.moreImages.push(URL.createObjectURL(file));
            }
        },
        change({ coordinates, canvas }) {
            console.log(coordinates, canvas);
        }
    }
};
</script>
