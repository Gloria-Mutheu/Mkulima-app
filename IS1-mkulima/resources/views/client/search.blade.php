<x-app-layout>
    <div class="flex justify-center my-5">
        <div class="flex flex-col items-center bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold">Search Results</h1>
            <table class="table-auto border-collapse border border-green-800">
                <thead>
                    <tr>
                        <th class="border border-green-600 px-4 py-2">Name</th>
                        <th class="border border-green-600 px-4 py-2"> Price</th>
                        <th class="border border-green-600 px-4 py-2">Description</th>
                        <th class="border border-green-600 px-4 py-2">Image</th>
                        <th class="border border-green-600 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($searchData['fertilizers'] as $fertilizer)
                    <tr>
                        <td class="border border-green-600 px-4 py-2">{{ $fertilizer['name'] }}</td>
                        <td class="border border-green-600 px-4 py-2">Ksh {{ $fertilizer['price'] }}</td>
                        <td class="border border-green-600 px-4 py-2">{{ $fertilizer['description'] }}</td>
                        <td class="border border-green-600 px-4 py-2">
                            <img src="{{ asset('storage/images/fertilizers/' . $fertilizer['image_file_path']) }}"
                                alt="image" width="100px" height="100px">
                        </td>
                        <td class="border border-green-600 px-4 py-2">
                            <div flex flex-col>
                                <a href="{{ route('client-fertilizer.show', $fertilizer['id']) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    View
                                </a>
                                <!-- add to cart -->
                                <form action="{{ route('client.cart.store') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="fertilizer_id" value="{{ $fertilizer['id'] }}">
                                    <button type="submit"
                                        class="bg-blue_cart hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @foreach($searchData['equipment'] as $equipment)
                    <tr>
                        <td class="border border-green-600 px-4 py-2">{{ $equipment['name'] }}</td>
                        <td class="border border-green-600 px-4 py-2">Ksh {{ $equipment['hire_price'] }}</td>
                        <td class="border border-green-600 px-4 py-2">{{ $equipment['description'] }}</td>
                        <td class="border border-green-600 px-4 py-2">
                            <img src="{{ asset('storage/images/equipment/' . $equipment['image_file_path']) }}"
                                alt="image" width="100px" height="100px">
                        </td>
                        <td class="border border-green-600 px-4 py-2">
                            <div class="flex flex-col">
                                <div class="mt-3">
                                    <a href="{{ route('client-equipment.show', $equipment->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        View
                                    </a>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('client.hire-equipment', ['equipment_id' => $equipment->id]) }}"
                                        class="my-4">
                                        <button
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold rounded px-4 py-2">
                                            Hire Now
                                        </button>
                                    </a>
                                </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>