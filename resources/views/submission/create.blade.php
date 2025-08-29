<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Submission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('submission.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <h3 class="text-lg font-medium border-b border-gray-700 pb-2 mb-4">Receipt Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="receipt_no" class="block text-sm font-medium">Receipt No.</label>
                                    <input type="text" name="receipt_no" id="receipt_no" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                </div>
                                <div>
                                    <label for="receipt_date" class="block text-sm font-medium">Receipt Date</label>
                                    <input type="date" name="receipt_date" id="receipt_date" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                </div>
                                <div>
                                    <label for="name" class="block text-sm font-medium">Name</label>
                                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                </div>
                                <div>
                                    <label for="its_number" class="block text-sm font-medium">ITS Number</label>
                                    <input 
                                        type="text" 
                                        name="its_number" 
                                        id="its_number"
                                        class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700"
                                        maxlength="8" 
                                        pattern="[0-9]*"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    >
                                    <p id="its_message" class="mt-1 text-sm text-yellow-500" style="display: none;">ITS Number must be 8 digits.</p>

                                    @error('its_number')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
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
                                            <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="kh" class="block text-sm font-medium">Kh</label>
                                    <input type="number" name="kh" id="kh" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="0" step="0.01">
                                </div>
                                <div>
                                    <label for="nm" class="block text-sm font-medium">NM</label>
                                    <input type="number" name="nm" id="nm" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="0" step="0.01">
                                </div>
                                <div>
                                    <label for="khms" class="block text-sm font-medium">Khms</label>
                                    <input type="number" name="khms" id="khms" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="0" step="0.01">
                                </div>
                                <div>
                                    <label for="si" class="block text-sm font-medium">SI</label>
                                    <input type="number" name="si" id="si" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="0" step="0.01">
                                </div>
                                <div>
                                    <label for="mnt" class="block text-sm font-medium">Mnt</label>
                                    <input type="number" name="mnt" id="mnt" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="0" step="0.01">
                                </div>
                                <div>
                                    <label for="nyz" class="block text-sm font-medium">Nyz</label>
                                    <input type="number" name="nyz" id="nyz" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="0" step="0.01">
                                </div>
                                <div>
                                    <label for="nj" class="block text-sm font-medium">Nj</label>
                                    <input type="number" name="nj" id="nj" class="contribution-amount mt-1 block w-full rounded-md bg-gray-900 border-gray-700" value="0" step="0.01">
                                </div>
                            </div>
                            <div class="mt-4 text-right">
                                <label for="total_collection" class="block text-sm font-medium">Total Collection</label>
                                <input type="text" name="total_collection" id="total_collection" class="mt-1 inline-block w-auto rounded-md bg-gray-700 border-gray-600 text-lg font-bold" readonly>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium border-b border-gray-700 pb-2 mb-4">Mode of Payment</h3>
                            <select name="payment_mode" id="payment_mode" class="mt-1 block w-full rounded-md bg-gray-900 border-gray-700">
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                            </select>

                            <div id="cash_payment_details" class="mt-4">
                                </div>

                            <div id="cheque_payment_details" class="hidden mt-4">
                                <div id="cheque-list">
                                    </div>
                                <button type="button" id="add-cheque" class="mt-2 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Add Cheque</button>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-sum for contributions
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
        updateTotal();

        // Show/hide payment details
        const paymentModeSelect = document.getElementById('payment_mode');
        const cashDetails = document.getElementById('cash_payment_details');
        const chequeDetails = document.getElementById('cheque_payment_details');
        paymentModeSelect.addEventListener('change', function() {
            cashDetails.classList.toggle('hidden', this.value !== 'cash');
            chequeDetails.classList.toggle('hidden', this.value !== 'cheque');
        });

        // Add multiple cheques
        const addChequeBtn = document.getElementById('add-cheque');
        const chequeList = document.getElementById('cheque-list');
        let chequeIndex = 0;
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

        const itsInput = document.getElementById('its_number');
    const itsMessage = document.getElementById('its_message');

    itsInput.addEventListener('input', function() {
        if (this.value.length > 0 && this.value.length < 8) {
            itsMessage.style.display = 'block';
        } else {
            itsMessage.style.display = 'none';
        }
    });
    </script>
</x-app-layout>