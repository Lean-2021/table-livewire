<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class ToggleButton extends Component
{
    public Model $model;
    public string $field;
    public bool $active;

    public function mount()
    {
        $this->active = (bool) $this->model->getAttribute($this->field);
    }

    public function render()
    {
        return view('livewire.backend.toggle-button');
    }

    public function updatedActive($value)
    {
        $this->model->setAttribute($this->field, (bool) $value);
        $this->model->save();

        $this->dispatch('brandToggled');
    }
}