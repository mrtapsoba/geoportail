<div class="action-bar">
    <span>
        @isset($thematiqueid)
            {{ $thematiqueid }} \ {{ count($sousthematiques) }}
        @endisset
        @isset($sousthematik)
            {{ $thematik }} \ {{ $sousthematik->nom }} \ {{ count($couches) }}
        @endisset

        @isset($thematiqueid)
            sous thematiques
        @endisset
        @isset($sousthematik)
            couches
        @endisset
        @isset($thematiques)
            {{ count($thematiques) }} thematiques
        @endisset
        @isset($fonddecarte)
            {{ count($fonddecarte) }} fonds de carte
        @endisset

    </span>
    <div class="
    actions-btn">
        <button><i class="fas fa-trash-can ic"></i></button>
        <button type="button" data-toggle="modal" data-target="#addForm"><i class="fas fa-plus ic"></i></button>
    </div>
</div>
