<template>
    <ais-index app-id="VTSLVYP1L6" api-key="3d58de5a863787a134480dba37d5b25e" index-name="dev_test_products_en">

        <ais-search-box>

            <div class="input-group">
                <ais-input placeholder="Search product by name or reference..." :class-names="{'ais-input': 'form-control search-control'}"></ais-input>
                <span class="input-group-btn">
                    <button class="btn btn-green" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span>
            </div>

        </ais-search-box>

        <ais-results inline-template>
            <div class="search-autocomplete">

                <ul>
                    <li v-for="result in results" :key="result.objectID"><a :href="'/product/'+result.slug" title="">{{ result.name }}</a></li>
                </ul>
            </div>
        </ais-results>

    </ais-index>

</template>

<script>
    export default {

    }
</script>
