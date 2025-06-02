<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Matriculas; 
use App\Models\Estudiantes; 
use App\Models\Materias; 

class MatriculaComponent extends Component
{
    public $carnet, $materia;
    public $inscritas = [];

    public function render()
    {     
        return view('livewire.matricula-component');
    }

    protected $rules = [
        'carnet' => 'required',
        'materia' => 'required',
    ];

    public function store(){
        $this->validate();

        $estudiante = Estudiantes::where('carnet',$this->carnet)->first();
        $materia = Materias::where('codigo',$this->materia)->first();

        if(!empty($estudiante) and !empty($materia)){
            $matricula = Matriculas::where(['id_materia'=> $materia->id, 'id_estudiante'=> $estudiante->id])->first();
            if(empty($matricula)){
                $matricula = new Matriculas();
                $matricula->id_estudiante = $estudiante->id;
                $matricula->id_materia = $materia->id;
                $matricula->fecha = now();
                $matricula->created_at = now();

                $matricula->save();
                session()->flash('state', 'La materia ha sido inscrita.');
            } else {
                session()->flash('state', 'La materia ya está inscrita.');
            }
            $this->showSubjectsByCarnet();
        } else {
            if(empty($estudiante) || empty($materia)){ 
                session()->flash('state', 'Revise su carnet y código de materia.');
            }
            $this->inscritas = [];
        }        
    }

    public function showSubjectsByCarnet(){        
        $data = Matriculas::select('materias.nombre as materia', 'materias.codigo as codigo', 'matriculas.id as id')
        ->join('estudiantes','estudiantes.id','=','matriculas.id_estudiante')
        ->join('materias','materias.id','=','matriculas.id_materia')
        ->where('estudiantes.carnet', $this->carnet)
        ->get();
        // dd($data);   
        $this->inscritas = $data;     
    }

    public function erase($id){
        // dd($id);
        $matricula = Matriculas::find($id)->first();
        $matricula->delete();

        $this->showSubjectsByCarnet();
        session()->flash('state', 'Materia eliminada.');
    }
}
