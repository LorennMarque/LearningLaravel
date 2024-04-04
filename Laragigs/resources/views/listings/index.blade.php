<x-layout>
@include('partials._hero')
@include('partials._searchbox')
{{-- <h1>{{$heading}}</h1> --}}

{{-- @php --}}
{{-- $nombre = "Lorenzo" --}}
{{-- @endphp --}}

{{-- <h2>Hola {{$nombre}}!! Bienvenido</h2> --}}


{{-- @if(count($listings) == 0)
<p>No listings yet</p>
@endif --}}
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
@unless(count($listings)==0)
@foreach($listings as $listing)
    <x-listing-card :listing="$listing"/>
    {{-- <li>{{ $listing['title']}}</li> --}}
    {{-- <li>{{ $listing['description']}}</li> --}}
    {{-- <li><a href="/listings/{{ $listing['id']}}">Ver más</a></li> --}}
    {{-- <hr>
    <div class="bg-gray-50 border border-gray-200 rounded p-6 ">
        <div class="flex">
            <img
                class="hidden w-48 mr-6 md:block"
                src="{{asset('images/logo.jpg')}}"
                alt=""
            />
            <div>
                <h3 class="text-2xl">
                    <a href="/listings/{{ $listing->id}}">{{ $listing->title}}</a>
                </h3>
                <div class="text-xl font-bold mb-4">{{ $listing->company}}</div>
                <ul class="flex">
                    @php
                        $tags = explode("," , $listing->tags)
                    @endphp
                    @foreach($tags as $tag)
                    <li
                        class="flex  items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                    >
                        <a href="#">{{$tag}}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="text-lg mt-4">
                    <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
                </div>
            </div>
        </div>
    </div> --}}
@endforeach
@else
<p>No hay listings</p>
@endunless
<div>
    <div class="mt-6 p-4">
        {{$listings->links()}}
    </div>
</x-layout>