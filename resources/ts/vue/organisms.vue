<template>
   
   <div>

       <h2> Organism list ({{ organisms.length }}) </h2>
       <table class="pure-table pure-table-horizontal">
            <thead>
                <tr>
                    <th>Genus</th>
                    <th>species</th>
                </tr>
            </thead>
            <tbody>
                <OrganismsDetails v-for="organism of organisms" :key="organism.id" :data="organism"/>
            </tbody>
        </table>

   </div>

</template>

<style lang="scss" scoped >

</style>

<script lang="ts">

import {Vue, Component} from 'vue-property-decorator';
import axios from 'axios';
import OrganismsDetails from './organism_details.vue';

/**
 * Type of the organism
 */
 type OrganismT = {
    id: number;
    genus: string;
    species: string;
}


@Component({
    components: {
        OrganismsDetails,
    }
})
export default class OrganismsVue extends Vue {

    organisms : OrganismT[] = [];

    mounted(){
        // Load the organisms when the component gets mounted
        this.loadOrganisms();
    }

    /**
     * Recieve the organisms from the api endpoint
     */
     async loadOrganisms(){
         const response = (await axios.get('/api/organisms/'));
         this.organisms = response.data.data
    }

}
</script>
