<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Inventario de Hardware') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Formulario de Alta (Estilizado con Tailwind CSS) -->
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 pb-2 border-b border-gray-100 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Registrar Nuevo Equipo
                </h3>
                
                <form action="{{ route('equipos.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre del Equipo</label>
                            <input type="text" name="nombre" required placeholder="Ej: Monitor LED 24\""
                                   class="w-full rounded-md border-gray-300 shadow-sm border p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Número de Serie / Patrimonio</label>
                            <input type="text" name="numero_serie" required placeholder="Ej: SN-987654321"
                                   class="w-full rounded-md border-gray-300 shadow-sm border p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Aula / Ubicación</label>
                            <select name="aula_id" required
                                    class="w-full rounded-md border-gray-300 shadow-sm border p-2 focus:border-blue-500 focus:ring focus:ring-blue-200">
                                <option value="">Seleccionar Aula</option>
                                @foreach($aulas as $aula)
                                    <option value="{{ $aula->id }}">{{ $aula->nombre_sala }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="space-y-4 flex flex-col justify-between">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción del Equipo</label>
                            <textarea name="descripcion" rows="3" required placeholder="Detalles sobre el estado físico y especificaciones..."
                                      class="w-full rounded-md border-gray-300 shadow-sm border p-2 focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Imagen de Hardware</label>
                            <input type="file" name="imagen" accept=".jpg,.jpeg,.png"
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition">
                                Guardar Equipo
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Listado de Equipos (Grid Adaptativo) -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Equipos Registrados
                </h3>

                <!-- Contenedor Adaptativo de Equipos (Grid 1 col móvil, 2 col tablet, 3 col desktop) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 bg-gray-50 rounded-xl border border-gray-100">
                    @forelse($equipos as $equipo)
                        <!-- Tarjeta de Hardware -->
                        <div class="bg-white rounded-xl shadow-md border border-gray-100 transition hover:shadow-lg overflow-hidden flex flex-col justify-between">
                            <div>
                                <!-- Sección Superior Multimedia -->
                                @if($equipo->imagen_ruta)
                                    <img src="{{ asset($equipo->imagen_ruta) }}" alt="{{ $equipo->nombre }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex flex-col items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                                        </svg>
                                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Sin imagen</span>
                                    </div>
                                @endif

                                <!-- Cuerpo de Información -->
                                <div class="p-5 space-y-3">
                                    <div class="flex justify-between items-start gap-2">
                                        <h4 class="text-lg font-bold text-gray-800 leading-tight">{{ $equipo->nombre }}</h4>
                                        
                                        @if($equipo->aula)
                                            <span class="bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded-full text-xs font-semibold whitespace-nowrap">
                                                {{ $equipo->aula->nombre_sala }}
                                            </span>
                                        @else
                                            <span class="bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full text-xs font-semibold whitespace-nowrap">
                                                Sin Aula
                                            </span>
                                        @endif
                                    </div>

                                    <div>
                                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Patrimonio / N/S</p>
                                        <p class="text-sm text-gray-600 font-mono">{{ $equipo->numero_serie }}</p>
                                    </div>

                                    <div>
                                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Descripción</p>
                                        <p class="text-sm text-gray-600 leading-relaxed">{{ $equipo->descripcion }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center flex flex-col items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0V9a2 2 0 00-2-2H6a2 2 0 00-2 2v2m0 4h18"></path>
                            </svg>
                            <h4 class="text-lg font-bold text-gray-700 mb-1">Inventario Vacío</h4>
                            <p class="text-gray-500 text-sm max-w-md">No hay equipos registrados en este momento. Utilice el formulario superior para registrar el primer dispositivo de hardware.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
