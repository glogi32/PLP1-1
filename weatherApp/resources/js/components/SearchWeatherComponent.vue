<template>
    <div class="col-md-4">
        <h3>Search weather by name</h3>
        <input type="text" id="searchWeather" v-model="keyword" class="form-control">
        <button class="btn btn-primary" @click="searchWeather">Search</button>
        <div class="bg-dark p-3 mt-4" v-if="cities.length" >
            <div class="bg-secondary p-2 text-white" v-for="city in cities" v-bind:key="city.id">
                <h5>{{city.name}}</h5>
                <ul>
                    <li>Temp: {{city.weather[0].temp}}</li>
                    <li>Min temp: {{city.weather[0].temp_max}}</li>
                    <li>Max temp: {{city.weather[0].temp_min}}</li>
                    <li>Humidity: {{city.weather[0].humidity}}</li>
                    <li>Description: {{city.weather[0].description}}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name : "Search",
    data(){
        return{
            keyword : "",
            cities : [],
        }
    },
    methods: {
        searchWeather : function(){
            axios.get("http://127.0.0.1:8000/api/city-weather",{
                params: {
                    name : this.keyword
                }
            })
            .then(
                res => {
                    console.log(res);
                    this.cities = res.data;
                    console.log(this.cities);
                }
            )
            .catch(
                err => {
                    console.log(err)
                }
            );
        }
    }
}
</script>

<style>

</style>