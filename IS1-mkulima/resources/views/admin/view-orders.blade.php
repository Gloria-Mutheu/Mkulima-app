<x-app-layout>
    <div class="flex justify-center my-5 flex-col">
        <div class="flex flex-col items-center bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold">All Fertilizer Orders</h1>
            <table class="table-auto border-collapse border border-green-800">
                <thead>
                    <tr>
                        <th class="border border-green-600 px-4 py-2"> Name</th>
                        <th class="border border-green-600 px-4 py-2"> Quantity</th>
                        <th class="border border-green-600 px-4 py-2">Total Price</th>
                        <th class="border border-green-600 px-4 py-2"> Description</th>
                        <th class="border border-green-600 px-4 py-2">Image</th>
                        <th class="border border-green-600 px-4 py-2">Supplier</th>
                        <th class="border border-green-600 px-4 py-2">Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="border border-green-600 px-4 py-2">{{$order['fertilizer']->name}}</td>
                        <td class="border border-green-600 px-4 py-2">{{$order->quantity}}</td>
                        <td class="border border-green-600 px-4 py-2">Ksh {{$order->total_price}}</td>
                        <td class="border border-green-600 px-4 py-2">{{$order['fertilizer']->description}}</td>
                        <td class="border border-green-600 px-4 py-2"><img
                                src="{{ asset('storage/images/fertilizers/'.$order['fertilizer']->image_file_path) }}"
                                alt="image" width="100px" height="100px"></td>
                        <td class="border border-green-600 px-4 py-2">
                            {{$order['fertilizer']['supplier']['user']['name'] }}
                        </td>
                        <td class="border border-green-600 px-4 py-2
            @if($order->status === 'pending')
                bg-yellow-300
            @elseif($order->status === 'complete')
                bg-green-300
            @endif
        ">
                            {{$order->status}}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-5">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>