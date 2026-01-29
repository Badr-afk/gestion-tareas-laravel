<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('tareas.update', $tarea) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Título</label>
                        <input type="text" name="titulo" value="{{ $tarea->titulo }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fecha Límite</label>
                        <input type="date" name="fecha_limite" value="{{ $tarea->fecha_limite }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Prioridad</label>
                        <select name="prioridad" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                            <option value="1" {{ $tarea->prioridad == 1 ? 'selected' : '' }}>Baja</option>
                            <option value="2" {{ $tarea->prioridad == 2 ? 'selected' : '' }}>Media</option>
                            <option value="3" {{ $tarea->prioridad == 3 ? 'selected' : '' }}>Alta</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('tareas.index') }}" class="text-gray-500 hover:text-gray-800">Cancelar</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Actualizar Tarea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>