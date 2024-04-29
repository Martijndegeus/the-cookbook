<html>
    <head>
        <title>{{ Str::ucfirst($recipe->name) }}</title>
        <link rel="stylesheet" href="https://cdn.curlwind.com?classes=text-*,font-*,border-l-*,border-green-*,border-gray-*,font-gray-*,italic,mt-*,my-*,pl-*,py-*">
    </head>
    <body>
        <h1 class="text-4xl font-bold">{{ Str::ucfirst($recipe->name) }}</h1>
        <p class="text-sm font-normal text-right">
            Edited {{ $recipe->updated_at->format('j F Y') }}</p>
        <blockquote class="border-l-4 border-green-500 italic my-8 pl-12">
            {!! $recipe->description !!}
        </blockquote>
        <h2 class="py-2 my-2 text-3xl font-sans font-bold">{{ __('Shopping list') }} for {{ $people }} {{ $people > 1 ? __('people') : __('person') }}</h2>
        <ul class="py-2">
            @foreach($recipe->ingredients as $ingredient)
                <li class="font-sans">
                    <span>{{ $ingredient->quantity * $people }}</span> <span class="font-thin">{{ $ingredient->unit }} of</span> {{ $ingredient->name }}
                </li>
            @endforeach
        </ul>
        <hr class="py-2 border-gray-500" />
        <h2 class="py-2 my-2 text-3xl font-sans font-bold">{{ __('Let\'s cook') }} <span class="text-sm font-normal">{{ $recipe->total_time_string }} preparation time</span></h2>
        <ol>
            @foreach($recipe->steps as $step)
                <li>
                    <h3 class="py-1 mt-2 text-xl font-sans font-bold">{{ $step->order }}. {{ Str::ucfirst($step->name) }}</h3>
                    @if($step->duration)
                        <small class="mx-1 text-sm font-gray-800">{{ $step->time_string }}</small>
                    @endif
                    <p class="font-sans">{!! $step->action !!}</p>
                </li>
            @endforeach
        </ol>
        <script type="text/php">
            if (isset($pdf)) {
                $text = __('page') . " {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width) / 2;
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>
