<template>
	<div class="login">
		<h1 class="title text-light">Login</h1>		
		<form class="form">
			<label for="" class="form-label">Usuario:</label>
			<input type="text" id="user" name="user" class="form-input">
			<label for="" class="form-label">Password:</label>
			<input type="password" id="pass" name="pass" class="form-input">
			<button type="submit" class="form-submit" @click.prevent="login()">Enviar</button>
		</form>		
		<div>
			<p :class="['text-white', 'text-center', 'btn', color]" v-if="admin">Acceso Administrador</p>
			<p :class="['text-white', 'text-center', 'btn', color]" v-if="use">Acceso Usuario</p>
			<p :class="['text-dark', 'text-center', 'btn', color]" v-if="cre">credenciales Incorrectos</p>
			<p :class="['text-white', 'text-center', 'btn', color]" v-if="vacio">Campos Vacios</p>
		</div>				
	</div>	
</template>
<script>

	export default{
		name:'Login',
		mounted(){
			this.accesoLogin();
		},
		data(){
			return{
				usuario:{},
				user:'',
				pass:'',
				acceso:'',

				admin:false,
				use:false,
				cre:false,
				vacio:false,
				color:''

			}
		},
		methods:{
			login(){								
					let usuario = document.getElementById('user');
					let password = document.getElementById('pass');

					let datos = new FormData();

					datos.append("usuario", usuario.value);
					datos.append("password", password.value);

				if(usuario.value!='' && password.value!=''){
					
					fetch('http://localhost/api-service/usuario.php',{
						method:'POST',
						body:datos
					})
					.then((res)=>{
						return res.json();										
					}).then((json)=>{					
						if(json!=0){
							this.usuario=json;
							let loginUser = JSON.stringify(this.usuario);
							sessionStorage.setItem('login',loginUser);						
							if(this.usuario[0].tipo==1){
								this.vacio=false;
								this.admin=true;
								this.use=false;
								this.cre=false;
								this.color="btn-success";
								location.href="/admin";
							}else{
								this.vacio=false;
								this.admin=false;
								this.use=true;
								this.cre=false;
								this.color="btn-success";
								location.href="/";								
							}												
						}else{
							//alert("credenciales incorrectos");							
								this.vacio=false;
								this.admin=false;
								this.use=false;
								this.cre=true;
								this.color="btn-warning";
						}					
					})
					.catch((error)=>{
						console.log(error);
					});	
				}else{					
						this.vacio=true;
						this.admin=false;
						this.use=false;
						this.cre=false;
						this.color="btn-danger";
				}				
			},
			//restringir sitio si esta logueado segun el usuario
			accesoLogin(){
				this.acceso = JSON.parse(sessionStorage.getItem('login'));
				console.log(this.acceso);
				if(this.acceso!=null){
					if(this.acceso[0].tipo==1){
						location.href="/admin";	
					}else{
						if(this.acceso[0].tipo==2){
							location.href="/";	
						}
					}					
				}
			}
		}
	}
</script>
<style>
.login {
  padding: 2rem;
}
.title {
  text-align: center;
}
.form {
  margin: 3rem auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 20%;
  min-width: 350px;
  max-width: 100%;
  background: rgba(19, 35, 47, 0.9);
  border-radius: 5px;
  padding: 40px;
  box-shadow: 0 4px 10px 4px rgba(0, 0, 0, 0.3);
}
.form-label {
  margin-top: 2rem;
  color: white;
  margin-bottom: 0.5rem;
  &:first-of-type {
    margin-top: 0rem;
  }
}
.form-input {
  padding: 10px 15px;
  background: none;
  background-image: none;
  border: 1px solid white;
  color: white;
  &:focus {
    outline: 0;
    border-color: #1ab188;
  }
}
.form-submit {
  background: #1ab188;
  border: none;
  color: white;
  margin-top: 3rem;
  padding: 1rem 0;
  cursor: pointer;
  transition: background 0.2s;
  &:hover {
    background: #0b9185;
  }
}

/*Animaciones*/

</style>