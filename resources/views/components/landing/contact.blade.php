<div
    class="relative isolate bg-white"
    id="{{ __("contact") }}"
>
    <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
        <div class="relative px-6 pb-20 pt-24 sm:pt-32 lg:static lg:px-8 lg:py-48">
            <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
                <div class="absolute inset-y-0 left-0 -z-10 w-full overflow-hidden bg-gray-100 ring-1 ring-gray-900/10 lg:w-1/2">
                    <svg class="absolute inset-0 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
                        <defs>
                            <pattern id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="100%" y="-1" patternUnits="userSpaceOnUse">
                                <path d="M130 200V.5M.5 .5H200" fill="none" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" stroke-width="0" fill="white" />
                        <svg x="100%" y="-1" class="overflow-visible fill-gray-50">
                            <path d="M-470.5 0h201v201h-201Z" stroke-width="0" />
                        </svg>
                        <rect width="100%" height="100%" stroke-width="0" fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">{{ __("Contactează-ne") }}</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Vrem să auzim de la tine! Dacă ai întrebări despre programul nostru, doriți să colaborezi, sau ai nevoie de informații suplimentare despre cursurile de informatică, completează formularul de mai jos. Echipa ViaInfo este aici pentru a te ajuta!
                </p>
            </div>
        </div>
        <form
            action="{{ route("contact.store") }}"
            method="POST"
            class="px-6 pb-24 pt-20 sm:pb-32 lg:px-8 lg:py-48"
        >
            @csrf
            <div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-sm font-semibold leading-6 text-gray-900">{{ __("Nume") }} *</label>
                        <div class="mt-2.5">
                            <input
                                type="text"
                                name="first_name"
                                id="first_name"
                                autocomplete="given_name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                            >
                        </div>
                        @error("first_name")
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold leading-6 text-gray-900">{{ __("Prenume") }} *</label>
                        <div class="mt-2.5">
                            <input type="text" name="last_name" id="last_name" autocomplete="family_name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                        @error("last_name")
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email *</label>
                        <div class="mt-2.5">
                            <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="phone_number" class="block text-sm font-semibold leading-6 text-gray-900">{{ __("Număr de telefon") }}</label>
                        <div class="mt-2.5">
                            <input type="tel" name="phone_number" id="phone_number" autocomplete="tel" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                        @error("email")
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">{{ __("Mesaj") }} *</label>
                        <div class="mt-2.5">
                            <textarea name="message" id="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        @error("message")
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-8 flex justify-end">
                    <button
                        type="submit"
                        class="rounded-md bg-blue-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                    >
                        {{ __("Trimite") }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
