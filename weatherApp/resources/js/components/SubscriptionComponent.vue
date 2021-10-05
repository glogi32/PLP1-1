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
    data()  {
        return {
            testCities:[{"id":1,"name":"Tirana\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":2,"name":"Andorra la Vella\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":3,"name":"Vienna\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":4,"name":"Minsk\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":5,"name":"Brussels\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":6,"name":"Sarajevo\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":7,"name":"Sofia\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":8,"name":"Zagreb\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":9,"name":"Prague\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":10,"name":"Copenhagen\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":11,"name":"Tallinn\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":12,"name":"Helsinki\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":13,"name":"Paris\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":14,"name":"Berlin\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":15,"name":"Athens\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":16,"name":"Budapest\r\n","created_at":"2021-10-04T08:34:38.000000Z","updated_at":"2021-10-04T08:34:38.000000Z"},{"id":17,"name":"Reykjavik\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":18,"name":"Dublin\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":19,"name":"Rome\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":20,"name":"Riga\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":21,"name":"Vaduz\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":22,"name":"Vilnius\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":23,"name":"Luxembourg\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":24,"name":"Valletta\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":25,"name":"Chisinau\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":26,"name":"Monaco\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":27,"name":"Podgorica\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":28,"name":"Amsterdam Haag\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":29,"name":"Skopje\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":30,"name":"Oslo\r\n","created_at":"2021-10-04T08:34:39.000000Z","updated_at":"2021-10-04T08:34:39.000000Z"},{"id":31,"name":"Warsaw\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":32,"name":"Lisbon\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":33,"name":"Bucharest\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":34,"name":"Moscow\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":35,"name":"San Marino\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":36,"name":"Belgrade\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":37,"name":"Bratislava\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":38,"name":"Ljubljana\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":39,"name":"Madrid\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":40,"name":"Stockholm\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":41,"name":"Bern\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":42,"name":"Kiev\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"},{"id":43,"name":"London\r\n","created_at":"2021-10-04T08:34:40.000000Z","updated_at":"2021-10-04T08:34:40.000000Z"}],
            selectedCity: null
        }
    },
    props: [
        'test'
    ],
    
    mounted(){
        let th = this;
        axios.get("http://127.0.0.1:8000/api/cities")
        .then(
            res => {
                th.testCities = res.data;
                console.log(th.testCities)
            }).catch(
            err => {
                console.log(err)
            }
        )
    },
    methods : {
        greet() {
            alert(12)
        }
    },
}
</script>

<style>

</style>