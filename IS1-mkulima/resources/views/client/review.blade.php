<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class=" flex justify-center font-semibold text-xl text-gray-800 leading-tight">
                Add review
            </h2>
        </div>
        <div class="flex justify-center  my-5  ">
            <div class="flex flex-col items-center bg-white rounded-lg shadow-xl px-12 py-7">
                <form action="{{ route('client.review-fertilizer.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- if any error, display it -->
                    <p>
                        @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 mb-4">
                        @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                        @endforeach
                    </div>
                    @endif
                    </p>

                    <!-- success message if it 's ther -->
                    <p>
                        @if(session()->has('success'))
                    <div class="bg-green-500 text-white p-4 mb-4">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    </p>

                    <div class="container mx-auto">
                        <div class="flex flex-col space-y-4">
                            <div class="flex flex-col py-2">
                                <label for="name" class="font-bold mb-0.5">Review</label>
                                <textarea type="text" placeholder="Write your review" name="comment" required
                                    :value="old('name')" class="border border-gray-300 px-1 py-2 rounded"></textarea>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-12 py-2 rounded mx-auto">Add
                                Review</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <style>
        .fertilizers,
        .equipment {
            font-size: 1.3rem;
            font-weight: bold;
            color: #1E40AF;
        }

        .fertilizers:hover,
        .equipment:hover {
            color: #78C1F3;
        }
        </style>
    </x-slot>
</x-app-layout>