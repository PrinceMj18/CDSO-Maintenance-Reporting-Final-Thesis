<div
    id="materialsModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">

```
<div class="w-full max-w-3xl overflow-hidden rounded-xl border border-gray-200 bg-white shadow-2xl">

    <!-- Header -->
    <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">

        <h2 class="text-xl font-semibold text-gray-800">
            Materials Used
        </h2>

        <button
            type="button"
            id="closeModal"
            class="text-2xl text-gray-400 transition-colors hover:text-red-500">
            &times;
        </button>

    </div>


    <!-- Body -->
    <div class="p-6">

        <!-- No Material Used -->
        <div class="mb-5 flex items-center gap-2">

            <input
                type="checkbox"
                id="noMaterial"
                name="no_material"
                value="1"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">

            <label
                for="noMaterial"
                class="text-sm font-medium text-gray-700">

                No material used

            </label>

        </div>


        <!-- Materials Container -->
        <div id="materialsContainer">

            <table class="w-full text-sm">

                <thead>

                    <tr class="border-b border-gray-200">

                        <th class="py-3 text-left font-semibold text-gray-700">
                            Material
                        </th>

                        <th class="w-32 py-3 text-left font-semibold text-gray-700">
                            Quantity
                        </th>

                        <th class="w-20"></th>

                    </tr>

                </thead>


                <tbody id="materialsTable">

                    <tr class="material-row">

                        <td class="pr-2 pb-3">

                            <select
                                name="item_id[]"
                                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">

                                @foreach($inventoryItems as $item)

                                    <option value="{{ $item->id }}">

                                        {{ $item->name }}
                                        ({{ $item->quantity }} {{ $item->unit }})

                                    </option>

                                @endforeach

                            </select>

                        </td>


                        <td class="pb-3">

                            <input
                                type="number"
                                min="1"
                                value="1"
                                name="quantity_used[]"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">

                        </td>


                        <td class="pb-3 text-center">

                            <button
                                type="button"
                                class="removeRow font-medium text-red-600 transition-colors hover:text-red-700">

                                Remove

                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>


            <!-- Add Material -->
            <button
                type="button"
                id="addRow"
                class="mt-5 rounded-lg bg-slate-700 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-slate-800">

                + Add Material

            </button>

        </div>

    </div>


    <!-- Footer -->
    <div class="flex justify-end gap-3 rounded-b-xl border-t border-gray-200 bg-gray-50 px-6 py-4">

        <button
            type="button"
            id="cancelModal"
            class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-700 transition-colors hover:bg-gray-100">

            Cancel

        </button>


        <button
            type="submit"
            class="rounded-lg bg-indigo-600 px-4 py-2 font-medium text-white transition-colors hover:bg-indigo-700">

            Complete Request

        </button>

    </div>

</div>
```

</div>
