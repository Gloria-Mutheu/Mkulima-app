<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight relative z-50">
            Manage your products
        </h2>
    </x-slot>
    <div class="  flex flex-col sm:rounded-lg p-5 items-center relative z-50">

        <div class="flex flex-col gap-y-4 bg-black p-6 rounded-md bg-opacity-30">
            <a href="{{url('/sup-fertilizer')}} " class="bg-white flex flex-row gap-2 items-center shadow-sm shadow-emerald-800 hover:bg-blue-700 hover:text-white text-blue-500  font-bold py-2 px-4 rounded text-2xl w-72 ">
                <h1>
                    Manage Fertilizers
                </h1>
                <i class="fa-solid fa-up-right-from-square text-xl"></i>

            </a>
            <a href="{{url('/sup-equipment')}} " class="bg-white  flex flex-row gap-2 items-center shadow-sm shadow-emerald-800 hover:bg-blue-700 hover:text-white text-blue-500 font-bold py-2 px-4 rounded text-2xl w-72">
                <h1>
                    Manage Equipment
                </h1>
                <i class="fa-solid fa-up-right-from-square text-xl"></i>
            </a>
            <a href="{{route('supplier.order.index')}} " class=" bg-white flex flex-row gap-2 items-center shadow-sm shadow-emerald-800 hover:bg-blue-700 hover:text-white text-blue-500 font-bold py-2 px-4 rounded text-2xl w-72">
                <h1>
                    Manage Orders
                </h1>
                <i class="fa-solid fa-up-right-from-square text-xl"></i>
            </a>
        </div>
    </div>
    <div class="absolute flex top-0 w-full h-screen justify-center items-end z-0 ">
        <img class="w-96 lg:w-2/4 opacity-70 animate-pulse" src="/images/tracktor.webp" alt="">
    </div>
</x-app-layout>