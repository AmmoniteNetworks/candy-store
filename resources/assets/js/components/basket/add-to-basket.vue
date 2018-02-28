<template>
    <div>
        <div class="product-qty-price">
            <div class="form-group product-qty">
                <label class="sr-only">Quantity</label>
                <input min="1" max="99" type="number" class="form-control" v-model="storedProduct.quantity">
            </div>
            <div class="product-price">
                <div class="numeric numeric-lg">{{ storedProduct.variant.price | currency }}</div>
                <span class="vat">{{ vatLabel }}.<br>VAT</span>
            </div>
        </div>
        <a v-if="productHasInventory" href="javascript:void(0)" class="btn btn-green add-to-basket_summary" @click="addToBasket">Add to Basket</a>
        <a v-if="!productHasInventory" href="javascript:void(0)" class="btn btn-grey add-to-basket_summary" disabled>Out of Stock</a>
    </div>
</template>

<script>
    export default {
        props: {
            product: {
                type: Object,
                default: ''
            }
        },
        data() {
            return {
                selected: {}
            }
        },
        created() {
            this.updateVariant();
        },
        computed: {
            storedProduct() {
                return this.$store.state.product;
            },
            vatLabel() {
                return this.$store.getters.vatLabel;
            },
            productHasInventory: function(data) {
                return (this.product.variants.data[0].inventory > 0)
            }
        },
        methods: {
            addToBasket: function() {
                // Build Basket Line
                this.$store.commit('setProduct', this.product);
                this.$store.dispatch('addToBasket', this.storedProduct)
                .then(response => {
                    CandyEvent.$emit('addedToBasket');
                });
            },
            updateVariant: function() {
                var defaultVariant = this.product.variants.data[0];
                var _this = this;

                if (defaultVariant.options.length == 0) {
                    this.$store.commit('setProductVariant', defaultVariant);
                } else {
                    $.each(defaultVariant.options, function(key, value) {
                        _this.selected[key] = value;
                    });
                    this.$store.commit('setProductVariant', Candy.mapVariant(this.product.variants, this.selected));
                }
            }
        }
    }
</script>
