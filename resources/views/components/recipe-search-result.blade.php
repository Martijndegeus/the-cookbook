<li>
    <h2 class="pt-2 text-3xl font-sans font-bold">
        <a href="{{ route('recipe.view', $recipe->id) }}">{{ str($recipe->name)->ucfirst() }}</a>
    </h2>
    <p class="text-sm md:text-base font-sans font-normal text-gray-600">{{ $recipe->total_time_string }}</p>
    <div class="block flex text-xs font-sans my-2">
        <div class="pr-2"><x-icons.heart /> {{ __('Liked by :likes people', ['likes' => random_int(1, 300)]) }}</div>
        <div class="pl-2"><x-icons.play /> {{ __('Prepared :times_cooked times', ['times_cooked' => random_int(1, 250)]) }}</div>
    </div>
    <a href="{{ route('recipe.view', $recipe->id) }}">
        <img class="my-4 block" alt="{{ Str::ucfirst($recipe->name) }}" src="https://placehold.co/1000x400" />
    </a>
    <a href="{{ route('recipe.view', $recipe->id) }}">
        <div class="mb-4">{!! $recipe->description  !!}</div>
    </a>
    <x-ingredient-tag-list :ingredients="$recipe->ingredients" />
    <hr class="border-b-2 border-gray-400 dark:border-gray-600 my-4 mx-4">
</li>
