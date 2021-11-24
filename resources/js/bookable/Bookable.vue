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
            <availability :bookable-id="this.$route.params.id" v-on:availability="checkPrice($event)" class="mb-4"/>
            
            <transition name="fade">
                <PriceBreakdown v-if="price" :price="price" class="mb-4" />
            </transition>
            <transition name="fade">
                <button class="btn btn-outline-secondary btn-block" v-if="price">Book now</button>
            </transition>
        </div>
    </div>
</template>

<script>
    import Availability from './Availability';
    import ReviewList from './ReviewList';
    import PriceBreakdown from './PriceBreakdown';
    import { mapState } from "vuex";
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
        computed: mapState({
            lastSearchComputed: "lastSearch"
        }),
        methods: {
            async checkPrice(hasAvailability) {
                if(!hasAvailability) {
                    this.price = null;
                    return;
                }

                try {
                    this.price = (await axios.get(`/bookables/${this.bookable.id}/price?from=${this.lastSearchComputed.from}&to=${this.lastSearchComputed.to}`)).data.data;    
                    console.log(this.price);
                } catch(err) {
                    console.log(err);
                    this.price = null;
                }

            }
        }
    }

</script>
