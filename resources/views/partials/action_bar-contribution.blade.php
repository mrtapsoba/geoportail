<div class="action-bar">
    <span>
        Contributions: {{ $nbAttente }} en attente \ {{ $nbEtude }} en etude \ {{ $nbPriseEnCompte }} prises
        en
        compte \ {{ $nbRejete }} rejetées

    </span>
    <div class="
    actions-btn">
        @isset($actionbar)
            @if ($actionbar)
                <button><i class="fas fa-trash-can ic plus"></i></button>
                @isset($contributions)
                    <a href="{{ route('contributionCoucheClient') }}"><i class="fas fa-plus ic plus"></i></a>
                @endisset
                @php
                    if (!isset($contributions)) {
                        echo '<button type="button" data-toggle="modal" data-target="#addForm"><i class="fas fa-plus ic"></i></button>';
                    }
                @endphp
            @else
                @livewire('search')
            @endif
        @endisset

    </div>
</div>
