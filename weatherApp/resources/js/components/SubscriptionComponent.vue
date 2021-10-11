<template>
    <div class="col-md-6">
        <div class="col-md-4">
            <select name="ddlCities" id="ddlCities" class="form-control" v-model="selectedCityId" > 
                <option v-for="city in testCities" v-bind:key="city.id" v-bind:value="city.id">
                    {{ city.name }}
                </option>
            </select>
            <button id="btnSubscribe" class="btn btn-primary"  v-on:click="subscribe"  >Subscribe</button>
            <div v-if="errors" class="alert alert-danger mt-3" role="alert">
                <ul>
                    <li v-for="err in errors" v-bind:key="err">{{err}}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name : "Subscription",
    data: function()  {
        return {
            testCities:[],
            selectedCityId: null,
            userId: document.getElementById("userId").value,
            errors : null
        }
    },
    props: [
        
    ],
    mounted(){
        this.loadCities();
    },
    methods : {
        subscribe : function(){
            axios.post("http://127.0.0.1:8000/api/subscribtion",{
                userId : this.userId,
                cityId : this.selectedCityId
            })
            .then(
                res => {
                    console.log("success");
                    console.log(res.data.data)
                    this.$emit("subscribe")
                }
            )
            .catch(
                err => {
                    console.log(err.response.data.errors)
                    this.errors = err.response.data.errors
                }
            );
        },
        loadCities: function(){
            axios.get("http://127.0.0.1:8000/api/cities")
            .then(
                res => {
                    this.testCities = res.data;
            }).catch(
                err => {
                    console.log(err)
                }
            )
        }
    },
    emits: ['subscribe'],
}
</script>

<style>

</style>