<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransaccionesRequest;
use App\Http\Requests\UpdateTransaccionesRequest;
use App\Repositories\TransaccionesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Transacciones;
use DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class TransaccionesController extends AppBaseController
{
    /** @var  TransaccionesRepository */
    private $transaccionesRepository;

    public function __construct(TransaccionesRepository $transaccionesRepo)
    {
        $this->middleware('permission:transacciones-list', ['only' => ['index']]);
        $this->middleware('permission:transacciones-show', ['only' => ['show']]);
        $this->middleware('permission:transacciones-create', ['only' => ['create','store']]);
        $this->middleware('permission:transacciones-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:transacciones-delete', ['only' => ['destroy']]);
        $this->transaccionesRepository = $transaccionesRepo;
        
    }

    /**
     * Display a listing of the Transacciones.
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
      $hasFilter = false;
      $transacciones = null;
      $alumno = Input::get('alumnos');
      $evento = Input::get('eventos');

      // eliminamos validaciones innecesarias y ponemos la fecha de hoy por defecto en ambas variables
      $f1 = $f2 = null;//date('Y-m-d');

      if(! is_null($request->fechaInicial) || ! empty($request->fechaInicial) && ! is_null($request->fechaFinal) || ! empty($request->fechaFinal))
      {
          $f1 = $request->fechaInicial;
          $f2 = $request->fechaFinal;
          $hasFilter = true;

      }
      elseif (is_null($request->fechaFinal) || empty($request->fechaFinal))
      {
        $f2 = date('Y-m-d');
      }

      if (!is_null($request->fechaInicial) || !is_null($request->fechaFinal) || !is_null($request->alumnos) || !is_null($request->eventos))
      {
        $hasFilter = true;
      }


      // Seleccion de datos SIN FILTRO (Para el SELECT)
      if (\Auth::user()->hasRole('admin'))
      {
        $transaccionesCompleto = DB::table('transaccionesView')
            ->orderBy('fechaEvento', 'DESC')
            ->get();
      }
      else if (\Auth::user()->hasRole('member'))
      {
          
        $transaccionesCompleto = DB::table('transaccionesView')
            ->where('nombre','Becas I')
            ->orWhere('nombre', 'Becas II')
            ->orWhere('nombre', 'Intervencion Agil I')
            ->orWhere('nombre','Intervencion Agil II')
            ->orderBy('fechaEvento', 'DESC')
            ->get();
            //echo $transaccionesCompleto;
      }
      else if (\Auth::user()->hasRole('user'))
      {
        $transaccionesCompleto = DB::table('transaccionesView')
            ->where('nombreProfesor',str_before(\Auth::user()->email,'@'))
            ->orderBy('fechaEvento', 'DESC')
            ->get();
      }

      // Seleccion de datos con FILTRO
      if (\Auth::user()->hasRole('admin') ||\Auth::user()->hasRole('member'))
      {
        $query = DB::table('transaccionesView');

        if (!is_null($f1) && is_null($f2)) {
          $f2 = date('Y-m-d');
          $query->whereBetween('fechaEvento', [Carbon::parse($f1)->startOfDay(), Carbon::parse($f2)->endOfDay()]);
        }
        if (is_null($f1) && !is_null($f2)) {
          $query->where('fechaEvento', '<=', Carbon::parse($f2)->endOfDay());
        }
        if (!is_null($f1) && !is_null($f2)) {
          $query->whereBetween('fechaEvento', [Carbon::parse($f1)->startOfDay(), Carbon::parse($f2)->endOfDay()]);
        }

        if ($evento != null) {
          $query->where('nombre',$evento);
        }
        if ($alumno != null) {
          $query->where('idPersona',$alumno);
        }

        $transacciones = $query->orderBy('fechaEvento', 'DESC')
            ->get();
      }



      if (is_null($transacciones))
      {
        return view('transacciones.index', ["hasFilter" => $hasFilter]);
      }
      else
      {
        return view('transacciones.index', ["hasFilter" => $hasFilter, "transacciones" => $transacciones, "f1" => $f1, "f2" => $f2, "transaccionesCompleto" => $transaccionesCompleto]);
      }

    }

    /**
     * Show the form for creating a new Transacciones.
     *
     * @return Response
     */
    public function create()
    {
        return view('transacciones.create');
    }

    /**
     * Store a newly created Transacciones in storage.
     *
     * @param CreateTransaccionesRequest $request
     *
     * @return Response
     */
    public function store(CreateTransaccionesRequest $request)
    {
        $input = $request->all();

        $transacciones = $this->transaccionesRepository->create($input);

        Flash::success('Transacciones saved successfully.');

        return redirect(route('transacciones.index'));
    }

    /**
     * Crear Transacciones a traves de los datos de apk.
     *
     * @param Request $request
     * @return Response
     */
    public function registrarTransaccion(Request $resultado)
    {

        $respon = array("valid" => false,"horasAlumno"=>'',"horasTotales"=>'');
        $horasAlumno = "";
        $horasTotales = "";

        //Comprueba si la variable $datos contiene información, si el contenido es diferente de vacío entra al if.
        if ($resultado != "")
        {
            //creacion de un nuevo array con las mismas "keys" del POST.
            $valores = ["idPersona" => $resultado['idPersona'], "idEvento" => $resultado['idEvento'],"fecha"=>$resultado['fecha'],"tipoRegistro"=>$resultado['tipoRegistro'],"esPar"=>$resultado['esPar'] ,"validado"=>$resultado['validado'],"valido" =>$resultado['valido']];
           // $valores = ["idPersona" => "lazaro.hernandez", "idEvento" => "1","fecha"=>"2018-03-19 10:00:00","tipoRegistro"=>"Profesor","esPar"=>true ,"validado"=>"1","valido" =>true];


            if ($valores['valido'] == true)
            {
                //Creamos la transaccion y la insertamos
                $transaccion= new Transacciones();
                $transaccion->idPersona=$valores['idPersona'];
                $transaccion->idEvento=$valores['idEvento'];
                $transaccion->fechaEvento=$valores['fecha'];
                $transaccion->tipo=$valores['tipoRegistro'];
                $transaccion->validado=$valores['validado'];
                $transaccion->save();


                if($transaccion->tipo=="Alumno"){

                    if($valores['esPar'] ==true){

                        $transaccionImpar= new Transacciones();
                        $transaccionImpar=Transacciones::where('idPersona',$transaccion->idPersona)->where('idEvento',$transaccion->idEvento)->where('tipo',"Alumno")->orderBy('fechaEvento', 'desc')->take(1)->skip(1)->get()->first();

                         DB::update('update resumen_alumnos set validado=:validado, horas = cast( TIMESTAMPDIFF(minute, :fechaInicio, :fechaFin) /60 as  decimal(5,2)) where idAlumno = :idPersona and idEvento=:idEvento and fechaEvento=cast(:fechaEvento as Date) and horas=-1', ['idPersona' =>$transaccion->idPersona,'idEvento'=>$transaccion->idEvento,'fechaEvento'=>$transaccion->fechaEvento,'fechaInicio'=>$transaccionImpar->fechaEvento,'fechaFin'=>$transaccion->fechaEvento,'validado'=>$transaccion->validado]);
                         if ($transaccion->idEvento==207 || $transaccion->idEvento==208 || $transaccion->idEvento==220 ||$transaccion->idEvento==221) {

                            $horasAlumno = DB::select("SELECT SUM(horas) as horas FROM resumen_alumnos WHERE idEvento=:idEvento and idAlumno=:idAlumno and week(fechaEvento)=week(curdate())",['idEvento'=>$transaccion->idEvento,'idAlumno'=>$transaccion->idPersona]);

                         } else {
                            $horasAlumno = DB::select("SELECT SUM(horas) as horas FROM resumen_alumnos WHERE idEvento=:idEvento and idAlumno=:idAlumno",['idEvento'=>$transaccion->idEvento,'idAlumno'=>$transaccion->idPersona]);

                         }

                         $horasTotales = DB::select("SELECT SUM(horas) as horas FROM resumen_eventos WHERE idEvento=:idEvento and horas>-1",['idEvento'=>$transaccion->idEvento]);
                    }else{

                        DB::insert('insert into resumen_alumnos (idAlumno, idEvento,fechaEvento,horas,validado) values (?, ?, ?, ?, ?)', [$transaccion->idPersona, $transaccion->idEvento,$transaccion->fechaEvento,'-1',$transaccion->validado]);


                    }

                }elseif($transaccion->tipo=="Profesor"){



                     if($valores['esPar'] ==true){

                        $transaccionImpar= new Transacciones();
                        $transaccionImpar=Transacciones::where('idPersona',$transaccion->idPersona)->where('idEvento',$transaccion->idEvento)->where('tipo',"Profesor")->orderBy('fechaEvento', 'desc')->take(1)->skip(1)->get()->first();

                        DB::update('update resumen_eventos set horas = cast( TIMESTAMPDIFF(minute, :fechaInicio, :fechaFin) /60 as  decimal(5,2)) where  idEvento=:idEvento and fechaEvento=cast(:fechaEvento as Date) and horas=-1', ['idEvento'=>$transaccion->idEvento,'fechaEvento'=>$transaccion->fechaEvento,'fechaInicio'=>$transaccionImpar->fechaEvento,'fechaFin'=>$transaccion->fechaEvento]);


                    }else{

                        DB::insert('insert into resumen_eventos (idEvento,fechaEvento,horas) values (?, ?, ?)', [ $transaccion->idEvento,$transaccion->fechaEvento,'-1']);
                    }

                }





                $respon = array("valid" => true,"horasAlumno"=>$horasAlumno,"horasTotales"=>$horasTotales);
            }


        }
         header('Content-Type: application/json');
        return json_encode($respon);
    }

    /**
     * Display the specified Transacciones.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transacciones = $this->transaccionesRepository->findWithoutFail($id);

        if (empty($transacciones)) {
            Flash::error('Transacciones not found');

            return redirect(route('transacciones.index'));
        }

        return view('transacciones.show')->with('transacciones', $transacciones);
    }

    /**
     * Show the form for editing the specified Transacciones.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transacciones = $this->transaccionesRepository->findWithoutFail($id);

        if (empty($transacciones)) {
            Flash::error('Transacciones not found');

            return redirect(route('transacciones.index'));
        }

        return view('transacciones.edit')->with('transacciones', $transacciones);
    }

    /**
     * Update the specified Transacciones in storage.
     *
     * @param  int              $id
     * @param UpdateTransaccionesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransaccionesRequest $request)
    {
        $transacciones = $this->transaccionesRepository->findWithoutFail($id);

        if (empty($transacciones)) {
            Flash::error('Transacciones not found');

            return redirect(route('transacciones.index'));
        }

        $transacciones = $this->transaccionesRepository->update($request->all(), $id);

        Flash::success('Transacciones updated successfully.');

        return redirect(route('transacciones.index'));
    }

    /**
     * Remove the specified Transacciones from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //$transacciones = $this->transaccionesRepository->findWithoutFail($id);
        $transacciones=DB::table('transacciones')->find($id);

        if (empty($transacciones)) {
            Flash::error('Transacciones not found');

            return redirect(route('transacciones.index'));
        }

        //$this->transaccionesRepository->delete($id);
        DB::table('transacciones')->delete($id);

        Flash::success('Transacciones deleted successfully.');

        return redirect(route('transacciones.index'));
    }
}
