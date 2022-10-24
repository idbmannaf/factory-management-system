<template>
<div class="padding-around">
<div class="h5">Create New Shop</div>
<!-- <select-user :agent="agent"></select-user> -->

        <!-- <div class="padding-around" v-if="selectedUser">
            <div class="h6">Product Owner</div>
            <div>
                Email: {{ selectedUser.email }} <br>
                Mobile: {{ selectedUser.mobile }}
            </div>
            <div class="padding-top" v-if="sourceList">
                <div class="h6">
                    Select product shop from Owner Shop
                </div>
                <div class="w3-text-yellow" v-if="!sourceList.length">
                    This user do not have any shop. Please add a shop for him.
                </div>
                <div class="pt-1 padding-around">
                    <div v-for="(source, index) in sourceList" :key="index">
                    <input type="radio" v-model="selectedSource" :value="source.id">
                    <label for="selectedSource">{{source.name.en}}</label>
                </div>
                </div>
            </div>
            <div class="text-center py-2">
                <button class="btn btn-sm btn-info" @click="newSource = !newSource"> <i class="fa fa-edit"></i> Add New Source</button>
            </div>
            <div v-if="newSource">
            </div>
        </div> -->
                <ecom-product-create-source :agent="agent" ></ecom-product-create-source>
</div>
</template>

<script>
import eventBus from './../../../../../event-bus'
export default {
    props: ['agent'],
    data() {
        return {
            selectedUser: null,
            options: [],
            sourceList:[],
            selectedSource: null,
            newSource: false,
        }
    },
    mounted() {
        eventBus.$on('selectUser',(data)=>{
            this.selectedUser = data.user
            this.setSelectedUser()
        });
        eventBus.$on('newUserAdded',(data)=>{
            this.selectedUser = data
            this.setSelectedUser()
        });
        eventBus.$on('newUserForm',(data)=>{
            this.activeNewUserForm()
        });
        eventBus.$on('selectNewSource',(data)=>{
            this.selectNewSource(data)
        });
    },
    methods: {
        setSelectedUser(){
            this.sourceList = []
            if(this.selectedUser){
                axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/owner/${this.selectedUser.id}/sources/get`).then(res=>{
                    if (res.data.length > 0) {
                        this.sourceList = res.data
                    }
                })
            }
        },
        selectNewSource(source){
            this.sourceList.push(source)
            this.selectedSource = source.id
            this.newSource = !this.newSource
        },
        submitProduct(){
            axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/submit`, {'user_id' : this.selectedUser.id, 'source_id' : this.selectedSource }).then(res => {
                if (res.status == 200) {
                    this.$swal({
                        title: 'Success!',
                        text: 'Product is submitted for review.',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    this.$router.push({ name: 'agent.ecommerce.product.list'});
                }
            })
        },
        activeNewUserForm(){
            this.selectedUser = null
            this.selectedSource = null
        },
        newUserAdded(user){
            this.selectedUser = user
            this.addNewUser = !this.addNewUser
        },
    },

}
</script>

<style>

</style>
