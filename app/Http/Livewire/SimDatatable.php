<?php

namespace App\Http\Livewire;

use App\Models\SimCard;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SimDatatable extends LivewireDatatable
{
    public $model = SimCard::class;
    public function builder()
    {
        return SimCard::query();
    }
    public function render()
    {
        return view('livewire.sim-datatable');
    }
}
