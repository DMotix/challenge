<template>

    <tr>
        <td>{{ data.genus }}</td>
        <td>{{ data.species }}</td>
    </tr>
    
</template>
 
 
<style lang="scss" scoped >


</style>

<script lang="ts">

import {Vue, Component} from 'vue-property-decorator';

@Component({
    props: {
        data: Object,
    },
})
export default class OrganismsVue extends Vue {
    
}
</script>
 