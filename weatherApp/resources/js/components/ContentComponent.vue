<template>
  <div>
    <div class="row mt-5">
      <subscription-component @subscribe="loadUserCities"></subscription-component>
      <cities-component v-bind:cities=userCities @unsubscribe="loadUserCities"></cities-component>
    </div>
    <div class="row mt-5">
      <search-weather-component></search-weather-component>
    </div>
  </div>
</template>

<script>
import SubscribtionComponent from "./SubscriptionComponent.vue";
import CitiesComponent from "./CitiesComponent.vue";
export default {  
  data() {
    return {
      userCities : [],
      userId : document.getElementById("userId").value
    }
  },
  mounted() {
    this.loadUserCities();
  },
  methods: {
    loadUserCities: function(){
      axios.get("http://127.0.0.1:8000/api/user-cities",{
        params: {
          userId : this.userId
        }
      })
      .then(
        res => {
          this.userCities = res.data;
        }
      )
      .catch(
        err => {
          console.log(err.response.data.errors)
        }
      )
    }
  },
  components: {
    SubscribtionComponent,
    CitiesComponent
  },


}
</script>

<style>

</style>