@extends("layouts.main")

@section("content")
    <div class="bg-white">
        <x-landing.header />
        <main class="max-w-4xl mx-auto p-6 space-y-6 pt-32 pb-16">
            <section>
                <h2 class="text-2xl font-semibold text-blue-600">Introducere</h2>
                <p class="text-lg">În această politică de confidențialitate, vă vom explica cum colectăm, utilizăm și protejăm datele dumneavoastră personale atunci când utilizați platforma "viainfo". Ne angajăm să protejăm confidențialitatea utilizatorilor noștri și să respectăm legislația în vigoare privind protecția datelor personale.</p>
            </section>

            <section>
                <h2 class="text-2xl font-semibold text-blue-600">Ce date colectăm?</h2>
                <p class="text-lg">Colectăm următoarele tipuri de date personale:</p>
                <ul class="list-disc pl-6 space-y-2 text-lg">
                    <li>Informații de contact: nume, adresă de e-mail, număr de telefon;</li>
                    <li>Informații de utilizare a platformei: comportament pe site, preferințe, activități de navigare;</li>
                    <li>Informații tehnice: adresa IP, tipul dispozitivului, browser-ul utilizat, data și ora accesării.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-semibold text-blue-600">Cum folosim datele dumneavoastră?</h2>
                <p class="text-lg">Datele colectate sunt utilizate în următoarele scopuri:</p>
                <ul class="list-disc pl-6 space-y-2 text-lg">
                    <li>Pentru a îmbunătăți experiența utilizatorilor pe platformă;</li>
                    <li>Pentru a vă contacta în scopuri administrative și de suport;</li>
                    <li>Pentru a trimite actualizări și notificări legate de platformă;</li>
                    <li>Pentru a analiza modul în care este utilizată platforma și a îmbunătăți funcționalitățile acesteia.</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-semibold text-blue-600">Cum protejăm datele dumneavoastră?</h2>
                <p class="text-lg">Adoptăm măsuri de securitate tehnice și organizaționale adecvate pentru a proteja datele dumneavoastră personale împotriva accesului neautorizat, pierderii sau distrugerii accidentale. Aceste măsuri includ criptarea datelor, autentificarea utilizatorilor și controlul accesului.</p>
            </section>

            <section>
                <h2 class="text-2xl font-semibold text-blue-600">Care sunt drepturile dumneavoastră?</h2>
                <p class="text-lg">În conformitate cu legislația privind protecția datelor personale, aveți următoarele drepturi:</p>
                <ul class="list-disc pl-6 space-y-2 text-lg">
                    <li>Dereptul de acces la datele personale;</li>
                    <li>Dereptul de a rectifica datele personale inexacte;</li>
                    <li>Dereptul de a solicita ștergerea datelor personale;</li>
                    <li>Dereptul de a vă opune prelucrării datelor în anumite circumstanțe;</li>
                    <li>Dereptul de a solicita portabilitatea datelor.</li>
                </ul>
                <p class="text-lg">Pentru a exercita oricare dintre aceste drepturi, vă rugăm să ne contactați prin intermediul detaliilor de contact din secțiunea de mai jos.</p>
            </section>

            <section>
                <h2 class="text-2xl font-semibold text-blue-600">Modificări ale politicii de confidențialitate</h2>
                <p class="text-lg">Ne rezervăm dreptul de a modifica această politică de confidențialitate în orice moment. Orice modificare va fi postată pe această pagină, iar data ultimei actualizări va fi modificată corespunzător.</p>
            </section>

            <section class="text-center">
                <p class="text-lg">Pentru întrebări suplimentare sau pentru a exercita drepturile dumneavoastră în legătură cu protecția datelor personale, vă rugăm să ne contactați la <a href="https://viainfo.info/#contact" class="text-blue-600 hover:text-blue-800">viainfo.info/#contact</a>.</p>
            </section>
        </main>
        <x-landing.footer />
    </div>
@endsection
