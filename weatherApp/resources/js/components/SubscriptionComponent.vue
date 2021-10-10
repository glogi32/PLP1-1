<template>
    <div class="col-md-6">
        <div class="col-md-4">
            <select name="ddlCities" id="ddlCities" class="form-control" v-model="selectedCity" > 
                <option v-for="city in testCities" v-bind:key="city.id" v-bind:value="city.id">
                    {{ city.name }}
                </option>
            </select>
            <button id="btnSubscribe" class="btn btn-primary"  v-on:click="greet" >Subscribe</button>
        </div>
    </div>
</template>

<script>
export default {
    data: function()  {
        return {
            testCities:[],
            selectedCity: null
        }
    },
    props: [
        'test'
    ],
    
    mounted(){
        let th = this;
        this.loadCities();
        
    },
    methods : {
        greet() {
            alert(12)
        },
        loadCities: function(){
            axios.get("http://127.0.0.1:8000/api/cities")
            .then(
                res => {
                    this.testCities = res.data;
                    console.log(this.testCities)
            }).catch(
                err => {
                    console.log(err)
                }
            )
        }
    },
}
</script>

<style>

</style>