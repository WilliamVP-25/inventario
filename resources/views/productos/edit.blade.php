@extends('layouts.app')

@section('title', 'Editar Producto '.$producto->nombre)
@section('color-style', 'bg-primary')
@section('content')

    <div class="text-left container mb-3 p-0">
        <a class="btn btn-outline-primary" href="{{ url('/productos') }}"><i class="ti-arrow-left"></i> Volver</a>
        <a class="btn btn-outline-primary" href="{{ route('productos.traslado', $producto->id) }}"><i class="ti-exchange-vertical text-danger"></i> Realizar Traslado</a>
    </div>

    <div class="container p-0" align="center">

    <form enctype="multipart/form-data" type="put" id="formEditProduct" name="formEditProduct">
        <div class="row">
            <input type="hidden" value="{{ csrf_token() }}" name="_token">

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Imagen Producto (opcional)</label>
                    <img width="100" src="{{ Storage::url($producto->imagen) }}" alt="imagen">
                <div class="input-group">
                    <input type="file" name="imagen"  data-toggle="tooltip" title="Cambiar Imagen."  class="form-control" id="imagen_edit">
                </div>
            </div>

            <div class="col-md-2">
                <label class="text-primary font-weight-bold">Código de Producto:</label>
                <div class="input-group">
                    <input placeholder="Código del Producto" value="{{ $producto->codigo }}" type="text" class="form-control" name="codigo"  id="codigo_edit" autofocus>
                </div>
            </div>

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Nombre:</label>
                <div class="input-group">
                    <input placeholder="Nombre del Producto" value="{{ $producto->nombre }}" type="text" class="form-control" name="nombre"  id="nombre_edit" autofocus>
                </div>
            </div>

        </div>

        <div class="row mt-4">

            <div class="col-md-2">
                <label class="text-primary font-weight-bold"><i class="ti-money"></i> Precio Compra:</label>
                <div class="input-group">
                    <input placeholder="Precio de compra" name="precio_compra" value="{{ $producto->precio_compra }}"  type="number" class="form-control" id="precioc_edit" autofocus>
                </div>
            </div>

            <div class="col-md-2">
                <label class="text-primary font-weight-bold"><i class="ti-money"></i> Precio Venta:</label>
                <div class="input-group">
                    <input placeholder="Precio de Venta" name="precio_venta" type="number" value="{{ $producto->precio_venta }}"  class="form-control" id="preciov_edit" autofocus>
                </div>
            </div>

            <div class="col-md-3">
                <label for="bodega_edit" class="text-primary font-weight-bold">Bodega:</label>
                <div class="input-group">
                    <select class="form-control" data-live-search="true" name="bodega_id" id="bodega_edit">
                        @foreach(\App\Bodega::all() as $bodega)
                            @if ($bodega->id === $producto->bodega_id)
                            <option selected data-tokens="{{$bodega->nombre}}" value="{{ $bodega->id }}"><strong>{{ $bodega->id }}</strong>: {{ $bodega->nombre }}</option>
                            @else
                            <option data-tokens="{{$bodega->nombre}}" value="{{ $bodega->id }}"><strong>{{ $bodega->id }}</strong>: {{ $bodega->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <label class="text-primary font-weight-bold">Cantidad en Mostrador:</label>
                <div class="input-group">
                    <input placeholder="Cantidad en Mostrador" disabled name="mostrador" value="{{ $producto->mostrador }}"  type="number" class="form-control" id="cantidadm_edit" autofocus>
                </div>
            </div>

            <div class="col-md-2">
                <label class="text-primary font-weight-bold">Cantidad Bodega:</label>
                <div class="input-group">
                    <input placeholder="Cantidad en Bodega" disabled name="existencias" type="number" value="{{ $producto->existencias }}"  class="form-control" id="cantidadb_edit" autofocus>
                </div>
            </div>

        </div>
        <div class="row mt-4">

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Fecha Vencimiento:</label>
                <div class="input-group">
                    <input type="text"  style="border: 1px solid #ccc; border-radius: 0px;"  class="form-control datepicker" name="vencimiento" value="{{ $producto->vencimiento }}"  id="fecha_edit" autofocus>
                </div>
            </div>

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Categoria/tipo Producto:</label>
                <div class="input-group">
                    <select class="form-control" name="categoria_id" data-live-search="true" id="categoria_edit">
                        <option selected disabled>Seleccione...</option>
                        @foreach($categorias as $categoria)
                            @if ($categoria->id == $producto->categoria_id)
                                <option selected data-tokens="{{$categoria->nombre}}" value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @else
                                <option data-tokens="{{$categoria->nombre}}" value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Unidad de Medida Producto:</label>
                <div class="input-group">
                    <select id="unidad_edit" name="medida_id" class="form-control" data-live-search="true">
                        <option selected disabled>Seleccione...</option>
                        @foreach($unidades as $unidad)
                            @if ($unidad->id == $producto->medida_id)
                                <option selected data-tokens="{{$unidad->nombre}}" value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                            @else
                                <option data-tokens="{{$unidad->nombre}}" value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <label class="text-primary font-weight-bold">Estado del Producto:</label>
                <div class="input-group">
                    <select id="estado_edit" name="estado" class="form-control">
                        @if ($producto->estado == 1)
                            <option selected value="1">ACTIVO</option>
                            <option value="0">INACTIVO</option>
                        @else
                            <option value="1">ACTIVO</option>
                            <option selected value="0">INACTIVO</option>
                        @endif

                    </select>
                </div>
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-md-5 text-left">
                <label class="text-primary font-weight-bold">Descripción Producto (opcional)</label>
                <div class="input-group">
                    <textarea name="descripcion" placeholder="Descripción del producto" id="descripcion_edit" cols="30" rows="10" style="width: 300px; max-width: 500px; height: 50px; max-height: 150px;" class="form-control">{{$producto->descripcion}}</textarea>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="form-group col-sm-12 mt-4"><br><br>
                <button type="button" class="btn btn-success btnUpdate"><i class="ti-save"></i> GUARDAR CAMBIOS</button>
                <button type="reset" class="btn btn-info"><i class="ti-reload"></i> DESHACER CAMBIOS</button>
            </div>
        </div>
    </form>

    </div>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <script src="{{ asset('js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset('js/scripts/producto.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
        });
        $('.datepicker').datepicker({
            format: "yyyy/mm/dd",
            language: "es",
            local: "es",
            autoclose: true
        });
    </script>
@endsection
