<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Equipment hired successfully
        </h2>
    </x-slot>
    <div>
        <form method="POST" action="{{ route('client.hire-equipment.store') }}">
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
                <h4 class=" py-3"><b>Equipment: </b> {{$hireDetails['equipment']->name}}</h4>
                <h4 class=" py-3"><b>Total Price: </b> {{$hireDetails->total_price}}</h4>
                <h4 class=" py-3"><b>Status: </b> {{$hireDetails->status}}</h4>
                <h4 class=" py-3"><b>Hire from: </b> {{$hireDetails->from}}</h4>
                <h4 class=" py-3"><b>Return date: </b> {{$hireDetails->to}}</h4>
            </div>
        </form>

        <style>
            form {
                display: flex;
                flex-direction: column;
                margin: 1rem auto;
                max-width: 500px;
                border-radius: 7px;
                padding: 1rem;
                box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
            }

            form .container {
                display: flex;
                width: 100%;
                margin: 1rem;
                flex-direction: column;
                max-width: 340px;
            }

            form .container label {
                display: flex;
                font-size: 1.2rem;
                color: black;
            }

            form .container input {
                border-radius: 7px;
                border: none;
                padding: 0.5rem;
                width: 150px;
            }

            form input:focus {
                outline: none;
            }

            form button {
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

            form button:hover {
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