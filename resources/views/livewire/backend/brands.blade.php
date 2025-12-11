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
                    @if (count($selectedBrands) > 0)
                        <button title="Eliminar seleccionados" wire:click="deleteSelectedBrands"
                            class="absolute mt-1 z-10 right-1 ms-20 bg-red-700 hover:bg-red-800 p-2 rounded-md">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                            </svg>
                        </button>
                    @endif
                </tr>
            </thead>
            <tbody>


                @if (count($brands) > 0)
                    @foreach ($brands as $brand)
                        <tr
                            class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="table-checkbox-2" type="checkbox" value="{{ $brand->id }}"
                                        wire:model.live="selectedBrands"
                                        class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft text-blue-800 font-bolder">
                                    <label for="table-checkbox-2" class="sr-only">Table checkbox</label>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg"
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
                            <td class="flex mt-3 px-6 py-4 space-x-3 items-center">
                                <div class="inline"
                                    title="{{ !$brand->status ? 'Habilitar disponibilidad' : 'Deshabilitar disponibilidad' }}">
                                    <livewire:backend.toggle-button :model="$brand" field="status"
                                        wire:key="{{ $brand->id }}" />
                                </div>
                                <!-- Modal toggle -->
                                <a href="#" type="button" data-modal-target="editUserModal"
                                    data-modal-show="editUserModal"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar
                                </a>
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
        <!-- Main modal -->
        <div id="editUserModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div
                    class="relative bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm p-4 md:p-6">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between border-b border-gray-200 dark:border-gray-600 pb-4 md:pb-5">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            Create new product
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="editUserModal">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="#">
                        <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5 shadow-sm placeholder:text-gray-400"
                                    placeholder="Bonnie Green" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="position"
                                    class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                                <input type="text" name="position" id="position"
                                    class="bg-gray-50 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3 py-2.5 shadow-sm placeholder:text-gray-400"
                                    placeholder="React Developer" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="category"
                                    class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <select id="category"
                                    class="block w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 px-3 py-2.5 shadow-sm placeholder:text-gray-400">
                                    <option selected="">Online</option>
                                    <option value="offline">Offline</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="biography"
                                    class="block mb-2.5 text-sm font-medium text-gray-900 dark:text-white">Biography</label>
                                <textarea id="biography" rows="4"
                                    class="block bg-gray-50 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5 shadow-sm placeholder:text-gray-400"
                                    placeholder="Write a short biography here"></textarea>
                            </div>
                        </div>
                        <div
                            class="flex items-center space-x-4 border-t border-gray-200 dark:border-gray-600 pt-4 md:pt-6">
                            <button type="submit"
                                class="inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 box-border border border-transparent focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 shadow-sm font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                                Update user
                            </button>
                            <button data-modal-hide="crud-modal" type="button"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
