<template>
    <div>
        <button type="button" :class="prevClass" @click="goToPreviousPage"><i class="fa fa-angle-left" aria-hidden="true" ></i></button>
        <p>Page {{ page }} of {{ totalPages }}</p>
        <button type="button" :class="nextClass" @click="goToNextPage"><i class="fa fa-angle-right" aria-hidden="true" ></i></button>
    </div>
</template>

<script>
    import { Pagination } from 'vue-instantsearch';

    export default {
        extends: Pagination,
        data() {
            return {
                prevClass: 'btn btn-sm btn-light-blue',
                nextClass: 'btn btn-sm btn-light-blue'
            }
        },
    }
</script>
