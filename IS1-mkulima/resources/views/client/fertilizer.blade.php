<x-app-layout>
    <div class="flex justify-center my-5">
        <div class="flex flex-col items-center bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold">List of all existing fertilizers</h1>
            <table class="table-auto border-collapse border border-green-800">
                <thead>
                    <tr>
                        <th class="border border-green-600 px-4 py-2">Fertilizer Name</th>
                        <th class="border border-green-600 px-4 py-2">Fertilizer Price</th>
                        <th class="border border-green-600 px-4 py-2">Fertilizer Description</th>
                        <th class="border border-green-600 px-4 py-2">Fertilizer Image</th>
                        <th class="border border-green-600 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fertilizers as $fertilizer)
                    <tr>
                        <td class="border border-green-600 px-4 py-2">{{$fertilizer->name}}</td>
                        <td class="border border-green-600 px-4 py-2">Ksh {{$fertilizer->price}}</td>
                        <td class="border border-green-600 px-4 py-2">{{$fertilizer->description}}</td>
                        <td class="border border-green-600 px-4 py-2"><img
                                src="{{ asset('storage/images/fertilizers/'.$fertilizer->image_file_path) }}"
                                alt="image" width="100px" height="100px"></td>
                        <td class="border border-green-600 px-4 py-2">
                            <div flex flex-col>
                                <a href="{{ route('client-fertilizer.show', $fertilizer->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    View
                                </a>
                                <!-- add to cart -->
                                <form action="{{ route('client.cart.store') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="fertilizer_id" value="{{ $fertilizer->id }}">
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{ $fertilizers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>