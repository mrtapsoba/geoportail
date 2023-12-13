<div class="action-bar">
    <span>
        @isset($cartes)
            {{ count($cartes) }} cartes
        @endisset
        @isset($nbAttente)
            Demandes: {{ $nbAttente }} en attente \ {{ $nbEtude }} en etude \ {{ $nbPriseEnCompte }} prises en
            compte \ {{ $nbRejete }} rejetées
        @endisset


    </span>
    <div class="
    actions-btn">
        <button><i class="fas fa-trash-can ic"></i></button>
        <button type="button" data-toggle="modal" data-target="#addForm"><i class="fas fa-plus ic"></i></button>
    </div>
</div>
