<template>
    <tr>
        <td>1</td>
        <td>{{ market.name }}</td>
        <td>adaws</td>
        <td>adaws</td>
        <td>adaws</td>
        <td>adaws</td>
        <td>
            <router-link class="btn-link" :to="{name:'dealer.market.details', params:{market: market.id}}">details</router-link>
            <router-link class="btn-link" :to="{name:'dealer.market.edit', params:{market: market.id}}">edit</router-link>
        </td>
    </tr>
</template>
<script>
export default {
    props:[
        'market',
    ],
}
</script>