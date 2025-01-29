<x-app-layout>
    <x-slot name="header">
        <h2>
            Manage your fertilizers
        </h2>
    </x-slot>

    <!-- display success message after successful addition of fertilizer -->
    @if (session('success'))
        <div class="flex justify-center my-5">
            <div class="bg-green-100  text-green-700 px-6 py-1 rounded-md">
                <h1 class="text-xl font-bold ">{{ session('success') }}</h1>
            </div>
        </div>
    @endif


    <!-- display error message after unsuccessful addition of fertilizer -->
    @if (session('error'))
        <div class="flex justify-center my-5">
            <div class="bg-red-100  text-red-700 px-6 py-1 rounded-md">
                <h1 class="text-xl font-bold ">{{ session('error') }}</h1>
            </div>
        </div>
    @endif

    <!--add new fertilizer  -->
    <div class="flex justify-center  my-5  ">
        <div class="flex items-center bg-blue-700 rounded-lg shadow-xl   md:flex-row md:space-x-4">
            <a href="{{ url('/sup-fertilizer/create') }}"
                class="text-white text-xl hover:bg-white hover:text-blue-700 border border-blue-700 hover:border hover:border-blue-500 font-bold py-2 px-7 rounded ">
                <h1>Add fertilizer</h1>
            </a>
        </div>
    </div>
    <div class="grid grid-cols-auto-fit min-w-250 gap-7 p-3 sm:p-5">
        @foreach ($fertilizers as $fertilizer)
            <x-products-component :product="$fertilizer" image-path="fertilizers"
                delete-route="sup-fertilizer"></x-products-component>
        @endforeach
    </div>
</x-app-layout>
