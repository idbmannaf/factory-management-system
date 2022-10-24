<template>
    <div class="padding-around">
        <div class="form-group">
            <label for="name">Shop Name*</label>
            <input class="form-control" :class="{'is-invalid' : error.name}" type="text" v-model="newSourceInfo.name">
            <div class="alert alert-danger" v-for="(msg, index) in error.name" :key="index">
                {{ msg }}
            </div>
        </div>
        <div class="form-group">
            <label for="owner_name">Owner name*</label>
            <input class="form-control" :class="{'is-invalid' : error.owner_name}" type="text" v-model="newSourceInfo.owner_name">
            <div class="alert alert-danger" v-for="(msg, index) in error.owner_name" :key="index">
                {{ msg }}
            </div>
        </div>
        <div class="form-group">
            <label for="description">Shop Description</label>
            <textarea class="form-control" rows="3" :class="{'is-invalid' : error.description}" v-model="newSourceInfo.description"></textarea>
            <div class="alert alert-danger" v-for="(msg, index) in error.description" :key="index">
                {{ msg }}
            </div>
        </div>
        <div class="form-group">
            <label for="address">Shop Address</label>
            <textarea class="form-control" rows="3" :class="{'is-invalid' : error.address}" v-model="newSourceInfo.address"></textarea>
            <div class="alert alert-danger" v-for="(msg, index) in error.address" :key="index">
                {{ msg }}
            </div>
        </div>
        
        <div class="form-group">
            <label for="mobile">Mobile number*</label>
            <input class="form-control" :class="{'is-invalid' : error.mobile}" type="number" v-model="newSourceInfo.mobile">
            <div class="alert alert-danger" v-for="(msg, index) in error.mobile" :key="index">
                {{ msg }}
            </div>
        </div>
        <div class="form-group">
            <label for="type">Shop Type</label>
            <select class="form-control" :class="{'is-invalid' : error.type}" v-model="newSourceInfo.type">
                <option value="" selected disabled>Select one</option>
                <option value="distributor">Distributor</option>
                <option value="flagship_distributor">Flagship Distributor</option>
            </select>
            <div class="alert alert-danger" v-for="(msg, index) in error.market" :key="index">
                {{ msg }}
            </div>
        </div>
        
        <div class="form-group">
            <label for="due_amount">Initial/Due Amount*</label>
            <input class="form-control" :class="{'is-invalid' : error.due_amount}" type="number" v-model="newSourceInfo.due_amount">
            <div class="alert alert-danger" v-for="(msg, index) in error.due_amount" :key="index">
                {{ msg }}
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary" v-on:click="saveSource()"> <i class="fa fa-save"></i> Save Source</button>
        </div>
    </div>
</template>

<script>
import eventBus from './../../../../../../event-bus'
export default {
    props: ['agent','owner'],
    data() {
        return {
            newSourceInfo: {},
            error:{},
            selectedMarket: null,
            marketAreas: [],
        }
    },
    created() {
        // axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/markets/get`).then(res => {
        //     this.marketAreas = res.data
        // })
    },
    methods: {
        selectMarket(){
            if (this.selectedMarket) {
                this.newSourceInfo.market = this.selectedMarket.id
            }else{
                this.newSourceInfo.market = null
            }
        },
        saveSource(){
            axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/shop/save`, this.newSourceInfo).then(res => {
                if (res.status == 200) {
                    this.$swal({
                        title: 'Success!',
                        text: 'Shop is added.',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                    });
                    // eventBus.$emit('selectNewSource', res.data)
                    
                    this.$router.push({ name: 'agent.ecom.source.list'});
                }else{
                    this.error = res.data
                }
            });
            // axios.post(window.location.origin+`/api/agent/${this.agent}/ecommerce/product/owner/${this.owner.id}/source/save`, this.newSourceInfo).then(res => {
            //     if (res.status == 200) {
            //         this.$swal({
            //             title: 'Success!',
            //             text: 'Source is added.',
            //             icon: 'success',
            //             confirmButtonText: 'Ok',
            //         });
            //         eventBus.$emit('selectNewSource', res.data)
            //     }
            // });
        },
    },
}
</script>