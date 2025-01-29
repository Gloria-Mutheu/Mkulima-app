<x-app-layout>

    <div class="flex flex-col my-2 max-w-601 mx-auto items-center bg-white-500  pb-3">
        <div class="flex flex-col  bg-white px-4">
            <div class="flex flex-col items-left  overflow-hidden   p-2">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight underline">
                    View Equipment
                </h2>
            </div>
            <div class="flex flex-col items-left  overflow-hidden   py-2">
                <img src="{{ asset('storage/images/equipment/'.$equipment->image_file_path) }}" alt="image"
                    class="rounded" width="300px">
            </div>
            <div class="flex flex-col items-left  overflow-hidden   py-2">
                <h1 class="text-xl font-bold">{{$equipment->name}}</h1>
            </div>
            <div class="flex flex-col items-left  overflow-hidden   ">
                <h1 class="text-base "><b>Price:</b> Ksh {{$equipment->hire_price}}</h1>
            </div>

            <div class="flex flex-col items-left  overflow-hidden   ">
                <h1 class="text-base "><b>Description:</b> {{$equipment->description}}</h1>
            </div>

            <div class="flex flex-col items-left  overflow-hidden  py-2 ">
                <a href="{{ route('client.hire-equipment', ['equipment_id' => $equipment->id]) }}" class="my-4">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold rounded px-4 py-2">
                        Hire Now
                    </button>
                </a>

            </div>

        </div>
    </div>

</x-app-layout>