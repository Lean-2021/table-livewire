<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="text-slate-200 flex items-center justify-end">

            <a href="{{ route('brands') }}" wire:navigate
                class="flex bg-slate-700 rounded-md p-2 w-24 gap-x-2 hover:bg-slate-600">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m15 19-7-7 7-7" />
                </svg>
                Volver
            </a>
        </div>
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Nueva Marca</h2>
            <form wire:submit="save">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                        </label>
                        <input type="text" wire:model="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Ingrese el nombre">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="small_size">Imagen</label>

                        <!-- Profile Photo File Input -->
                        <input type="file" id="images" class="hidden" wire:model="images" multiple />
                        <x-secondary-button class="mt-2 me-2 bg-slate-800" type="button"
                            onclick="document.getElementById('images').click()">
                            {{ __('Seleccionar Imagenes') }}
                        </x-secondary-button>


                        <x-input-error for="images" class="mt-2" />
                        @error('images')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button wire:click="save"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                    Guardar
                </button>
                <!-- Vista previa de imagenes-->
                @if (count($images) > 0)
                    <div class="flex gap-x-5 mt-14">
                        @foreach ($images as $index => $image)
                            <div class="mt-2 relative">
                                <img src="{{ $image->temporaryURL() }}"
                                    class="rounded-lg w-20 h-20 object-cover bg-no-repeat bg-center shadow-sm shadow-slate-300" />
                                <button class="absolute -top-2 -left-2 bg-red-600 rounded-md"
                                    wire:click.prevent="deletedImagePreview({{ $index }})">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                    </svg>

                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </form>
        </div>
    </section>
</div>
