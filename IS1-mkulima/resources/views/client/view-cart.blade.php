<x-app-layout>
    <div class="flex justify-center my-5 flex-col">
        <div class="flex flex-col items-center bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <!-- if any error, display it -->
            <p>
                @if (session('error'))
            <div class="bg-red-500 text-white p-2 mb-4">
                {{ session('error') }}
            </div>
            @endif
            </p>

            <!-- if any success message, display it -->
            <p>
                @if (session('success'))
            <div class="bg-green-500 text-white p-2 mb-4">
                {{ session('success') }}
            </div>
            @endif
            </p>
            <h1 class="text-2xl font-bold">Cart Items</h1>
            <table class="table-auto border-collapse border border-green-800">
                <thead>
                    <tr>
                        <th class="border border-green-600 px-4 py-2">Fertilizer Name</th>
                        <th class="border border-green-600 px-4 py-2">Fertilizer Description</th>
                        <th class="border border-green-600 px-4 py-2">Fertilizer Image</th>
                        <th class="border border-green-600 px-4 py-2">Quantity</th>
                        <th class="border border-green-600 px-4 py-2">Total Amount</th>
                        <th class="border border-green-600 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                    <tr>
                        <td class="border border-green-600 px-4 py-2">{{$cart['fertilizer'] [0]['name']}}</td>
                        <td class="border border-green-600 px-4 py-2">{{$cart['fertilizer'] [0]['description']}}</td>
                        <td class="border border-green-600 px-4 py-2"><img src="{{ asset('storage/images/fertilizers/'.$cart['fertilizer'][0]['image_file_path']) }}" alt="image" width="100px" height="100px"></td>
                        <td class="border border-green-600 px-4 py-2">
                            <form action="{{ route('client.cart.update', $cart->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" id="quantity" value="{{$cart->quantity}}" class="border border-green-600 px-4 py-2" min="1" max="100">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Update Quantity
                                </button>
                            </form>
                        </td>
                        <td class="border border-green-600 px-4 py-2">Ksh {{$cart->total_price}}</td>
                        <td class="border border-green-600 px-4 py-2">
                            <div flex flex-col>
                                <form action="{{ route('client.cart.destroy', $cart->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Remove
                                    </button>
                                </form>
                            </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-center items-center  mt-6">
            <button class="text-center">
                <a href="{{ route('client.checkout.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Checkout
                </a>
            </button>
        </div>

    </div>
</x-app-layout>