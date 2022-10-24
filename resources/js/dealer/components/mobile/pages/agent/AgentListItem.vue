<template>
    <tr>
        <td>1</td>
        <td>{{ agent.name }}</td>
        <td>adaws</td>
        <td>adaws</td>
        <td>adaws</td>
        <td>adaws</td>
        <td>
            <router-link class="btn-link" :to="{name:'dealer.agent.details', params:{agent: agent.id}}">details</router-link>
            <router-link class="btn-link" :to="{name:'dealer.agent.edit', params:{agent: agent.id}}">edit</router-link>
        </td>
    </tr>
</template>
<script>
export default {
    props:[
        'agent',
    ],
}
</script>