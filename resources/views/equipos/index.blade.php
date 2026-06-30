<!DOCTYPE html>
<html>
<head>
    <title>Gestión del Laboratorio</title>
</head>
<body>

<h1>Listado de Equipos</h1>

@forelse($equipos as $equipo)

    <hr>

    <p><strong>Nombre:</strong> {{ $equipo->nombre }}</p>

    <p><strong>Número de Serie:</strong> {{ $equipo->numero_serie }}</p>

    <p><strong>Descripción:</strong> {{ $equipo->descripcion }}</p>

    <p><strong>Aula:</strong> {{ $equipo->aula->nombre_sala ?? 'Sin Aula' }}</p>

@if($equipo->imagen_ruta)

    <img
        src="{{ asset($equipo->imagen_ruta) }}"
        alt="Imagen del equipo"
        width="200">

@endif
@empty

    <p>No hay equipos registrados.</p>

@endforelse

<hr>

<h2>Agregar Equipo</h2>

<form action="{{ route('equipos.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <label>Nombre</label>
    <br>
    <input type="text" name="nombre">
    <br><br>

    <label>Número de Serie</label>
    <br>
    <input type="text" name="numero_serie">
    <br><br>

    <label>Descripción</label>
    <br>
    <textarea name="descripcion"></textarea>
    <br><br>

    <label>Imagen</label>
    <br>
    <input type="file"
           name="imagen"
           accept=".jpg,.jpeg,.png">
    <br><br>

    <label>Aula</label>
    <br>
    <select name="aula_id">
        <option value="">Seleccionar Aula</option>
        @foreach($aulas as $aula)
            <option value="{{ $aula->id }}">
                {{ $aula->nombre_sala }}
            </option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">
        Guardar Equipo
    </button>

</form>

</body>
</html>
