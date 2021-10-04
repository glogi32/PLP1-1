<template>
    <div class="col-md-6">
        <div class="col-md-4">
            <select name="ddlCities" id="ddlCities" class="form-control">
                <option v-for="city in cities" v-bind:key="city.id" v-bind:value="city.id">
                    {{ city.name }}
                </option>
            </select>
            <button id="btnSubscribe" class="btn btn-primary">Subscribe</button>
        </div>
    </div>
</template>

<script>
export default {
    data()  {
        return {
            cities:[]
        }
    },
    props: [
        'test'
    ],
  
}
</script>

<style>

</style>