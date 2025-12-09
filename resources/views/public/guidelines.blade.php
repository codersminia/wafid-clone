@extends('layouts.public')

@section('title', 'Wafid - Guidelines')

@section('content')

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Guidelines</h1>
            <p class="lead">Important guidelines for employment and residency</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Employment Guidelines</h3>
                            <h5>General Requirements</h5>
                            <ul class="ml-4">
                                <li>Valid passport with minimum 6 months validity</li>
                                <li>Completed employment contract</li>
                                <li>Medical examination clearance</li>
                                <li>Police clearance certificate</li>
                                <li>Educational qualifications verification</li>
                            </ul>
                            <h5 class="mt-4">Documentation Checklist</h5>
                            <ul class="ml-4">
                                <li>Original passport and copies</li>
                                <li>Birth certificate</li>
                                <li>Educational certificates</li>
                                <li>Medical examination report</li>
                                <li>Employment contract</li>
                                <li>Sponsor letter</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Residency Guidelines</h3>
                            <h5>Eligibility Criteria</h5>
                            <ul class="ml-4">
                                <li>Minimum age requirement: 18 years</li>
                                <li>Valid employment offer or business registration</li>
                                <li>Financial stability proof</li>
                                <li>Health insurance coverage</li>
                                <li>Accommodation arrangement</li>
                            </ul>
                            <h5 class="mt-4">Renewal Process</h5>
                            <p>Residency permits must be renewed annually. The renewal process should be initiated 30 days before expiration.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Quick Reference</h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <strong>Processing Time</strong>
                                    <p class="text-muted mb-0">5-10 business days</p>
                                </li>
                                <li class="mb-3">
                                    <strong>Validity Period</strong>
                                    <p class="text-muted mb-0">1-3 years</p>
                                </li>
                                <li class="mb-3">
                                    <strong>Renewal Period</strong>
                                    <p class="text-muted mb-0">30 days before expiration</p>
                                </li>
                                <li>
                                    <strong>Support</strong>
                                    <p class="text-muted mb-0">Available 24/7</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title">Download Documents</h5>
                            <a href="#" class="btn btn-dark btn-sm btn-block mb-2">
                                <i class="fas fa-download"></i> Employment Form
                            </a>
                            <a href="#" class="btn btn-dark btn-sm btn-block mb-2">
                                <i class="fas fa-download"></i> Residency Form
                            </a>
                            <a href="#" class="btn btn-dark btn-sm btn-block">
                                <i class="fas fa-download"></i> Checklist
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
    
