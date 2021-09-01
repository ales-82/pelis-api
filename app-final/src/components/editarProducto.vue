<template>
	<div class="container">
		<h2 class="text-center text-light p-3">Editar Producto</h2>			
		<form>
			<div class="row d-flex justify-content-center bg-light p-5 mt-3 border border-secondary rounded shadow font-weight-bold">
				<input type="hidden" name="id" id="id" >
				<div class="col-md-6">					
					<label for="" class="negrita">Nombre</label>
					<input type="text" name="nombre"  id="nombre" class="form-control" v-model="product.nombre">
					<div class="text-danger" v-if="name">Campo requerido</div>
				</div>				
				<div class="col-md-6">
					<label for="" class="negrita">Genero</label>
					<input type="text" name="genero"  id="genero" class="form-control" v-model="product.genero">
					<div class="text-danger" v-if="gender">Campo requerido</div>
				</div>
				<div class="col-md-6">
					<label for="" class="negrita">Precio</label>
					<input type="text" name="precio"  id="precio" class="form-control" v-model="product.precio">
					<div class="text-danger" v-if="price">Campo requerido</div>
				</div>
				<div class="col-md-6">
					<label for="" class="negrita">Año</label>
					<input type="text"  name="agno"  id="agno" class="form-control mx-auto w-50" v-model="product.year">
					<div class="text-danger" v-if="year">Campo requerido</div>
				</div>							
				<div class="col-md-6">
					<label for="" class="negrita">Agregue una imagen</label>
					<input type="file" name="foto" id="foto" class="form-control">
					<div class="text-danger" v-if="image">Campo requerido</div>
				</div>
				<div class="col-md-12 mt-3">
					<input type="submit" name="button" class="btn btn-primary" @click.prevent="updateProducto(product.id)" value="enviar">
				</div>
				<div class="col-md-12 mt-3" v-if="update">
					<span class='help-block text-center'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Producto Actualizado</strong></span>
				</div>
			</div>
		</form>
	</div>
</template>
<script>
	export default{
		mounted(){
			this.permisoSesion();
			this.editarProducto();
		},
		data(){
			return{				
				producto:{
					nombre:'',
					year:'',
					genero:'',
					precio:'',
					imagen:''
				},
				product:[],
				//product:'',				
				name:false,
				year:false,
				gender:false,
				price:false,
				image:false,
				update:false
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
			editarProducto(){				
				this.id=this.$route.params.id;		

				fetch('http://localhost/api-service/?id='+this.id)
				.then((res)=>{
					return res.json();					
				})
				.then(r=>{					
					this.producto=r;										
					this.product=this.producto[0];					
					//console.log(this.product.nombre);					
				})
				.catch((error)=>{
					console.log(error);
				});				
			},
			updateProducto(id){
				let img = document.getElementById('foto').value;

				if(this.product.nombre && this.product.year && this.product.genero && this.product.precio && img !=''){
					console.log("entraste");
					let formdata = new FormData();

					formdata.append("nombre", document.getElementById("nombre").value);
					formdata.append("agno", document.getElementById("agno").value);
					formdata.append("genero", document.getElementById("genero").value);
					formdata.append("precio", document.getElementById("precio").value);
					formdata.append("imagen", document.getElementById("foto").files[0]);

					fetch('http://localhost/api-service/?id='+id,{
						method:'POST',
						body:formdata
					}).then((res)=>{
						console.log(res);
					}).then(()=>{
						this.name=false;
						this.year=false;
						this.gender=false;
						this.price=false;

						this.product.nombre='';
						this.product.year='';
						this.product.genero='';
						this.product.precio='';
						let img=document.getElementById('foto');
						img.value='';
						this.update="true";

						/*let notif=document.getElementById('notif');
						notif.innerHTML="<span class='help-block text-center'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Producto Actualizado</strong></span>";*/
					}).catch((error)=>{
						console.log(error);
					});
				}else{
					!this.product.nombre ? this.name=true : this.name=false;
					!this.product.year ? this.year=true : this.year=false;
					!this.product.genero ? this.gender=true : this.gender=false;
					!this.product.precio ? this.price=true : this.price=false;
					img=='' ? this.image=true : this.image=false;
				}
			}
		}
	}
</script>