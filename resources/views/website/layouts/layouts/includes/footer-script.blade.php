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

        // chatboat

        // press enter on keyboad to send the chat
        $(".chatbot_send_msg_textarea").trigger('click');

            $(".chatbot_send_msg_textarea").keypress(function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            //alert(code);
            if (code == 13) {
                send_chatboat_text();
            }

        });

        $(document).on('click', '.chatbot_send_msg_btn', function() {
            send_chatboat_text();
        })

        function send_chatboat_text() {

            var search_query = $('.chatbot_send_msg_textarea').val();

            avatar_url = '{{ URL::asset('img/useravatar') }}';

            bot_avatar_url = '{{ URL::asset('img/icons/avatar/chatbot_avatar.png') }}';

            var sender_msg = '<div class="d-flex flex-row justify-content-end p-3 pb-2">'+
                    '<div class="chat_sender">' + 
                        search_query +
                    '</div>' +
                    '<img class="chatbot_avatar" src=' + avatar_url + '/{{ Auth::user()->avatar }}>'
                '</div>';
                             
            $('.chatboat_body').append(sender_msg);
            $('.chatbot_send_msg_textarea').val('')

            if (search_query != "") {

                var url = "{{ route('sett.chatboat', ':id') }}";
                url = url.replace(':id', search_query);

                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        if (data !== "") {
                            var html = ''
                            console.log('www');

                            var url_show =
                                "{{ route('sett.managers.show', ':id') }}";
                            url_show = url_show.replace(':id', data.id);
                         
                            console.log(data);
                            html +=
                            '<div class="d-flex flex-row p-3 pb-2">'+
                                '<img class="chatbot_avatar" src="' + bot_avatar_url + '">' +
                                '<div class="chat_receiver">' + 
                                    data.result
                                '</div>' +
                            '</div>';
                             
                            $('.chatboat_body').append(html);
                        }

                        if (data == "") {
                            $('#chatboat_body').html(
                                '<a class="list-group-item list-group-item-action border-0"><i class="fas fa-search text-gray-200 me-2"></i>No Record</a>'
                            );
                        }
                    },
                });
            } else {
                console.log('wwwa');

                $("#search-eng-show-list_topbar").empty();
            }
            console.log('21212');

            $('.chatboat_body').scrollTop($('.chatboat_body')[0].scrollHeight);
            $(".chatboat_body").animate({ scrollTop: $('.chatboat_body').prop("scrollHeight")}, 1000);

        };

    });
</script>