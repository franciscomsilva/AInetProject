@extends('layouts.app')

@section('title', 'Mudar Password')


@section('content')

    <div>
        <form action="{{route('user.updatePassword')}}" method="post" class="form-group">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <div class="form-group">
                <div class="form-group">
                    <label for="old_password">Password Antiga</label>
                    <input
                            type="password" class="form-control"
                            name="old_password" id="old_password"
                            placeholder="Password Antiga"/>
                    <br>
                    <label for="new_password">Password Nova</label>
                    <input
                            type="password" class="form-control"
                            name="password" id="new_password"
                            placeholder="Password Nova"/>
                    <br>
                    <label for="new_password_conf">Confirmação Password Nova</label>
                    <input
                            type="password" class="form-control"
                            name="password_conf" id="new_password_conf"
                            placeholder="Confirmação Password Nova"/>

            </div>
                <button type="submit" class="btn btn-success" name="ok">Alterar</button>
                <a type="submit" class="btn btn-default" href="{{route('user.home')}}">Cancelar</a>
        </form>
    </div>
@endsection
