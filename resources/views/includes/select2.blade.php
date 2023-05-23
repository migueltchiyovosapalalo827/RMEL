<!-- Push section css -->

@section('css')
@parent

  <link rel="stylesheet" href="{{asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

<!-- Push section js -->
@section('js')
@parent
  <script src="{{asset('public/plugins/select2/js/select2.min.js')}}"></script>
    <script>
        $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        })
    </script>
@endsection

