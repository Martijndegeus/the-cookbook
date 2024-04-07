<div>
    <section>
        <input placeholder="{{ __('Search') }}" wire:model.live="searchQuery" />
    </section>
    <section>
        <table>
            <thead>
            <tr><th>{{ __('Name') }}</th></tr>
            </thead>
            <tbody>
            @forelse($recipes as $recipe)
                <tr>
                    <td>{{ $recipe->name }}</td>
                </tr>
            @empty
                <tr><td>No recipes found</td></tr>
            @endforelse
            </tbody>
        </table>
    </section>
</div>
