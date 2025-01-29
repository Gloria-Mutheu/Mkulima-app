<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Choose your category
        </h2>
    </x-slot>
    <div class="flex flex-col gap-4 bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
        <a href="{{url('/client-fertilizer')}}"
            class=" fertilizers hover:bg-blue-700 hover:text-white-700   font-bold py-2 px-4 rounded">
            <h1>
                View Fertilizers
            </h1>

        </a>
        <a href="{{url('/client-equipment')}}"
            class=" equipment hover:bg-blue-700 hover:text-white  font-bold py-2 px-4 rounded">
            <h1>
                View Equipment
            </h1>
        </a>
    </div>


</x-app-layout>