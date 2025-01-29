<x-app-layout>

    <div class="border-b">
        <div class="max-w-7xl mx-auto">
            <div class=" overflow-hidden   p-5">
                <h1 class="text-xl sm:text-2xl font-bold">Welcome {{ Auth::user()->name }}</h1>
            </div>
        </div>
    </div>

    <!-- Create links to log in as supplier or client -->
    <div class="max-w-7xl mx-auto border-b">
        <div class="flex  flex-col items-center  overflow-hidden   p-5">
            <h1 class="text-xl sm:text-2xl font-bold">What would you like to do?</h1>
            <div class="flex justify-center flex-col sm:flex-row">
                <div class="p-3 sm:p-5 flex">
                    <a href="{{ route('supplier.dashboard') }}"
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Access Supplier Dashboard
                    </a>
                </div>
                <div class="p-3 sm:p-5 flex">
                    <a href="{{ route('client.create-client') }}"
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Access Client Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 px-5 py-4 ">
        <div class="mx-auto w-fit shadow-lg shadow-blue_primary_dark py-8 px-4 rounded-md">
            <h4 class="text-lg ">Supplier can add and sell fertilizers and equipments to clients </h4>
        </div>
        <div class=" mx-auto sm:mx-0 shadow-lg shadow-lime-900 w-fit py-8 px-4 rounded-md">
            <h4 class="text-lg ">Client can buy fertilizers and equipments from suppliers </h4>
        </div>
    </div>
</x-app-layout>