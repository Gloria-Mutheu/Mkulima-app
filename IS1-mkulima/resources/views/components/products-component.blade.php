<!-- list of all existing fertilizers/equipment -->
<div class="flex flex-col sm:flex-row gap-3  shadow-sm shadow-gray-950  p-3 sm:p-5 ">
    <div class="relative sm:w-52 flex">
        <img class="w-100 object-cover rounded"
            src="{{ asset('storage/images/' . $imagePath . '/' . $product->image_file_path) }}" alt="product_image">
    </div>
    <div>
        <div class="flex flex-col">
            <div>
                <h2 class="text-xl font-bold pb-3">{{ $product->name }}</h2>
                <p class="text-md font-normal">Ksh {{ $product->price }} </p>
                <p class="text-md py-2">
                    {{ strlen($product->description) > 40 ? substr($product->description, 0, 40) . '...' : $product->description }}
                </p>

                <p class="text-sm">Created at: {{ $product->created_at }}</p>
            </div>
        </div>
        <div class="flex flex-row items-center gap-3 pt-3">
            <div>
                <form action="{{ route($deleteRoute . '.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ">
                        Delete
                    </button>
                </form>
            </div>
            <div>
                <a href="{{ url('/' . $deleteRoute . '/' . $product->id . '/edit') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">Update</a>
            </div>
        </div>
    </div>
</div>
