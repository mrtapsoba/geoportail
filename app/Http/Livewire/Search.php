<?php

namespace App\Http\Livewire;

use App\Models\Contribution;
use App\Models\Couche;
use Livewire\Component;

class Search extends Component
{
    public $searchTerm;
    public $couches = [];
    public $search = 0;
    public $nbEtude = 0;
    public $nbPriseEnCompte = 0;
    public $nbRejete = 0;
    public function render()
    {
        $searchTerm = "%" . $this->searchTerm . "%";
        $this->couches = Couche::where('nom', 'like', $searchTerm)
            ->orWhere('annee_prod', 'like', $searchTerm)->orWhere('description', 'like', $searchTerm)->get();
        //print('search');
        return view('livewire.search');
    }

    public function searchCouche()
    {
        $searchTerm = "%" . $this->searchTerm . "%";
        $this->couches = Couche::where('nom', 'like', $searchTerm)->get();
        print('search');
    }
}
