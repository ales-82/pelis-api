<template>
  <div class="home">    
    <Carrito/>
  </div>
</template>

<script>
// @ is an alias to /src
import Carrito from '@/components/Carrito.vue'

export default {
  name: 'Home',
  components: {
    Carrito
  }
}
</script>