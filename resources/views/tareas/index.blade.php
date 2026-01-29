<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mis Tareas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4 text-gray-700">Nueva Tarea</h3>
                <form action="{{ route('tareas.store') }}" method="POST" class="flex gap-4 items-end flex-wrap">
                    @csrf
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs text-gray-500 uppercase tracking-wide">Título</label>
                        <input type="text" name="titulo" class="border-gray-300 rounded-md shadow-sm w-full focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: Comprar pan..." required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 uppercase tracking-wide">Fecha</label>
                        <input type="date" name="fecha_limite" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 uppercase tracking-wide">Prioridad</label>
                        <select name="prioridad" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="1">Baja</option>
                            <option value="2">Media</option>
                            <option value="3">Alta</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow transition duration-150 ease-in-out">
                        Publicar
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 w-32 text-center text-gray-500">Estado</th>
                            <th class="p-4 text-gray-500">Detalle de la Tarea</th>
                            <th class="p-4 text-gray-500">Vence</th>
                            <th class="p-4 text-right text-gray-500">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($tareas as $tarea)
                        <tr class="hover:bg-gray-50 transition {{ $tarea->completada ? 'bg-green-50' : '' }}">
                            
                            <td class="p-4 text-center">
                                <form action="{{ route('tareas.toggle', $tarea) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="text-xs font-bold py-1 px-3 rounded border transition duration-200 
                                        {{ $tarea->completada ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-600 border-gray-300 hover:bg-gray-100' }}">
                                        {{ $tarea->completada ? 'Completada' : 'Pendiente' }}
                                    </button>
                                </form>
                            </td>

                            <td class="p-4">
                                <p class="text-lg {{ $tarea->completada ? 'line-through text-gray-400' : 'font-semibold text-gray-800' }}">
                                    {{ $tarea->titulo }}
                                </p>
                                <span class="text-xs font-bold px-2 py-1 rounded mt-1 inline-block
                                    {{ $tarea->prioridad == 3 ? 'bg-red-100 text-red-700' : ($tarea->prioridad == 2 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                    Prioridad: {{ $tarea->prioridad == 3 ? 'Alta' : ($tarea->prioridad == 2 ? 'Media' : 'Baja') }}
                                </span>
                            </td>

                            <td class="p-4 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($tarea->fecha_limite)->format('d/m/Y') }}
                            </td>

                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('tareas.edit', $tarea) }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-xs transition">
                                    Editar
                                </a>

                                <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" class="inline form-eliminar">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs transition">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400">
                                <p class="text-xl">Sin tareas</p>
                                <p class="text-sm">No tienes tareas pendientes.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const forms = document.querySelectorAll('.form-eliminar');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: '¿Confirmar eliminación?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#4b5563',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });
        });
    </script>
</x-app-layout>