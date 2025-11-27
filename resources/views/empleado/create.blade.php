<form method="post" action="{{ url('/empleado') }}" enctype="multipart/form-data">
    @csrf
    @include('empleado.form',['modo'=>'Crear'])
</form>
