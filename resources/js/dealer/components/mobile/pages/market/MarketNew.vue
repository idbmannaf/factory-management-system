<template>
    <div class="padding-around">
        <div class="card">
            <div class="card-header h5">
                Add New Market
            </div>
            <div class="card-body">
                <div class="padding-bottom">
                    <div class="h6">
                        <label for="name">Market Name</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" v-model="market.name">
                    </div>
                </div>
                <div class="padding-bottom">
                    <div class="h6">
                        <label for="name">Market Name Bangla</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" v-model="market.name_bn">
                    </div>
                </div>
                <div class="padding-bottom">
                    <div class="h6">
                        <label for="name">Market Name</label>
                    </div>
                    <div>
                        <select class="form-control  select2-container step2-select select2" v-model="market.agent" id="">
                            <option value="">a</option>
                            <option value="">b</option>
                        </select>
                    </div>
                </div>
                
                <div class="padding-bottom h6">
                    <input type="checkbox" v-model="market.active"> Active
                </div>
                <div class="text-center">
                    <button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            market: {
                name: '',
                name_bn: '',
                agent: '',
                active: false,
            },
        }
    },
    created() {
        $(document).ready(function(){
            $('.select2').select2({
                theme: 'bootstrap4',
            });
        });
    },
}
</script>