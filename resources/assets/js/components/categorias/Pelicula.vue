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
                            <button type="button" class="btn btn-secondary">
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
                                            <button type="button" class="btn btn-warning btn-sm" title="EDITAR PELICULA">
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