<div class="prod-card">
    <img src="/images/{{ $card->image }}" alt="">
    <h2>{{ $card->nom }}</h2>
    <p class="attribution">{{ $card->attribution }}</p>
    <p><i>Ajouté le {{ $card->created_at->format('d M Y à H:i') }}</i></p>

</div>
