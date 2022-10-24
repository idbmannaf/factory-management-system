<template>
    <div class="pading-top">
        <div class="card">
            <div class="card-header h4">
                Agent List <router-link class="btn btn-sm btn-primary float-right" :to="{name: 'dealer.agent.add'}"><i class="fa fa-plus"></i> add new user</router-link>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Location</th>
                                <th>Active Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <agent-list-item v-for="(agent, index) in agents" :key="index" :agent="agent"></agent-list-item>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            agents: [
                {
                    id: 1,
                    name: 'a',
                },
                {
                    id: 2,
                    name: 'a',
                },
            ],
        }
    },
}
</script>