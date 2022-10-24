<template>
  <div>
        <div class="input-group px-3 mb-3 text-center">
            <v-select class="form-control py-1" label="email" :filterable="false" :options="options"
            @search="onSearch"
            v-model="selectedSource"
            @input="setSelectedSource"
            >
                <template slot="no-options">
                Please enter 1 or more characters
                </template>
                <template slot="option" slot-scope="option" >
                <div class="d-center">
                    {{ option.name.en }} ({{ option.mobile }})
                    </div>
                </template>
                <template slot="selected-option" slot-scope="option">
                <div class="selected d-center">
                    {{ option.name.en }} ({{ option.mobile }})
                </div>
                </template>
            </v-select>
            <!-- <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"
                @click="activeNewUserForm()">
                    <i class="fa fa-user-plus"></i>
                </span>
            </div> -->
        </div>
  </div>
</template>

<script>
import eventBus from './../../../../../event-bus'
export default {
    props: ['agent'],
    data() {
        return {
            options: [],
            selectedSource: null,
            addNewUser: false,
        }
    },
    mounted() {
        eventBus.$on('newUserAdded', (data)=>{
            this.addNewUser = !this.addNewUser
        })
    },
    created() {

    },
    methods: {
        onSearch(search, loading) {
            this.addNewUser = false
            if(search.length) {
                loading(true);
                axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/shop/search?q=${search}`).then(res=>{
                        this.options = res.data
                    loading(false);
                })
            }
        },
        setSelectedSource(){
            eventBus.$emit('selectSource',{source: this.selectedSource})
        },
        activeNewUserForm(){
            this.addNewUser = !this.addNewUser
            eventBus.$emit('newUserForm')
        },
    },
}
</script>

<style>

</style>
