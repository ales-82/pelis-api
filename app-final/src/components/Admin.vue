<template>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 p-3">
				<br>
				<router-link to="/crear_producto" type="button" id="btn-nuevo" class="btn btn-success">Nuevo producto</router-link> |
				<a class="btn btn-danger" @click="cerrarSesion()">Cerrar sesion</a> 
			</div>			
		</div> 
		<br>
		<div class="row" v-if="exist">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table striped table-bordered table-condensed bg-light">
						<thead>
							<tr>							
							<th>Nombre</th>
							<th>Año</th>
							<th>Genero</th>
							<th>precio</th>
							<th>url-imagen</th>
							<th colspan="2">Acción</th>
						</tr>
						</thead>
						<tbody>
							<tr v-for="peli in peliculas" v-bind:key="peli.id">
								<td>{{peli.nombre}}</td>
								<td>{{peli.year}}</td>
								<td>{{peli.genero}}</td>
								<td>{{peli.precio}}</td>
								<td><img :src="'http://localhost/api-service/image/'+peli.imagen" alt="" width="15%"></td>
								<td>
									<router-link :to="{name:'editarProducto',params:{id:peli.id}}" class="btn btn-warning btn-sm ">Editar</router-link>
								</td>	
								<td>
									<button @click.prevent="deleteMovie(peli.id)" class="btn btn-danger btn-sm">Eliminar</button>
								</td>
							</tr>
						</tbody>					
					</table>
				</div>
			</div>
		</div>
		<h1 v-else class="bg-danger h2 text-center text-white w-custom m-auto">
				No hay existencias
		</h1>					
	</div>
</template>
<style>
	.w-custom{
		width: 500px !important;		
	}	
</style>
<script>
	export default{
		mounted(){
			this.permisoSesion();
			this.getMovies();
		},
		data(){
			return{
				peliculas:{},
				exist:false
			}
		},
		methods:{
			permisoSesion(){			

				let login = JSON.parse(sessionStorage.getItem('login'));

				if(login==null){
					location.href="/login";
				}else{
					let tipo=login[0].tipo;		

				//tipo 2 es el usuario, no autorizado
					if(tipo==2){
						location.href="/login";
					}
				}				
			},
			cerrarSesion(){
				let loginUser=sessionStorage.removeItem('login');
				if(loginUser==null){
					location.href="/login";
				}
			},
			getMovies(){
				fetch('http://localhost/api-service/')
				.then((res)=>{
					return res.json();					
				})
				.then((json)=>{
					this.peliculas=json;
					if(this.peliculas.length==0){
						this.exist=false;
					}else{
						this.exist=true;	
					}					
				});
			},
			deleteMovie(id){
				fetch('http://localhost/api-service/?id='+id,{
					method:'delete'
				}).then(()=>{
					alert('producto eliminado');
					this.getMovies();
				}).catch((error)=>{
					console.log(error);
				});
			}			
		}
	}
</script>