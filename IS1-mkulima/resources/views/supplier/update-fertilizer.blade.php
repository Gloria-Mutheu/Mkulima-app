<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class=" flex justify-center font-semibold text-xl text-gray-800 leading-tight">
                Update the fertilizer
            </h2>

        </div>
    </x-slot>
    <div class="flex flex-col items-center    ">
        <form action="{{ route('sup-fertilizer.update', $fertilizer->id) }}" method="POST" enctype="multipart/form-data" class="bg-white w-5/6 sm:w-fit flex relative px-3 sm:px-5 py-7 my-5 rounded-lg shadow-xl ">
            @csrf
            @method('PUT')
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
            <div class="flex flex-col space-y-4 relative w-full">
                <div class="flex flex-col py-2 ">
                    <label for="name" class="font-bold mb-0.5">Name</label>
                    <input type="text" placeholder="Enter Name" name="name" required :value="old('name')" class="border border-gray-300 px-3 py-2 rounded" value="{{$fertilizer->name}}">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="flex flex-col py-2">
                    <label for="description" class="font-bold mb-0.5">Description</label>
                    <input type="text" placeholder="Enter Description" name="description" required :value="old('description')" class="border border-gray-300 px-3 py-2 rounded" value="{{$fertilizer->description}}">
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="flex flex-col py-2">
                    <label for="price" class="font-bold mb-0.5">Price</label>
                    <input type="number" min="1" placeholder="Enter Price" name="price" required :value="old('price')" class="border border-gray-300 px-3 py-2 rounded" value="{{$fertilizer->price}}">
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div class="flex flex-col py-2">
                    <label for="image" class="font-bold mb-0.5">Image</label>
                    <input type="file" accept="image/*" name="image" required class="border border-gray-300 px-3 py-2 rounded" value="{{$fertilizer->image_file_path}}">

                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <button type="submit" class="bg-blue-500 text-white px-12 py-2 rounded mx-auto">Update</button>
            </div>
        </form>
    </div>

</x-app-layout>