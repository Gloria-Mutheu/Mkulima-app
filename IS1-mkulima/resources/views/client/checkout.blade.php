<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Make Order
        </h2>
    </x-slot>
    <div class="container-wrapper">
        <div>
            @csrf
            <!-- if any error, display it -->
            <p>
                @if (session('error'))
            <div class="bg-red-500 text-white p-4 mb-4">
                {{ session('error') }}
            </div>
            @endif
            </p>
            <div class="container">
                <h4 class=" py-3"><b>Total Items: </b> {{$data['totalItems']}}</h4>
                <h4 class=" py-3"><b>Total Quantity: </b> {{$data['totalQuantity']}}</h4>
                <h4 class=" py-3"><b>Total Price: </b>Ksh {{$data['totalPrice']}}</h4>
            </div>
        </div>
        <div class="flex justify-center items-center  mt-6">
            <form action="{{ route('client.order.store') }}" method="POST">
                @csrf
                <button type="submit" class="text-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Order Now
                </button>
            </form>
        </div>
    </div>

    <style>
        .container-wrapper {
            display: flex;
            flex-direction: column;
            margin: 1rem auto;
            max-width: 500px;
            border-radius: 7px;
            padding: 1rem;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
        }

        .container-wrapper .container {
            display: flex;
            width: 100%;
            margin: 1rem;
            flex-direction: column;
            max-width: 340px;
        }

        .container-wrapper .container label {
            display: flex;
            font-size: 1.2rem;
            color: black;
        }

        .container-wrapper .container input {
            border-radius: 7px;
            border: none;
            padding: 0.5rem;
            width: 150px;
        }

        .container-wrapper input:focus {
            outline: none;
        }

        .container-wrapper button {
            border-radius: 7px;
            margin: auto;
            border: none;
            padding: 0.5rem 1.5rem;
            background-color: #78C1F3 !important;
            color: black;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
        }

        .container-wrapper button:hover {
            background-color: #1E40AF !important;
            color: white;
        }

        .login {
            text-align: center;
            margin: 1rem auto;
        }

        .login a {
            color: #78C1F3;
            font-weight: bold;
        }
    </style>


</x-app-layout>