<div>
    <h1 class="text-center text-primary">Matriculas</h1>
    <form>
        <div class="row">
            <div class="col-lg-6">
                <label for="Carnet">Carnet</label>
                <input type="text" class="form-control" wire:model="carnet">
                @error('carnet')
                    <p class="text-danger text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="col-lg-6">
                <label for="Codigo">Código de materia</label>
                <input type="text" class="form-control" wire:model="materia">
                @error('materia')
                    <p class="text-danger text-center">{{$message}}</p>
                @enderror
            </div>
            <div class="col-lg-12 pt-4 pb-4">
                <button class="btn btn-primary" type="button" wire:click="store">Matricular</button>
                <button class="btn btn-warning" type="button" wire:click="showSubjectsByCarnet">Mostrar inscripción</button>
            </div>
        </div>
    </form>
    <div class="row">
        <h4 class="text-center text-dark">Materias Inscritas</h4>
        <table class="table table-hovered table-bordered">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Código</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($inscritas))
                    @foreach($inscritas as $in)
                        <tr>
                            <td>{{$in->materia}}</td>
                            <td>{{$in->codigo}}</td>
                            <td>
                                <button class="btn btn-danger" wire:click="erase({{$in->id}})">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">No hay materias inscritas</td>
                    </tr>
                @endif                
            </tbody>
        </table>
    </div>

    <div class="row">
        <div-col-lg-12>
            @if(session()->has('state'))
            <p class="text-primary text-center">{{session('state')}}</p>
            @endif
        </div-col-lg-12>
    </div>

</div>
