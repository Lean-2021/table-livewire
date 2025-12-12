<?php

namespace App\Livewire\Backend;

use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BrandsForm extends Component
{
    use \Livewire\WithFileUploads;

    public $name;
    public $id_marca;
    public $images = [];

    #[Layout("layouts.dashboard")]
    public function render()
    {
        return view('livewire.backend.brands-form');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'images' => 'nullable|array|max:10',
            'images.*' => 'nullable|image|mimes:png,jpg,svg|max:1024',
        ]);



        $data = [
            'name' => $this->name,
            'status' => 1,
        ];



        $brand = Brand::updateOrCreate(
            ['id' => $this->id_marca],
            $data
        );

        if ($this->images) {
            foreach ($this->images as $image) {
                $name =  Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('brands', $name);
                $brand->images()->create(['path' => $path]);
            }
        }


        $this->id_marca = 0;
        $this->name = '';
        $this->images = [];


        $this->dispatch('flash-message', message: "Marca guardada con éxito");

        return $this->redirectRoute('brands', navigate: true);
    }

    public function deletedImagePreview($index)
    {
        unset($this->images[$index]); // Eliminar la imagen en el indice indicado
        $this->images = array_values($this->images); // reacomoda el array para que no quede con indices vacios
    }
}