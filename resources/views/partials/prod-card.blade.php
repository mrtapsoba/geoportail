<div class="prod-card">
    @isset($thematiqueid)
        <a href="{{ route('couche', ['thematik' => $thematik, 'sousthematik' => $card->id]) }}">
        @endisset

        @isset($thematiques)
            <a href="{{ route('sousthematique', ['id' => $card->id]) }}">
            @endisset
            <img src="/images/{{ $card->image }}" alt="">
            <h2>{{ $card->nom }}</h2>
            <p><i>Ajouté le {{ $card->created_at->format('d M Y à H:i') }}</i></p>
        </a>
</div>
