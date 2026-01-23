@extends('layouts.public')

@section('title', 'Wafid - FAQ')

@section('content')

    <!-- Page Header -->
    <section class="inner-page-hero"
        style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('assets/public/images/hero-bg.jpg') }}') center/cover no-repeat;">
        <div class="container">
            <h1 class="font-weight-bold">Frequently Asked Questions</h1>
            <p class="lead">Find answers to common questions</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div id="faqAccordion">
                        @forelse($faqs as $faq)
                            <div class="card mb-3">
                                <div class="card-header" id="heading{{ $faq->id }}">
                                    <h5 class="mb-0">
                                        {{--
                                        1. Added 'collapsed' class: Ensures arrow starts pointing down
                                        2. Added FontAwesome <i> tag for the arrow
                                            --}}
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                                aria-controls="collapse{{ $faq->id }}">

                                                <span>{{ $faq->question }}</span>

                                                <!-- The Arrow Icon -->
                                                <i class="fas fa-chevron-down faq-arrow"></i>
                                            </button>
                                    </h5>
                                </div>

                                <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}"
                                    data-parent="#faqAccordion">
                                    <div class="card-body">
                                        {{-- Use {!! !!} if you store HTML in your database, otherwise use {{ }} --}}
                                        {!! nl2br(e($faq->answer)) !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <h3>No FAQs available at the moment.</h3>
                                <p class="text-muted">Please contact support for assistance.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection