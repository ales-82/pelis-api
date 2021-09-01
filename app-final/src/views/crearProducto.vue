<template>
  <div class="home">    
    <crearProducto/>
  </div>
</template>

<script>
// @ is an alias to /src
import crearProducto from '@/components/crearProducto.vue'

export default {
  name: 'Home',
  components: {
    crearProducto
  }
}
</script>