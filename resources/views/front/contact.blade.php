@extends('front.layouts.app')

@section('title', __('app.titles.contact') . ' - ' . ($settings->company_name ?? 'EYWEP'))
@section('description', 'Contactez ' . ($settings->company_name ?? 'EYWEP') . ' - Adresse, téléphone, email et formulaire de contact.')

@section('content')
<main>

    {{-- Page Banner --}}
    @include('front.partials.page-banner', ['bannerTitle' => __('app.pages.contact')])

    {{-- Contact Form + Info --}}
    <div class="section-contact-form contact-2 section-padding">
        <div class="container">
            <div class="section-headings text-center">
                <div class="subheading text-20 subheading-bg" data-aos="fade-up">
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <g clip-path="url(#clip0_contact)">
                            <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="CurrentColor"/>
                        </g>
                        <defs><clipPath id="clip0_contact"><rect width="14" height="14" fill="CurrentColor"/></clipPath></defs>
                    </svg>
                    <span>{{ __('app.contact.section_label') }}</span>
                    <svg class="icon icon-14" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <g clip-path="url(#clip1_contact)">
                            <path d="M8.71401 5.28599C11.7514 5.4205 14 5.9412 14 7C14 8.0588 11.7514 8.5795 8.71401 8.71401C8.5795 11.7514 8.0588 14 7 14C5.9412 14 5.4205 11.7514 5.28599 8.71401C2.2486 8.5795 0 8.0588 0 7C0 5.94119 2.2486 5.4205 5.28599 5.28599C5.4205 2.2486 5.9412 0 7 0C8.0588 0 8.5795 2.2486 8.71401 5.28599Z" fill="CurrentColor"/>
                        </g>
                        <defs><clipPath id="clip1_contact"><rect width="14" height="14" fill="CurrentColor"/></clipPath></defs>
                    </svg>
                </div>
                <h2 class="heading text-50" data-aos="fade-up" data-aos-delay="50">
                    {{ __('app.contact.heading') }}
                </h2>
            </div>

            <div class="contact-box radius18">
                <div class="row product-grid justify-content-between">

                    {{-- Colonne gauche : carte + infos --}}
                    <div class="col-12 col-lg-6 col-contact-content">

                        {{-- Google Map --}}
                        @php
                            $mapUrl = $settings->company_location
                                ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126069.27563988668!2d7.399917199999999!3d9.0578588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e745f4cd62fd9%3A0x53bd17b4a20ea12b!2sAbuja%2C%20Nigeria!5e0!3m2!1sfr!2sng!4v1700000000000';
                        @endphp
                        <div class="google-map">
                            <div class="iframe-wrapper">
                                <iframe
                                    src="{{ $mapUrl }}"
                                    title="{{ __('app.contact.map_title') }}"
                                    width="1920"
                                    height="600"
                                    style="border:0"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                ></iframe>
                            </div>
                        </div>

                        <div class="contact-info-list">
                            <div class="card-icon-text card-icon-text-horizontal" data-aos="fade-up">
                                <div class="svg-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                    </svg>
                                </div>
                                <div class="content">
                                    <h2 class="heading text-16 fw-500">{{ __('app.contact.address_label') }}</h2>
                                    <p class="text text-20">{{ $settings->company_address ?? 'Ouagadougou, Burkina Faso' }}</p>
                                </div>
                            </div>

                            <div class="card-icon-text card-icon-text-horizontal" data-aos="fade-up">
                                <div class="svg-wrapper">
                                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23.8337 3.67188C28.2097 3.67188 32.4066 5.41026 35.5009 8.50461C38.5953 11.599 40.3337 15.7958 40.3337 20.1719M23.8337 11.0052C26.2648 11.0052 28.5964 11.971 30.3155 13.6901C32.0346 15.4091 33.0003 17.7407 33.0003 20.1719M25.359 30.3799C25.7376 30.5538 26.1642 30.5935 26.5684 30.4925C26.9727 30.3915 27.3304 30.1559 27.5828 29.8244L28.2337 28.9719C28.5752 28.5165 29.0181 28.1469 29.5272 27.8923C30.0363 27.6377 30.5978 27.5052 31.167 27.5052H36.667C37.6395 27.5052 38.5721 27.8915 39.2597 28.5791C39.9473 29.2668 40.3337 30.1994 40.3337 31.1719V36.6719C40.3337 37.6443 39.9473 38.577 39.2597 39.2646C38.5721 39.9522 37.6395 40.3385 36.667 40.3385C27.9148 40.3385 19.5212 36.8618 13.3325 30.6731C7.14377 24.4844 3.66699 16.0907 3.66699 7.33854C3.66699 6.36608 4.0533 5.43345 4.74093 4.74582C5.42857 4.05818 6.3612 3.67188 7.33366 3.67188H12.8337C13.8061 3.67188 14.7387 4.05818 15.4264 4.74582C16.114 5.43345 16.5003 6.36608 16.5003 7.33854V12.8385C16.5003 13.4078 16.3678 13.9692 16.1132 14.4783C15.8587 14.9875 15.489 15.4303 15.0337 15.7719L14.1757 16.4154C13.8391 16.6724 13.6019 17.0379 13.5043 17.45C13.4067 17.8621 13.4548 18.2952 13.6403 18.6759C16.1459 23.765 20.2668 27.8807 25.359 30.3799Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="content">
                                    <h2 class="heading text-16 fw-500">{{ __('app.contact.phone_label') }}</h2>
                                    @if ($settings->company_phone)
                                        <a href="tel:{{ $settings->company_phone }}" class="text text-20" aria-label="{{ __('app.contact.phone_label') }}">{{ $settings->company_phone }}</a>
                                    @else
                                        <span class="text text-20">+226 00 00 00 00</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-icon-text card-icon-text-horizontal" data-aos="fade-up">
                                <div class="svg-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z"/>
                                    </svg>
                                </div>
                                <div class="content">
                                    <h2 class="heading text-16 fw-500">{{ __('app.contact.email_label') }}</h2>
                                    @if ($settings->company_email)
                                        <a href="mailto:{{ $settings->company_email }}" class="text text-20" aria-label="{{ __('app.contact.email_label') }}">{{ $settings->company_email }}</a>
                                    @else
                                        <a href="mailto:contact@eywep.org" class="text text-20" aria-label="{{ __('app.contact.email_label') }}">contact@eywep.org</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="contact-social" data-aos="fade-up">
                            <h2 class="heading text-20 fw-500">{{ __('app.contact.follow_label') }}</h2>
                            <ul class="social-icons list-unstyled">
                                <li>
                                    <a class="social-link text" href="{{ $settings->social_facebook ?? 'https://web.facebook.com/' }}" target="_blank" rel="noreferrer">
                                        <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.66634 10.2552H8.74967L9.58301 6.92188H6.66634V5.25521C6.66634 4.39739 6.66634 3.58854 8.33301 3.58854H9.58301V0.788625C9.31159 0.752583 8.28551 0.671875 7.20209 0.671875C4.94001 0.671875 3.33301 2.05259 3.33301 4.5883V6.92188H0.833008V10.2552H3.33301V17.3385H6.66634V10.2552Z" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="social-link text" href="{{ $settings->social_linkedin ?? 'https://www.linkedin.com/' }}" target="_blank" rel="noreferrer">
                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.78357 2.16742C3.78326 2.84601 3.37157 3.45666 2.74262 3.71142C2.11367 3.96619 1.39306 3.81419 0.920587 3.32711C0.448112 2.84001 0.318129 2.11511 0.59192 1.49421C0.86572 0.873305 1.48862 0.480397 2.1669 0.500755C3.0678 0.527797 3.78398 1.26612 3.78357 2.16742ZM3.83357 5.06742H0.500237V15.5007H3.83357V5.06742ZM9.10025 5.06742H5.78357V15.5007H9.06692V10.0257C9.06692 6.97573 13.0419 6.6924 13.0419 10.0257V15.5007H16.3336V8.8924C16.3336 3.75075 10.4503 3.94242 9.06692 6.4674L9.10025 5.06742Z" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">LinkedIn</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="social-link text" href="{{ $settings->social_twitter ?? 'https://x.com/' }}" target="_blank" rel="noreferrer">
                                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.5104 1.71289C16.8743 1.9943 16.1996 2.17914 15.5088 2.26127C16.2366 1.82561 16.7812 1.14026 17.0411 0.332886C16.3573 0.739186 15.6088 1.02515 14.8282 1.17835C14.1693 0.475394 13.2483 0.0770356 12.2848 0.0781272C10.3605 0.0781272 8.79975 1.63835 8.79975 3.56354C8.79975 3.83666 8.83109 4.10153 8.88967 4.35709C5.99206 4.21121 3.42506 2.82455 1.70565 0.715686C1.39608 1.24757 1.23338 1.85216 1.2342 2.46757C1.2342 3.67667 1.84967 4.74388 2.78458 5.36868C2.23115 5.35118 1.6899 5.20171 1.20599 4.93262C1.20545 4.94726 1.20545 4.9619 1.20545 4.97574C1.20545 6.66484 2.40683 8.07384 4.00166 8.39376C3.70234 8.47476 3.3936 8.51568 3.08352 8.51543C2.85831 8.51543 2.63976 8.49468 2.42733 8.45393C2.8711 9.83826 4.15739 10.8461 5.683 10.8738C4.44845 11.8427 2.92391 12.3683 1.35453 12.3661C1.07677 12.3663 0.799246 12.3499 0.523438 12.3171C2.1167 13.3413 3.97127 13.8849 5.86535 13.8829C12.2763 13.8829 15.7817 8.57243 15.7817 3.9671C15.7817 3.81643 15.778 3.66523 15.7713 3.51615C16.4536 3.02322 17.0425 2.41257 17.5104 1.71289Z" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">Twitter / X</span>
                                    </a>
                                </li>
                                @if ($settings->social_whatsapp)
                                <li>
                                    <a class="social-link text" href="{{ $settings->social_whatsapp }}" target="_blank" rel="noreferrer">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9 1.5C4.859 1.5 1.5 4.859 1.5 9c0 1.418.392 2.746 1.073 3.878l-.7 2.849 2.849-.7A7.447 7.447 0 009 16.5c4.141 0 7.5-3.359 7.5-7.5S13.141 1.5 9 1.5zM0 9C0 4.03 4.03 0 9 0s9 4.03 9 9-4.03 9-9 9a8.952 8.952 0 01-4.362-1.127L0 18l1.127-4.638A8.952 8.952 0 010 9z" fill="currentColor"/>
                                            <path d="M6.735 5.25c-.2-.443-.41-.452-.6-.46-.155-.007-.332-.007-.51-.007-.177 0-.465.066-.708.332-.244.266-.932.912-.932 2.222 0 1.31.953 2.576 1.086 2.754.133.177 1.863 2.998 4.576 4.075.638.274 1.136.438 1.524.56.64.203 1.224.175 1.685.106.514-.076 1.585-.647 1.808-1.272.222-.624.222-1.16.155-1.272-.066-.111-.244-.177-.51-.31-.266-.133-1.585-.784-1.83-.873-.244-.088-.422-.133-.6.133-.177.266-.687.873-.842 1.05-.155.177-.31.2-.576.067-.266-.134-1.121-.413-2.135-1.315-.789-.703-1.322-1.573-1.477-1.838-.155-.266-.016-.41.116-.543.12-.12.266-.31.4-.465.133-.155.177-.266.266-.443.088-.177.044-.332-.022-.465-.067-.133-.6-1.449-.821-1.985z" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">WhatsApp</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{-- Colonne droite : formulaire (désactivé) --}}
                    <div class="col-12 col-lg-6 col-contact-form">
                        <div class="contact-form-wrap radius18">
                            <div class="contact-form-headings">
                                <h2 class="heading text-32" data-aos="fade-up">{{ __('app.contact.form_title') }}</h2>
                                <p class="text text-16" data-aos="fade-up">
                                    {{ __('app.contact.form_subtitle') }}
                                </p>
                            </div>
                            <form action="#" class="form contact-form" data-aos="fade-up" aria-hidden="true">
                                <fieldset disabled style="border:none;padding:0;margin:0;">
                                <div class="field">
                                    <label for="ContactForm-name" class="visually-hidden">{{ __('app.contact.label_name') }}</label>
                                    <input id="ContactForm-name" class="text-16" type="text" placeholder="{{ __('app.contact.placeholder_name') }}" name="name">
                                </div>
                                <div class="field">
                                    <label for="ContactForm-email" class="visually-hidden">{{ __('app.contact.label_email') }}</label>
                                    <input id="ContactForm-email" class="text-16" type="email" placeholder="{{ __('app.contact.placeholder_email') }}" name="email">
                                </div>
                                <div class="field">
                                    <label for="ContactForm-subject" class="visually-hidden">{{ __('app.contact.label_subject') }}</label>
                                    <input id="ContactForm-subject" class="text-16" type="text" placeholder="{{ __('app.contact.placeholder_subject') }}" name="subject">
                                </div>
                                <div class="field">
                                    <label for="ContactForm-body" class="visually-hidden">{{ __('app.contact.label_message') }}</label>
                                    <textarea id="ContactForm-body" class="text-16" rows="4" placeholder="{{ __('app.contact.placeholder_message') }}" name="message"></textarea>
                                </div>
                                <div class="form-button">
                                    <button type="button" class="button button--secondary" aria-disabled="true">
                                        {{ __('app.contact.send_btn') }}
                                        <span class="svg-wrapper">
                                            <svg class="icon-20" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.3365 7.84518L6.16435 15.0173L4.98584 13.8388L12.158 6.66667H5.83652V5H15.0032V14.1667H13.3365V7.84518Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>
@endsection
