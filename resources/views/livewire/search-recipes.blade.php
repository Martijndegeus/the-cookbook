<!--Container-->
<div class="container w-full md:max-w-3xl lg:max-w-4xl mx-auto pt-20">
    <div class="w-full px-4 md:px-6 text-xl text-gray-800 dark:text-gray-400 leading-normal"
         style="font-family: Georgia,serif;">
        <div class="md:flex md:flex-row md:order-1">
            <div class="md:w-4/6 md:order-2">
                <section>
                    <input
                        class="rounded-full w-full h-14 bg-transparent py-0 sm:pl-6 pl-5 pr-16 sm:pr-32 outline-none border-2
                        border-gray-100 shadow-md hover:outline-none focus:ring-cool-indigo-200 focus:border-cool-indigo-200"
                        placeholder="{{ __('Search') }}" wire:model.live="searchQuery"/>
                </section>
                <section>
                    <h1 class="font-bold font-sans break-normal text-gray-900 dark:text-gray-400 pt-6 pb-2 text-3xl md:text-4xl">{{ __('Search results') }}</h1>
                    <div class="text-right font-sans text-xs">
                        {{ __('Order') }}: <button class="border px-2 py-1 ml-2 mr-1 rounded" wire:click="orderResult('time')">{{ __('Time') }} {!! ($orderBy !== 'time') ? '&uparrow; &downarrow;' : ($orderDirection == 'asc' ? '&uparrow;' : '&downarrow;') !!}</button>
                        <button class="border px-2 py-1 ml-1 mr-2 rounded" wire:click="orderResult('ingredients')">{{ __('Ingredients') }} {!! ($orderBy !== 'ingredients') ? '&uparrow; &downarrow;' : ($orderDirection == 'asc' ? '&uparrow;' : '&downarrow;') !!}</button>
                    </div>
                    <ul>
                        @forelse($recipes as $recipe)
                            <x-recipe-search-result :recipe="$recipe" />
                        @empty
                            <li>{{ __('No recipes found') }}</li>
                        @endforelse
                    </ul>
                    <div class="my-4">
                        {{ $recipes->links('vendor.livewire.tailwind') }}
                    </div>
                </section>
            </div>
            <section class="md:mr-4 md:w-2/6">
                <h3 class="text-xl font-bold font-sans mb-4">{{ __('Ingredients') }}</h3>
                <ul class="text-base md:max-h-screen overflow-y-scroll">
                    @foreach ($ingredients as $ingredient)
                        <li><a href="{{ route('recipe.search', ['searchQuery' => $ingredient->name]) }}">{{ $ingredient->name }} <span class="text-sm font-thin font-sans">({{ $ingredient->count }})</span></a></li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
</div>
