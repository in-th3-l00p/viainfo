@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Folosirea sistemului de prezente')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.docs.index'), 'name' => __('Documentație utilizator') ],
            [ 'name' => __('Folosirea sistemului de prezente') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Cum să utilizezi sistemul de prezență al platformei ViaInfo") }}
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
                        <p>{{ __("Este important să alegi corect modul de marcare a prezenței în momentul creării evenimentului.") }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <h3 class="text-xl font-semibold">{{ __("Cuprins") }}</h3>
            <ul class="list-inside list-decimal text-sm text-gray-600">
                <li><a href="#crearea-evenimentului" class="text-blue-500 hover:underline">{{ __("Crearea unui eveniment și selectarea modului de marcare a prezenței") }}</a></li>
                <li><a href="#oferta-cod-participare" class="text-blue-500 hover:underline">{{ __("Oferirea codului de participare anonimă") }}</a></li>
                <li><a href="#elev-participare-anonima" class="text-blue-500 hover:underline">{{ __("Cum se vede evenimentul cu participare anonimă din perspectiva unui elev") }}</a></li>
            </ul>
        </div>

        <div class="mb-8" id="crearea-evenimentului">
            <h3 class="text-xl font-semibold mb-4">{{ __("Crearea unui eveniment și selectarea modului de marcare a prezenței") }}</h3>
            <p class="mb-4">{{ __("Pentru a crea un eveniment în cadrul unei clase, accesează pagina clasei respective și apasă pe butonul de creare eveniment. Aici, vei putea selecta între două moduri de marcare a prezenței:") }}</p>
            <ul class="list-inside list-disc mb-4">
                <li><strong>{{ __("Modul obișnuit") }}:</strong> Profesorii vor marca prezența sau absența fiecărui elev din panoul de absente ale evenimentului.</li>
                <li><strong>{{ __("Participare anonimă") }}:</strong> Profesorul oferă un cod de participare, iar elevii se marchează singuri drept prezenți folosind acest cod.</li>
            </ul>
            <p class="mb-4">{{ __("După completarea formularului de creare eveniment, asigură-te că ai selectat tipul de marcare a prezenței dorit. Aici vei găsi un exemplu de cum arată formularul de creare eveniment și opțiunea de alegere a tipului de prezență:") }}</p>
            <img src="/docs/admin/attendance/step1.png" alt="Formular creare eveniment" class="w-full mb-8 rounded-lg shadow-lg">
        </div>

        <div class="mb-8" id="oferta-cod-participare">
            <h3 class="text-xl font-semibold mb-4">{{ __("Oferirea codului de participare anonimă") }}</h3>
            <p class="mb-4">{{ __("După ce evenimentul a fost creat, apare opțiunea de a oferi codul de participare anonimă. Accesează evenimentul creat și apasă pe butonul de 'Afișează codul de participare'. Aceasta va deschide o pagină unde va fi afișat codul pe care elevii îl vor folosi pentru a se marca prezenți.") }}</p>
            <img src="/docs/admin/attendance/step2.png" alt="Buton pentru afișarea codului de participare" class="w-full mb-8 rounded-lg shadow-lg">
        </div>

        <div class="mb-8" id="elev-participare-anonima">
            <h3 class="text-xl font-semibold mb-4">{{ __("Cum se vede evenimentul cu participare anonimă din perspectiva unui elev") }}</h3>
            <p class="mb-4">{{ __("Pentru un elev, în intervalul de timp în care evenimentul are loc, pe tabul de evenimente al clasei va apărea un buton care permite elevului să introducă codul de participare. După ce apasă pe buton, elevul va fi redirecționat către o pagină unde poate introduce codul pentru a marca prezența.") }}</p>
            <img src="/docs/admin/attendance/step3.png" alt="Perspectiva elevului la evenimentul cu participare anonimă" class="w-full mb-8 rounded-lg shadow-lg">
        </div>
    </x-layout>
@endsection
