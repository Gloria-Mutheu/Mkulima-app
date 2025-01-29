<x-app-layout>
    <div class="flex justify-center my-5 flex-col">
        <div class="  flex space-x-3 bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <a href="{{route('client.hire-equipment.index')}}"
                class=" fertilizers hover:bg-blue-700 hover:text-white  font-bold py-2 px-4 rounded">
                <h1>
                    Viewed Hired Equipments
                </h1>

            </a>

        </div>
        <div class="flex flex-col items-center bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold">List of all existing equipments</h1>
            <table class="table-auto border-collapse border border-green-800">
                <thead>
                    <tr>
                        <th class="border border-green-600 px-4 py-2">Equipment Name</th>
                        <th class="border border-green-600 px-4 py-2">Equipment Hire Price</th>
                        <th class="border border-green-600 px-4 py-2">Equipment Description</th>
                        <th class="border border-green-600 px-4 py-2">Equipment Image</th>
                        <th class="border border-green-600 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipments as $equipment)
                    <tr>
                        <td class="border border-green-600 px-4 py-2">{{$equipment->name}}</td>
                        <td class="border border-green-600 px-4 py-2">Ksh {{$equipment->hire_price}}</td>
                        <td class="border border-green-600 px-4 py-2">{{$equipment->description}}</td>
                        <td class="border border-green-600 px-4 py-2"><img
                                src="{{ asset('storage/images/equipment/'.$equipment->image_file_path) }}" alt="image"
                                width="100px" height="100px"></td>
                        <td class="border border-green-600 px-4 py-2">
                            <div class="flex flex-col">
                                <a href="{{ route('client-equipment.show', $equipment->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    View
                                </a>
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
            <div class="mt-5">
                {{ $equipments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>