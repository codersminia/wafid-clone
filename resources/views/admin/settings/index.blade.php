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

                        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
                            id="settingsForm">
                            @csrf

                            <!-- Tab Persistence -->
                            <input type="hidden" name="active_tab" id="active_tab"
                                value="{{ session('active_tab', old('active_tab', '#kt_tab_general')) }}">

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
                                <li class="nav-item">
                                    <a class="nav-link text-success font-weight-bold" data-toggle="tab"
                                        href="#kt_tab_testimonials">
                                        <span class="nav-icon"><i class="flaticon2-chat-1 text-success"></i></span>
                                        <span class="nav-text">Testimonials</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-warning font-weight-bold" data-toggle="tab"
                                        href="#kt_tab_feedback">
                                        <span class="nav-icon"><i class="flaticon2-mail text-warning"></i></span>
                                        <span class="nav-text">Private Feedback</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content mt-5" id="myTabContent">
                                <!-- GENERAL TAB -->
                                <div class="tab-pane fade" id="kt_tab_general" role="tabpanel">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Site Name</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="site_name"
                                                value="{{ $settings['site_name'] ?? '' }}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Site Logo</label>
                                        <div class="col-9">
                                            <div class="image-input image-input-outline" id="kt_image_logo">
                                                <div class="image-input-wrapper"
                                                    style="background-image: url({{ isset($settings['logo']) ? asset($settings['logo']) : asset('assets/admin/media/bg/bg-3.jpg') }})">
                                                </div>

                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title="Change Logo">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="logo_remove" />
                                                </label>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title="Cancel Logo">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="remove" data-toggle="tooltip" title="Remove Logo">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Favicon</label>
                                        <div class="col-9">
                                            <div class="image-input image-input-outline" id="kt_image_favicon">
                                                <div class="image-input-wrapper"
                                                    style="background-image: url({{ isset($settings['favicon']) ? asset($settings['favicon']) : asset('assets/admin/media/bg/bg-3.jpg') }})">
                                                </div>

                                                <label
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="change" data-toggle="tooltip" title="Change Favicon">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="favicon" accept=".png, .ico" />
                                                    <input type="hidden" name="favicon_remove" />
                                                </label>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title="Cancel Favicon">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>

                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="remove" data-toggle="tooltip" title="Remove Favicon">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Footer Description</label>
                                        <div class="col-9">
                                            <textarea class="form-control" name="footer_text"
                                                rows="3">{{ $settings['footer_text'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- CONTACT TAB -->
                                <div class="tab-pane fade" id="kt_tab_contact" role="tabpanel">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Support Email</label>
                                        <div class="col-9">
                                            <input class="form-control" type="email" name="site_email"
                                                value="{{ $settings['site_email'] ?? '' }}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Phone Number</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="site_phone"
                                                value="{{ $settings['site_phone'] ?? '' }}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">WhatsApp Number</label>
                                        <div class="col-9">
                                            <input class="form-control" type="text" name="site_whatsapp"
                                                value="{{ $settings['site_whatsapp'] ?? '' }}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Address</label>
                                        <div class="col-9">
                                            <textarea class="form-control" name="site_address"
                                                rows="3">{{ $settings['site_address'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- SOCIAL TAB -->
                                <div class="tab-pane fade" id="kt_tab_social" role="tabpanel">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Facebook URL</label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fab fa-facebook-f"></i></span></div>
                                                <input type="text" class="form-control" name="social_facebook"
                                                    value="{{ $settings['social_facebook'] ?? '' }}"
                                                    placeholder="https://facebook.com/..." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Twitter / X URL</label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fab fa-twitter"></i></span></div>
                                                <input type="text" class="form-control" name="social_twitter"
                                                    value="{{ $settings['social_twitter'] ?? '' }}"
                                                    placeholder="https://twitter.com/..." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Instagram URL</label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fab fa-instagram"></i></span></div>
                                                <input type="text" class="form-control" name="social_instagram"
                                                    value="{{ $settings['social_instagram'] ?? '' }}"
                                                    placeholder="https://instagram.com/..." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">LinkedIn URL</label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fab fa-linkedin-in"></i></span></div>
                                                <input type="text" class="form-control" name="social_linkedin"
                                                    value="{{ $settings['social_linkedin'] ?? '' }}"
                                                    placeholder="https://linkedin.com/..." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">TikTok URL</label>
                                        <div class="col-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="fab fa-tiktok"></i></span></div>
                                                <input type="text" class="form-control" name="social_tiktok"
                                                    value="{{ $settings['social_tiktok'] ?? '' }}"
                                                    placeholder="https://tiktok.com/@..." />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- OFFICE LOCATIONS TAB -->
                                <div class="tab-pane fade" id="kt_tab_office" role="tabpanel">
                                    <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
                                        <div class="alert-icon"><i class="flaticon-map-location"></i></div>
                                        <div class="alert-text">Add your office locations here to display on the "Visit Our
                                            Offices" section of the website.</div>
                                    </div>

                                    <div id="office-locations-container">
                                        @php
                                            $offices = isset($settings['office_locations']) ? json_decode($settings['office_locations'], true) : [];
                                        @endphp
                                        @foreach($offices as $index => $office)
                                            <div class="card card-custom gutter-b border office-item" data-index="{{ $index }}">
                                                <div class="card-header border-0 min-h-50px align-items-center">
                                                    <h3 class="card-title font-size-h5 text-dark font-weight-bold">Office
                                                        #{{ $index + 1 }}</h3>
                                                    <div class="card-toolbar">
                                                        <a href="javascript:;"
                                                            class="btn btn-sm btn-light-danger font-weight-bold btn-remove-office"><i
                                                                class="la la-trash-o"></i> Remove</a>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-2">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>City Name</label>
                                                            <input type="text" class="form-control"
                                                                name="office_locations[{{ $index }}][city]"
                                                                value="{{ $office['city'] ?? '' }}" placeholder="e.g. Lahore">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Branch Title</label>
                                                            <input type="text" class="form-control"
                                                                name="office_locations[{{ $index }}][title]"
                                                                value="{{ $office['title'] ?? '' }}"
                                                                placeholder="e.g. Head Office">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Phone</label>
                                                            <input type="text" class="form-control"
                                                                name="office_locations[{{ $index }}][phone]"
                                                                value="{{ $office['phone'] ?? '' }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Map Embed URL (iframe src)</label>
                                                            <input type="text" class="form-control"
                                                                name="office_locations[{{ $index }}][map_url]"
                                                                value="{{ $office['map_url'] ?? '' }}"
                                                                placeholder="https://www.google.com/maps/embed?...">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label>Google Review URL (Direct Link)</label>
                                                            <input type="text" class="form-control"
                                                                name="office_locations[{{ $index }}][google_review_url]"
                                                                value="{{ $office['google_review_url'] ?? '' }}"
                                                                placeholder="https://g.page/r/...">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Address</label>
                                                            <textarea class="form-control"
                                                                name="office_locations[{{ $index }}][address]"
                                                                rows="2">{{ $office['address'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-3">
                                        <a href="javascript:;" id="btn-add-office"
                                            class="btn btn-light-success font-weight-bold"><i class="la la-plus"></i> Add
                                            New Office</a>
                                    </div>
                                </div>

                                <!-- TESTIMONIALS TAB -->
                                <div class="tab-pane fade" id="kt_tab_testimonials" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h5 class="text-dark font-weight-bold m-0">Client Testimonials</h5>
                                        <button type="button" class="btn btn-success font-weight-bold" data-toggle="modal"
                                            data-target="#modalTestimonial" onclick="resetTestimonialForm()">
                                            <i class="la la-plus"></i> Add Testimonial
                                        </button>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-vertical-center"
                                            id="kt_testimonials_table">
                                            <thead>
                                                <tr class="text-left">
                                                    <th style="min-width: 150px">Client</th>
                                                    <th>Rating</th>
                                                    <th>Source</th>
                                                    <th>Location</th>
                                                    <th>Status</th>
                                                    <th>Homepage</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($testimonials as $tm)
                                                    <tr>
                                                        <td class="pl-0 py-4">
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-40 symbol-light-success mr-4">
                                                                    @if($tm->client_image)
                                                                        <span class="symbol-label"
                                                                            style="background-image: url('{{ asset($tm->client_image) }}')"></span>
                                                                    @else
                                                                        <span
                                                                            class="symbol-label font-size-h4 font-weight-bold">{{ substr($tm->client_name, 0, 1) }}</span>
                                                                    @endif
                                                                </div>
                                                                <div>
                                                                    <a href="javascript:;"
                                                                        class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $tm->client_name }}</a>
                                                                    <span
                                                                        class="text-muted font-weight-bold d-block">{{ $tm->client_position ?? 'Client' }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-warning">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i
                                                                        class="{{ $i <= $tm->rating ? 'fas' : 'far' }} fa-star fa-sm"></i>
                                                                @endfor
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $sourceClass = ['google' => 'label-light-danger', 'manual' => 'label-light-primary', 'form' => 'label-light-success'][$tm->source] ?? 'label-light-info';
                                                            @endphp
                                                            <span
                                                                class="label label-lg {{ $sourceClass }} label-inline font-weight-bold text-capitalize">{{ $tm->source }}</span>
                                                        </td>
                                                        <td>{{ $tm->office_city ?? '-' }}</td>
                                                        <td>
                                                            <span
                                                                class="label label-inline label-{{ $tm->status == 'approved' ? 'success' : ($tm->status == 'rejected' ? 'danger' : 'warning') }} font-weight-bold">
                                                                {{ ucfirst($tm->status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="switch switch-sm switch-icon">
                                                                <label>
                                                                    <input type="checkbox" disabled {{ $tm->display_on_homepage ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </td>
                                                        <td class="text-right pr-0">
                                                            <a href="javascript:;"
                                                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1"
                                                                onclick="editTestimonial({{ json_encode($tm) }})">
                                                                <i class="la la-edit text-primary"></i>
                                                            </a>
                                                            <a href="javascript:;"
                                                                class="btn btn-icon btn-light btn-hover-danger btn-sm delete-testimonial"
                                                                data-id="{{ $tm->id }}">
                                                                <i class="la la-trash text-danger"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- PRIVATE FEEDBACK TAB -->
                                <div class="tab-pane fade" id="kt_tab_feedback" role="tabpanel">
                                    <h5 class="text-dark font-weight-bold mb-5">Received Private Feedback</h5>
                                    <div class="table-responsive">
                                        <table class="table table-head-custom table-vertical-center" id="kt_feedback_table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Client</th>
                                                    <th>Rating</th>
                                                    <th>Message</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($feedbacks as $fb)
                                                    <tr class="{{ !$fb->is_read ? 'bg-light-warning' : '' }}"
                                                        id="fb-row-{{ $fb->id }}">
                                                        <td>{{ $fb->created_at->format('d M Y') }}</td>
                                                        <td>
                                                            <div class="font-weight-bold">{{ $fb->name }}</div>
                                                            <div class="small text-muted">{{ $fb->email }}</div>
                                                        </td>
                                                        <td>
                                                            <div class="text-warning">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i
                                                                        class="{{ $i <= $fb->rating ? 'fas' : 'far' }} fa-star fa-sm"></i>
                                                                @endfor
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-dark-75 text-truncate" style="max-width: 300px;"
                                                                title="{{ $fb->message }}">
                                                                {{ $fb->message }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if(!$fb->is_read)
                                                                <button class="btn btn-sm btn-clean btn-icon mark-read"
                                                                    data-id="{{ $fb->id }}" title="Mark as Read">
                                                                    <i class="la la-eye text-primary"></i>
                                                                </button>
                                                            @endif
                                                            <button class="btn btn-sm btn-clean btn-icon delete-feedback"
                                                                data-id="{{ $fb->id }}" title="Delete">
                                                                <i class="la la-trash text-danger"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
                    <a href="javascript:;" class="btn btn-sm btn-light-danger font-weight-bold btn-remove-office"><i
                            class="la la-trash-o"></i> Remove</a>
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
                        <input type="text" class="form-control field-map"
                            placeholder="https://www.google.com/maps/embed?...">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Google Review URL (Direct Link)</label>
                        <input type="text" class="form-control field-review" placeholder="https://g.page/r/...">
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

<!-- Testimonial Modal -->
<div class="modal fade" id="modalTestimonial" tabindex="-1" role="dialog" aria-labelledby="modalTestimonialLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.settings.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="testimonial_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTestimonialLabel">Add Testimonial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Client Name <span class="text-danger">*</span></label>
                            <input type="text" name="client_name" id="tm_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Client Position/City</label>
                            <input type="text" name="client_position" id="tm_position" class="form-control"
                                placeholder="e.g. CEO, From Lahore">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Rating <span class="text-danger">*</span></label>
                            <select name="rating" id="tm_rating" class="form-control" required>
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Source <span class="text-danger">*</span></label>
                            <select name="source" id="tm_source" class="form-control" required>
                                <option value="manual">Manual Entry</option>
                                <option value="google">Google Review</option>
                                <option value="form">Website Form</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Office City</label>
                            <input type="text" name="office_city" id="tm_city" class="form-control"
                                placeholder="e.g. Lahore">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Review Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="tm_content" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Client Image</label>
                            <input type="file" name="client_image" class="form-control border-0 px-0">
                            <small class="text-muted">Recommended: Square image 100x100px</small>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Status</label>
                            <select name="status" id="tm_status" class="form-control">
                                <option value="approved">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group d-flex align-items-center mt-5">
                            <label class="checkbox checkbox-outline checkbox-success mb-0">
                                <input type="checkbox" name="is_featured" id="tm_featured">
                                <span></span>&nbsp;Featured
                            </label>
                        </div>
                        <div class="col-md-4 form-group d-flex align-items-center mt-5">
                            <label class="checkbox checkbox-outline checkbox-primary mb-0">
                                <input type="checkbox" name="display_on_homepage" id="tm_homepage">
                                <span></span>&nbsp;Show on Homepage
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        'use strict';

        // File Input Initialization
        var avatar1 = new KTImageInput('kt_image_logo');
        var avatar2 = new KTImageInput('kt_image_favicon');

        $(document).ready(function () {
            // Tab Persistence
            var activeTab = $('#active_tab').val();
            if (activeTab) {
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
            $('#btn-add-office').on('click', function () {
                var index = container.find('.office-item').length;
                var $newItem = $(template);

                // Set Names with Index
                $newItem.find('.field-city').attr('name', 'office_locations[' + index + '][city]');
                $newItem.find('.field-title').attr('name', 'office_locations[' + index + '][title]');
                $newItem.find('.field-phone').attr('name', 'office_locations[' + index + '][phone]');
                $newItem.find('.field-map').attr('name', 'office_locations[' + index + '][map_url]');
                $newItem.find('.field-review').attr('name', 'office_locations[' + index + '][google_review_url]');
                $newItem.find('.field-address').attr('name', 'office_locations[' + index + '][address]');

                $newItem.find('.card-title').text('Office #' + (index + 1));

                container.append($newItem);
            });

            // Remove Office
            $(document).on('click', '.btn-remove-office', function () {
                $(this).closest('.office-item').remove();
            });

            // Auto-extract Iframe SRC for Map inputs
            $(document).on('input paste', '.field-map, input[name*="[map_url]"]', function () {
                var input = $(this);
                setTimeout(function () {
                    var val = input.val();
                    // Check if input looks like an iframe tag
                    if (val.trim().startsWith('<iframe') && val.includes('src="')) {
                        // Create a dummy element to parse the HTML string
                        var $temp = $('<div>').html(val);
                        var src = $temp.find('iframe').attr('src');

                        if (src) {
                            input.val(src);
                            // Optional: Show a small toast notification
                            toastr.success('Map URL extracted successfully!');
                        }
                    }
                }, 100);
            });
        });

        // Testimonial Logic
        function resetTestimonialForm() {
            $('#testimonial_id').val('');
            $('#modalTestimonialLabel').text('Add Testimonial');
            $('#modalTestimonial form')[0].reset();
        }

        function editTestimonial(tm) {
            resetTestimonialForm();
            $('#testimonial_id').val(tm.id);
            $('#modalTestimonialLabel').text('Edit Testimonial');
            $('#tm_name').val(tm.client_name);
            $('#tm_position').val(tm.client_position);
            $('#tm_rating').val(tm.rating);
            $('#tm_source').val(tm.source);
            $('#tm_city').val(tm.office_city);
            $('#tm_content').val(tm.content);
            $('#tm_status').val(tm.status);
            $('#tm_featured').prop('checked', !!tm.is_featured);
            $('#tm_homepage').prop('checked', !!tm.display_on_homepage);
            $('#modalTestimonial').modal('show');
        }

        $(document).on('click', '.delete-testimonial', function () {
            var id = $(this).data('id');
            var btn = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "This testimonial will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("admin/settings/testimonials") }}/' + id,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function (res) {
                            btn.closest('tr').fadeOut();
                            Swal.fire('Deleted!', res.message, 'success');
                        }
                    });
                }
            });
        });

        // Feedback Logic
        $(document).on('click', '.mark-read', function () {
            var id = $(this).data('id');
            var btn = $(this);
            $.ajax({
                url: '{{ url("admin/settings/feedback/read") }}/' + id,
                type: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function () {
                    $('#fb-row-' + id).removeClass('bg-light-warning');
                    btn.remove();
                    toastr.success('Marked as read');
                }
            });
        });

        $(document).on('click', '.delete-feedback', function () {
            var id = $(this).data('id');
            var btn = $(this);
            if (confirm('Delete this feedback?')) {
                $.ajax({
                    url: '{{ url("admin/settings/feedback") }}/' + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (res) {
                        btn.closest('tr').fadeOut();
                        toastr.error(res.message);
                    }
                });
            }
        });

    </script>
@endpush