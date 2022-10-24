<template>
    <div class="padding-around">
        <div class="card">
            <div class="card-header h5">
                Add Edit Agent
            </div>
            <div class="card-body">
                <div class="padding-bottom">
                    <div class="h6">
                        <label for="name">User</label>
                    </div>
                    <div>
                        <select class="form-control select2-container step2-select select2" v-model="agent.user_id" id="">
                            <option value="">a</option>
                            <option value="">b</option>
                        </select>
                    </div>
                </div>
                <div class="padding-bottom">
                    <div class="h6">
                        <label for="name">Agent Name</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" v-model="agent.name">
                    </div>
                </div>
                <div class="padding-bottom">
                    <div class="h6">
                        <label for="name">Agent Name Bangla</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" v-model="agent.name_bn">
                    </div>
                </div>
                <div class="padding-bottom">
                    <div class="h6">
                        <label for="address">Address</label>
                    </div>
                    <div>
                        <textarea class="form-control" v-model="agent.address" id="address" rows="3"></textarea>
                    </div>
                </div>
                <div class="padding-bottom">
                    <div class="h6">
                        <label for="mobile">Contact Number</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" v-model="agent.mobile">
                    </div>
                </div>
                <div class="padding-bottom h6">
                    <input type="checkbox" v-model="agent.active"> Active
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
            agent: {
                user_id: '',
                name: '',
                name_bn: '',
                address: '',
                mobile: '',
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