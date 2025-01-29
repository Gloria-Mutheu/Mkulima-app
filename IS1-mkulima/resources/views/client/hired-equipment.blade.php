<x-app-layout>
    <div class="flex justify-center my-5 flex-col">

        <div class="flex flex-col items-center bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <h1 class="text-2xl font-bold">List of all existing equipments</h1>
            <table class="table-auto border-collapse border border-green-800">
                <thead>
                    <tr>
                        <th class="border border-green-600 px-4 py-2">Equipment Name</th>
                        <th class="border border-green-600 px-4 py-2">Equipment Hire Price</th>
                        <th class="border border-green-600 px-4 py-2">Equipment Description</th>
                        <th class="border border-green-600 px-4 py-2">Equipment Image</th>
                        <th class="border border-green-600 px-4 py-2">Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($hireDetails as $hireDetail)
                    <tr>
                        <td class="border border-green-600 px-4 py-2">{{$hireDetail['equipment']->name}}</td>
                        <td class="border border-green-600 px-4 py-2">Ksh {{$hireDetail->total_price}}</td>
                        <td class="border border-green-600 px-4 py-2">{{$hireDetail['equipment']->description}}</td>
                        <td class="border border-green-600 px-4 py-2"><img
                                src="{{ asset('storage/images/equipment/'.$hireDetail['equipment']->image_file_path) }}"
                                alt="image" width="100px" height="100px"></td>
                        <td class="border border-green-600 px-4 py-2">
                            {{$hireDetail->status}}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{ $hireDetails->links() }}
            </div>
        </div>
    </div>
</x-app-layout>