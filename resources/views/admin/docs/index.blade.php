@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Documentație utilizator')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'name' => __('Documentație utilizator')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Informații esențiale pentru utilizarea platformei ViaInfo") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div class="mb-16">
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
                            <p>{{ __("Opțiunea este documentată în pagina din documentație intitulată \"Invitații utilizatori pe platformă\"") }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secțiune Invitare Utilizatori -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800">{{ __("Invitatie utilizatori pe platformă") }}</h3>
                <p class="text-sm text-gray-600 mb-2">{{ __("În această secțiune vei învăța cum să inviți noi utilizatori pe platformă și cum să gestionezi invitațiile acestora.") }}</p>
                <a href="{{ route("admin.docs.invites") }}" class="text-blue-600 hover:underline text-sm">{{ __("Vezi detalii") }}</a>
            </div>

            <!-- Secțiune Sisteme de Prezență -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800">{{ __("Folosirea sistemului de prezente") }}</h3>
                <p class="text-sm text-gray-600 mb-2">{{ __("Vezi cum funcționează sistemul de monitorizare a prezenței utilizatorilor pe platformă și cum să-l utilizezi eficient.") }}</p>
                <a href="{{ route("admin.docs.attendance") }}" class="text-blue-600 hover:underline text-sm">{{ __("Vezi detalii") }}</a>
            </div>

        </div>

    </x-layout>
@endsection
