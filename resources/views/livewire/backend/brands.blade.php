<div>
    <div
        class="relative overflow-x-auto bg-white dark:bg-gray-800 shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">

        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 p-4">
            <div>

                <label for="input-group-1" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="input-group-1" wire:model.live='search'
                        class="block w-full max-w-96 ps-9 pe-3 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm placeholder:text-gray-400 dark:placeholder:text-gray-400"
                        placeholder="Buscar por nombre...">
                </div>
            </div>

            <div>

                <a href="{{ route('brands-form') }}" wire:navigate
                    class="flex items-center gap-2 px-4 py-2 bg-slate-600 text-white rounded hover:bg-slate-700">
                    <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z"
                            clip-rule="evenodd" />
                    </svg>

                    Crear Nueva
                </a>
            </div>


        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead
                class="text-sm text-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 border-b border-t border-gray-200 dark:border-gray-700">
                <tr class="relative">
                    <th scope="col" class="px-4 py-3">
                        <div class="flex items-center">
                            <input id="table-checkbox" type="checkbox" value=""
                                class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft text-blue-800 font-bolder"
                                wire:model.live="selectAll">
                            <label for="table-checkbox" class="sr-only">Table checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Imagen
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Acciones

                    </th>
                    @if (count($selectedBrands) > 1)
                        <button title="Eliminar seleccionados" wire:click="confirmDeleted"
                            class="flex items-center gap-x-2 text-slate-100 fixed shadow-xl shadow-slate-900 mt-3 z-10 right-6 bottom-7 bg-red-700 hover:bg-red-800 p-3 rounded-md">
                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                            </svg>
                            Eliminar Seleccionadas
                        </button>
                    @endif
                </tr>
            </thead>
            <tbody>


                @if (count($brands) > 0)
                    @foreach ($brands as $indice => $brand)
                        <tr
                            class="bg-white dark:bg-gray-800 border-b border-gray-400 dark:border-gray-700 hover:bg-gray-400 dark:hover:bg-gray-900">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="table-checkbox-2" type="checkbox" value="{{ $brand->id }}"
                                        wire:model.live="selectedBrands"
                                        class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft text-blue-800 font-bolder">
                                    <label for="table-checkbox-2" class="sr-only">Table checkbox</label>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <img class="w-10 h-10 rounded-full"
                                    src="{{ count($brand->images) > 0 ? asset('storage/' . $brand->images->first()->path) : 'https://img.freepik.com/vector-gratis/diseno-plano-letrero-foto_23-2149291280.jpg?semt=ais_hybrid&w=740&q=80' }}"
                                    alt="image">
                            </td>

                            <td scope="row" class="px-6 py-4 text-gray-900 dark:text-white whitespace-nowrap">
                                <p class="text-base font-semibold">{{ $brand->name }}</p>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if ($brand->status)
                                        <div class="h-2.5 w-2.5 rounded-full me-2 bg-green-500"></div> Disponible
                                    @else
                                        <div class="h-2.5 w-2.5 rounded-full me-2 bg-red-400"></div> No Disponible
                                    @endif
                                </div>
                            </td>
                            <td class="flex mt-3 px-6 py-4 space-x-3 items-center relative">
                                <div class="inline mt-1"
                                    title="{{ !$brand->status ? 'Habilitar disponibilidad' : 'Deshabilitar disponibilidad' }}">
                                    <livewire:backend.toggle-button :model="$brand" field="status"
                                        wire:key="{{ $brand->id }}" />
                                </div>
                                <a href="{{ route('brands-form', $brand->id) }}" wire:navigate title="Editar"
                                    class="font-medium dark:text-slate-100 hover:underline"><svg
                                        class="w-6 h-6 text-gray-800 dark:text-gray-300 hover:text-gray-400"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </a>
                                @if (count($selectedBrands) == 1 && in_array($brand->id, $selectedBrands))
                                    <button title="Eliminar" wire:click="confirmDeleted"
                                        class="flex absolute items-center right-2 group ease-in-out duration-300 transition-all hover:bg-red-600 hover:p-2 hover:rounded-md  hover:text-white">
                                        <svg class="items-center w-5 h-5 text-red-500 dark:text-red-500 group-hover:text-slate-100"
                                            aria-hidden="true" xmlns="http://www.3.org/2000/svg" width="20"
                                            height="20" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                        <span class="ml-1 mt-1 hidden items-center group-hover:flex">Eliminar</span>
                                    </button>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="col p-2 text-gray-400 w-fullblock">
                            {{ $search == '' ? 'No existe ninguna marca.Ingrese una' : 'No existen coincidencias con la busqueda actual' }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div>
            {{ $brands->links() }}
        </div>

    </div>
</div>
