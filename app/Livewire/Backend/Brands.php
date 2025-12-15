<?php

namespace App\Livewire\Backend;

use App\Models\Brand;
use App\Models\Image;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Brands extends Component
{
    public $search = '';
    public $selectedBrands = [];
    public $selectAll = false;

    use WithPagination;


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

    #[On('delete-selected-brands')]
    public function deleteSelectedBrands()
    {
        Brand::whereIn('id', $this->selectedBrands)->delete();
        $this->selectedBrands = [];
        $this->selectAll = false;
    }

    // Method mod removed as it is replaced by direct route navigation in the view


    #[On('brandToggled')]
    public function handleBrandToggled(): void {}

    #[Layout('layouts.dashboard')]
    public function render()
    {
        $brands = Brand::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.backend.brands', [
            'brands' => $brands
        ]);
    }
}