<form method="post" action="{{ url('/empleado/' . $empleado->id) }}" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('empleado.form' , ['modo'=>'Editar']);
</form>
