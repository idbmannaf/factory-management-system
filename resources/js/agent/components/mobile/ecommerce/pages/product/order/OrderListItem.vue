<template>
    <tr>
        <td>
            {{ shipmentReturn.id }}
        </td>
        <td>
            {{ shipmentReturn.returned_at | date }}
        </td>
        <td>
            <router-link class="btn-link" :to="{name: 'agent.ecom.incoming.order.manage', params: { order: 1 }}">manage</router-link>
        </td>
    </tr>
</template>
<script>
export default {
    props: ['agent', 'shipmentReturn'],
}
</script>
