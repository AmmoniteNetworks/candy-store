<template>
    <div>
        <div v-for="(chunk,index) in chunkedResults" :key="index">
            <div class="row">

                <div class="col-xs-12 col-md-6" v-for="result in chunk" :key="result.objectID">
                    <div class="element product-box listing">
                        <div class="row">
                            <div class="col-xs-5">
                                <a :href="'/product/'+result.slug" class="product-img">
                                    <img :src="result.image">
                                </a>
                            </div>
                            <div class="col-xs-7">
                                <div class="product-details">
                                    {{ result.key }}
                                    <a :href="'/product/'+result.slug" class="product-title">
                                        <ais-highlight :result="result" attribute-name="name"></ais-highlight>
                                    </a>
                                    <form>
                                        <div class="product-qty-price">
                                            <div class="form-group product-qty">
                                                <label class="sr-only">Quantity</label>
                                                <input type="text" class="form-control" value="1">
                                            </div>
                                            <div class="product-price">
                                                <small>&pound;</small>{{ result.min_price }}
                                                <span class="vat">Exc.<br>VAT</span>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-green">Add to Basket</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    import { Results } from 'vue-instantsearch';

    export default {
        extends: Results,
        computed: {
            chunkedResults() {
                return _.chunk(this.results,2)
            }
        }
    }
</script>
