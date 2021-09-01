<template>
  <div id="app">    
    <!--<div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/login">Login</router-link> | 
    </div>-->
    <!--<div id="nab">            
      <router-link to="/admin">Admin</router-link> |
      <router-link to="/crear_producto">Crear Producto</router-link>|
      <router-link to="/editar_producto">Editar Producto</router-link>
    </div> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <router-link class="navbar-brand" to="/">My Pelis</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto text-light">
            <li class="nav-item active">
              <!--<a class="nav-link" href="#">Home</a>-->
              <router-link class="nav-link" to="/">Home</router-link>
            </li>
            <li class="nav-item">
              <!--<a class="nav-link" href="#">Link</a>-->
              <router-link class="nav-link" to="/login">Login</router-link>
            </li>                        
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active" id="admin">
              <a class="btn btn-primary mx-3 my-3" v-if="admin" href="/admin">Admin</a>              
            </li>
            <li v-if="close">
              <button @click.prevent="cerrarSesion()" class="btn btn-danger">Cerrar Sesion</button> 
            </li>
          </ul>          
        </div>
      </div>
    </nav>  
    <transition name="slide-fade"> 
      <router-view/>
    </transition>    
  </div>
</template>
<script>
  export default{
    mounted(){
      this.authUser();
      //this.botonCerrar();
    }, 
    data(){
      return{
        close:false,
        admin:false
      }
    },   
    methods:{
      authUser(){
        let usernav = document.getElementById('admin');

        let login = JSON.parse(sessionStorage.getItem('login'));


        if(login==null){
          console.log(login);
        }else{
          let tipo=login[0].tipo;
          let nombre=login[0].nombre;
          //usuario 1 autorizado para administrar la página
          if(tipo==1) {            
            this.admin=true;
          }else{
            if(tipo==2){
              usernav.innerHTML='<h1 class="text-light mx-3"> Bienvenido '+ nombre +'</h1>';
              this.close=true;

            }            
          }
        }
      },
      botonCerrar(){
        let close = document.getElementById('cerrar');

        let login = JSON.parse(sessionStorage.getItem('login'));

        if(login!=null){
          let tipo=login[0].tipo;
          if(tipo==2){            
            close.style.display="contents";            
          }
        }
      },
      cerrarSesion(){
        let loginUser=sessionStorage.removeItem('login');
        if(loginUser==null){
          location.href="/login";
        }
      }      
    }
  }
</script>

<style>
body{
    background: #222 !important; 
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  background: #222;    
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  /*color: #2c3e50;*/
  color: #fff;
}

#nav a.router-link-exact-active {
  color: #42b983;
}

/*estilos boton cerrar sesion para usuario*/
.close{
    display: none;    
}
.btn{
  font-size:1.5rem !important;
}

/*estilos transitions*/

.slide-fade-enter-active {
  transition: opacity .8s ease;
}
.slide-fade-leave-active {
  transition: opacity .8s ease;
}
.slide-fade-enter, .slide-fade-leave-to
{  
  opacity: 0;
}

.slide-fade-enter-active {
  opacity: 0;  
}
.slide-fade-leave-active {
  opacity: 0;
  
}
.slide-fade-enter, .slide-fade-leave-to
{  
  transition: opacity .8s ease;
}
</style>
