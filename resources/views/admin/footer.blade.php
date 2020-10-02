<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('bower_components/chart.js/Chart.js')}}"></script>
<!-- page specific scripts -->
@yield('pageSpecificScripts')
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('plugins/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('plugins/jquery.pjax.js')}}"></script>
<script src="{{asset('plugins/polyfill.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.js"
        data-turbolinks-track="true"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
<!-- date-range-picker -->
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
{{-----modal-----}}


<script>
    $("#datepicker_start").datepicker({
        format: 'yyyy-mm-dd',
        value: '2020-01-01'
    });
</script>

<script>
    $("#datepicker_end").datepicker({
        format: 'yyyy-mm-dd',
        defaultValue: '2020-01-05'
    });
</script>
<script>
    function datepicker_caller() {
        document.getElementById("start_time").value = $("#datepicker_start").datepicker({ dateFormat: 'yyyy-mm-dd' }).val();
        document.getElementById("end_time").value =  $("#datepicker_end").datepicker({ dateFormat: 'yyyy-mm-dd' }).val();
    }
</script>

<script>
    $(document).ready(function () {
        $('#ActivationChartID_Model').selectize({
            sortField: 'text'
        });
    });
</script>
<script type="text/javascript">
    $(".num").counterUp({delay: 10, time: 1000});
</script>

<script type="text/javascript">

    $(document).on('pjax:send', function () {
        $('#loading').show()
    })
    $(document).on('pjax:complete', function () {
        $('#loading').hide()
    })


    $(document).ready(function () {
        // does current browser support PJAX
        if ($.support.pjax) {
            $.pjax.defaults.timeout = 2000; // time in milliseconds
        }
    });


</script>


<script type="text/javascript">

    var selectedRows = function () {
        var selected = [];
        $('.grid-row-checkbox:checked').each(function () {
            selected.push($(this).data('id'));
        });

        return selected;
    }

    $('.grid-trash').on('click', function () {
        var ids = selectedRows().join();
        var sent_url = "none";
        sent_url = $(this).attr("data-name");
        console.log(sent_url);
        deleteItem(ids, sent_url);
    });

    function deleteItem(ids, sent_url) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true,
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure to delete this item ?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: "#DD6B55",
            cancelButtonText: 'No, cancel!',
            reverseButtons: true,

            preConfirm: function () {
                console.log(ids);
                return new Promise(function (resolve) {
                    $.ajax({
                        url: window.location.origin + '/' + sent_url + "/" + ids,
                        type: 'DELETE',
                        data: {
                            _token: '{{csrf_token()}}',
                        },
                        success: function (data) {
                            if (data.error == 1) {
                                swalWithBootstrapButtons.fire(
                                    'Cancelled',
                                    data.msg,
                                    'error'
                                )
                                $.pjax.reload('#pjax-container');
                                return;
                            } else {
                                $.pjax.reload('#pjax-container');
                                resolve(data);
                            }
                        }
                    });
                });
            }

        }).then((result) => {
            if (result.value) {
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Item has been deleted.',
                    'success'
                )
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                // swalWithBootstrapButtons.fire(
                //   'Cancelled',
                //   'Your imaginary file is safe :)',
                //   'error'
                // )
            }
        })
    }

</script>


<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>

<script type="text/javascript">
    (function ($) {

        $.fn.filemanager = function (type, options) {
            type = type || 'other';

            this.on('click', function (e) {
                type = $(this).data('type') || type;//sc
                var route_prefix = (options && options.prefix) ? options.prefix : '/sc_admin/uploads';
                var target_input = $('#' + $(this).data('input'));
                var target_preview = $('#' + $(this).data('preview'));
                window.open(route_prefix + '?type=' + type, 'File manager', 'width=900,height=600');
                window.SetUrl = function (items) {
                    var file_path = items.map(function (item) {
                        return item.url;
                    }).join(',');

                    // set the value of the desired input to image url
                    target_input.val('').val(file_path).trigger('change');

                    // clear previous preview
                    target_preview.html('');

                    // set or change the preview image src
                    items.forEach(function (item) {
                        target_preview.append(
                            $('<img>').attr('src', item.thumb_url)
                        );
                    });

                    // trigger change event
                    target_preview.trigger('change');
                };
                return false;
            });
        }

    })(jQuery);

    $('.lfm').filemanager();
</script>

<script>

    // Select row
    $(function () {
        //Enable check and uncheck all functionality
        $(".grid-select-all").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".box-body input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".box-body input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

    });

    // == end select row

    function format_number(n) {
        return n.toFixed(0).replace(/./g, function (c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
    }

    // active tree menu
    $(function () {
        // var route_name = 'admin_user.index';
        // var route_name = route_name.replace(".","_");
        // var obj = $('.'+route_name);
        // obj.addClass('active');
        // obj.parents('.treeview').addClass('active');
        var url = window.location.pathname,
            urlRegExp = new RegExp(url.replace(/\/$/, '') + "$"); // create regexp to match current url pathname and remove trailing
        $('.treeview-menu > li > a').each(function () {
            if (urlRegExp.test(this.href.replace(/\/$/, ''))) {
                $(this).parent().addClass('active');
                $(this).parents('.treeview').addClass('active');
            }
        });
    });
    // ==end active tree menu

</script>


<script type="text/javascript">
    $("[name='top'],[name='status']").bootstrapSwitch();
</script>


<script type="text/javascript">
    $("#for_all_select").select2({
        placeholder: "Select Options",
        allowClear: true
    });
</script>
<script>
    $(document).ready(function () {
        $("#click_for_slow").click(function () {
            $("#showing_password").slideToggle('slow');
            $(this).toggleClass('form-control col-sm-8 btn btn-success btn-block');
            if ($(this).val() == "Update Password") {
                $(this).val('Keep Previous Password');
            } else {
                $(this).val('Update Password');
            }
        });
    });
</script>

<script>
    var preloader = document.getElementById('start_loader');

    function function_start_loader() {
        preloader.style.display = 'none';
    }

    window.onload = function_start_loader;
</script>



