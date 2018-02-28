<template>

    <div v-show="show">
        <p class="filter-title">Colour</p>

        <div class="checkbox" v-for="facet in facetValues">
            <label>
                <input type="checkbox" :name="facet.name" :checked="facet.isRefined" value="1" @change="toggleRefinement(facet)">
                <span>{{ facet.name }} ({{ facet.count }})</span>
            </label>
        </div>
    </div>

</template>

<script>
    import { RefinementList } from 'vue-instantsearch';

    export default {
        extends: RefinementList,
        props: {
            attributeName: {
                type: String,
                default: 'colour'
            }
        }
    }
</script>
