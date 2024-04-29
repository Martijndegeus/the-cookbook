<!--Container-->
<div class="container w-full md:max-w-3xl mx-auto pt-20">

    <div class="w-full px-4 md:px-6 text-xl text-gray-800 dark:text-gray-400 leading-normal"
         style="font-family:Georgia,serif;">

        <!--Title-->
        <div class="font-sans">
            <p class="text-base md:text-sm text-green-500 font-bold">
                &lt; <a href="{{ url('/') }}" class="text-base md:text-sm text-green-500 font-bold no-underline hover:underline">
                    {{ __('BACK TO SEARCH') }}</a>
            </p>
            <h1 class="font-bold font-sans break-normal text-gray-900 dark:text-gray-400 pt-6 pb-2 text-3xl md:text-4xl">{{ str($recipe->name)->ucfirst() }}</h1>
            <p class="text-sm md:text-base font-normal text-gray-600">
                {{ __('Edited') }} {{ $recipe->updated_at->format('j F Y') }}</p>
            <a href="{{ route('recipe.pdf', [$recipe->id, $noOfPeople]) }}" target="_blank" class="float-right block" title="{{ __('Download PDF') }}">
                <x-icons.pdf class="dark:hover:text-green-500 mb-4" />
            </a>
        </div>

        <!--Post Content-->

        <img class="mt-4 block" alt="{{ Str::ucfirst($recipe->name) }}" src="https://placehold.co/1000x400" />

        <!--Lead Para-->
        <blockquote class="border-l-4 border-green-500 italic my-8 pl-8 md:pl-12">
            {!! $recipe->description !!}
        </blockquote>
        <h2 class="py-2 text-3xl font-sans font-bold">{{ __('Ingredients') }}</h2>
        <form class="max-w-xs font-sans">
            <label for="quantity_input"
                   class="block mb-2 text-sm font-medium text-gray-800 dark:text-gray-400">{{ __('Number of people') }}</label>
            <div class="relative flex items-center max-w-[8rem] mb-4">
                <button type="button" id="decrement_button"
                        wire:click="decreaseNoOfPeople"
                        class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 1h16"/>
                    </svg>
                </button>
                <input type="text" id="quantity_input" data-input-counter aria-describedby="helper-text-explanation"
                       class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       wire:model.live="noOfPeople"
                       placeholder="4" required/>
                <button type="button" id="increment_button"
                        wire:click="increaseNoOfPeople"
                        class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 1v16M1 9h16"/>
                    </svg>
                </button>
            </div>
        </form>

        <ul>
            @foreach($recipe->ingredients as $ingredient)
                <li class="font-sans">
                    <span>{{ $ingredient->quantity * $noOfPeople }}</span> <span class="font-thin">{{ $ingredient->unit }}{{ __(' of ') }}</span>{{ $ingredient->name }}
                </li>
            @endforeach
        </ul>

        <p class="py-6">{{ __('Total time') }}: {{ $recipe->total_time_string }}</p>

        <!--Divider-->
        <hr class="border-b-2 border-gray-400 dark:border-gray-600 mb-8 mx-4">

        <h2 class="py-2 text-3xl font-sans font-bold">{{ __('Cooking') }}</h2>

        @foreach($recipe->steps as $step)
            <h3 class="pt-2 text-2xl font-sans font-bold">{{ $loop->index + 1 }}. {{ str($step->name)->ucfirst() }}</h3>
            @if($step->duration)
                <p class="text-sm md:text-base font-sans font-normal text-gray-600">{{ $step->time_string }}</p>
            @endif

            <p class="py-6">{!! $step->action !!}</p>
        @endforeach

        <!--/ Post Content-->

    </div>

    <!--Tags -->
    <div class="text-base md:text-sm text-gray-500 px-4 py-6">
        {{ __('Tags') }}:
        <x-ingredient-tag-list :ingredients="$recipe->ingredients"/>
    </div>

    <!--Divider-->
    <hr class="border-b-2 border-gray-400 dark:border-gray-600 mb-8 mx-4">

    <!--Next & Prev Links-->
    <div class="font-sans flex justify-between content-center px-4 pb-12">
        <div class="text-left">
            @if(isset($recipe->previous))
                <span class="text-xs md:text-sm font-normal text-gray-600">&lt; {{ __('Previous') }} {{ __('Recipe') }}</span><br>
                <p><a href="{{ route('recipe.view', $recipe->previous->id) }}"
                      class="break-normal text-base md:text-sm text-green-500 font-bold no-underline hover:underline">{{ str($recipe->previous->name)->ucfirst() }}</a>
                </p>
            @endif
        </div>
        <div class="text-right">
            @if(isset($recipe->next))
                <span class="text-xs md:text-sm font-normal text-gray-600">{{ __('Next') }} {{ __('Recipe') }} &gt;</span><br>
                <p><a href="{{ route('recipe.view', $recipe->next->id) }}"
                      class="break-normal text-base md:text-sm text-green-500 font-bold no-underline hover:underline">{{ str($recipe->next->name)->ucfirst() }}</a>
                </p>
            @endif
        </div>
    </div>
    <!--/Next & Prev Links-->

</div>
<!--/container-->
