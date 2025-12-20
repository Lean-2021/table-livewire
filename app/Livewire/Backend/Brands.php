<?php

namespace App\Livewire\Backend;

use App\Models\Brand;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Brands extends Component
{
    public $search = '';
    public $selectedBrands = [];
    public $selectAll = false;

    use WithPagination;
    use Interactions;


    //Si tildamos el check del encabezado se seleccionan todos los registros
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedBrands = Brand::all()->pluck('id')->toArray();
            // dd($this->selectedBrands);
        } else {
            $this->selectedBrands = [];
        }
    }


    public function confirmDeleted()
    {
        $this->dialog()
            ->warning('¿Estás seguro de que deseas eliminar las marcas seleccionadas? Esta acción no se puede deshacer.')
            ->confirm(method: 'deleteSelectedBrands', text: 'Sí, eliminar')
            ->cancel('Cancelar')
            ->send();
    }

    #[On('delete-selected-brands')]
    public function deleteSelectedBrands()
    {
        Brand::whereIn('id', $this->selectedBrands)->delete();
        $this->selectedBrands = [];
        $this->selectAll = false;
    }

    public function mod($id)
    {
        // dd('hola');

        $this->dispatch('edit', $id)->to(BrandsForm::class);
    }



    // Escuchamos el evento disparado desde el componente BrandsForm
    #[On('show-toast')]
    public function showToast()
    {
        dd('estoy en showToast');
        $this->dispatch('toast', [
            'message' => 'Marca actualizada con éxito',
            'type' => 'success',
        ]);
    }

    #[On('brandToggled')]
    public function handleBrandToggled(): void {}

    #[Layout('layouts.dashboard')]
    public function render()
    {
        // session()->reflash();
        $brands = Brand::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.backend.brands', [
            'brands' => $brands
        ]);
    }
}