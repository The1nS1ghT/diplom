<template>
   <div v-for="tour in  tours ">
      <p>{{ tour.id_tour }}</p>
      <p>{{ tour.id_hotel }}</p>
   </div>
</template>

<script>
import axios from 'axios';

export default {
   data: () => ({
      tours: [
         {
            id_tour: '',
            id_hotel: ''
         }
      ]
   }),
   methods: {
      LoadTour() {
         axios.get('/tours')
            .then((res) => {
               console.log(res)
            })

      }
   }
}


</script>