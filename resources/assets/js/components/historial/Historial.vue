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
                        <i class="fa fa-align-justify"></i> MOVIMIENTOS DE PELICULAS
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="peliculas.titulo">PELICULA</option>
                                      <option value="users.nombrecompleto">CLIENTE</option>
                                      <option value="movimientos.movimiento">MOVIMIENTO</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup="listarMovimiento(1, buscar, criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                    <button type="submit" @click="listarMovimiento(1, buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="button" @click="exportarPDF()" class="btn btn-warning text-white" title="EXPORTAR MOVIMIENTOS">
                                    <i class="fa fa-file-pdf-o"></i>&nbsp;PDF
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">PELICULA</th>
                                    <th style="text-align: center;">CLIENTE</th>
                                    <th style="text-align: center;">MOVIMIENTO</th>
                                    <th style="text-align: center;">FECHA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="movimiento in arrayMovimiento" :key="movimiento.id">
                                    <td style="text-align: center;" v-text="movimiento.pelicula"></td>
                                    <td style="text-align: center;" v-text="movimiento.cliente"></td>
                                    <td style="text-align: center;" v-text="movimiento.movimiento"></td>
                                    <td style="text-align: center;" v-text="movimiento.fecha"></td>
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

    import FileSaver from 'file-saver';

    export default {

        data (){

            return {
                movimiento_id: 0,
                pelicula : '',
                cliente : '',
                movimiento : '',
                fecha : '',
                arrayMovimiento : [],
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
                criterio : 'peliculas.titulo',
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

            listarMovimiento(page, buscar, criterio){

                let me = this;
                var url = '/movimientos?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMovimiento = respuesta.movimientos.data;
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
                me.listarMovimiento(page, buscar, criterio);

            },

            exportarPDF(){
                
                let me = this;
                
                me.loading = true;
                axios.post('/reporteria/movimientos', {
                    'data' : me.arrayMovimiento
                }).then(function (response) {
                    me.loading = false;
                    axios.get('/reporteria/movimientos-descargar', {
                        responseType: "blob"
                    }).then((response) => {
                        
                        console.log(response.data);
                        FileSaver.saveAs(response.data, 'movimientos.pdf');
                        
                    });
                    console.response(response);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            
        },

        mounted() {

            this.listarMovimiento(1, this.buscar, this.criterio);

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