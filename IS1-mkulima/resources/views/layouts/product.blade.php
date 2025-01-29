<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$pageHeader}}
            </h2>
        </div>

    </x-slot>

    <!-- display success message after successful addition of fertilizer -->
    @if(session('success'))
    <div class="flex justify-center my-5">
        <div class="bg-green-100  text-green-700 px-6 py-1 rounded-md">
            <h1 class="text-xl font-bold ">{{ session('success') }}</h1>
        </div>
    </div>
    @endif


    <!-- display error message after unsuccessful addition of fertilizer -->
    @if(session('error'))
    <div class="flex justify-center my-5">
        <div class="bg-red-100  text-red-700 px-6 py-1 rounded-md">
            <h1 class="text-xl font-bold ">{{ session('error') }}</h1>
        </div>
    </div>
    @endif

    <!--choice to add new, update existing, delete existing, view existing fertilizers  -->
    <div class="flex justify-center  my-5  ">
        <div class="flex flex-col items-center bg-blue-700 rounded-lg shadow-xl   md:flex-row md:space-x-4">
            <a href="{{ route($createRoute) }}"
                class="text-white text-xl hover:bg-white hover:text-blue-700 border border-blue-700 hover:border hover:border-blue-500 font-bold py-2 px-7 rounded ">
                <h1>{{$action}}</h1>
            </a>
        </div>

    </div>

    <!-- list of all existing fertilizers -->
    <div class="grid grid-cols-auto-fit min-w-250 gap-7 p-3 sm:p-5">
        @foreach($products as $product)
        <div class="flex flex-col sm:flex-row gap-3  shadow-sm shadow-gray-950  p-3 sm:p-5 ">
            <div class="relative sm:w-52 flex">
                <img class="w-100 object-cover rounded" src="{{asset($imagePath . $product->image_file_path)}}"
                    alt="product_image">
            </div>
            <div>
                <div class="flex flex-col">
                    <div>
                        <h2 class="text-xl font-bold pb-3">{{$product->name}}</h2>
                        <p class="text-md font-normal">Ksh {{$product->price}} </p>
                        <p class="text-md py-2">{{$product->description}} </p>
                        <p class="text-sm">Created at: {{$product->created_at}}</p>
                    </div>
                </div>
                <div class="flex flex-row items-center gap-3 pt-3">
                    <div>
                        <form action="{{ route($deleteRoute, $fertilizer->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ">
                                Delete
                            </button>
                        </form>
                    </div>
                    <div>
                        <a href="{{ route($editRoute, $product->id) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">Update</a>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>