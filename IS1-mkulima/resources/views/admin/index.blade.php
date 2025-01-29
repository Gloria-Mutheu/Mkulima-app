<x-app-layout>

    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl  p-5">
                <h1 class="text-2xl font-bold">Welcome {{ Auth::user()->name }}</h1>
            </div>
        </div>
    </div>

    <!-- Create links to log in as supplier or client -->
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="flex  flex-col items-center bg-white overflow-hidden shadow-xl  p-5">
                <h1 class="text-2xl font-bold">What would you like to do?</h1>
                <div class="flex justify-center flex-col">
                    <div class="p-5">
                        <a href="{{ route('admin.view-orders') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            View Orders
                        </a>
                    </div>
                    <div class="p-5">
                        <a href="{{ route('admin.view-suppliers') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            View Suppliers
                        </a>
                    </div>
                    <div class="p-5">
                        <a href="{{ route('admin.view-clients') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            View Clients
                        </a>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>