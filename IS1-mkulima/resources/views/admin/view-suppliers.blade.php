<x-app-layout>
    <div class="flex justify-center my-5 flex-col">
        <div class="flex flex-col items-center bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold">All Suppliers</h1>
            <table class="table-auto border-collapse border border-green-800">
                <thead>
                    <tr>
                        <th class="border border-green-600 px-4 py-2"> Name</th>
                        <th class="border border-green-600 px-4 py-2"> Email</th>
                        <th class="border border-green-600 px-4 py-2">Phone Number</th>
                        <th class="border border-green-600 px-4 py-2"> Address</th>
                        <th class="border border-green-600 px-4 py-2">Username</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td class="border border-green-600 px-4 py-2">{{$supplier['user']->name}}</td>
                        <td class="border border-green-600 px-4 py-2">{{$supplier['user']->email}}</td>
                        <td class="border border-green-600 px-4 py-2">Ksh {{$supplier->phone_number}}</td>
                        <td class="border border-green-600 px-4 py-2">{{$supplier->address}}</td>
                        <td class="border border-green-600 px-4 py-2">{{$supplier['user']->username}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-5">
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>