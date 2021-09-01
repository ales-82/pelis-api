<template>
	<div class="container">
		<h2 class="text-center text-light p-3">Nuevo Producto</h2>
		<form>
			<div class="row d-flex justify-content-center bg-light p-5 mt-3 border border-secondary rounded shadow font-weight-bold">
				<div class="col-md-6">
					<label for="" class="negrita">Nombre</label>
					<input type="text" name="nombre" id="nombre" class="form-control" v-model="nombre">
					<div class="text-danger" v-if="name">Campo requerido</div>
				</div>				
				<div class="col-md-6">
					<label for="" class="negrita">Genero</label>
					<input type="text" name="genero" id="genero" class="form-control" v-model="genero">
					<div class="text-danger" v-if="gender">Campo requerido</div>
				</div>
				<div class="col-md-6">
					<label for="" class="negrita">Precio</label>
					<input type="text" name="precio" id="precio" class="form-control" v-model="precio">
					<div class="text-danger" v-if="price">Campo requerido</div>
				</div>
				<div class="col-md-6">
					<label for="" class="negrita">Año</label>
					<input type="text" name="agno" id="agno" class="form-control w-50 mx-auto" v-model="agno">
					<div class="text-danger" v-if="year">Campo requerido</div>
				</div>						
				<div class="col-md-6 mt-4">
					<label for="" class="negrita">Agregue una imagen</label>
					<input type="file" name="foto" id="foto" class="form-control">
					<div class="text-danger" v-if="image">Campo requerido</div>
				</div>				
				<div class="col-md-12 mt-3">
					<input type="submit" name="button" class="btn btn-primary" @click.prevent="crearProducto()" value="enviar">
				</div>
				<div class="col-md-12 mt-3" id="notif" v-if="created">
					<span class='help-block text-center'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Nuevo Producto almacenado</strong></span>
				</div>
			</div>
		</form>
	</div>
</template>
<script>
	export default{
		mounted(){
			this.permisoSesion();
		},
		data(){
			return{
				nombre:null,
				genero:null,
				agno:null,
				precio:null,

				name:false,
				year:false,
				gender:false,
				image:false,
				price:false,
				created:false,
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
						location.href="/";
					}
				}				
			},
			crearProducto(){
				let img = document.getElementById('foto').value;

				if(this.nombre && this.agno && this.genero && this.precio && img !=''){
					let formdata = new FormData();

					formdata.append("nombre", document.getElementById("nombre").value);
					formdata.append("agno", document.getElementById("agno").value);
					formdata.append("genero", document.getElementById("genero").value);
					formdata.append("precio", document.getElementById("precio").value);
					formdata.append("imagen", document.getElementById("foto").files[0]);

					fetch('http://localhost/api-service/',{
						method:'POST',
						body:formdata
					})
					.then((res)=>{
						console.log(res);
					}).then(()=>{
						this.nombre='';
						this.agno='';
						this.genero='';
						this.precio='';
						let img=document.getElementById('foto');
						img.value='';

						this.name=false;
						this.year=false;
						this.gender=false;
						this.price=false;

						this.created=true;
						
						/*let notif=document.getElementById('notif');

						notif.innerHTML="<span class='help-block text-center'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Nuevo Producto almacenado</strong></span>";*/
					})
					.catch((error)=>{
						console.log(error);
					})
				}else{
					!this.nombre ? this.name=true : this.name=false;
					!this.agno ? this.year=true : this.year=false;
					!this.genero ? this.gender=true : this.gender=false;
					!this.precio ? this.price=true : this.price=false;
					img=='' ? this.image=true : this.image=false;

				}
			}
		}
	}
</script>