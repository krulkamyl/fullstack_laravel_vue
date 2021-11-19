<template>
    <div>
        <div v-if="loading">
            Data is loading...
        </div>
        <div v-else>
            <div 
            class="row mb-4" 
            v-for="row in rows" 
            :key="'row'+row">
                <div class="col d-flex align-items-stretch" 
                v-for="(bookable) in bookablesInRow(row)" 
                :key="'column'+bookable.id">
                    <BookableListItem 
                    :item-title="bookable.title" 
                    :item-description="bookable.description" 
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
                loading: true,
                columns: 3,
                bookables: []
            }
        },
        created() {
            const p = new Promise((resolve, reject) => {
                console.log(resolve);
                console.log(reject);

                setTimeout(() => {
                    resolve("Hello")
                },3000);
            })
            .then(result => "hello "+ result)
            .then(result => console.log(`Success: ${result}`))
            .catch(result => console.log(`Result: ${result}`));

            console.log(p);

            const request = axios.get("/bookables")
                .then(response => {
                    this.bookables = response.data;
                    this.loading = false
                });
            console.log(request);
        }
    }

</script>
