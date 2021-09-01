<template>  
  <div class="container">    
    <div class="row">      
      <h1 class="mx-auto text-white py-3">Carrito</h1>
      <br>         
    </div>
    <div class="row" v-if="exist">
      <div class="col-lg-12">
        <div class="table resposive">
          <table class="table striped table-bordered bg-white">
            <thead>
              <tr>
                <td>Imagen</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>Eliminar</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cart in carts" :key="cart.id">
                <td class="w-25"><img :src="'http://localhost/api-service/image/'+cart.imagen" alt="" width="15%"></td>
                <td>{{ cart.nombre }}</td>
                <td>{{ cart.precio }}</td>
                <td><button @click="deleteCart(cart)" class="btn btn-outline-danger">x</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-12 text-dark">
        <h2 class="mx-auto w-50 bg-white rounded p-3">Total Rp. {{ total.toFixed(2) }} &nbsp;</h2>
      </div>      
    </div>
    <h1 v-else class="bg-danger h1 text-center text-white">
        No hay peliculas en el carrito
    </h1>  
    <div class="row">
      <div class="col-12">
        <button @click="payCarrito()" class="btn btn-primary mx-auto" v-if="pay">Pagar</button>
      </div>                       
    </div>
  </div>
</template>
<script>
  export default{
    mounted(){
      this.showCarrito();
      this.payBtn();
    },
    data(){
      return{
        total:0,
        cant:'1',
        exist:false,
        carts:{},
        pay:true      
      }
    },     
    methods:{
      //muestra el carrito
      showCarrito(){
        if(localStorage.getItem('cart')){
          this.carts=JSON.parse(localStorage.getItem('cart'));

          this.total=this.carts.reduce((total, item)=>{
            return total + this.cant * item.precio;
          }, 0);          
          if(this.total==0){
            this.exist=false;            
          }else{
            this.exist=true;            
          }          
        }else{          
          this.pay=false;
          
        }
      },
      //eliminar cada item del carrito, es decir cada pelicula
      deleteCart(pro){
        this.carts.splice(pro, 1);

        let add = JSON.stringify(this.carts);
        localStorage.setItem('cart',add);
        let nullCart=localStorage.getItem('cart').length;        
        if(nullCart==2){
           localStorage.removeItem('cart');
           this.exist=false;
        }
        this.showCarrito();
      },
      //boton para abonar la o las peliculas
      payCarrito(){
        if(sessionStorage.getItem('login')){
          let usuario = JSON.parse(sessionStorage.getItem('login'));
          let user=usuario[0].tipo;
          if(user==2){
            alert("abonaste");
            this.removeCart();                        
          }
        }else{
          alert('inicia sesion porfavor');
          this.$router.push('/login');
        }
      },
      //funcion para deshabilitar el boton de pagon, si no hay nada en el carrito
      payBtn(){        
        if(sessionStorage.getItem('login')){
          let admin=JSON.parse(sessionStorage.getItem('login'));
          let auth = admin[0].tipo;
          if(auth==1){                        
            this.pay=false;
          }
        }
      },
      //remover todo el carrito, si ya abono!
      removeCart(){
        if(localStorage.getItem('cart')){          
          localStorage.removeItem('cart');
          this.exist=false;  
          this.pay=false;          
        }
      }
    }
  }  
</script>