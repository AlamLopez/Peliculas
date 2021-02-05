<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">HOME</li>
                <li class="breadcrumb-item"><a href="#">ADMIN</a></li>
                <li class="breadcrumb-item active">DASHBOARD</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> USUARIOS
                        <template v-if="logueado.idrol == 1">
                            <button type="button" @click="abrirModal('usuario', 'registrar')" class="btn btn-secondary">
                                <i class="icon-plus"></i>&nbsp;NUEVO
                            </button>
                        </template>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombrecompleto">NOMBRE</option>
                                      <option value="usuario">USUARIO</option>
                                      <option value="email">EMAIL</option>
                                      <option value="nombre">ROL</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarUsuario(1, buscar, criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                    <button type="submit" @click="listarUsuario(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">OPCIONES</th>
                                    <th style="text-align: center;">NOMBRE</th>
                                    <th style="text-align: center;">USUARIO</th>
                                    <th style="text-align: center;">EMAIL</th>
                                    <th style="text-align: center;">ROL</th>
                                    <th style="text-align: center;">ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="usuario in arrayUsuario" :key="usuario.id">
                                    <template v-if="logueado.idrol == 1">
                                        <template v-if="usuario.id != logueado.id">
                                            <td style="text-align: center;">                                        
                                                <template v-if="usuario.condicion">
                                                    <button type="button" @click="abrirModal('usuario', 'actualizar', usuario)" class="btn btn-warning btn-sm" title="EDITAR USUARIO">
                                                        <i class="icon-pencil"></i>
                                                    </button> &nbsp;
                                                    <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(usuario.id)" title="DESACTIVAR USUARIO">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </template>
                                                <template v-else>
                                                    <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(usuario.id)" title="ACTIVAR USUARIO">
                                                        <i class="icon-check"></i>
                                                    </button>
                                                </template>
                                            </td>
                                        </template>
                                        <template v-else>
                                            <td style="text-align: center;">                                        
                                                    <button type="button" @click="abrirModal('usuario', 'actualizar', usuario)" class="btn btn-warning btn-sm" title="EDITAR USUARIO">
                                                        <i class="icon-pencil"></i>
                                                    </button> &nbsp;
                                                    
                                            </td>
                                        </template>
                                    </template>
                                    <template v-else>
                                        <td style="text-align: center;"></td>
                                    </template>
                                    <td style="text-align: center;" v-text="usuario.nombrecompleto"></td>
                                    <td style="text-align: center;" v-text="usuario.usuario"></td>
                                    <td style="text-align: center;" v-text="usuario.email"></td>
                                    <td style="text-align: center;" v-text="usuario.rol"></td>
                                    <td style="text-align: center;">
                                        <div v-if="usuario.condicion">
                                            <span class="badge badge-success">ACTIVO</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">DESACTIVADO</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" @click="cerrarModal()" class="close" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">NOMBRE Y APELLIDO (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombrecompleto" class="form-control" placeholder="NOMBRE Y APELLIDO">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">USUARIO (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="usuario" @blur="validarNombre(usuario, user_id)" class="form-control" placeholder="NOMBRE DE USUARIO">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">EMAIL (*)</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="EMAIL DEL USUARIO">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">PASSWORD (*)</label>
                                    <div class="col-md-9">
                                        <input type="password" v-model="password" class="form-control" placeholder="PASSWORD DE ACCESO">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">ROL (*)</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idrol">
                                            <option value="0">SELECCIONE UN ROL</option>
                                            <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div v-show="errorUsuario" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjUsuario" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">CERRAR</button>
                            <button type="button" v-if="tipoAccion==1" @click="registrarUsuario()" class="btn btn-primary">GUARDAR</button>
                            <button type="button" v-if="tipoAccion==2" @click="actualizarUsuario()" class="btn btn-primary">ACTUALIZAR</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {

        data (){

            return {
                user_id: 0,
                nombrecompleto: 0,
                usuario : '',
                email : '',
                password : '',
                idrol: 0,
                arrayUsuario : [],
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion: 0,
                errorUsuario : 0,
                errorMostrarMsjUsuario : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'usuario',
                buscar : '',
                logueado : 0
            }

        },

        computed : {

            isActived : function(){
                return this.pagination.current_page;
            },

            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }

        },

        methods : {

            listarUsuario(page, buscar, criterio){
                let me = this;
                var url = '/usuarios?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUsuario = respuesta.usuarios.data;
                    me.logueado = respuesta.logueado;
                    me.pagination = respuesta.pagination;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            selectRol(){
                let me = this;
                var url = '/roles/selectRol';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRol = respuesta.roles;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })
            },

            cambiarPagina(page, buscar, criterio){
                
                let me = this;
                me.pagination.current_page = page;
                me.listarUsuario(page, buscar, criterio);
            },

            registrarUsuario(){
                if(this.validarUsuario()){
                    return;
                    
                }
                let me = this;
                axios.post('/usuarios/registrar', {
                    'usuario': this.usuario,
                    'nombrecompleto': this.nombrecompleto,
                    'email' : this.email,
                    'password': this.password,
                    'idrol': this.idrol
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuario(1, '', 'usuario');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'USUARIO ACTUALIZADO',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            actualizarUsuario(){

                if(this.validarUsuario()){
                    return;
                    
                }

                let me = this;

                axios.put('/usuarios/actualizar', {
                    'id': this.user_id,
                    'nombrecompleto': this.nombrecompleto,
                    'usuario': this.usuario,
                    'email' : this.email,
                    'password': this.password,
                    'idrol': this.idrol
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuario(1, '', 'usuario');
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'USUARIO ACTUALIZADO',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(function (error) {
                    console.log(error);
                });
            },

            desactivarUsuario(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                    
                        title: 'ESTÁ SEGURO DE DESACTIVAR A ESTE USUARIO?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'SÍ, DESACTÍVALO!',
                        cancelButtonText: 'NO, CANCELAR!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            let me = this;
                            axios.put('/usuarios/desactivar', {
                                'id': id
                            }).then(function (response) {
                                me.listarUsuario(1, '', 'usuario');
                                swalWithBootstrapButtons.fire(
                                    'DESACTIVADO!',
                                    'EL USUARIO HA SIDO DESACTIVADO.',
                                    'success'
                                )
                            }).catch(function (error) {
                                console.log(error);
                            });
                            
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            
                        }
                });
            },

            activarUsuario(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                    
                        title: 'ESTÁ SEGURO DE ACTIVAR A ESTE USUARIO?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'SÍ, ACTÍVALO!',
                        cancelButtonText: 'NO, CANCELAR!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            let me = this;
                            axios.put('/usuarios/activar', {
                                'id': id
                            }).then(function (response) {
                                me.listarUsuario(1, '', 'usuario');
                                swalWithBootstrapButtons.fire(
                                    'ACTIVADO!',
                                    'EL USUARIO HA SIDO ACTIVADO.',
                                    'success'
                                )
                            }).catch(function (error) {
                                console.log(error);
                            });
                            
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            
                        }
                });
            },

            validarUsuario(){
                
                this.errorUsuario = 0;
                this.errorMostrarMsjUsuario = [];
                if(!this.usuario) this.errorMostrarMsjUsuario.push("EL NOMBRE DE USUARIO NO PUEDE IR VACÍO.");  
                if(!this.nombrecompleto) this.errorMostrarMsjUsuario.push("EL NOMBRE Y APELLIDO NO PUEDE IR VACÍO.")
                if(!this.email) this.errorMostrarMsjUsuario.push("EL EMAIL DE USUARIO NO PUEDE IR VACÍO.");
                if(!this.password && !this.tipoAccion == 1) this.errorMostrarMsjUsuario.push("LA CONTRASEÑA NO PUEDE IR VACÍA.");
                if(!this.idrol) this.errorMostrarMsjUsuario.push("DEBE SELECCIONAR UN ROL PARA EL USUARIO."); 
                if(this.errorMostrarMsjUsuario.length) this.errorUsuario = 1;
                return this.errorUsuario;
            },

            validarNombre(usuario, user_id){
                
                let me = this;
                me.errorUsuario = 0;
                me.errorMostrarMsjUsuario = [];
                console.log(user_id);
                if(user_id == 0){
                    var url = '/usuarios/unico/' + usuario;
                    axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        if(respuesta=="no") me.errorMostrarMsjUsuario.push("EL NOMBRE DE USUARIO " + usuario + " YA EXISTE.");
                        if(me.errorMostrarMsjUsuario.length){
                            
                            me.usuario = '';
                            me.errorUsuario = 1;
                            
                        } 
                        return me.errorUsuario;
                    }).catch(function (error) {
                        console.log(error);
                    });
                }else{
                    var url = '/usuarios/unico/' + usuario + '/' + user_id;
                    axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        if(respuesta=="no") me.errorMostrarMsjUsuario.push("EL NOMBRE DE USUARIO " + usuario + " YA EXISTE.");
                        if(me.errorMostrarMsjUsuario.length){
                            
                            me.usuario = '';
                            me.errorUsuario = 1;
                            
                        } 
                        return me.errorUsuario;
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },

            validarEmail(email, user_id){
                
                let me = this;
                me.errorUsuario = 0;
                me.errorMostrarMsjUsuario = [];
                if(user_id == 0){
                    var url = '/usuarios/unicoEmail/' + email;
                    axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        if(respuesta=="no") me.errorMostrarMsjUsuario.push("EL EMAIL " + email + " YA HA SIDO REGISTRADO.");
                        if(me.errorMostrarMsjUsuario.length){
                            
                            me.email = '';
                            me.errorUsuario = 1;
                            
                        } 
                        return me.errorUsuario;
                    }).catch(function (error) {
                        console.log(error);
                    });
                }else{
                    var url = '/usuarios/unicoEmail/' + email + '/' + user_id;
                    axios.get(url).then(function (response) {
                        var respuesta = response.data;
                        if(respuesta=="no") me.errorMostrarMsjUsuario.push("EL EMAIL " + email + " YA HA SIDO REGISTRADO.");
                        if(me.errorMostrarMsjUsuario.length){
                            
                            me.email = '';
                            me.errorUsuario = 1;
                            
                        } 
                        return me.errorUsuario;
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },

            abrirModal(modelo, accion, data = []){
                this.selectRol();
                switch (modelo) {
                    case 'usuario':
                        {
                            switch (accion) {
                                
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'REGISTRAR USUARIO'
                                        this.usuario = '';
                                        this.nombrecompleto = '';
                                        this.password = '';
                                        this.email = '';
                                        this.tipoAccion = 1;
                                        this.idrol = 0;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                         this.modal = 1;
                                         this.tituloModal = 'ACTUALIZAR USUARIO';
                                         this.tipoAccion = 2;
                                         this.idrol = data['idrol'];
                                         this.nombrecompleto = data['nombrecompleto'];
                                         this.user_id = data['id'];
                                         this.usuario = data['usuario'];
                                         this.email = data['email'];
                                         this.password = data['password'];
                                         break;
                                    }
                            
                            }
                        }
                        
                }
            },

            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.usuario = '';
                this.nombrecompleto = '';
                this.password = '';
                this.errorUsuario = 0;
                this.errorMostrarMsjUsuario = [];
            }

        },

        mounted() {
            this.listarUsuario(1, this.buscar, this.criterio);
        }
    }
</script>

<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>