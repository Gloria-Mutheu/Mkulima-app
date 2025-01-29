<x-app-layout>

    <div class="flex flex-col my-2   items-center bg-white-500  pb-3">
        <div class="flex flex-col   bg-white px-12">
            <div class="flex flex-col items-left  overflow-hidden   p-2">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight underline">
                    View Fertilizer
                </h2>
            </div>
            <div class="flex flex-col items-left  overflow-hidden   py-2">
                <img src="{{ asset('storage/images/fertilizers/'.$fertilizer->image_file_path) }}" alt="image"
                    class="rounded" width="300px">
            </div>
            <div class="flex flex-col items-left  overflow-hidden   py-2">
                <h1 class="text-xl font-bold">{{$fertilizer->name}}</h1>
            </div>
            <div class="flex flex-col items-left  overflow-hidden   ">
                <h1 class="text-base font-bold">Price: Ksh {{$fertilizer->price}}</h1>
            </div>

            <div class="flex flex-col items-left  overflow-hidden   ">
                <h1 class="text-base font-bold">Description: {{$fertilizer->description}}</h1>
            </div>

            <div class="flex flex-col items-left  overflow-hidden  py-2 ">
                <form action="{{ route('client.cart.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="fertilizer_id" value="{{ $fertilizer->id }}">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add to cart
                    </button>
                </form>

            </div>
            <hr>

            <div class="flex flex-col items-left  overflow-hidden   p-2 mt-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight underline">
                    Reviews
                </h2>
                @if ($reviews->count() > 0)
                @foreach ($reviews as $review)
                <div class="flex flex-col items-left  overflow-hidden py-2">
                    <h4 class="text-xl  mx-2"> {{$review->client_name }}: <span class=" mx-2"> {{$review->comment }}
                        </span>
                    </h4>

                </div>
                @endforeach
                @else

                <div class="flex flex-col items-left  overflow-hidden ">
                    <em class="text-xl font-bold"> No reviews yet </em>
                </div>

                @endif
            </div>
        </div>
    </div>


</x-app-layout>