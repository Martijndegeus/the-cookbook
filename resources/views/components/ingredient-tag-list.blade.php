<div>
    @foreach($ingredients as $ingredient)
        @if($loop->index !== 0)
            |
        @endif <a href="{{ route('recipe.search', ['searchQuery' => $ingredient->name]) }}" class="text-base md:text-sm text-green-500 no-underline hover:underline">{{ $ingredient->name }}</a>
    @endforeach
</div>
