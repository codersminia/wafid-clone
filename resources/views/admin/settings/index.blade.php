@extends('layouts.admin')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon"><i class="flaticon2-gear text-primary"></i></span>
                        <h3 class="card-label">Website Settings</h3>
                    </div>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
                        @csrf
                        
                        <!-- Tab Persistence -->
                        <input type="hidden" name="active_tab" id="active_tab" value="{{ session('active_tab', old('active_tab', '#kt_tab_general')) }}">

                        <ul class="nav nav-tabs nav-tabs-line mb-5" role="tablist" id="settingsTabs">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_general">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_contact">Contact Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_social">Social Media</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_office">Office Locations</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-5" id="myTabContent">
                            <!-- GENERAL TAB -->
                            <div class="tab-pane fade" id="kt_tab_general" role="tabpanel">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Site Name</label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Site Logo</label>
                                    <div class="col-9">
                                        <div class="image-input image-input-outline" id="kt_image_logo" style="background-image: url({{ asset('assets/media/users/blank.png') }})">
                                            <div class="image-input-wrapper" style="background-image: url({{ isset($settings['logo']) ? asset($settings['logo']) : asset('assets/media/users/blank.png') }})"></div>

                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="Change Logo">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="logo" accept=".png, .jpg, .jpeg"/>
                                                <input type="hidden" name="logo_remove"/>
                                            </label>

                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Logo">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                        <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Favicon</label>
                                    <div class="col-9">
                                        <div class="image-input image-input-outline" id="kt_image_favicon" style="background-image: url({{ asset('assets/media/users/blank.png') }})">
                                            <div class="image-input-wrapper" style="background-image: url({{ isset($settings['favicon']) ? asset($settings['favicon']) : asset('assets/media/users/blank.png') }})"></div>

                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="Change Favicon">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="favicon" accept=".png, .ico"/>
                                                <input type="hidden" name="favicon_remove"/>
                                            </label>

                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Favicon">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                        <span class="form-text text-muted">Allowed file types: png, ico.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Footer Description</label>
                                    <div class="col-9">
                                        <textarea class="form-control" name="footer_text" rows="3">{{ $settings['footer_text'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- CONTACT TAB -->
                            <div class="tab-pane fade" id="kt_tab_contact" role="tabpanel">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Support Email</label>
                                    <div class="col-9">
                                        <input class="form-control" type="email" name="site_email" value="{{ $settings['site_email'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Phone Number</label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" name="site_phone" value="{{ $settings['site_phone'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">WhatsApp Number</label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" name="site_whatsapp" value="{{ $settings['site_whatsapp'] ?? '' }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Address</label>
                                    <div class="col-9">
                                        <textarea class="form-control" name="site_address" rows="3">{{ $settings['site_address'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Google Maps Embed URL (Main)</label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" name="site_map" value="{{ $settings['site_map'] ?? '' }}" placeholder="https://www.google.com/maps/embed?..." />
                                    </div>
                                </div>
                            </div>

                            <!-- SOCIAL TAB -->
                            <div class="tab-pane fade" id="kt_tab_social" role="tabpanel">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Facebook URL</label>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-facebook-f"></i></span></div>
                                            <input type="text" class="form-control" name="social_facebook" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/..." />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Twitter / X URL</label>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-twitter"></i></span></div>
                                            <input type="text" class="form-control" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}" placeholder="https://twitter.com/..." />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Instagram URL</label>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-instagram"></i></span></div>
                                            <input type="text" class="form-control" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/..." />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">LinkedIn URL</label>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-linkedin-in"></i></span></div>
                                            <input type="text" class="form-control" name="social_linkedin" value="{{ $settings['social_linkedin'] ?? '' }}" placeholder="https://linkedin.com/..." />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">TikTok URL</label>
                                    <div class="col-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-tiktok"></i></span></div>
                                            <input type="text" class="form-control" name="social_tiktok" value="{{ $settings['social_tiktok'] ?? '' }}" placeholder="https://tiktok.com/@..." />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- OFFICE LOCATIONS TAB -->
                            <div class="tab-pane fade" id="kt_tab_office" role="tabpanel">
                                <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
                                    <div class="alert-icon"><i class="flaticon-map-location"></i></div>
                                    <div class="alert-text">Add your office locations here to display on the "Visit Our Offices" section of the website.</div>
                                </div>

                                <div id="office-locations-container">
                                    @php
                                        $offices = isset($settings['office_locations']) ? json_decode($settings['office_locations'], true) : [];
                                    @endphp
                                    @foreach($offices as $index => $office)
                                        <div class="card card-custom gutter-b border office-item" data-index="{{ $index }}">
                                            <div class="card-header border-0 min-h-50px align-items-center">
                                                <h3 class="card-title font-size-h5 text-dark font-weight-bold">Office #{{ $index + 1 }}</h3>
                                                <div class="card-toolbar">
                                                    <a href="javascript:;" class="btn btn-sm btn-light-danger font-weight-bold btn-remove-office"><i class="la la-trash-o"></i> Remove</a>
                                                </div>
                                            </div>
                                            <div class="card-body pt-2">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label>City Name</label>
                                                        <input type="text" class="form-control" name="office_locations[{{ $index }}][city]" value="{{ $office['city'] ?? '' }}" placeholder="e.g. Lahore">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Branch Title</label>
                                                        <input type="text" class="form-control" name="office_locations[{{ $index }}][title]" value="{{ $office['title'] ?? '' }}" placeholder="e.g. Head Office">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" name="office_locations[{{ $index }}][phone]" value="{{ $office['phone'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label>Map Embed URL (iframe src)</label>
                                                        <input type="text" class="form-control" name="office_locations[{{ $index }}][map_url]" value="{{ $office['map_url'] ?? '' }}" placeholder="https://www.google.com/maps/embed?...">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Address</label>
                                                        <textarea class="form-control" name="office_locations[{{ $index }}][address]" rows="2">{{ $office['address'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <a href="javascript:;" id="btn-add-office" class="btn btn-light-success font-weight-bold"><i class="la la-plus"></i> Add New Office</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Save Settings</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template for New Office -->
<template id="office-template">
    <div class="card card-custom gutter-b border office-item">
        <div class="card-header border-0 min-h-50px align-items-center">
            <h3 class="card-title font-size-h5 text-dark font-weight-bold">New Office</h3>
            <div class="card-toolbar">
                <a href="javascript:;" class="btn btn-sm btn-light-danger font-weight-bold btn-remove-office"><i class="la la-trash-o"></i> Remove</a>
            </div>
        </div>
        <div class="card-body pt-2">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>City Name</label>
                    <input type="text" class="form-control field-city" placeholder="e.g. Lahore">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Branch Title</label>
                    <input type="text" class="form-control field-title" placeholder="e.g. Head Office">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" class="form-control field-phone">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Map Embed URL (iframe src)</label>
                    <input type="text" class="form-control field-map" placeholder="https://www.google.com/maps/embed?..." >
                </div>
                <div class="col-md-12">
                    <label>Address</label>
                    <textarea class="form-control field-address" rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

@endsection

@push('scripts')
<script>
    'use strict';

    // File Input Initialization
    var avatar1 = new KTImageInput('kt_image_logo');
    var avatar2 = new KTImageInput('kt_image_favicon');

    $(document).ready(function() {
        // Tab Persistence
        var activeTab = $('#active_tab').val();
        if(activeTab) {
            $('#settingsTabs a[href="' + activeTab + '"]').tab('show');
        }

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href");
            $('#active_tab').val(target);
        });

        // SweetAlert for Success
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3699FF'
            });
        @endif

        // Office Locations Repeater
        var container = $('#office-locations-container');
        var template = $('#office-template').html();

        // Add Office
        $('#btn-add-office').on('click', function() {
            var index = container.find('.office-item').length;
            var $newItem = $(template);
            
            // Set Names with Index
            $newItem.find('.field-city').attr('name', 'office_locations['+index+'][city]');
            $newItem.find('.field-title').attr('name', 'office_locations['+index+'][title]');
            $newItem.find('.field-phone').attr('name', 'office_locations['+index+'][phone]');
            $newItem.find('.field-map').attr('name', 'office_locations['+index+'][map_url]');
            $newItem.find('.field-address').attr('name', 'office_locations['+index+'][address]');

            $newItem.find('.card-title').text('Office #' + (index + 1));

            container.append($newItem);
        });

        // Remove Office
        $(document).on('click', '.btn-remove-office', function() {
            $(this).closest('.office-item').remove();
            // Re-index logic if strictly needed, but PHP handles non-consecutive arrays fine mostly,
            // or we just rely on unique keys if we used random IDs.
            // For simple list, appending with new index is fine, removals might leave gaps but standard PHP form handling usually handles array keys.
            // Actually, to be safe, we could re-index name attributes on submission or remove but Laravel handles `office_locations[0]`, `office_locations[2]` etc. as an array.
        });
    });
</script>
@endpush
