@extends('principal')

@section('contenido')

    <template v-if="menu==0">
        <pelicula></pelicula>
    </template>

    <template v-if="menu==1">
        <usuario></usuario>
    </template>

    <template v-if="menu==2">
        <rol></rol>
    </template>

    <template v-if="menu==3">
        <h1>ESTE ES EL TEMPLATE 1 HAHANUEVAMENTE DIGO ES EL 3</h1>

    </template>

    <template v-if="menu==6">
        <h1>ESTE ES EL TEMPLATE 1 HAHANUEVAMENTE DIGO ES EL 6</h1>
    </template>

    <template v-if="menu==7">
        <categoria></categoria>
    </template>
    
@endsection