<div>
    <div class="action-bar">
        <span>
            {{ count($couches) }} couches trouvée(s)

        </span>
        <div class="actions-btn">

            <input placeholder="couche name" type="searchyes" class="form-control nc" wire:model="searchTerm" />
            @error('searchTerm')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    </div>
    @if (count($couches) > 0)
        <div class="produits-list">
            <table>
                <thead>
                    <tr style="padding: 8px auto">
                        <th>ID</th>
                        <th>Nom du produit</th>
                        <th>Fichier</th>
                        <th>Annee</th>
                        <th>Description</th>
                        <th>Date d'ajout</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($couches as $couche)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <th><a href="{{ route('delimitation', ['id' => $couche->id]) }}">{{ $i }}</a>
                            </th>
                            <td><a href="{{ route('delimitation', ['id' => $couche->id]) }}">{{ $couche->nom }}</a>
                            </td>
                            <td><a
                                    href="{{ route('delimitation', ['id' => $couche->id]) }}">{{ $couche->fichier }}</a>
                            </td>
                            <td><a
                                    href="{{ route('delimitation', ['id' => $couche->id]) }}">{{ $couche->annee_prod }}</a>
                            </td>
                            <td><a href="{{ route('delimitation', ['id' => $couche->id]) }}">
                                    {{ \Illuminate\Support\Str::limit($couche->description, 50, $end = '...') }}</a>
                            </td>
                            <td><a
                                    href="{{ route('delimitation', ['id' => $couche->id]) }}">{{ $couche->created_at->format('d M Y à H:i') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-success mt-3">
            <span>Aucune couche</span>
        </div>
    @endif

</div>
