<template>
    <div class="col-md-4">
        <h3>Search weather by name</h3>
        <input type="text" id="searchWeather" v-model="keyword" class="form-control">
        <div v-if="errors" class="alert alert-danger mt-3" role="alert">
                <ul>
                    <li v-for="(err,name) in errors" v-bind:key="err">
                        <ul v-if="err.length">
                            {{name}}
                            <li v-for="e in err" v-bind:key="e">
                                {{e}}
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        <button class="btn btn-primary" @click="searchWeather">Search</button>
        <div class="bg-dark p-3 mt-4" v-if="cities.length" >
            <div class="bg-secondary p-2 text-white" v-for="city in cities" v-bind:key="city.id">
                <h5>{{city.name}}</h5>
                <ul v-if="city.weather_today.length">
                    <li>Temp: {{city.weather_today[0].temp}}</li>
                    <li>Min temp: {{city.weather_today[0].temp_max}}</li>
                    <li>Max temp: {{city.weather_today[0].temp_min}}</li>
                    <li>Humidity: {{city.weather_today[0].humidity}}</li>
                    <li>Description: {{city.weather_today[0].description}}</li>
                </ul>
                <p v-else>No data for this day.</p>
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
            errors : null,
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
                    this.errors = err.response.data.errors;
                }
            );
        }
    }
}
</script>

<style>

</style>