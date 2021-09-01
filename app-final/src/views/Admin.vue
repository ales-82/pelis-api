<template>
  <div class="home">    
    <Admin/>
  </div>
</template>
<style>
  .home{
    height: 100vh;
  }
</style>

<script>
// @ is an alias to /src
import Admin from '@/components/Admin.vue'

export default {
  name: 'Home',
  components: {
    Admin
  }
}
</script>