@extends('layouts.public')

@section('title', 'Wafid - Medical Examination')

@section('content')

    <style>
        /* Loader Styles */
        #loaderOverlay {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        #loaderOverlay.show { display: flex; }

        /* --- TABLE STYLES --- */
        .table-responsive {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border-radius: 4px;
            margin-top: 20px;
            border: 1px solid #dee2e6;
        }

        .table {
            margin-bottom: 0;
            font-size: 0.8rem; /* Slightly smaller font to fit content */
            width: 100%;
        }

        /* --- DESKTOP SPECIFIC (No Scroll) --- */
        @media (min-width: 992px) {
            .table-responsive {
                overflow-x: visible; /* Disable scroll on desktop */
            }
            .table {
                table-layout: fixed; /* Forces table to fit screen exactly */
            }
            .table td {
                word-wrap: break-word; /* Wraps text to next line */
                white-space: normal;
                overflow-wrap: break-word;
            }
        }

        /* --- MOBILE SPECIFIC (Scrollable) --- */
        @media (max-width: 991px) {
            .table-responsive {
                overflow-x: auto; /* Enable scroll on mobile */
            }
            .table thead th {
                white-space: nowrap; /* Keep headers in one line on mobile */
            }
        }

        /* Header Styling */
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            padding: 12px 8px;
            font-size: 0.8rem;
        }

        .table thead th:hover {
            background-color: #e2e6ea;
        }

        .table td {
            vertical-align: top;
            padding: 8px;
        }

        /* Column Widths (Percentages to ensure fit on Desktop) */
        .col-name { width: 18%; }
        .col-country { width: 8%; text-align: center; }
        .col-city { width: 10%; }
        .col-address { width: 16%; } /* Wider for address */
        .col-phone { width: 12%; }
        .col-email { width: 14%; }
        .col-web { width: 8%; }
        .col-rating { width: 14%; }

        /* Sort Icons */
        .sort-icon {
            font-size: 0.7rem;
            margin-left: 3px;
            color: #ccc;
            float: right;
            margin-top: 3px;
        }
        .sort-active { color: #333; }

        /* Links & Extras */
        .map-link { color: #212529; text-decoration: underline; font-weight: 600; }
        .map-link:hover { color: #0056b3; }
        
        .country-flag { width: 18px; display: block; margin: 0 auto 3px auto; }
        
        .star-gold { color: #ffc107; }
        .star-grey { color: #e4e5e9; }
        
        /* Rating stars wrapper to prevent breaking */
        .star-rating {
            display: flex;
            align-items: center;
            flex-wrap: wrap; 
        }
        .rating-number { font-size: 0.7rem; color: #777; margin-left: 3px; }

        /* Pagination */
        .pagination-wrapper { padding: 15px; background: #fff; border-top: 1px solid #dee2e6; }
        .page-link { cursor: pointer; color: #333; }
        .page-item.active .page-link { background-color: #333; border-color: #333; color: #fff; }
    </style>

    <!-- Page Header -->
    <section class="page-header bg-dark text-white py-5">
        <div class="container">
            <h1>Medical Examinations</h1>
            <p class="lead">Book your health check-up appointment or view your test results</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container"> <!-- Custom fluid container -->
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    
                    <!-- Search Form -->
                    <div class="appointment-form-wrapper" style="max-width: 1140px; margin: 0 auto;">
                        <form id="appointmentForm" class="appointment-form">
                            @csrf
                            <div class="form-section">
                                <h5 class="section-title">Medical Center Search</h5>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="country">Country</label>
                                        <select class="form-control" id="country" name="country">
                                            <option value="Pakistan">Pakistan</option>                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="city">City</label>
                                        <select name="city" class="form-control" id="city">
                                            <option value="">Select City</option>
                                            <option value="bahawalpur">Bahawalpur</option>
                                            <option value="chakdara">Chakdara</option>
                                            <option value="faisalabad">Faisalabad</option>
                                            <option value="gujranwala">Gujranwala</option>
                                            <option value="gwadar">Gwadar</option>
                                            <option value="islamabad">Islamabad</option>
                                            <option value="karachi">Karachi</option>
                                            <option value="khuzdar">Khuzdar</option>
                                            <option value="lahore">Lahore</option>
                                            <option value="multan">Multan</option>
                                            <option value="panjgur">Panjgur</option>
                                            <option value="peshawar">Peshawar</option>
                                            <option value="quetta">Quetta</option>
                                            <option value="rawalpindi">Rawalpindi</option>
                                            <option value="sahiwal">Sahiwal</option>
                                            <option value="sialkot">Sialkot</option>
                                            <option value="turbat">Turbat</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="center_name">Medical center name</label>
                                        <input type="text" class="form-control" name="center_name" id="center_name">
                                    </div>
                                </div>
                            </div>                            

                            <div class="">
                                <button type="submit" class="btn btn-dark">Search</button>
                                <button type="reset" id="resetBtn" class="btn btn-outline-dark">Reset</button>
                            </div>
                        </form>
                    </div>

                    <!-- Dynamic Results Area -->
                    <div id="resultsArea" style="display:none;">
                        
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="resultsTable">
                                <thead>
                                    <tr>
                                        <th class="col-name" data-col="medical_center">
                                            Center Name <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-country" data-col="country">
                                            Country <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-city" data-col="city">
                                            City <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-address" data-col="address_line_1">
                                            Address <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-phone" data-col="phone">
                                            Phone <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-email" data-col="email">
                                            E-mail <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-web" data-col="website">
                                            Web <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                        <th class="col-rating" data-col="rating">
                                            Rating <i class="fas fa-sort sort-icon"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="resultsTableBody">
                                    <!-- Rows injected via JS -->
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="pagination-wrapper d-flex justify-content-between align-items-center flex-wrap">
                                <div class="text-muted small mb-2 mb-md-0" id="entriesInfo"></div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0" id="paginationLinks"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- No Results -->
                    <div id="noResults" class="alert alert-warning text-center mt-4" style="display:none;">
                        No medical centers found matching your criteria.
                    </div>

                </div>
            </div>
        </div>

        <!-- Loader -->
        <div id="loaderOverlay">
            <div class="loader-content text-center">
                <div class="spinner-border text-light" role="status" style="width: 4rem; height: 4rem;">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="text-light mt-3" style="font-size: 1.5rem;">Loading...</div>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('appointmentForm');
            const loader = document.getElementById('loaderOverlay');
            const resultsArea = document.getElementById('resultsArea');
            const tableBody = document.getElementById('resultsTableBody');
            const noResults = document.getElementById('noResults');
            const resetBtn = document.getElementById('resetBtn');
            const paginationLinks = document.getElementById('paginationLinks');
            const entriesInfo = document.getElementById('entriesInfo');
            const headers = document.querySelectorAll('#resultsTable th[data-col]');

            let state = {
                page: 1,
                sortBy: 'medical_center',
                sortOrder: 'asc'
            };

            const showLoader = () => loader.classList.add('show');
            const hideLoader = () => loader.classList.remove('show');

            async function fetchResults() {
                showLoader();
                
                const formData = new FormData(form);
                formData.append('page', state.page);
                formData.append('sort_by', state.sortBy);
                formData.append('sort_order', state.sortOrder);

                try {
                    const response = await fetch("{{ route('medical.search') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                            "Accept": "application/json"
                        },
                        body: formData
                    });

                    const json = await response.json();

                    if (json.status === 'success') {
                        renderTable(json.data);
                    } else {
                        alert('Error retrieving data.');
                    }
                } catch (err) {
                    console.error(err);
                    alert('Network error.');
                } finally {
                    hideLoader();
                }
            }

            function renderTable(paginator) {
                tableBody.innerHTML = '';
                paginationLinks.innerHTML = '';

                if (paginator.data.length > 0) {
                    resultsArea.style.display = 'block';
                    noResults.style.display = 'none';

                    entriesInfo.innerText = `Showing ${paginator.from} to ${paginator.to} of ${paginator.total} entries`;

                    paginator.data.forEach(center => {
                        const row = document.createElement('tr');
                        const flagUrl = 'https://flagcdn.com/w40/pk.png';
                        
                        // Google Maps Link
                        const mapQuery = encodeURIComponent(center.medical_center + ' ' + center.city);
                        const mapLink = `https://www.google.com/maps/search/?api=1&query=${mapQuery}`;

                        let fullAddress = center.address_line_1 || '';
                        if(center.address_line_2) fullAddress += ', ' + center.address_line_2;

                        row.innerHTML = `
                            <td>
                                <a href="${mapLink}" target="_blank" class="map-link" title="View on Map">
                                    ${center.medical_center}
                                </a>
                            </td>
                            <td class="text-center">
                                <img src="${flagUrl}" class="country-flag" alt="PK">
                            </td>
                            <td>${center.city}</td>
                            <td>${fullAddress || '-'}</td>
                            <td>${center.phone || '-'}</td>
                            <td style="word-break: break-all;">${center.email || '-'}</td>
                            <td>
                                ${center.website ? `<a href="${center.website}" target="_blank" style="color:#007bff;"><i class="fas fa-link"></i></a>` : '-'}
                            </td>
                            <td>${getStarRatingHtml(center.rating)}</td>
                        `;
                        tableBody.appendChild(row);
                    });

                    renderPagination(paginator);
                    resultsArea.scrollIntoView({ behavior: 'smooth', block: 'start' });

                } else {
                    resultsArea.style.display = 'none';
                    noResults.style.display = 'block';
                }
            }

            function renderPagination(data) {
                let html = '';
                html += `<li class="page-item ${data.prev_page_url ? '' : 'disabled'}">
                            <a class="page-link" onclick="changePage(${data.current_page - 1})">Prev</a>
                         </li>`;

                for (let i = 1; i <= data.last_page; i++) {
                    if (i == 1 || i == data.last_page || (i >= data.current_page - 1 && i <= data.current_page + 1)) {
                         const active = i === data.current_page ? 'active' : '';
                         html += `<li class="page-item ${active}">
                                    <a class="page-link" onclick="changePage(${i})">${i}</a>
                                  </li>`;
                    } else if (i == data.current_page - 2 || i == data.current_page + 2) {
                         html += `<li class="page-item disabled"><a class="page-link">...</a></li>`;
                    }
                }

                html += `<li class="page-item ${data.next_page_url ? '' : 'disabled'}">
                            <a class="page-link" onclick="changePage(${data.current_page + 1})">Next</a>
                         </li>`;

                paginationLinks.innerHTML = html;
            }

            function getStarRatingHtml(rating) {
                let html = '<div class="star-rating">';
                const score = parseFloat(rating) || 0;
                for (let i = 1; i <= 5; i++) {
                    html += (i <= score) 
                        ? '<i class="fas fa-star star-gold" style="font-size:0.7rem;"></i>' 
                        : '<i class="fas fa-star star-grey" style="font-size:0.7rem;"></i>';
                }
                html += `<span class="rating-number">(${score})</span></div>`;
                return html;
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                state.page = 1;
                fetchResults();
            });

            resetBtn.addEventListener('click', function() {
                resultsArea.style.display = 'none';
                noResults.style.display = 'none';
                state.page = 1;
                state.sortBy = 'medical_center';
                state.sortOrder = 'asc';
                updateHeaderVisuals();
            });

            headers.forEach(th => {
                th.addEventListener('click', function() {
                    const col = this.getAttribute('data-col');
                    if (state.sortBy === col) {
                        state.sortOrder = state.sortOrder === 'asc' ? 'desc' : 'asc';
                    } else {
                        state.sortBy = col;
                        state.sortOrder = 'asc';
                    }
                    updateHeaderVisuals();
                    fetchResults();
                });
            });

            function updateHeaderVisuals() {
                headers.forEach(th => {
                    const icon = th.querySelector('.sort-icon');
                    icon.className = 'fas sort-icon fa-sort';
                    icon.classList.remove('sort-active');
                    if (th.getAttribute('data-col') === state.sortBy) {
                        icon.classList.add('sort-active');
                        icon.className = state.sortOrder === 'asc' 
                            ? 'fas sort-icon fa-sort-up sort-active' 
                            : 'fas sort-icon fa-sort-down sort-active';
                    }
                });
            }

            window.changePage = function(page) {
                if(page < 1) return;
                state.page = page;
                fetchResults();
            };
        });
    </script>
@endsection