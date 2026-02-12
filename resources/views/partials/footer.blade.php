<footer class="relative border-t border-slate-200 pb-12 pt-20 dark:border-zinc-800" id="section-kontak">
    <div class="absolute -top-16 left-0 size-64 bg-purple-500 opacity-10 blur-3xl"></div>
    <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
        <div class="relative z-10 grid grid-cols-12 gap-5 xl:grid-cols-12">
            @php
                $contact = $contact ?? \App\Models\S_Contact::first();
            @endphp

            <div class="col-span-12 lg:col-span-8">
                <div class="mb-5">
                    <!-- Konten yang sudah ada (jika ada) -->
                </div>

                <!-- Social Media Links -->
                <ul class="flex items-center gap-3 mb-6">
                    <li>
                        <a href="https://www.facebook.com/smkn1tlg/"
                            class="hover:text-custom-500 dark:hover:text-custom-500 flex size-10 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition-all duration-200 ease-linear dark:border-zinc-800 dark:text-zinc-400">
                            <i data-lucide="facebook" class="size-4"></i>
                        </a>
                    </li>
                    <li>
                        <a target="_blank"
                            href="https://www.instagram.com/smkn1tlg?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                            class="hover:text-custom-500 dark:hover:text-custom-500 flex size-10 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition-all duration-200 ease-linear dark:border-zinc-800 dark:text-zinc-400">
                            <i data-lucide="instagram" class="size-4"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://youtube.com/@smkn1tlg?si=xZ2ax5BopDQWU2jh" target="_blank"
                            class="hover:text-custom-500 dark:hover:text-custom-500 flex size-10 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition-all duration-200 ease-linear dark:border-zinc-800 dark:text-zinc-400">
                            <i data-lucide="youtube" class="size-4"></i>
                        </a>
                    </li>
                </ul>

                <!-- Google Maps - 2 Kampus -->
                <div class="mt-6">
                    <h4 class="mb-4 text-lg font-semibold text-slate-800 dark:text-zinc-100">Lokasi Kami</h4>

                    <!-- Grid untuk 2 maps -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Kampus 1 -->
                        <div>
                            <h5 class="mb-2 text-sm font-medium text-slate-700 dark:text-zinc-200">Kampus 1</h5>
                            <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-zinc-800">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.236026261817!2d108.30788997371191!3d-6.981451068363909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f3970682a1a3d%3A0x4cb5ac8a7524e323!2sSMK%20Negeri%201%20Talaga!5e0!3m2!1sid!2sid!4v1770856352823!5m2!1sid!2sid"
                                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade" class="w-full">
                                </iframe>
                            </div>
                        </div>

                        <!-- Kampus 2 -->
                        <div>
                            <h5 class="mb-2 text-sm font-medium text-slate-700 dark:text-zinc-200">Kampus 2</h5>
                            <div class="overflow-hidden rounded-lg border border-slate-200 dark:border-zinc-800">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2704116710465!2d108.28919687371182!3d-6.977387368321625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f3bd1661739f7%3A0x494597a8fa250a4d!2sSMK%20Negeri%201%20Talaga%20Campus%202!5e0!3m2!1sid!2sid!4v1770856535773!5m2!1sid!2sid"
                                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <h4 class="mb-4 text-lg font-semibold text-slate-800 dark:text-zinc-100">Kontak</h4>
                @if ($contact)
                    <div class="mb-3 text-slate-600 dark:text-zinc-300">
                        @if (!empty($contact->address_1))
                            <div class="mb-2 flex items-start gap-3">
                                <i data-lucide="map-pin" class="mt-1 size-4"></i>
                                <div>
                                    <div class="font-medium text-slate-700 dark:text-zinc-100">Alamat</div>
                                    <div class="text-sm">{{ $contact->address_1 }} @if (!empty($contact->address_2))
                                            <br>{{ $contact->address_2 }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (!empty($contact->email))
                            <div class="mb-2 flex items-center gap-3">
                                <i data-lucide="mail" class="size-4"></i>
                                <a href="mailto:{{ $contact->email }}"
                                    class="text-sm text-slate-600 dark:text-zinc-300">{{ $contact->email }}</a>
                            </div>
                        @endif

                        @if (!empty($contact->no_telp))
                            <div class="mb-2 flex items-center gap-3">
                                <i data-lucide="phone" class="size-4"></i>
                                <a href="tel:{{ $contact->no_telp }}"
                                    class="text-sm text-slate-600 dark:text-zinc-300">{{ $contact->no_telp }}</a>
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-sm text-slate-500 dark:text-zinc-400">Kontak belum tersedia.</p>
                @endif
            </div>
        </div><!--end grid-->

    </div>
    <div class="text-16 mt-16 border-t pt-10 text-center text-slate-500 dark:border-zinc-800 dark:text-zinc-400">
        <p>
            ©
            <script>
                document.write(new Date().getFullYear())
            </script> SMKN 1 Talaga.
            Engineered by <a href="#!" class="text-slate-800 underline dark:text-zinc-100">Labantik</a>,
            Supported by <a href="#!" class="text-slate-800 underline dark:text-zinc-100">ICT SMKN 1
                Talaga</a>.
        </p>
    </div>
</footer>
