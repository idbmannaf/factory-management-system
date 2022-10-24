<template>
    <tr>
        <td>{{ product.id }}</td>
        <td>{{ product.name.en ? product.name.en : product.name }}</td>
        <td>{{ product.owner.mobile ? product.owner.mobile : product.owner.email }}</td>
        <td>{{ product.source.name.en ? product.source.name.en : product.source.name }}</td>
        <td>
            {{ product.status ? product.status.toUpperCase() : '' }}
        </td>
        <td>
            <!-- <router-link class="btn w3-blue btn-link p-2 m-1" :to="{name: 'agent.ecom.product.edit', params:{'product': product.id}}">
                <i class="fa fa-edit"></i>
            </router-link> -->
            <a class="btn w3-red btn-link p-2 m-1" href=""> <i class="fa fa-trash"></i></a>
        </td>
    </tr>
</template>
<script>
export default {
    props: [
        'product',
    ],
}
</script>
