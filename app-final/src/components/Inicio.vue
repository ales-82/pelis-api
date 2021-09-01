<template>
	<div id="producto" class="container">				
		<div class="row mt-2 mb-2">
			<div class="col-md">
				<router-link to="/carrito" class="btn btn-primary">
					<i class="fab fa-shopping-cart"><i class="badge badge-light">Ver Carrito {{cantidad}}</i></i>
				</router-link>
			</div>
		</div>
		<div id="notif"></div>
		<div class="row text-light">
			<div class="col-12 col-md-4 col-sm-6" v-for="peli in peliculas" v-bind:key="peli.id">
				<div class="card card-body mb-2 mr-2 rounded fondo">
					<h4>{{peli.nombre}}  </h4>
					<p>{{peli.genero}}</p>
					<img :src="'http://localhost/api-service/image/'+peli.imagen" alt="imagen" class="img-responsive">
					<div class="row">
						<div class="col-sm-6">año : {{peli.year}}</div>
						<div class="col-sm-6">$ {{peli.precio}}</div>
					</div>
					<div class="text-right mt-3">
						<button @click.prevent="addCarrito(peli)" class="btn btn-primary btn-sm">Agregar Carrito</button>						
					</div>
				</div>							
			</div>							
		</div>		
	</div>	
</template>
<script>
	export default{
		mounted(){
			this.getMovies();			
		},
		data(){
			return{
				peliculas:{},
				carrito:[],
				addCart:{
					id:'',
					nombre:'',
					year:'',
					precio:'',
					genero:'',
					imagen:''
				},
				cantidad:''
			}
		},
		created(){
			this.verCarrito();		
		},
		methods:{
			getMovies(){
				fetch('http://localhost/api-service/')
				.then((res)=>{
					return res.json();
				})
				.then((json)=>{
					this.peliculas=json;
				})
			},			
			cerrarSesion(){
				let loginUser=sessionStorage.removeItem('login');
				if(loginUser==null){
					location.href="/login";
				}
			},
			addCarrito(peli){
				this.addCart.id=peli.id;
				this.addCart.nombre=peli.nombre;
				this.addCart.year=peli.year;
				this.addCart.precio=peli.precio;
				this.addCart.genero=peli.genero;
				this.addCart.imagen=peli.imagen;

				this.carrito.push(this.addCart);

				//console.log(this.carrito);
				this.agregarCompra();
			},
			agregarCompra(){
				let carts = JSON.stringify(this.carrito);
				localStorage.setItem('cart',carts);
				this.verCarrito();
			},
			verCarrito(){
				if(localStorage.getItem('cart')){
					this.carrito=JSON.parse(localStorage.getItem('cart'));
					this.cantidad=this.carrito.length;
				}
			}
		}
	}
</script>
<style>
	.fondo{
		background: #283747;
	}	
</style>