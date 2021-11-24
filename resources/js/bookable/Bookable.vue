<template>
    <div class="row">
        <div class="col-md-8 pb-4">
            <div class="card">
                <div class="card-body">
                    <div v-if="!loading">
                        <h2>{{ bookable.title }}</h2>
                        <hr />
                        <article>{{ bookable.description }}</article>
                    </div>
                    <div v-else>
                        Loading...
                    </div>
                </div>
            </div>

            <ReviewList :bookable-id="this.$route.params.id" />
        </div>
        <div class="col-md-4 pb-4">
            <availability :bookable-id="this.$route.params.id" v-on:availability="checkPrice($event)" class="mb-4" />

            <transition name="fade">
                <PriceBreakdown v-if="price" :price="price" class="mb-4" />
            </transition>
            <transition name="fade">
                <button class="btn btn-outline-secondary btn-block" v-if="price" @click="addToBasket"
                    :disabled="inBasketAlready">Book now</button>
            </transition>

            <button class="btn btn-outline-secondary btn-block" v-if="inBasketAlready" @click="removeFromBasket">
                Remove from basket
            </button>

            <div v-if="inBasketAlready" class="mt-4 text-muted warning">
                Seems like you've added this object to basket already. If you want to change dates, remove form basket
                list
            </div>
        </div>
    </div>
</template>

<script>
    import Availability from './Availability';
    import ReviewList from './ReviewList';
    import PriceBreakdown from './PriceBreakdown';
    import {
        mapState
    } from "vuex";
    export default {
        components: {
            Availability,
            ReviewList,
            PriceBreakdown
        },

        data() {
            return {
                bookable: null,
                loading: true,
                price: null
            }
        },
        created() {
            axios.get(`/bookables/${this.$route.params.id}`)
                .then(response => {
                    this.bookable = response.data.data;
                    this.loading = false;
                });
        },
        computed: {
            ...mapState({
                lastSearchComputed: "lastSearch",
            }),
            inBasketAlready() {
                if (this.bookable === null) {
                    return false;
                }
                return this.$store.getters.inBasketAlready(this.bookable.id);
            }
        },
        methods: {
            async checkPrice(hasAvailability) {
                if (!hasAvailability) {
                    this.price = null;
                    return;
                }

                try {
                    this.price = (await axios.get(
                        `/bookables/${this.bookable.id}/price?from=${this.lastSearchComputed.from}&to=${this.lastSearchComputed.to}`
                    )).data.data;
                    console.log(this.price);
                } catch (err) {
                    console.log(err);
                    this.price = null;
                }

            },
            addToBasket() {
                this.$store.dispatch("addToBasket", {
                    bookable: this.bookable,
                    price: this.price,
                    dates: this.lastSearchComputed
                });
            },
            removeFromBasket() {
                this.$store.dispatch("removeFromBasket", this.bookable.id);
            }
        }
    }

</script>

<style scoped>
    .warning {
        font-size: 0.7 rem;
    }

</style>
