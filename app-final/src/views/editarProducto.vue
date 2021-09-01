<template>
  <div class="home">    
    <editarProducto/>
  </div>
</template>

<script>
// @ is an alias to /src
import editarProducto from '@/components/editarProducto.vue'

export default {
  name: 'Home',
  components: {
    editarProducto
  }
}
</script>