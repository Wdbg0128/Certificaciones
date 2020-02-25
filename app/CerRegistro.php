<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\MaeCertificado;
use App\MaeEnteCertificador;
use App\Mae_nivel_cer;
use App\Mae_tipo_cer;
use Illuminate\Support\Facades\DB;

class CerRegistro extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cer_registros';


    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Num_Sap', 'maecertificado_id', 'fecha_Expedicion', 'fecha_Fin', 'maeentecertificador_id', 'archivo', 'estado','nivel_id','tipo_id','observacion','fecha_exp_concepto','fecha_fin_concepto','concepto_aptitud','archivo_concepto'];

    // public function datosPersonales()
    // {
    //     $datos = DB::connection('sqlsrv_sap')
    //     ->select('SELECT NUM_SAP,
    //     IDENTIFICACION,
    //     APELLIDOS_NOMBRES,
    //     INF_ORGANIZACIONAL_PA0001_View.BTRTL, --Gerencia
    //     LISTADO_PERSONAL_SAP_TODOS_View.CARGO, --Cargo
    //     INF_ORGANIZACIONAL_PA0001_View.ABKRS, -- AR = ARMADA; ES = TEMPORAL CM= COTECMAR MENSUAL CI= C INDEFINIDOS CF=C FIJOS NL= NOLIQUIDA SM SEMESTRAL
    //     INF_ORGANIZACIONAL_PA0001_View.PERSK, --Tipo de Nomina
    //     INF_ORGANIZACIONAL_PA0001_View.WERKS, -- PLANTA
    //     INF_ORGANIZACIONAL_PA0001_View.STAT2, -- ESTADO NUEVO
    //     INF_ORGANIZACIONAL_PA0001_View.PERSG  --ESTADO VIEJO
    //     FROM LISTADO_PERSONAL_SAP_TODOS_View
    //     JOIN INF_ORGANIZACIONAL_PA0001_View ON LISTADO_PERSONAL_SAP_TODOS_View.NUM_SAP =
    //     INF_ORGANIZACIONAL_PA0001_View.PERNR where(NUM_SAP= ?)',[$this->Num_Sap]);

    //     return $datos;
    // }
    public function datosPersonalesTODOS()
    {
        $datos = DB::connection('sqlsrv_sap')
                ->select('SELECT * FROM LISTADO_PERSONAL_SAP_SENCILLO_View where(PERSG<>5) and (STAT2=3)');
        return response()->json($datos);
    }
    public function certificado()
    {
        return MaeCertificado::where('id',$this->maecertificado_id)->get();
    }
    public function entecertificador()
    {
        return MaeEnteCertificador::where('id',$this->maeentecertificador_id)->get();
    }
    public function tipocertificado()
    {
        return Mae_tipo_cer::where('id',$this->tipo_id)->get();
    }
    public function nivelcertificado()
    {
        return Mae_nivel_cer::where('id',$this->nivel_id)->get();
    }
    public function DatosPersonalesSAP()
    {
        $datos = DB::connection('sqlsrv_sap')
                    ->select('SELECT *
                    FROM LISTADO_PERSONAL_SAP_SENCILLO_View
                     where(NUM_SAP= ?)',[$this->Num_Sap]);
        return response()->json($datos);
    }
}


