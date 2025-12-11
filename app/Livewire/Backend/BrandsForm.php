<?php

namespace App\Livewire\Backend;

use App\Models\Brand;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BrandsForm extends Component
{
    use \Livewire\WithFileUploads;

    public $name;
    public $image, $id_marca;
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
            'image' => 'nullable|image|max:1024',
        ]);



        $data = [
            'name' => $this->name,
            'status' => 1,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('brands', 'public');
        }

        Brand::updateOrCreate(
            ['id' => $this->id_marca],
            $data
        );


        $this->id_marca = 0;
        $this->name = '';
        $this->image = '';


        $this->dispatch('flash-message', message: "Marca guardada con éxito");

        return $this->redirectRoute('brands', navigate: true);
    }

    public function deletedImagePreview($index)
    {
        unset($this->images[$index]); // Eliminar la imagen en el indice indicado
        $this->images = array_values($this->images); // reacomoda el array para que no quede con indices vacios
    }
}
