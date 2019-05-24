<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach

</div>