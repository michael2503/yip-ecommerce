@if(Session::get('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{Session::get('success')}}
</div>
@endif
