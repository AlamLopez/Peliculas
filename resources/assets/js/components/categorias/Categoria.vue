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
                        <i class="fa fa-align-justify"></i> CATEGORIAS
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">NOMBRE</option>
                                      <option value="descripcion">DESCRIPCIÓN</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarCategoria(1, buscar, criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                    <button type="submit" @click="listarCategoria(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">NOMBRE</th>
                                    <th style="text-align: center;">DESCRIPCIÓN</th>
                                    <th style="text-align: center;">ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                    <td style="text-align: center;" v-text="categoria.nombre"></td>
                                    <td style="text-align: center;" v-text="categoria.descripcion"></td>
                                    <td style="text-align: center;">
                                        <div v-if="categoria.condicion">
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
        </main>
</template>

<script>

    export default {

        data (){
            
            return {
                categoria_id: 0,
                nombre : '',
                descripcion : '',
                arrayCategoria : [],
                modal : 0,
                tituloModal : '',
                tipoAccion: 0,
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
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

            listarCategoria(page, buscar, criterio){

                let me = this;
                var url = '/categorias?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias.data;
                    me.pagination = respuesta.pagination;
                    console.log(response);
                })
                .catch(function (error) {
                    
                    console.log(error);
                })

            },

            cambiarPagina(page, buscar, criterio){
                
                let me = this;
                me.pagination.current_page = page;
                me.listarCategoria(page, buscar, criterio);

            }

        },

        mounted() {

            this.listarCategoria(1, this.buscar, this.criterio);

        }

    }

</script>

<style>

    .modal-content{
        width: 100% !important;
        position: fixed !important;
    }

    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: fixed !important;
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