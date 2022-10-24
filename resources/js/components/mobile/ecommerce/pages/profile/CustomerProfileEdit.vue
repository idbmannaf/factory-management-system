<template>
    <div>
        <section class="padding-around">
            <div class="icontext">
                <div class="icon">
                    <img :src="fiUrl" class="rounded-circle shadow-sm img-md" >
                </div>
                <div class="text">
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file_pasport" accept="" @change="onFileChange" lang="en">
                    <label class="custom-file-label" for="file_pasport">Profile image</label>
                    </div>
                    <div class="text-right mt-2">
                        <button class="btn btn-danger" v-if="image" @click="cancelUpload"> <i class="fa fa-trash"></i> Cancel</button>
                        <button class="btn btn-secondary" :disabled="!image" @click="uploadImage"> <i class="fas fa-upload"></i> Upload</button>
                    </div>
                </div>
            </div>
            <div class="px-3" v-if="errors.image">
                
            </div>

            <hr>

            <div class="form-group">
                <label>Name</label>
                <input type="text" required class="form-control" v-model="userData.name">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="telefon" class="form-control" v-model="userData.mobile" pattern="^[+][0-9]{12}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" autofocus autocomplete="on" class="form-control" v-model="userData.email">
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select v-model="userData.gender" class="form-control">
                <option value="male">male</option>
                <option value="female">Female</option>
                </select>
            </div>
            <!-- <div class="form-group">
                <label>Gender</label>
                <input type="text" list="city" v-model="userData.gender" class="form-control" placeholder="Yozing">
                <datalist id="city">
                <option value="male">male</option>
                <option value="female">Female</option>
                </datalist>
            </div> -->

            <div class="form-group">
                <label>Date of Birth <b v-if="user.dob"> : {{ user.dob | date }}</b></label>
                <input type="date" autofocus class="form-control" v-model="userData.dob">
            </div>

            <!-- <div class="form-group">
                <label>Address</label>
                <textarea type="date" autofocus class="form-control" v-model="userData.address"></textarea>
            </div> -->
            
            <button class="btn btn-light btn-block"> <i class="fa fa-lock"></i> Change password</button>
          

            <button type="submit" class="btn btn-block btn-primary" form="profile_form" @click="updateProfile"> Save  </button>

            </section> <!-- section body .// -->

            <hr class="divider my-3">

            <bottom-back-button></bottom-back-button>
    </div>
</template>
<script>
import eventBus from './../../../../../event-bus'
export default {
    data() {
        return {
            user: {},
            userData:{},
            image: null,
            fiUrl: null,
            errors: [],
        }
    },
    created() {
        axios.get(window.location.origin+`/api/check-login`).then(res=>{
            if (res.data.login) {
                this.user           = res.data.user
                this.userData.name  = this.user.name
                this.userData.email = this.user.email
                this.userData.mobile = this.user.mobile
                this.userData.gender = this.user.gender
                this.userData.dob   = this.user.dob
                this.fiUrl          = this.user.img_name ?? ' '
            }
        });
    },
    methods: {
        // updateProfile(){

        // },
        onFileChange(e) {
            const file = e.target.files[0];
            this.image = file;
            this.fiUrl = URL.createObjectURL(file);
            console.log(this.fiUrl);
            // this.cropperUrl = URL.createObjectURL(file);
            // this.featured_image = e.target.files[0];
            // if (this.featured_image) {
            //     this.is_selected_FI = true
            // }else{
            //     this.is_selected_FI = false
            // }
        },
        cancelUpload(){
            this.image = null
            this.fiUrl = this.user.img_name ?? ' '
        },
        uploadImage(){
            if (this.image) {
                let formData = new FormData();
                formData.append('image', this.image)
                axios.post(window.location.origin+`/api/profile-picture/upload`, 
                    formData,
                    {
                        headers: {
                            "Content-Type": `multipart/form-data; boundary=${formData._boundary}`
                        }
                    }
                ).then(res=>{
                    if (res.status == 200) {
                        this.image = null
                        this.user.img_name = res.data.img_name
                        this.fiUrl = res.data.img_name
                        this.$swal({
                            title: 'Success!',
                            text: 'Profile Picture is updated.',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                    }else{
                        this.errors.image = res.data.image
                    }
                })
            }
        },
        updateProfile(){
            axios.post(window.location.origin+`/api/update-profile`, this.userData).then(res=>{
                if (res.status == 200) {
                    this.user           = res.data
                    this.userData.name  = this.user.name
                    this.userData.email = this.user.email
                    this.userData.mobile = this.user.mobile
                    this.userData.gender = this.user.gender
                    this.userData.dob   = this.user.dob

                    this.$swal({
                            title: 'Success!',
                            text: 'Profile is updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                }else{
                    this.errors = res.data
                }
            })
        }
    },
}
</script>