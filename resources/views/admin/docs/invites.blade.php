@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Invitații Utilizatori')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.docs.index'), 'name' => __('Documentație') ],
            [ 'name' => __('Invitații Utilizatori')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Cum să inviti utilizatori pe platforma ViaInfo") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <!-- Alerta -->
        <div class="rounded-md bg-yellow-50 p-4 mb-8 shadow-md">
            <div class="flex">
                <div class="shrink-0">
                    <svg class="w-5 h-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">{{ __("Atenție!") }}</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>{{ __("Din cauza unor probleme cu serviciul de trimitere de emailuri, unii utilizatori nu au primit invitația.") }}</p>
                        <p>{{ __("O soluție ar fi ca administratorii să trimită manual linkul de invitație utilizând opțiunea 'Copy link'.") }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-16">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __("Cum funcționează invitațiile utilizatorilor?") }}</h2>
            <p class="gtext-gray-600 leading-relaxed mb-4">
                {{ __("Invitațiile pentru utilizatori sunt trimise prin email. Când un utilizator primește invitația, va găsi un link în email-ul respectiv care îi va permite să își creeze un cont pe platformă. Utilizatorul va putea alege o parolă, iar contul va fi activat automat.") }}
            </p>
        </div>

        <div class="mb-16">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __("Pașii pentru a ajunge la pagina de invitații") }}</h2>
            <p class="gtext-gray-600 mb-4">{{ __("Pentru a ajunge la pagina de invitații utilizatori, urmează acești pași:") }}</p>
            <ol class="list-decimal pl-8 mb-4 gtext-gray-600">
                <li>{{ __("Din sidebar, accesează opțiunea 'Utilizatori'.") }}</li>
                <li>{{ __("Pe pagina cu utilizatori, apasă pe butonul 'Invitație' aflat deasupra tabelului cu utilizatori.") }}</li>
            </ol>
            <p class="gtext-gray-600 mb-4">{{ __("Pagina de invitații poate fi accesată și direct prin această rută: ") }}
                <a href="{{ route('admin.users.invitations.index') }}" class="text-blue-500 hover:underline">Link</a>
            </p>

            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ __("Pasul 1: Accesarea opțiunii 'Utilizatori'") }}</h3>
                <img src="{{ asset('/docs/admin/invites/step1.png') }}" alt="Accesarea utilizatori" class="w-full mb-8 rounded-lg shadow-lg">

                <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ __("Pasul 2: Apăsarea butonului 'Invitație'") }}</h3>
                <img src="{{ asset('/docs/admin/invites/step2.png') }}" alt="Buton invitație utilizatori" class="w-full rounded-lg shadow-lg">
            </div>
        </div>

        <div class="mb-16">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __("Cum să iei link-ul de invitație al unui utilizator") }}</h2>
            <p class="gtext-gray-600 mb-4">{{ __("Pentru a obține link-ul de invitație al unui utilizator, urmează acești pași:") }}</p>
            <ol class="list-decimal pl-8 mb-4 gtext-gray-600">
                <li>{{ __("Accesează meniul utilizatorului pentru care vrei să obții linkul de invitație.") }}</li>
                <li>{{ __("Apasă pe opțiunea 'Copy link'. Acest lucru va copia linkul în clipboard-ul tău.") }}</li>
            </ol>

            <div class="mt-8">
                <img src="{{ asset('/docs/admin/invites/step3.png') }}" alt="Accesare utilizator" class="w-full mb-4 rounded-lg shadow-lg">
            </div>
        </div>

        <div class="mb-16">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __("Cum să inviți un utilizator pe platformă") }}</h2>
            <p class="gtext-gray-600 mb-4">{{ __("Pentru a trimite o invitație unui utilizator, urmează acești pași:") }}</p>
            <ol class="list-decimal pl-8 mb-4 gtext-gray-600">
                <li>{{ __("Accesează meniul de adăugare a unui utilizator nou.") }}</li>
                <li>{{ __("Completează formularul cu informațiile necesare pentru utilizatorul care va primi invitația.") }}</li>
                <li>{{ __("Apasă pe butonul de trimitere pentru a crea invitația.") }}</li>
            </ol>

            <div class="mt-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ __("Pasul 1: Accesarea meniului de adăugare utilizator") }}</h3>
                <img src="{{ asset('/docs/admin/invites/step4.png') }}" alt="Meniu adăugare utilizator" class="w-full mb-8 rounded-lg shadow-lg">

                <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ __("Pasul 2: Completarea formularului de invitație") }}</h3>
                <img src="{{ asset('/docs/admin/invites/step5.png') }}" alt="Formular invitație utilizator" class="w-full rounded-lg shadow-lg">
            </div>
        </div>

    </x-layout>
@endsection
