<template>
    <div class="col-md-4 ">
        <h3>Subscriptions:</h3>    
        <div class="bg-dark text-white mt-3 p-3" v-if="cities.length">
            <div v-for="city in cities" v-bind:key="city.id" class="bg-secondary text-white my-2 p-2">
                {{city.name}} 
                <button class=" btn-danger float-right" @click="onDelete(city.id)">Delete</button>
            </div>
        </div>
        <div class="alert alert-info mt-3" v-else role="alert">
            You are not subscribed to cities.
        </div>
    </div>
</template>

<script>
export default {
    name : "Cities",
    props : {
        cities :Array,
    },
    data(){
        return {
            userId : document.getElementById("userId").value
        }
    },
    mounted(){
        console.log(this.cities)
    },
    methods : {
        onDelete : function(id){
            axios.delete("http://127.0.0.1:8000/api/unsubscribe",{
                data : {
                    userId : this.userId,
                    cityId : id
                }
            })
            .then(
                res => {
                    console.log(res)
                    this.$emit("unsubscribe",id);
                }
            )
            .catch(
                err => {
                    console.log(err)
                }
            )
        }
    }
}
</script>

<style scoped>

</style>