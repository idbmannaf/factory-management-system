<template>
<tr>
<td>
{{ user.name }}
</td>
<td>
{{ user.mobile }}
</td>
<td>
{{ user.email }}
</td>
<td>
{{ user.password_temp }}
</td>
</tr>
</template>

<script>
export default {
props: ['agent', 'user'],
data() {
    return {

    }
},
created() {
},
}
</script>

<style>

</style>
