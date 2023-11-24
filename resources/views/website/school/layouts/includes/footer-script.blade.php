<!-- bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"
    integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Toastr alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif

    @if (Session::has('errors'))
        toastr.error("{{ session()->get('errors')->first() }}");
    @endif

    @if (Session::has('info'))
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif
</script>


@yield('js')

<!-- own script -->
<script src="{{ URL::asset('js/website.js') }}"></script>

<script>
    //--------------------- search engine ajax -------------------

    $(document).ready(function() {
        // Send Search Text to the server
        $("#search-eng_topbar").keyup(function() {
            let search_query = $(this).val();
            if (search_query != "") {

                var url = "{{ route('sett.pat_patient_search', ':id') }}";
                url = url.replace(':id', search_query);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#search-eng-show-list_topbar").show();

                        if (data !== "") {
                            var html = ''
                            $.each(data, function(key, value) {

                                var url_show =
                                    "{{ route('sett.managers.show', ':id') }}";
                                url_show = url_show.replace(':id', value.id);

                                html +=
                                    '<a href="' + url_show +
                                    '" class="search-eng-a list-group-item list-group-item-action border-1 text-gray-500" style="cursor: pointer;"><i class="fas fa-search text-gray-200 me-2"></i> ' +
                                    value.full_name + '</a>';
                            });
                            $('#search-eng-show-list_topbar').html(html);
                        }

                        if (data == "") {
                            $('#search-eng-show-list_topbar').html(
                                '<a class="list-group-item list-group-item-action border-0"><i class="fas fa-search text-gray-200 me-2"></i>No Record</a>'
                            );
                        }
                    },
                });
            } else {
                $("#search-eng-show-list_topbar").empty();
                $("#search-eng-show-list_topbar").hide();;
            }
        });
    
        $("#search-eng_topbar_small").keyup(function() {
            let search_query = $(this).val();
            if (search_query != "") {

                var url = "{{ route('sett.pat_patient_search', ':id') }}";
                url = url.replace(':id', search_query);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#search-eng-show-list_topbar_small").show();

                        if (data !== "") {
                            var html = ''
                            $.each(data, function(key, value) {

                                var url_show =
                                    "{{ route('sett.managers.show', ':id') }}";
                                url_show = url_show.replace(':id', value.id);

                                html +=
                                    '<a href="' + url_show +
                                    '" class="search-eng-a list-group-item list-group-item-action border-1 text-gray-500" style="cursor: pointer;"><i class="fas fa-search text-gray-200 me-2"></i> ' +
                                    value.full_name + '</a>';
                            });
                            $('#search-eng-show-list_topbar_small').html(html);
                        }

                        if (data == "") {
                            $('#search-eng-show-list_topbar_small').html(
                                '<a class="list-group-item list-group-item-action border-0"><i class="fas fa-search text-gray-200 me-2"></i>No Record</a>'
                            );
                        }
                    },
                });
            } else {
                $("#search-eng-show-list_topbar_small").empty();
                $("#search-eng-show-list_topbar_small").hide();;
            }
        });



        $(document).on('click', ".change_school_sidebar", function(e) {
        e.preventDefault();

            var url = "{{ route('school_route.change_school_sidebar') }}";
            var type = $(this).data('school_type');

            that = this;

            $.ajax({
                url: url
                , type: 'POST'
                , dataType: "json"
                , data: {
                    '_token': "{{ csrf_token() }}"
                    , 'type': type
                , }
                , success: function(data) {
                    if (data.status == true) {
                        toastr.success(data.msg);
                        var delay = 1500;
                        setTimeout(function(){ location.reload() }, delay);
                    } 
                    else {
                        toastr.error(data.msg);
                    }
                }
                , error: function(err) {
                    toastr.error(err.responseJSON.message);
                    //show error message after the input and in toaster
                    $.each(err.responseJSON.errors, function (input_name, error) {
                            var el = $(document).find('#'+input_name+'-js_error_valid');
                            el.html($('<div class="error_ajax_msg" style="color: red;">'+error[0]+'</div>'));
                            toastr.error(error[0]);
                    });

                }
            , });

        });

   

    });
</script>