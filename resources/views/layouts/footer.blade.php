<div class="nk-footer">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> &copy; {{ date('Y') }} Abhishek Chauhan.
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalSmall">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="img" />
            </div>
        </div>
    </div>
</div>

@if (Session::has('type') && Session::has('message'))
    <script>
        $(document).ready(function () {
            toastr.clear();
            NioApp.Toast("{{ Session::get('message') }}", "{{ Session::get('type') }}", {
                position: 'top-right'
            });
        });
    </script>
@endif
<script>
    function imgModal(src) {
        $("#img").attr('src', src)
        $("#modalSmall").modal('show');
    }
</script>