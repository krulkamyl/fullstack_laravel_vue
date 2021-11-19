<template>
    <div>
        <div v-if="!loading">
            Data is loading...
        </div>
        <div v-else>
            <div 
            class="row mb-4" 
            v-for="row in rows" 
            :key="'row'+row">
                <div class="col" 
                v-for="(bookable, column) in bookablesInRow(row)" 
                :key="'column'+column">
                    <BookableListItem 
                    :item-title="bookable.title" 
                    :item-content="bookable.content" 
                    :price="bookable.price" />
                </div>

                <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder'+row+p"> </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BookableListItem from './BookableListItem';

    export default {
        components: {
            BookableListItem
        },
        computed: {
            rows() {
                return Math.ceil(this.bookables.length / this.columns);
            }
        },
        methods: {
            bookablesInRow(row) {
                return this.bookables.slice((row-1) * this.columns, row * this.columns)
            },
            placeholdersInRow(row) {
                return this.columns - this.bookablesInRow(row).length;
            }
        },
        data() {
            return {
                loading: false,
                columns: 3,
                bookables: [{
                        title: "Example Bookable item",
                        content: "Here is a offer for bookable item example",
                        price: 1000
                    },
                    {
                        title: "Example Bookable item",
                        content: "Here is a offer for bookable item example",
                        price: 900
                    },
                    {
                        title: "Example Bookable item",
                        content: "Here is a offer for bookable item example",
                        price: 180000
                    },
                    {
                        title: "Example Bookable item",
                        content: "Here is a offer for bookable item example",
                        price: 123
                    },
                    {
                        title: "Example Bookable item",
                        content: "Here is a offer for bookable item example",
                        price: 1234
                    }
                ]
            }
        },
        created() {
            console.info("Hello world from created lifecycle hook!");
            setTimeout(() => {
                this.loading = true;
            }, 800);
        }
    }

</script>
