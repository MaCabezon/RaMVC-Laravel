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
class TransaccionesController extends AppBaseController
{
    /** @var  TransaccionesRepository */
    private $transaccionesRepository;

    public function __construct(TransaccionesRepository $transaccionesRepo)
    {
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
        $this->transaccionesRepository->pushCriteria(new RequestCriteria($request));
        $transacciones = $this->transaccionesRepository->all();

        return view('transacciones.index')
            ->with('transacciones', $transacciones);
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
    public function registrarTransaccion()
    {
       //Decodifica el formato json del array y lo guarda en la variable $datos.
        $datos = json_decode(file_get_contents('php://input'), true);
        $respon = array("valid" => false,"horasAlumno"=>'',"horasTotales"=>'');
        $horasAlumno = "";
        $horasTotales = "";
        //Comprueba si la variable $datos contiene información, si el contenido es diferente de vacío entra al if.
        if ($datos != "")
        {
            //creacion de un nuevo array con las mismas "keys" del POST.
            $valores = ["idPersona" => "", "idEvento" => "","fecha"=>"","tipoRegistro"=>"","esPar"=>"" ,"validado"=>"","valido" =>""];

            //LLena cada clave del nuevo array con el valor del POST correspondiente.
           foreach ($datos as $indice => $valor)
            {
                $valores[$indice] = $valor;
            }



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

                       // $transaccionImpar= new Transacciones();
                        $transaccionImpar=Transacciones::where('idPersona',$transaccion->idPersona)->where('idEvento',$transaccion->idEvento)->where('tipo',"Alumno")->orderBy('fechaEvento', 'desc')->take(1)->skip(1)->get()->first();

                         DB::update('update resumen_alumnos set validado=:validado, horas = cast( TIMESTAMPDIFF(minute, :fechaInicio, :fechaFin) /60 as  decimal(5,2)) where idAlumno = :idPersona and idEvento=:idEvento and fechaEvento=cast(:fechaEvento as Date) and horas=-1', ['idPersona' =>$transaccion->idPersona,'idEvento'=>$transaccion->idEvento,'fechaEvento'=>$transaccion->fechaEvento,'fechaInicio'=>$transaccionImpar->fechaEvento,'fechaFin'=>$transaccion->fechaEvento,'validado'=>$transaccion->validado]);
                         $horasAlumno = DB::select("SELECT SUM(horas) FROM resumen_alumnos WHERE idEvento=:idEvento",['idEvento'=>$transaccion->idEvento]);
                    }else{

                        DB::insert('insert into resumen_alumnos (idAlumno, idEvento,fechaEvento,horas,validado) values (?, ?, ?, ?, ?,?)', [$transaccion->idPersona, $transaccion->idEvento,$transaccion->fechaEvento,'-1',$transaccion->validado]);


                    }

                }elseif($transaccion->tipo=="Profesor"){



                     if($valores['esPar'] ==true){

                        $transaccionImpar= new Transacciones();
                        $transaccionImpar=Transacciones::where('idPersona',$transaccion->idPersona)->where('idEvento',$transaccion->idEvento)->where('tipo',"Profesor")->orderBy('fechaEvento', 'desc')->take(1)->skip(1)->get()->first();

                        DB::update('update resumen_eventos set horas = cast( TIMESTAMPDIFF(minute, :fechaInicio, :fechaFin) /60 as  decimal(5,2)) where  idEvento=:idEvento and fecha=:fecha and horas=-1', ['idEvento'=>$transaccion->idEvento,'fecha'=>$transaccion->fechaEvento,'fechaInicio'=>$transaccionImpar->fechaEvento,'fechaFin'=>$transaccion->fechaEvento]);
                        $horasTotales = DB::select("SELECT SUM(horas) FROM resumen_eventos WHERE idEvento=:idEvento",['idEvento'=>$transaccion->idEvento]);

                    }else{

                        DB::insert('insert into resumen_eventos (idEvento,fechaEvento) values (?, ?)', [ $transaccion->idEvento,$transaccion->fechaEvento]);
                    }

                }





                $respon = array("valid" => true,"horasAlumno"=>$horasAlumno,"horasTotales"=>$horasTotales);
            }


        }
        return $respon;
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
        $transacciones = $this->transaccionesRepository->findWithoutFail($id);

        if (empty($transacciones)) {
            Flash::error('Transacciones not found');

            return redirect(route('transacciones.index'));
        }

        $this->transaccionesRepository->delete($id);

        Flash::success('Transacciones deleted successfully.');

        return redirect(route('transacciones.index'));
    }
}
