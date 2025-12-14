<?php

namespace App\Livewire\Backend;

use App\Models\Brand;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;



class BrandsForm extends Component
{
    use \Livewire\WithFileUploads;

    public $name;
    public $id_marca;
    public $images = []; // Para nuevas imagenes
    public $savedImages = []; // Para imagenes existentes en BD
    public $editMode = false;

    // Recibimos el id opcional desde la ruta
    public function mount($id = null)
    {
        if ($id) {
            $brand = Brand::findOrFail($id);
            $this->id_marca = $brand->id;
            $this->name = $brand->name;
            $this->savedImages = $brand->images; // Colección de imagenes
            $this->editMode = true;
        }
    }

    #[Layout("layouts.dashboard")]
    public function render()
    {
        return view('livewire.backend.brands-form');
    }

    public function save()
    {
        $rules = [
            'name' => 'required',
            'images' => 'nullable|array|max:10',
            'images.*' => 'nullable|image|mimes:png,jpg,svg|max:1024',
        ];

        $this->validate($rules);

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
                // Generar nombre único
                $name = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
                // Guardar en disco
                $path = $image->storeAs('brands', $name, 'public');
                // Crear registro en relación
                $brand->images()->create(['path' => $path]);
            }
        }

        $this->reset(['id_marca', 'name', 'images', 'savedImages']);
        $this->editMode = false;


        session()->flash('flash', [
            'message' => 'Marca guardada con éxito',
            'title' => 'Éxito',
            'icon' => 'success',
            'position' => 'top-end',
            'timer' => 3000,
        ]);

        return $this->redirectRoute('brands', navigate: true);
    }

    // Delete an image from a brand (existing image from DB)
    public function deleteImage($imageId)
    {
        $image = Image::find($imageId);
        if ($image) {
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
            $image->delete();
            // Actualizar la lista en memoria
            $this->savedImages = collect($this->savedImages)->reject(function ($img) use ($imageId) {
                return (is_array($img) ? $img['id'] : $img->id) == $imageId;
            });
        }
    }

    // Eliminar la imagen previa seleccionada (upload pending)
    public function deletedImagePreview($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    //Eliminar todas las imagenes
    public function deletedAll()
    {
        $brand = Brand::findOrFail($this->id_marca);

        $images = $brand->images;

        foreach ($images as $image) {
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
            $image->delete();
        }
        $this->savedImages = [];
        $this->dispatch('deletedAllImages');
    }

    // ELiminar todas las imagenes previas
    public function deleteAllNewImages()
    {
        $this->images = [];
    }
}
