<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="bg-white ">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-center text-gray-800 ">Contact Saya
            </h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-800 sm:text-xl">" Jika tertarik berbicara dengan saya silahkan hubungi melalui pesan dihalaman ini "
            </p>
            <form action="#" class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5  "autocomplete=off
                        placeholder="Masukkan email anda..." required>
                </div>
                <div>
                    <label for="subject"
                        class="block mb-2 text-sm font-medium text-gray-900 ">Nama</label>
                    <input type="text" id="subject"
                        class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 "autocomplete=off
                        placeholder="Biarkan kami mengenal nama anda..." required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Pesan</label>
                    <textarea id="message" rows="6"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 "
                        placeholder="Silahkan masukkan pesan anda..."></textarea>
                </div>
                <button type="submit"
                    class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-gray-700 sm:w-fit hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">Kirim Pesan</button>
            </form>
        </div>
    </section>
</x-layout>
