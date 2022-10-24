<template>
    <div class="padding-top w3-white">
        <div class="steps-wizard clearfix mb-3">
            <div class="step done" data-step-num="1">
                <div class="step-icon"> 1 </div>
                <span class="step-title">Upload Photos</span>
            </div>
            <div class="step done" data-step-num="2">
                <div class="step-icon"> 2 </div>
                <span class="step-title">Product Information</span>
            </div>
            <div class="step done   " data-step-num="3">
                <div class="step-icon "> 3 </div>
                <span class="step-title">Product Category</span>
            </div>
            <div class="step current" data-step-num="4">
                <div class="step-icon"> 4 </div>
                <span class="step-title">Product Owner</span>
            </div>
        </div>
        <div class="h5 px-3">
                        Set Product Owner
                    </div>
                    <div>
                        <select-user :agent="agent"></select-user>

                        <div class="padding-around" v-if="selectedUser">
                            <div class="h6">Product Owner</div>
                            <div>
                                Email: {{ selectedUser.email }} <br>
                                Mobile: {{ selectedUser.mobile }}   
                            </div>
                            <div class="padding-top" v-if="sourceList">
                                <div class="h6">
                                    Select product source from Owner Sources
                                </div>
                                <div class="w3-text-yellow" v-if="!sourceList.length">
                                    This user do not have any source. Please add a source for him.
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
                                <ecom-product-create-source :owner="selectedUser" :agent="agent" ></ecom-product-create-source>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="px-3">
                    <div class="padding-around">
                            <button class="btn btn-success w-100" :disabled="!selectedUser || !selectedSource" :class="{'w3-grey': !selectedUser || !selectedSource}" @click="submitProduct()"><i class="fas fa-feather-alt"></i> Submit for review</button>
                        </div>
                </div>
                <hr class="divider my-3">
                <div class="px-1">
                    <div>
                        <bottom-back-bottom></bottom-back-bottom>
                    </div>
                </div>
                    </div>
    </div>
</template>
<script>
import eventBus from './../../../../../../event-bus'
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
    mounted(){
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
    created() {
        axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/category/check`).then(res=>{
            if (!res.data) {
                this.$router.push({ name: 'agent.ecom.product.create.category'})
            }
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