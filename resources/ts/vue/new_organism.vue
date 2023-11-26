<template>

   
   <div>
        <h2> Add New Organism </h2>

        <form class="pure-form pure-form-stacked" @submit.prevent="">
            <fieldset class="pure-group">
                <input
                    required
                    type="text"
                    v-model="genus"
                    placeholder="Genus"
                    class="pure-input-1"
                >
                <input
                    required
                    type="text"
                    v-model="species"
                    placeholder="Species"
                    class="pure-input-1"
                >
            </fieldset>

            <p>{{ msg }}</p>

            <button
                class="pure-button pure-button-primary pure-input-1"
                @click="onClick"
            > Create </button>

        </form>

   </div>


</template>


<style lang="scss" scoped >

</style>


<script lang="ts">

import {Vue, Component, Prop, Watch} from 'vue-property-decorator';
import axios from 'axios';




@Component({})
export default class NewOrganismVue extends Vue {

    genus = ''
    species = '';
    msg = 'Status';

    async onClick(){

        
        if (this.genus === '' || this.genus === ' ' || this.species === '' || this.species === ' ') {
            this.msg = 'Please fill both Genus and Species fields';
            return;
        }

        const data = {
            genus: this.genus,
            species: this.species,
        }

        this.msg = 'Adding new organism';

        try {
            const response = await axios.post('/api/organisms/', data);
            this.msg = 'Success';
            this.genus = '';
            this.species = '';
        } catch (e){
            if (axios.isAxiosError(e) && e.response) {
                this.msg = e.response.data.error;
            } else {
                this.msg = 'Other error'
            }

        }


    }

}
</script>
