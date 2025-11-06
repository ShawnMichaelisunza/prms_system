<nav class="text-md text-gray-500 font-bold font-sans" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        @foreach ($links as $label => $url)
            <li class="inline-flex items-center">
                @if (!$loop->last)
                    <a href="{{ $url }}" class="text-red-600 hover:underline">{{ $label }}</a>
                    <span class="mx-1">/</span>
                @else
                    <span class="text-gray-800">{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>