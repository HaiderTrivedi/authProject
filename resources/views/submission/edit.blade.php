<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Submission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('submission.update', $submission) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h3 class="text-lg font-medium border-b border-gray-700 pb-2 mb-4">Receipt Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="receipt_no" class="block text-sm font-medium">Receipt No.</label>
                                    <input type="text" name="receipt_no" id="receipt_no" value="{{ old('receipt_no', $submission->receipt_no) }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                </div>
                                <div>
                                    <label for="receipt_date" class="block text-sm font-medium">Receipt Date</label>
                                    <input type="date" name="receipt_date" id="receipt_date" value="{{ old('receipt_date', $submission->receipt_date) }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                </div>
                                <div>
                                    <label for="name" class="block text-sm font-medium">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $submission->name) }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                </div>
                                <div>
                                    <label for="its_number" class="block text-sm font-medium">ITS Number</label>
                                    <input type="text" name="its_number" id="its_number" value="{{ old('its_number', $submission->its_number) }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium border-b border-gray-700 pb-2 mb-4">Financial Contributions</h3>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label for="currency_id" class="block text-sm font-medium">Currency</label>
                                    <select name="currency_id" id="currency_id" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}" {{ $submission->currency_id == $currency->id ? 'selected' : '' }}>{{ $currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="kh" class="block text-sm font-medium">Kh</label>
                                    <input type="number" name="kh" id="kh" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="{{ old('kh', $submission->kh) }}" step="0.01">
                                </div>
                                <div>
                                    <label for="nm" class="block text-sm font-medium">NM</label>
                                    <input type="number" name="nm" id="nm" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="{{ old('nm', $submission->nm) }}" step="0.01">
                                </div>
                                <div>
                                    <label for="khms" class="block text-sm font-medium">Khms</label>
                                    <input type="number" name="khms" id="khms" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="{{ old('khms', $submission->khms) }}" step="0.01">
                                </div>
                                <div>
                                    <label for="si" class="block text-sm font-medium">SI</label>
                                    <input type="number" name="si" id="si" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="{{ old('si', $submission->si) }}" step="0.01">
                                </div>
                                <div>
                                    <label for="mnt" class="block text-sm font-medium">Mnt</label>
                                    <input type="number" name="mnt" id="mnt" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="{{ old('mnt', $submission->mnt) }}" step="0.01">
                                </div>
                                <div>
                                    <label for="nyz" class="block text-sm font-medium">Nyz</label>
                                    <input type="number" name="nyz" id="nyz" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="{{ old('nyz', $submission->nyz) }}" step="0.01">
                                </div>
                                <div>
                                    <label for="nj" class="block text-sm font-medium">Nj</label>
                                    <input type="number" name="nj" id="nj" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="{{ old('nj', $submission->nj) }}" step="0.01">
                                </div>
                            </div>
                             <div class="mt-4 text-right">
                                <label for="total_collection" class="block text-sm font-medium">Total Collection</label>
                                <input type="text" name="total_collection" id="total_collection" value="{{ old('total_collection', $submission->total_collection) }}" class="mt-1 inline-block w-auto rounded-md bg-gray-700 border-gray-600 text-lg font-bold" readonly>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium border-b border-gray-700 pb-2 mb-4">Mode of Payment</h3>
                            <select name="payment_mode" id="payment_mode" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                <option value="cash" {{ $submission->payment_mode == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="cheque" {{ $submission->payment_mode == 'cheque' ? 'selected' : '' }}>Cheque</option>
                            </select>

                            <div id="cheque_payment_details" class="{{ $submission->payment_mode == 'cheque' ? '' : 'hidden' }} mt-4">
                                <div id="cheque-list">
                                    @foreach($submission->cheques as $index => $cheque)
                                    <div class="p-4 border border-gray-700 rounded-md mb-2">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div><label class="block text-sm">Payee Name</label><input type="text" name="cheques[{{ $index }}][payee_name]" value="{{ $cheque->payee_name }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700"></div>
                                            <div><label class="block text-sm">Payer Name</label><input type="text" name="cheques[{{ $index }}][payer_name]" value="{{ $cheque->payer_name }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700"></div>
                                            <div><label class="block text-sm">Date</label><input type="date" name="cheques[{{ $index }}][date]" value="{{ $cheque->date }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700"></div>
                                            <div><label class="block text-sm">Amount</label><input type="number" name="cheques[{{ $index }}][amount]" value="{{ $cheque->amount }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700" step="0.01"></div>
                                            <div><label class="block text-sm">Cheque Number</label><input type="text" name="cheques[{{ $index }}][cheque_number]" value="{{ $cheque->cheque_number }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700"></div>
                                            <div><label class="block text-sm">Currency</label><select name="cheques[{{ $index }}][currency_id]" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                                @foreach($currencies as $currency)
                                                    <option value="{{ $currency->id }}" {{ $cheque->currency_id == $currency->id ? 'selected' : '' }}>{{ $currency->code }}</option>
                                                @endforeach
                                            </select></div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-cheque" class="mt-2 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Add Cheque</button>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">Update Submission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Same JavaScript as the create page, with a starting index for new cheques
        const contributionInputs = document.querySelectorAll('.contribution-amount');
        const totalInput = document.getElementById('total_collection');

        function updateTotal() {
            let total = 0;
            contributionInputs.forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            totalInput.value = total.toFixed(2);
        }
        contributionInputs.forEach(input => input.addEventListener('input', updateTotal));

        const paymentModeSelect = document.getElementById('payment_mode');
        const chequeDetails = document.getElementById('cheque_payment_details');
        paymentModeSelect.addEventListener('change', function() {
            chequeDetails.classList.toggle('hidden', this.value !== 'cheque');
        });

        const addChequeBtn = document.getElementById('add-cheque');
        const chequeList = document.getElementById('cheque-list');
        let chequeIndex = {{ $submission->cheques->count() }}; // Start index from existing cheques
        addChequeBtn.addEventListener('click', function() {
            const chequeBlock = document.createElement('div');
            chequeBlock.classList.add('p-4', 'border', 'border-gray-700', 'rounded-md', 'mb-2');
            chequeBlock.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm">Payee Name</label><input type="text" name="cheques[${chequeIndex}][payee_name]" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700"></div>
                    <div><label class="block text-sm">Payer Name</label><input type="text" name="cheques[${chequeIndex}][payer_name]" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700"></div>
                    <div><label class="block text-sm">Date</label><input type="date" name="cheques[${chequeIndex}][date]" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700"></div>
                    <div><label class="block text-sm">Amount</label><input type="number" name="cheques[${chequeIndex}][amount]" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700" step="0.01"></div>
                    <div><label class="block text-sm">Cheque Number</label><input type="text" name="cheques[${chequeIndex}][cheque_number]" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700"></div>
                    <div><label class="block text-sm">Currency</label><select name="cheques[${chequeIndex}][currency_id]" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">${document.getElementById('currency_id').innerHTML}</select></div>
                </div>
            `;
            chequeList.appendChild(chequeBlock);
            chequeIndex++;
        });
    </script>
</x-app-layout>