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
                        <i class="fa fa-align-justify"></i> PELICULA
                        <template v-if="logueado.idrol == 1">
                            <button type="button" @click="abrirModal('pelicula', 'registrar')" class="btn btn-secondary">
                                <i class="icon-plus"></i>&nbsp;NUEVO
                            </button>
                        </template>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="titulo">TITULO</option>
                                      <option value="director">DIRECTOR</option>
                                      <option value="anio_estreno">ANIO ESTRENO</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarPelicula(1, buscar, criterio, select_categoria, select_condicion)" class="form-control" placeholder="TEXTO A BUSCAR">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-daterange">
                                    <div class="input-group-addon bg-primary">CATEGORIA</div>
                                    <select class="form-control col-md-8" v-model="select_categoria" @change="listarPelicula(1, buscar, criterio, select_categoria, select_condicion)">
                                        <option value="">TODOS</option>
                                        <option v-for="nombreCategoria in arrayCategoria" :key="nombreCategoria.id" :value="nombreCategoria.id" v-text="nombreCategoria.nombre"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <template v-if="logueado.idrol == 1">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group input-daterange">
                                        <div class="input-group-addon bg-primary">CONDICION</div>
                                        <select class="form-control col-md-8" v-model="select_condicion" @change="listarPelicula(1, buscar, criterio, select_categoria, select_condicion)">
                                            <option value="">TODOS</option>
                                            <option value="1">DISPONIBILIDAD</option>
                                            <option value="0">INDISPONIBILIDAD</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">OPCIONES</th>
                                    <th style="text-align: center;">TITULO</th>
                                    <th style="text-align: center;">DIRECTOR</th>
                                    <th style="text-align: center;">DURACION</th>
                                    <th style="text-align: center;">ANIO ESTRENO</th>
                                    <th style="text-align: center;">CATEGORIA</th>
                                    <template v-if="logueado.idrol==1">
                                        <th style="text-align: center;">MULTA DIARIA</th>
                                    </template>
                                    <th style="text-align: center;">ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pelicula in arrayPelicula" :key="pelicula.id">
                                    <td style="text-align: center;">  
                                        <template v-if="logueado.idrol==1">
                                            <button type="button" @click="abrirModal('pelicula', 'actualizar', pelicula)" class="btn btn-warning btn-sm" title="EDITAR PELICULA">
                                                <i class="icon-pencil"></i>
                                            </button> &nbsp;
                                            <template v-if="pelicula.condicion">
                                                <button type="button" @click="desactivarPelicula(pelicula.id)" class="btn btn-danger btn-sm" title="DESACTIVAR PELICULA">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </template>
                                            <template v-else>
                                                <button type="button" @click="activarPelicula(pelicula.id)" class="btn btn-info btn-sm" title="ACTIVAR PELICULA">
                                                    <i class="icon-check"></i>
                                                </button>
                                            </template>
                                        </template>                                      
                                    </td>
                                    <td style="text-align: center;" v-text="pelicula.titulo"></td>
                                    <td style="text-align: center;" v-text="pelicula.director"></td>
                                    <td style="text-align: center;" v-text="pelicula.duracion"></td>
                                    <td style="text-align: center;" v-text="pelicula.anio_estreno"></td>
                                    <td style="text-align: center;" v-text="pelicula.categoria"></td>
                                    <template v-if="logueado.idrol==1">
                                        <td style="text-align: center;" v-text="pelicula.multa_diaria"></td>
                                    </template>
                                    <td style="text-align: center;">
                                        <div v-if="pelicula.condicion">
                                            <span class="badge badge-success">DISPONIBLE</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">NO DISPONIBLE</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio, select_categoria)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio, select_categoria)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio, select_categoria)">Sig</a>
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
                                    <label class="col-md-3 form-control-label" for="text-input">TITULO (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="titulo" class="form-control" placeholder="TITULO DE PELICULA">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">DIRECTOR (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="director" class="form-control" placeholder="DIRECTOR DE PELICULA">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">DURACION EN MINUTOS (*)</label>
                                    <div class="col-md-9">
                                        <input type="number" min="0" v-model="duracion" class="form-control" placeholder="DURACION DE PELICULA">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">ANIO DE ESTRENO (*)</label>
                                    <div class="col-md-9">
                                        <input type="number" min="0" v-model="anio_estreno" class="form-control" placeholder="ANIO DE ESTRENO DE PELICULA">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">MULTA DIARIA (*)</label>
                                    <div class="col-md-9">
                                        <input type="number" min="0" v-model="multa_diaria" class="form-control" placeholder="MULTA DIARIA DE PELICULA">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">CATEGORIA (*)</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="categoria_id">
                                            <option value="">SELECCIONE UNA CATEGORIA</option>
                                            <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div v-show="errorPelicula" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPelicula" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">CERRAR</button>
                            <button type="button" v-if="tipoAccion==1" @click="registrarPelicula()" class="btn btn-primary">GUARDAR</button>
                            <button type="button" v-if="tipoAccion==2" @click="actualizarPelicula()" class="btn btn-primary">ACTUALIZAR</button>
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
                pelicula_id: 0,
                titulo: 0,
                director : '',
                duracion : '',
                anio_estreno : '',
                categoria_id: 0,
                multa_diaria : '',
                arrayPelicula : [],
                arrayCategoria : [],
                modal : 0,
                tituloModal : '',
                tipoAccion: 0,
                errorPelicula : 0,
                errorMostrarMsjPelicula : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'titulo',
                buscar : '',
                logueado : 0,
                select_categoria : '',
                select_condicion : ''
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

            listarPelicula(page, buscar, criterio, select_categoria, select_condicion){

                let me = this;
                var url = '/peliculas?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio + '&select_categoria=' + select_categoria + '&select_condicion=' + select_condicion;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPelicula = respuesta.peliculas.data;
                    me.logueado = respuesta.logueado;
                    me.pagination = respuesta.pagination;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })

            },

            cambiarPagina(page, buscar, criterio, select_categoria, select_condicion){
                
                let me = this;
                me.pagination.current_page = page;
                me.listarPelicula(page, buscar, criterio, select_categoria, select_condicion);

            },

            desactivarPelicula(id){

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                
                    title: 'ESTÁ SEGURO DE DESACTIVAR A ESTA PELICULA?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'SÍ, DESACTÍVALA!',
                    cancelButtonText: 'NO, CANCELAR!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/peliculas/desactivar', {
                            'id': id
                        }).then(function (response) {
                            me.listarPelicula(1, me.buscar, me.criterio, me.select_categoria, me.select_condicion);
                            swalWithBootstrapButtons.fire(
                                'DESACTIVADO!',
                                'LA PELICULA HA SIDO DESACTIVADO.',
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

            activarPelicula(id){

                const swalWithBootstrapButtons = Swal.mixin({

                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },

                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                
                    title: 'ESTÁ SEGURO DE ACTIVAR A ESTA PELICULA?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'SÍ, ACTÍVALO!',
                    cancelButtonText: 'NO, CANCELAR!',
                    reverseButtons: true

                }).then((result) => {

                    if (result.value) {

                        let me = this;
                        axios.put('/peliculas/activar', {
                            'id': id
                        }).then(function (response) {
                           
                            me.listarPelicula(1, me.buscar, me.criterio, me.select_categoria, me.select_condicion);
                            swalWithBootstrapButtons.fire(
                                'ACTIVADO!',
                                'LA PELICULA HA SIDO ACTIVADO.',
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

            selectCategoria(){

                let me = this;
                var url = '/categorias/selectCategoria';
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias;
                    console.log(response);

                })
                .catch(function (error) {
                    
                    console.log(error);

                })

            },

            registrarPelicula(){

                if(this.validarPelicula()){

                    return;
                    
                }

                let me = this;

                axios.post('/peliculas/registrar', {
                    
                    'titulo': this.titulo,
                    'director': this.director,
                    'duracion': this.duracion,
                    'anio_estreno': this.anio_estreno,
                    'multa_diaria': this.multa_diaria,
                    'idcategoria': this.categoria_id
                    
                }).then(function (response) {
                    
                    me.cerrarModal();
                    me.listarPelicula(1, me.buscar, me.criterio, me.select_categoria, me.select_condicion);
                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'PELICULA INGRESADA',
                        showConfirmButton: false,
                        timer: 1500
                    });

                }).catch(function (error) {
                    console.log(error);
                });
            },

            actualizarPelicula(){

                if(this.validarPelicula()){

                    return;
                    
                }

                let me = this;

                axios.put('/peliculas/actualizar', {

                    'id': this.pelicula_id,
                    'titulo': this.titulo,
                    'director': this.director,
                    'duracion': this.duracion,
                    'anio_estreno': this.anio_estreno,
                    'multa_diaria': this.multa_diaria,
                    'idcategoria': this.categoria_id

                }).then(function (response) {

                    me.cerrarModal();
                    me.listarPelicula(1, me.buscar, me.criterio, me.select_categoria, me.select_condicion);

                    Swal.fire({   
                        position: 'top-end',
                        icon: 'success',
                        title: 'PELICULA ACTUALIZADO',
                        showConfirmButton: false,
                        timer: 1500
                    });

                }).catch(function (error) {

                    console.log(error);

                });
            },

            validarPelicula(){
                
                this.errorPelicula = 0;
                this.errorMostrarMsjPelicula = [];
                if(!this.titulo) this.errorMostrarMsjPelicula.push("EL TITULO DE LA PELICULA NO PUEDE IR VACÍO.");  
                if(!this.director) this.errorMostrarMsjPelicula.push("EL DIRECTOR DE LA PELICULA NO PUEDE IR VACÍO.")
                if(!this.duracion) this.errorMostrarMsjPelicula.push("LA DURACION DE LA PELICULA NO PUEDE IR VACÍO.");
                if(!this.anio_estreno) this.errorMostrarMsjPelicula.push("EL ANIO DE ESTRENO DE LA PELICULA NO PUEDE IR VACÍO.");
                if(!this.multa_diaria) this.errorMostrarMsjPelicula.push("LA MULTA DIARIA DE LA PELICULA NO PUEDE IR VACÍO.");
                if(!this.categoria_id) this.errorMostrarMsjPelicula.push("DEBE SELECCIONAR UNA CATEGORIA PARA LA PELICULA."); 
                if(this.errorMostrarMsjPelicula.length) this.errorPelicula = 1;
                return this.errorPelicula;
            },

            abrirModal(modelo, accion, data = []){

                this.selectCategoria();

                switch (modelo) {

                    case 'pelicula':
                        {
                            switch (accion) {
                                
                                case 'registrar':
                                    {
                                        this.modal = 1;
                                        this.tituloModal = 'REGISTRAR PELICULA'
                                        this.titulo = '';
                                        this.director = '';
                                        this.duracion = '';
                                        this.anio_estreno = '';
                                        this.multa_diaria = '';
                                        this.categoria_id = '';
                                        this.tipoAccion = 1;
                                        break;
                                    }
                                case 'actualizar':
                                    {
                                         this.modal = 1;
                                         this.tituloModal = 'ACTUALIZAR PELICULA';
                                         this.tipoAccion = 2;
                                         this.pelicula_id = data['id'];
                                         this.categoria_id = data['idcategoria'];
                                         this.titulo = data['titulo'];
                                         this.director = data['director'];
                                         this.duracion = data['duracion'];
                                         this.anio_estreno = data['anio_estreno'];
                                         this.multa_diaria = data['multa_diaria'];
                                         break;
                                    }
                            
                            }
                        }
                        
                }
            },

            cerrarModal(){

                this.modal = 0;
                this.tituloModal = '';
                this.titulo = '';
                this.director = '';
                this.duracion = '';
                this.duracion = '';
                this.anio_estreno = '';
                this.multa_diaria = '';
                this.errorPelicula = 0;
                this.errorMostrarMsjPelicula = [];

            }

        },

        mounted() {

            this.listarPelicula(1, this.buscar, this.criterio, this.select_categoria, this.select_condicion);
            this.selectCategoria();

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