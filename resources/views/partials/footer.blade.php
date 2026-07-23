@php
    $menus = $menus ?? \App\Models\S_Menu::all();
    $expertises = \DB::table('core_expertise_concentrations')->orderBy('name')->take(5)->get();
    $contact = $contact ?? \App\Models\S_Contact::first();
@endphp

<footer id="footer" class="footer footer-16 position-relative" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding-top: 60px;">

    <div class="container">

        <div class="footer-main" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-start">

                <!-- Column 1: Info Sekolah -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="brand-section">
                        <a href="{{ url('/') }}" class="logo d-flex align-items-center mb-3 text-decoration-none">
                            <img src="{{ asset('assets/images/logosmk.png') }}" alt="Logo SMKN 1 Talaga" style="max-height: 40px; margin-right: 10px;">
                            <span class="sitename" style="font-size: 20px; font-weight: 700; color: #1e3a8a;">SMKN 1 Talaga</span>
                        </a>
                        <p class="brand-description" style="color: #64748b; font-size: 14px; line-height: 1.6;">
                            SMK Negeri 1 Talaga senantiasa berupaya mencetak lulusan yang unggul, berkarakter, terampil, siap kerja, dan berdaya saing global melalui proses pendidikan berkualitas.
                        </p>

                        <div class="contact-info mt-4" style="font-size: 13.5px; color: #475569;">
                            @if($contact && !empty($contact->address_1))
                                <div class="contact-item d-flex align-items-start mb-3">
                                    <i class="bi bi-geo-alt-fill me-2 text-primary" style="font-size: 18px; margin-top: 2px;"></i>
                                    <div>
                                        <strong class="d-block text-dark mb-1" style="font-size: 13px;">Kampus 1:</strong>
                                        <span class="text-muted d-block mb-2" style="line-height: 1.4;">{{ $contact->address_1 }}</span>
                                        @if(!empty($contact->address_2))
                                            <strong class="d-block text-dark mb-1" style="font-size: 13px;">Kampus 2:</strong>
                                            <span class="text-muted d-block" style="line-height: 1.4;">{{ $contact->address_2 }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if($contact && !empty($contact->no_telp))
                                <div class="contact-item d-flex align-items-center mb-2">
                                    <i class="bi bi-telephone-fill me-2 text-primary" style="font-size: 16px;"></i>
                                    <a href="tel:{{ $contact->no_telp }}" class="text-decoration-none text-secondary hover-primary">{{ $contact->no_telp }}</a>
                                </div>
                            @endif
                            @if($contact && !empty($contact->email))
                                <div class="contact-item d-flex align-items-center">
                                    <i class="bi bi-envelope-fill me-2 text-primary" style="font-size: 16px;"></i>
                                    <a href="mailto:{{ $contact->email }}" class="text-decoration-none text-secondary hover-primary">{{ $contact->email }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Column 2: Navigasi Cepat -->
                <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                    <div class="nav-column">
                        <h6 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;">Navigasi</h6>
                        <nav class="footer-nav d-flex flex-column gap-2" style="font-size: 14px;">
                            <a href="{{ url('/#home') }}" class="text-decoration-none text-secondary hover-primary">Beranda</a>
                            @foreach($menus->take(5) as $m)
                                <a href="{{ url('/#' . $m->slug) }}" class="text-decoration-none text-secondary hover-primary">{{ $m->name }}</a>
                            @endforeach
                        </nav>
                    </div>
                </div>

                <!-- Column 3: Jurusan Terpopuler -->
                <div class="col-6 col-md-3 col-lg-3 mb-4 mb-lg-0">
                    <div class="nav-column">
                        <h6 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;">Jurusan</h6>
                        <nav class="footer-nav d-flex flex-column gap-2" style="font-size: 14px;">
                            @foreach($expertises as $exp)
                                <a href="{{ route('expertise.show', $exp->slug) }}" class="text-decoration-none text-secondary hover-primary">{{ $exp->name }}</a>
                            @endforeach
                        </nav>
                    </div>
                </div>

                <!-- Column 4: Peta Lokasi -->
                <div class="col-md-6 col-lg-3">
                    <div class="nav-column" id="section-kontak">
                        <h6 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;">Lokasi Kampus</h6>
                        <div class="d-flex flex-column gap-3">
                            <div>
                                <small class="text-muted d-block mb-1 font-weight-bold">Kampus 1</small>
                                <div class="overflow-hidden rounded border" style="height: 110px;">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.236026261817!2d108.30788997371191!3d-6.981451068363909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f3970682a1a3d%3A0x4cb5ac8a7524e323!2sSMK%20Negeri%201%20Talaga!5e0!3m2!1sid!2sid!4v1770856352823!5m2!1sid!2sid"
                                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>
                            <div>
                                <small class="text-muted d-block mb-1 font-weight-bold">Kampus 2</small>
                                <div class="overflow-hidden rounded border" style="height: 110px;">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2704116710465!2d108.28919687371182!3d-6.977387368321625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f3bd1661739f7%3A0x494597a8fa250a4d!2sSMK%20Negeri%201%20Talaga%20Campus%202!5e0!3m2!1sid!2sid!4v1770856535773!5m2!1sid!2sid"
                                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Copyright -->
    <div class="footer-bottom mt-5 py-4" style="border-top: 1px solid #e2e8f0; font-size: 14px; color: #64748b;">
        <div class="container">
            <div class="bottom-content">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center text-lg-start mb-2 mb-lg-0">
                        <p class="m-0">© {{ date('Y') }} <strong>SMKN 1 Talaga</strong>. All rights reserved.</p>
                    </div>
                    <div class="col-lg-6 text-center text-lg-end">
                        <div class="credits">
                            Designed & Developed by <a href="#!" class="text-primary text-decoration-none">Labantik</a> | Supported by <a href="#!" class="text-primary text-decoration-none">ICT SMKN 1 Talaga</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>

<style>
    .hover-primary:hover {
        color: #0d6efd !important;
    }
</style>
